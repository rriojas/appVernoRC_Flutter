import 'package:flutter/material.dart';
import 'package:preyecto_tecnologico/src/models/moduleStudentInterface.dart';
import 'package:preyecto_tecnologico/src/pages/modules/student/editStudentPage.dart';

class DetailsStudentPage extends StatefulWidget {
  final ModuleStudentInterface student;

  const DetailsStudentPage({
    Key? key,
    required this.student,
  }) : super(key: key);

  @override
  State<DetailsStudentPage> createState() => _DetailsStudentPageState();
}

class _DetailsStudentPageState extends State<DetailsStudentPage> {
  List<String> listHeaders = [
    'Matricula',
    'idUsuario',
    'idCarrera',
    'campus',
    'validado',
    'Carrera',
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Admon alumnos'),
        actions: [
          IconButton(
            onPressed: () {},
            icon: const Icon(Icons.edit),
          ),
          IconButton(
            onPressed: () {
              Navigator.push(
                context,
                MaterialPageRoute(
                  builder: (_) => const EditStudentPage(),
                ),
              );
            },
            icon: const Icon(Icons.edit),
          ),
          IconButton(
            onPressed: () {},
            icon: const Icon(Icons.cancel),
          ),
        ],
      ),
      body: createBody(),
    );
  }

  createBody() {
    return AbsorbPointer(
      absorbing: true,
      child: Padding(
        padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 20),
        child: Form(
            child: ListView.builder(
                itemCount: listHeaders.length,
                itemBuilder: (_, index) {
                  return createCustomTextField(widget.student, index);
                })),
      ),
    );
  }

  createCustomTextField(ModuleStudentInterface student, int index) {
    final Map<String, dynamic> headers = widget.student.toJson();

    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 10.0),
      child: TextFormField(
        initialValue: headers[listHeaders[index]],
        decoration:
            InputDecoration(label: Text(listHeaders[index].toUpperCase())),
      ),
    );
  }
}
