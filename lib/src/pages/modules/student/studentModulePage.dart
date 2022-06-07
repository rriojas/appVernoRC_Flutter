import 'package:flutter/material.dart';
import 'package:preyecto_tecnologico/src/models/moduleStudentInterface.dart';
import 'package:preyecto_tecnologico/src/pages/modules/student/detailsStudentPage.dart';
import 'package:preyecto_tecnologico/src/services/loginService.dart';
import 'package:preyecto_tecnologico/src/utils/utils.dart';

class ModuleStudentPage extends StatelessWidget {
  ModuleStudentPage({Key? key}) : super(key: key);

  late LoginService service;
  Utils capitalizer = Utils();

  @override
  Widget build(BuildContext context) {
    service = LoginService();
    return Scaffold(
      appBar: AppBar(
        title: const Text(' Alumnos'),
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: () {},
        child: const Icon(Icons.add),
        tooltip: 'Agregar alumno',
      ),
      body: createBody(context),
    );
  }

  createBody(BuildContext context) {
    return FutureBuilder(
        future: service.getModuleStudent(),
        builder: (_, AsyncSnapshot<List<ModuleStudentInterface>> data) {
          if (!data.hasData) {
            return const Center(
              child: CircularProgressIndicator(),
            );
          }
          final students = data.data;
          return Padding(
            padding: const EdgeInsets.all(8.0),
            child: ListView.builder(
                itemCount: students?.length,
                itemBuilder: (_, index) {
                  return createItemStuden(students![index], context);
                }),
          );
        });
  }

  createItemStuden(ModuleStudentInterface student, BuildContext context) {
    return Card(
      elevation: 5,
      child: ListTile(
        title: Text(capitalizer.capitalizer(student.nombreDelAlumno ?? '')),
        subtitle: Text(student.campus ?? ' '),
        trailing: const Icon(Icons.arrow_forward_ios),
        onTap: () {
          Navigator.push(
            context,
            MaterialPageRoute(
              builder: (_) => DetailsStudentPage(student: student),
            ),
          );
        },
      ),
    );
  }
}
