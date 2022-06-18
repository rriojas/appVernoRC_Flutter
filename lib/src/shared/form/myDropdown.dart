import 'package:flutter/material.dart';
import 'package:preyecto_tecnologico/src/models/institutionCampusAvailable.dart';
import 'package:preyecto_tecnologico/src/services/studentService.dart';
import 'package:reactive_forms/reactive_forms.dart';

class MyDropdown extends StatefulWidget {
  final TextEditingController controller;
  final String label;
  final Stream<InstitutionCampusAvailable> stream;
  final List<String> items;

  const MyDropdown({
    Key? key,
    required this.controller,
    required this.label,
    required this.stream,
    required this.items,
  }) : super(key: key);

  @override
  State<MyDropdown> createState() => _MyDropdownState();
}

final service = StudentService();

class _MyDropdownState extends State<MyDropdown> {
  @override
  void initState() {
    WidgetsBinding.instance?.addPostFrameCallback((timeStamp) {
      service.getAvailableInstitutions();
    });

    super.initState();
  }

  List<DropdownMenuItem<String>> listDropdown = [];

  @override
  Widget build(BuildContext context) {
    listDropdown = widget.items
        .map((e) => DropdownMenuItem<String>(
              child: Text(e),
              value: e,
            ))
        .toList();

    return ReactiveDropdownField(
      formControlName: widget.label,
      isExpanded: true,
      items: listDropdown,
      onChanged: (dynamic onChanged) {
        widget.controller.text = onChanged;
      },
      decoration: InputDecoration(
          label: Text(
        widget.label,
      )),
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
