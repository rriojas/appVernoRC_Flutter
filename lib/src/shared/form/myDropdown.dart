import 'package:flutter/material.dart';
import 'package:preyecto_tecnologico/src/models/institutionCampusAvailable.dart';
import 'package:preyecto_tecnologico/src/services/studentService.dart';
import 'package:reactive_forms/reactive_forms.dart';
import "package:unorm_dart/unorm_dart.dart" as unorm;

class MyDropdown extends StatefulWidget {
  final String label;
  final String fcn;
  final Stream<InstitutionCampusAvailable> stream;
  final List<String> items;
  final String? idSelect;

  const MyDropdown({
    Key? key,
    required this.label,
    required this.stream,
    required this.items,
    this.idSelect,
    required this.fcn,
  }) : super(key: key);

  @override
  State<MyDropdown> createState() => _MyDropdownState();
}

final service = StudentService();

class _MyDropdownState extends State<MyDropdown> {
  @override
  void initState() {
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
      formControlName: widget.fcn,
      isExpanded: true,
      items: listDropdown,
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
