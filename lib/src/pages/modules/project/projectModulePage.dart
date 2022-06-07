import 'package:flutter/material.dart';
import 'package:preyecto_tecnologico/src/models/projectModuleInterface.dart';
import 'package:preyecto_tecnologico/src/services/loginService.dart';

class ProjectModulePage extends StatelessWidget {
  ProjectModulePage({Key? key}) : super(key: key);

  LoginService service = LoginService();
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text(' Proyectos'),
      ),
      body: createBody(context),
    );
  }

  createBody(BuildContext context) {
    return FutureBuilder(
        future: service.getProjectModule(),
        builder: (_, AsyncSnapshot<List<ProjectModuleInterface>> data) {
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

  createItemStuden(ProjectModuleInterface student, BuildContext context) {
    return Card(
      elevation: 5,
      child: ListTile(
        title: Text(student.investigador ?? ' '),
        subtitle: Text(student.titulo ?? ' '),
        trailing: const Icon(Icons.arrow_forward_ios),
        onTap: () {
          /*   Navigator.push(
            context,
            MaterialPageRoute(
              builder: (_) => DetailsStudentPage(student: student),
            ),
          ); */
        },
      ),
    );
  }
}
