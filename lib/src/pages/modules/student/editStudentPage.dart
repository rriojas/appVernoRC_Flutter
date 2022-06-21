import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:mask_text_input_formatter/mask_text_input_formatter.dart';
import 'package:preyecto_tecnologico/src/models/infoAlumnoInterface.dart';
import 'package:preyecto_tecnologico/src/pages/modules/student/settingsStudent.dart';
import 'package:preyecto_tecnologico/src/services/studentService.dart';
import 'package:preyecto_tecnologico/src/shared/form/myDropdown.dart';
import 'package:preyecto_tecnologico/src/shared/form/myTextFormBirthday.dart';
import 'package:preyecto_tecnologico/src/shared/form/myTextFormField.dart';
import 'package:preyecto_tecnologico/src/shared/loading/loading.dart';
import 'package:preyecto_tecnologico/src/shared/showMessage/myShowMessage.dart';
import 'package:reactive_forms/reactive_forms.dart';

class EditStudentPage extends StatefulWidget {
  final InforAlumnoInterface student;
  EditStudentPage({
    Key? key,
    required this.student,
  }) : super(key: key);

  @override
  State<EditStudentPage> createState() => _EditStudentPageState();
}

class _EditStudentPageState extends State<EditStudentPage> {
  late GlobalKey<FormState> _formKey;

  late StudentService service;

  late FormGroup fg;

  var allWidgets = <Widget>[];

  Map<String, FormControl> mapReactiveForm = {};

  String keys = '';
  final loading = Loading();

  final formatted = MaskTextInputFormatter(
      mask: '(###) ###-####', filter: {"#": RegExp(r'[0-9]')});

  final myShowDialog = MyShowMessages();

  @override
  void initState() {
    service = StudentService();
    WidgetsBinding.instance?.addPostFrameCallback((timeStamp) {
      //  service.getStudent(widget.student.idUsuario as String);
    });
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    mapReactiveForm.clear();
    allWidgets.clear();

    for (int i = 0; i < settingFormEditStudent.length; i++) {
      keys = settingFormEditStudent[i]
          .keys
          .toString()
          .replaceAll('(', '')
          .replaceAll(')', '');
      final validators = settingFormEditStudent[i][keys]?['validators']
          ?.map((e) =>
              e as Map<String, dynamic>? Function(AbstractControl<dynamic>))
          .toList();

      final inputFormatted = settingFormEditStudent[i][keys]?['inputFormatted']
          ?.map((e) => e as TextInputFormatter)
          .toList();
      final label = settingFormEditStudent[i][keys]?['label']
          ?.map((e) => e as String)
          .toList();

      final alumno = widget.student.toJson();
      final dataAlumno = alumno['Alumno'];

      String? select;
      if (keys == 'idCarrera') {
        select = widget.student.optCarrera
            ?.firstWhere(
                (element) => element.id == widget.student.alumno?.idCarrera)
            .descripcion;
      }

      FormControl<String> item = FormControl<String>(
          value: select ?? dataAlumno[keys], validators: validators!);

      final type = settingFormEditStudent[i][keys]?['type']
          ?.map((e) => e as String)
          .toList();

      switch (type?[0]) {
        case 'text':
          allWidgets.add(CreateMyTextFormField(
            label: label![0],
            fcn: keys,
            inputFormated: inputFormatted,
          ));
          break;
        case 'drop':
          final items = widget.student.optCarrera
              ?.map((e) => e.descripcion as String)
              .toList();

          allWidgets.add(
            MyDropdown(
              label: label![0],
              stream: service.getInstitutionStream,
              items: items!,
              idSelect: select,
              fcn: keys,
            ),
          );
          break;
        case 'birth':
          allWidgets.add(MyTextFormBirthday(
            label: label![0],
            fcn: keys,
          ));
          break;
        default:
      }

      mapReactiveForm.putIfAbsent(keys, () => item);
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

    mapReactiveForm.addAll(
      {'idAlumno': FormControl(value: widget.student.alumno?.idAlumno)},
    );
    mapReactiveForm.addAll(
      {'method': FormControl(value: 'Update')},
    );
    mapReactiveForm.addAll(
      {'idVerano': FormControl(value: widget.student.alumno?.idVerano)},
    );
    mapReactiveForm.addAll(
      {'idUsuario': FormControl(value: widget.student.alumno?.idUsuario)},
    );

    fg = FormGroup(mapReactiveForm);

    _formKey = GlobalKey<FormState>();
    return Scaffold(
      appBar: AppBar(
        title: const Text('Editar alumno'),
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

    fg.control('idCarrera').value = widget.student.optCarrera
        ?.firstWhere(
            (element) => element.descripcion == fg.control('idCarrera').value)
        .id;
    showConfirmEditStudent();
  }

  sendData() async {
    Navigator.pop(context);
    await service.updateStudent(fg.value).then((value) => showMessage());
    fg.control('idCarrera').value = widget.student.optCarrera
        ?.firstWhere((element) => element.id == fg.control('idCarrera').value)
        .descripcion;
  }

  showConfirmEditStudent() {
    myShowDialog.myShowModalBottomSheet(
        context: context,
        title: 'Aviso',
        callBackOne: sendData,
        callBackTwo: () => Navigator.pop(context),
        container: '¿Deseas editar este alumno?',
        titleButtonTwo: 'Cancelar',
        icon: Icons.warning,
        colorIcon: Colors.orange);
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
                      Navigator.pop(context);
                    },
                    child: const Text('Ok'))
              ],
            ));
  }
}
