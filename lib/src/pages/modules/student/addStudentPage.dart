import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:mask_text_input_formatter/mask_text_input_formatter.dart';
import 'package:preyecto_tecnologico/src/pages/modules/student/settingsStudent.dart';
import 'package:reactive_forms/reactive_forms.dart';

import 'package:date_format/date_format.dart';

import 'widgets/createMyTextFormField.dart';
import 'widgets/myDropdownGender.dart';
import 'widgets/myTextFormBirthday.dart';

class AddStudentPage extends StatefulWidget {
  const AddStudentPage({Key? key}) : super(key: key);

  @override
  State<AddStudentPage> createState() => _AddStudentPageState();
}

class _AddStudentPageState extends State<AddStudentPage> {
  late GlobalKey<FormState> _formKey;

  late FormGroup fg;

  Map<String, TextEditingController> textEditingControllers = {};

  var textFields = <Widget>[];

  @override
  Map<String, FormControl> mapReactiveForm = {};

  List keys = [];

  @override
  Widget build(BuildContext context) {
    keys.clear();
    mapReactiveForm.clear();
    textFields.clear();
    textEditingControllers.clear();

    listTextFieldMap.forEach((element) {
      keys.add(element.keys.toString().replaceAll('(', '').replaceAll(')', ''));
    });

    for (int i = 0; i < keys.length; i++) {
      final a = listTextFieldMap[i][keys[i]];
      final b = a
          ?.putIfAbsent('validators', () => () => [])
          .call()
          .map((e) =>
              e as Map<String, dynamic>? Function(AbstractControl<dynamic>))
          .toList();

      final c = a
          ?.putIfAbsent('inputFormatted', () => () => [])
          .call()
          .map((e) => e as TextInputFormatter)
          .toList();

      var item = FormControl(validators: b!);
      mapReactiveForm.putIfAbsent(keys[i], () => item);

      var textEdit = TextEditingController();

      if (keys[i] == 'Genero') {
        textFields.add(
          MyDropdownGender(
            controller: textEdit,
          ),
        );
      } else if (keys[i] == 'Fecha de nacimiento') {
        textFields.add(MyTextFormBirthday(
          controller: textEdit,
        ));
      } else {
        textFields.add(CreateMyTextFormField(
          controller: textEdit,
          label: keys[i],
          fcn: keys[i],
          inputFormated: c,
        ));
      }

      textEditingControllers.putIfAbsent(keys[i], () => textEdit);
    }

    textFields.addAll([
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
            children: textFields
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
