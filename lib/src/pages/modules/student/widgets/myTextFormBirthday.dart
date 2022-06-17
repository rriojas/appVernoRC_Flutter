import 'package:date_format/date_format.dart';
import 'package:flutter/material.dart';

class MyTextFormBirthday extends StatefulWidget {
  final TextEditingController controller;
  const MyTextFormBirthday({
    Key? key,
    required this.controller,
  }) : super(key: key);

  @override
  State<MyTextFormBirthday> createState() => _MyTextFormBirthdayState();
}

class _MyTextFormBirthdayState extends State<MyTextFormBirthday> {
  @override
  Widget build(BuildContext context) {
    return TextFormField(
      decoration: const InputDecoration(
        label: Text('Fecha de nacimiento'),
      ),
      controller: widget.controller,
      onTap: () {
        _selectDate(context, widget.controller);
        FocusScope.of(context).requestFocus(FocusNode());
      },
    );
  }

  _selectDate(BuildContext mycontext, TextEditingController controller) {
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
        print(dateTemp);
        controller.text =
            formatDate(dateTemp, [yyyy, '-', mm, '-', dd]).toString();
        setState(() {});
      }
    });
  }
}
