import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:preyecto_tecnologico/src/models/infoAlumnoInterface.dart';
import 'package:preyecto_tecnologico/src/models/moduleStudentInterface.dart';
import 'package:preyecto_tecnologico/src/pages/modules/student/settingsStudent.dart';
import 'package:preyecto_tecnologico/src/services/studentService.dart';
import 'package:preyecto_tecnologico/src/shared/form/myDropdown.dart';
import 'package:preyecto_tecnologico/src/shared/form/myTextFormBirthday.dart';
import 'package:preyecto_tecnologico/src/shared/form/myTextFormField.dart';
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

  Map<String, TextEditingController> textEditingControllers = {};

  var allWidgets = <Widget>[];

  Map<String, FormControl> mapReactiveForm = {};

  String keys = '';

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
    final mapStudent = widget.student.toJson();

    mapStudent.forEach((key, value) {
      print('$key - $value');
    });
    mapReactiveForm.clear();
    allWidgets.clear();
    textEditingControllers.clear();

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
      print(dataAlumno);

      FormControl<String> item =
          FormControl<String>(value: dataAlumno[keys], validators: validators!);

      var textEdit = TextEditingController();
      final type = settingFormEditStudent[i][keys]?['type']
          ?.map((e) => e as String)
          .toList();

      switch (type?[0]) {
        case 'text':
          allWidgets.add(CreateMyTextFormField(
            controller: textEdit,
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
              controller: textEdit,
              label: keys,
              stream: service.getInstitutionStream,
              items: items!,
            ),
          );
          break;
        case 'birth':
          allWidgets.add(MyTextFormBirthday(
            controller: textEdit,
            label: label![0],
            fcn: keys,
          ));
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
        title: const Text('Editar alumno'),
      ),
      body: createBody(context),
    );
  }

  createBody(BuildContext context) {
    print(widget.student);
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
}
