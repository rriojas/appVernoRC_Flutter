import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:preyecto_tecnologico/src/pages/modules/student/widgets/myDropdown.dart';

import 'package:reactive_forms/reactive_forms.dart';

import 'widgets/createMyTextFormField.dart';
import 'widgets/myTextFormBirthday.dart';
import 'package:preyecto_tecnologico/src/pages/modules/student/settingsStudent.dart';

class AddStudentPage extends StatelessWidget {
  AddStudentPage({Key? key}) : super(key: key);

  late GlobalKey<FormState> _formKey;

  late FormGroup fg;

  Map<String, TextEditingController> textEditingControllers = {};

  var allWidgets = <Widget>[];

  @override
  Map<String, FormControl> mapReactiveForm = {};

  List keys = [];

  @override
  Widget build(BuildContext context) {
    keys.clear();
    mapReactiveForm.clear();
    allWidgets.clear();
    textEditingControllers.clear();

    for (var element in listTextFieldMap) {
      keys.add(element.keys.toString().replaceAll('(', '').replaceAll(')', ''));
    }

    for (int i = 0; i < listTextFieldMap.length; i++) {
      final validators = listTextFieldMap[i][keys[i]]?['validators']
          ?.map((e) =>
              e as Map<String, dynamic>? Function(AbstractControl<dynamic>))
          .toList();

      final inputFormatted = listTextFieldMap[i][keys[i]]?['inputFormatted']
          ?.map((e) => e as TextInputFormatter)
          .toList();

      FormControl<String> item = FormControl(validators: validators!);

      var textEdit = TextEditingController();

      if (keys[i] == 'Escuela/Facultad/Centro de investigación') {
        allWidgets.add(
          MyDropdown(
            controller: textEdit,
            label: keys[i],
            stream: service.getInstitutionStream,
          ),
        );
      } else if (keys[i] == 'Institución') {
        allWidgets.add(
          MyDropdown(
            controller: textEdit,
            label: keys[i],
            stream: service.getInstitutionStream,
          ),
        );
      } else if (keys[i] == 'Genero') {
        allWidgets.add(
          MyDropdown(
            controller: textEdit,
            label: keys[i],
            stream: service.getInstitutionStream,
          ),
        );
      } else if (keys[i] == 'Fecha de nacimiento') {
        allWidgets.add(MyTextFormBirthday(
          controller: textEdit,
          label: keys[i],
        ));
      } else {
        allWidgets.add(CreateMyTextFormField(
          controller: textEdit,
          label: keys[i],
          fcn: keys[i],
          inputFormated: inputFormatted,
        ));
      }
      mapReactiveForm.putIfAbsent(keys[i], () => item);

      textEditingControllers.putIfAbsent(keys[i], () => textEdit);
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
        onPressed: () {},
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

    textEditingControllers.forEach((key, value) {
      print(value.text);
    });

    if (_formKey.currentState != null && !_formKey.currentState!.validate()) {
      return;
    }
  }
}
