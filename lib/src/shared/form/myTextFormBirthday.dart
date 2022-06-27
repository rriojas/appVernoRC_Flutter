import 'package:date_format/date_format.dart';
import 'package:flutter/material.dart';
import 'package:reactive_forms/reactive_forms.dart';

class MyTextFormBirthday extends StatefulWidget {
  final String label;
  final String fcn;
  const MyTextFormBirthday({
    Key? key,
    required this.label,
    required this.fcn,
  }) : super(key: key);

  @override
  State<MyTextFormBirthday> createState() => _MyTextFormBirthdayState();
}

class _MyTextFormBirthdayState extends State<MyTextFormBirthday> {
  TextEditingController text = TextEditingController();

  @override
  Widget build(BuildContext context) {
    return ReactiveTextField(
      controller: text,
      formControlName: widget.fcn,
      decoration: const InputDecoration(
        label: Text('Fecha de nacimiento'),
      ),
      onTap: () {
        FocusScope.of(context).requestFocus(FocusNode());
        _selectDate();
      },
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

  _selectDate() {
    final dateNow = DateTime.now();
    final dateInit = DateTime(dateNow.year - 100, dateNow.month, dateNow.day);

    final dateLast = DateTime(dateNow.year, dateNow.month, dateNow.day);

    showDatePicker(
            locale: const Locale('es', 'ES'),
            context: context,
            initialDate: dateNow,
            firstDate: dateInit,
            lastDate: dateLast)
        .then((onValue) {
      if (onValue != null) {
        final dateTemp = DateTime.parse(onValue.toString());

        text.text = formatDate(dateTemp, [yyyy, '-', mm, '-', dd]).toString();
        setState(() {});
      }
    });
  }
}
