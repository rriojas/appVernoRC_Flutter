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
  Map<String, FormControl> mapReactiveForm = {};
  String keys = '';

  @override
  Widget build(BuildContext context) {
    mapReactiveForm.clear();
    allWidgets.clear();
    textEditingControllers.clear();

    for (int i = 0; i < listTextFieldMap.length; i++) {
      keys = listTextFieldMap[i]
          .keys
          .toString()
          .replaceAll('(', '')
          .replaceAll(')', '');
      final validators = listTextFieldMap[i][keys]?['validators']
          ?.map((e) =>
              e as Map<String, dynamic>? Function(AbstractControl<dynamic>))
          .toList();

      final inputFormatted = listTextFieldMap[i][keys]?['inputFormatted']
          ?.map((e) => e as TextInputFormatter)
          .toList();

      FormControl<String> item = FormControl(validators: validators!);

      var textEdit = TextEditingController();
      final type =
          listTextFieldMap[i][keys]?['type']?.map((e) => e as String).toList();

      switch (type?[0]) {
        case 'text':
          allWidgets.add(CreateMyTextFormField(
            controller: textEdit,
            label: keys,
            fcn: keys,
            inputFormated: inputFormatted,
          ));
          break;
        case 'drop':
          allWidgets.add(
            MyDropdown(
              controller: textEdit,
              label: keys,
              stream: service.getInstitutionStream,
            ),
          );
          break;
        case 'birth':
          allWidgets.add(MyTextFormBirthday(
            controller: textEdit,
            label: keys,
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
}
