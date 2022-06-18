import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:reactive_forms/reactive_forms.dart';

class CreateMyTextFormField extends StatelessWidget {
  final String label;
  final TextEditingController controller;
  final String fcn;
  final List<TextInputFormatter>? inputFormated;

  const CreateMyTextFormField({
    Key? key,
    required this.label,
    required this.controller,
    required this.fcn,
    this.inputFormated,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return ReactiveTextField(
      formControlName: fcn,
      inputFormatters: inputFormated,
      controller: controller,
      decoration: InputDecoration(
        label: Text(
          label,
        ),
      ),
      validationMessages: (error) {
        return {
          'required': 'Campo requerido',
          'minLength': 'Minímo requerido',
          ValidationMessage.pattern: 'Formato ínvalido',
          ValidationMessage.email: 'Correo invalido'
        };
      },
    );
  }
}
