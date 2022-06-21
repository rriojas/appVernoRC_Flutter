import 'dart:ffi';

import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:preyecto_tecnologico/src/models/institutionCampusAvailable.dart';
import 'package:preyecto_tecnologico/src/shared/form/myDropdown.dart';
import 'package:preyecto_tecnologico/src/shared/form/myTextFormField.dart';
import 'package:preyecto_tecnologico/src/shared/form/myTextFormBirthday.dart';
import 'package:preyecto_tecnologico/src/shared/showMessage/myShowMessage.dart';
import 'package:reactive_forms/reactive_forms.dart';

import 'package:preyecto_tecnologico/src/pages/modules/student/settingsStudent.dart';

class AddStudentPage extends StatefulWidget {
  final InstitutionCampusAvailable data;

  AddStudentPage({
    Key? key,
    required this.data,
  }) : super(key: key);

  @override
  State<AddStudentPage> createState() => _AddStudentPageState();
}

class _AddStudentPageState extends State<AddStudentPage> {
  late GlobalKey<FormState> _formKey;

  late FormGroup fg;

  Map<String, TextEditingController> textEditingControllers = {};

  var allWidgets = <Widget>[];

  Map<String, FormControl> mapReactiveForm = {};

  String keys = '';
  String label = '';
  final myShowDialog = MyShowMessages();

  @override
  void initState() {
    WidgetsBinding.instance?.addPostFrameCallback((timeStamp) {
      service.getAvailableInstitutions();
    });
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    mapReactiveForm.clear();
    allWidgets.clear();
    textEditingControllers.clear();

    for (int i = 0; i < settingFormAddStudent.length; i++) {
      keys = settingFormAddStudent[i]
          .keys
          .toString()
          .replaceAll('(', '')
          .replaceAll(')', '');
      final validators = settingFormAddStudent[i][keys]?['validators']
          ?.map((e) =>
              e as Map<String, dynamic>? Function(AbstractControl<dynamic>))
          .toList();

      final inputFormatted = settingFormAddStudent[i][keys]?['inputFormatted']
          ?.map((e) => e as TextInputFormatter)
          .toList();

      FormControl<String> item = FormControl(validators: validators!);

      var textEdit = TextEditingController();
      final type = settingFormAddStudent[i][keys]?['type']
          ?.map((e) => e as String)
          .toList();

      label = settingFormAddStudent[i][keys]?['label']
              ?.map((e) => e as String)
              .toList()[0] ??
          '';

      switch (type?[0]) {
        case 'text':
          allWidgets.add(CreateMyTextFormField(
            label: label,
            fcn: keys,
            inputFormated: inputFormatted,
            oscureText: (keys == 'Contraseña' || keys == 'Confirma contraseña')
                ? true
                : false,
          ));
          break;
        case 'drop':
          List<String> items = [];

          if (keys == 'Escuela/Facultad/Centro de investigación') {
            items = widget.data.campus?.map((e) => e.descripcion ?? '').toList()
                as List<String>;
          }
          if (keys == 'Institución') {
            items = widget.data.instituciones
                ?.map((e) => e.descripcion ?? '')
                .toList() as List<String>;
          }
          if (keys == 'Genero') {
            items = ['Masculino', 'Femenino'];
          }

          allWidgets.add(
            MyDropdown(
                fcn: keys,
                label: label,
                stream: service.getInstitutionStream,
                items: items),
          );
          break;
        case 'birth':
          allWidgets.add(
            MyTextFormBirthday(
              label: label,
              fcn: keys,
            ),
          );
          break;
        default:
      }

      mapReactiveForm.putIfAbsent(keys, () => item);

      textEditingControllers.putIfAbsent(keys, () => textEdit);
    }

    allWidgets.addAll([
      SizedBox(
        width: double.infinity,
        height: 50,
        child: ElevatedButton(
          onPressed: validateFormStudent,
          child: const Text(
            'Aceptar',
          ),
        ),
      ),
      TextButton(
        onPressed: () {
          Navigator.pop(context);
        },
        child: const Text(
          'Cancelar',
        ),
      )
    ]);

    fg = FormGroup(mapReactiveForm);

    _formKey = GlobalKey<FormState>();
    return Scaffold(
      appBar: AppBar(
        title: const Text('Agregar alumno'),
      ),
      body: createBody(context),
    );
  }

  createBody(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.all(20.0),
      child: SingleChildScrollView(
        child: ReactiveForm(
          formGroup: fg,
          key: _formKey,
          child: Column(
            children: allWidgets
                .map((e) => Container(
                      padding: const EdgeInsets.only(top: 15.0),
                      child: e,
                    ))
                .toList(),
          ),
        ),
      ),
    );
  }

  validateFormStudent() {
    fg.markAllAsTouched();
    if (_formKey.currentState != null && !_formKey.currentState!.validate()) {
      return;
    }
  }

  showConfirmAddStudent() {
    myShowDialog.myShowModalBottomSheet(
      context: context,
      title: 'Aviso',
      container: '¿Deseas dar de alta este alumno?',
      callBackOne: sendData,
      callBackTwo: () => Navigator.pop(context),
      titleButtonTwo: 'Cancelar',
    );
  }

  sendData() async {
    Navigator.pop(context);
    await service.updateStudent(fg.value).then((value) => showMessage());
    /*   fg.control('idCarrera').value = widget.data.instituciones
        ?.firstWhere((element) => element.id == fg.control('idCarrera').value)
        .descripcion; */
  }

  showMessage() {
    showDialog(
        barrierDismissible: false,
        context: context,
        builder: (_) => AlertDialog(
              title: const Text('Aviso'),
              content: const Text('Alumno fue editado correctamente'),
              actions: [
                TextButton(
                    onPressed: () {
                      Navigator.pop(context);
                      Navigator.pop(context);
                      Navigator.pop(context);
                    },
                    child: const Text('Ok'))
              ],
            ));
  }
}
