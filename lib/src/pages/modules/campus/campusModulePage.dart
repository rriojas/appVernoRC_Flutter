import 'package:flutter/material.dart';
import 'package:preyecto_tecnologico/src/models/campusModuleInterface.dart';
import 'package:preyecto_tecnologico/src/services/loginService.dart';

class CampusModulePage extends StatelessWidget {
  CampusModulePage({Key? key}) : super(key: key);

  late LoginService loginService;

  @override
  Widget build(BuildContext context) {
    loginService = LoginService();
    return Scaffold(
      appBar: AppBar(
        title: const Text('Campus'),
      ),
      body: createBody(),
      floatingActionButton: FloatingActionButton(
        onPressed: () {},
        child: const Icon(Icons.add),
        tooltip: 'Agregar campus',
      ),
    );
  }

  Widget createBody() {
    return Padding(
      padding: const EdgeInsets.all(8.0),
      child: FutureBuilder(
          future: loginService.getModuleCampus(),
          builder: (_, AsyncSnapshot<List<CampusModuleInterface>> data) {
            if (!data.hasData) {
              return const Center(child: CircularProgressIndicator());
            }
            final listCampus = data.data ?? [];
            return ListView.builder(
                itemCount: listCampus.length,
                itemBuilder: (_, index) {
                  return createCampusItem(listCampus[index]);
                });
          }),
    );
  }

  createCampusItem(CampusModuleInterface campus) {
    return Card(
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10)),
      elevation: 5,
      child: Padding(
        padding: const EdgeInsets.all(8.0),
        child: ListTile(
          title: Text(campus.nombre ?? ''),
          subtitle: Text(campus.institucion ?? ''),
          trailing: const Icon(Icons.arrow_forward_ios),
          onTap: () {},
        ),
      ),
    );
  }
}
