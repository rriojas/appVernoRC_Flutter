import 'package:flutter/material.dart';
import 'package:reactive_forms/reactive_forms.dart';

class AddStudentPage extends StatefulWidget {
  const AddStudentPage({Key? key}) : super(key: key);

  @override
  State<AddStudentPage> createState() => _AddStudentPageState();
}

class _AddStudentPageState extends State<AddStudentPage> {
  final listTextField = [
    'Nombre',
    'Apellido paterno',
    'Apellido materno',
    'Calle',
    'Numero',
    'Colonia',
    'Codígo postal',
    'Fecha de nacimiento',
    'Genero',
    'Telefono',
    'Institución',
    'Escuela/Facultad/Centro de investigación',
    'Correo',
    'Contraseña',
    'Confirma contraseña'
  ];

  late GlobalKey<FormState> _formKey;

  late FormGroup fg;
  Map<String, TextEditingController> textEditingControllers = {};
  var textFields = <Widget>[];
  @override
  void initState() {
    createFormBuilder();
    for (var element in listTextField) {
      var textEdit = TextEditingController();
      textEditingControllers.putIfAbsent(element, () => textEdit);
      textFields.add(CreateMyTextFormField(
        controller: textEdit,
        label: element,
        fcn: element,
      ));
    }

    super.initState();
  }

  Map<String, FormControl> mapReactiveForm = {};

  createFormBuilder() {
    for (var element in listTextField) {
      var item = FormControl(validators: [Validators.required]);
      mapReactiveForm.putIfAbsent(element, () => item);
    }

    fg = FormGroup(mapReactiveForm);
  }

  @override
  Widget build(BuildContext context) {
    _formKey = GlobalKey<FormState>();
    return Scaffold(
      appBar: AppBar(
        title: const Text('Agregar alumno'),
      ),
      body: createBody(),
    );
  }

  createBody() {
    return Padding(
      padding: const EdgeInsets.all(20.0),
      child: SingleChildScrollView(
        child: ReactiveForm(
          formGroup: fg,
          key: _formKey,
          child: Column(
            children: [
              Column(
                children: textFields
                    .map((e) => Container(
                          padding: const EdgeInsets.only(top: 15.0),
                          child: e,
                        ))
                    .toList(),
              ),
              SizedBox(
                width: double.infinity,
                height: 50,
                child: ElevatedButton(
                  onPressed: () {
                    if (!_formKey.currentState!.validate()) {
                      return;
                    }
                  },
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
              ),
            ]
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
}

class CreateMyTextFormField extends StatelessWidget {
  final String label;
  final TextEditingController controller;
  final String fcn;

  const CreateMyTextFormField({
    Key? key,
    required this.label,
    required this.controller,
    required this.fcn,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return ReactiveTextField(
      formControlName: fcn,
      controller: controller,
      decoration: InputDecoration(
        label: Text(
          label,
        ),
      ),
      validationMessages: (error) {
        return {
          'required': 'Campo requerido',
        };
      },
    );
  }
}
