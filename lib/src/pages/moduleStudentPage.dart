import 'package:flutter/material.dart';
import 'package:preyecto_tecnologico/src/models/moduleStudentInterface.dart';
import 'package:preyecto_tecnologico/src/services/loginService.dart';

class ModuleStudentPage extends StatelessWidget {
  ModuleStudentPage({Key? key}) : super(key: key);

  late LoginService service;

  @override
  Widget build(BuildContext context) {
    service = LoginService();
    return Scaffold(
      appBar: AppBar(
        title: const Text('Admon alumno'),
        actions: [
          IconButton(
            onPressed: () {},
            icon: const Icon(Icons.edit),
          ),
          IconButton(
            onPressed: () {},
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
    return FutureBuilder(
        future: service.getModuleStudent(),
        builder: (_, AsyncSnapshot<List<ModuleStudentInterface>> data) {
          if (!data.hasData) {
            return const Center(
              child: CircularProgressIndicator(),
            );
          }
          final rsonse = data.data;
          return ListView.builder(
              itemCount: rsonse?.length,
              itemBuilder: (_, index) {
                return Container(
                  color: index % 2 == 0 ? Colors.black12 : Colors.white,
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      Column(
                        children: [
                          Text(rsonse![index].idAlumno!),
                          Text(rsonse[index].matricula!),
                          Text(rsonse[index].nombreDelAlumno!),
                          Text(rsonse[index].campus!),
                          Text(rsonse[index].carrera!),
                          Text('Validado :${rsonse[index].validado!}'),
                        ],
                      ),
                      Column(
                        children: [
                          IconButton(
                            onPressed: () {},
                            icon: const Icon(Icons.edit),
                          ),
                          IconButton(
                            onPressed: () {},
                            icon: Icon(rsonse[index].validado == '1'
                                ? Icons.remove_red_eye_outlined
                                : Icons.check),
                          ),
                          IconButton(
                              onPressed: () {},
                              icon: Icon(
                                (rsonse[index].validado == '1'
                                    ? Icons.cancel_outlined
                                    : Icons.delete_forever),
                              ))
                        ],
                      ),
                    ],
                  ),
                );
              });
        });
  }
}
