import 'package:flutter/material.dart';
import 'package:preyecto_tecnologico/src/models/institutionCampusAvailable.dart';
import 'package:preyecto_tecnologico/src/services/loginService.dart';
import 'package:reactive_forms/reactive_forms.dart';

class MyDropdown extends StatefulWidget {
  final TextEditingController controller;
  final String label;
  final Stream<InstitutionCampusAvailable> stream;

  const MyDropdown({
    Key? key,
    required this.controller,
    required this.label,
    required this.stream,
  }) : super(key: key);

  @override
  State<MyDropdown> createState() => _MyDropdownState();
}

LoginService service = LoginService();

class _MyDropdownState extends State<MyDropdown> {
  @override
  void initState() {
    WidgetsBinding.instance?.addPostFrameCallback((timeStamp) {
      service.getAvailableInstitutions();
    });

    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return StreamBuilder(
        stream: widget.stream,
        builder: (_, AsyncSnapshot<InstitutionCampusAvailable> data) {
          if (!data.hasData) {
            return const CircularProgressIndicator();
          }
          final list = data.data;
          List<DropdownMenuItem<String>>? menuItem = [];
          switch (widget.label) {
            case 'Genero':
              //  widget.controller.text = 'Masculino';
              menuItem.addAll(const [
                DropdownMenuItem<String>(
                  child: Text(
                    'Masculino',
                  ),
                  value: 'Masculino',
                ),
                DropdownMenuItem<String>(
                  child: Text(
                    'Femenino',
                  ),
                  value: 'Femenino',
                ),
              ]);
              break;
            case 'Institución':
              //     widget.controller.text =
              //         list?.instituciones?[0].descripcion ?? '';
              final temp =
                  (list?.instituciones)!.map((e) => DropdownMenuItem<String>(
                        child: Text(
                          e.descripcion ?? '',
                        ),
                        value: e.descripcion,
                      ));

              menuItem.addAll(temp);
              break;
            default:
              //  widget.controller.text = list?.campus?[0].descripcion ?? '';
              final temp = (list?.campus)!.map((e) => DropdownMenuItem<String>(
                    child: Text(
                      e.descripcion ?? '',
                    ),
                    value: e.descripcion,
                  ));

              menuItem.addAll(temp);
              break;
          }

          return ReactiveDropdownField(
            formControlName: widget.label,
            isExpanded: true,
            items: menuItem,
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
        });
  }
}
