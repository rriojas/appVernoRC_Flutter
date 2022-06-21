import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:reactive_forms/reactive_forms.dart';

class CreateMyTextFormField extends StatelessWidget {
  final String label;
  final String fcn;
  final List<TextInputFormatter>? inputFormated;
  final bool? oscureText;

  const CreateMyTextFormField({
    Key? key,
    required this.label,
    required this.fcn,
    this.inputFormated,
    this.oscureText,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return ReactiveTextField(
      obscureText: oscureText ?? false,
      formControlName: fcn,
      inputFormatters: inputFormated,
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
