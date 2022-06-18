import 'package:flutter/material.dart';
import 'package:preyecto_tecnologico/src/models/infoAlumnoInterface.dart';
import 'package:preyecto_tecnologico/src/models/moduleStudentInterface.dart';
import 'package:preyecto_tecnologico/src/pages/modules/student/editStudentPage.dart';
import 'package:preyecto_tecnologico/src/shared/form/myDropdown.dart';

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

  bool loadingInfoStudent = false;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Admon alumnos'),
        actions: [
          IconButton(
            onPressed: () async {
              loadingInfoStudent = true;
              setState(() {});
              final data =
                  await service.getStudent(widget.student.idAlumno ?? '');
              Future.delayed(Duration(seconds: 0), () {
                loadingInfoStudent = false;
                setState(() {});
                Navigator.push(
                  context,
                  MaterialPageRoute(
                    builder: (_) => EditStudentPage(
                      student: data,
                    ),
                  ),
                );
              });
            },
            icon: !loadingInfoStudent
                ? const Icon(Icons.mode_edit_outline_outlined)
                : const SizedBox(
                    height: 15.0,
                    width: 15.0,
                    child: CircularProgressIndicator(
                      color: Colors.black,
                      strokeWidth: 2.0,
                    )),
          ),
          IconButton(
            onPressed: () {},
            icon: Icon(widget.student.validado != 0
                ? Icons.check_circle_outline
                : Icons.remove_red_eye),
          ),
          IconButton(
            onPressed: () {},
            icon: const Icon(Icons.cancel_outlined),
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
