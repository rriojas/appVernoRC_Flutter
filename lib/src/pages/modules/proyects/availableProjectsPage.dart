import 'package:flutter/material.dart';
import 'package:preyecto_tecnologico/src/models/availableProjectsInterface.dart';
import 'package:preyecto_tecnologico/src/pages/modules/proyects/detailsProjectPage.dart';
import 'package:preyecto_tecnologico/src/services/loginService.dart';
import 'package:preyecto_tecnologico/src/utils/utils.dart';

class AvailableProjectsPage extends StatefulWidget {
  AvailableProjectsPage({Key? key}) : super(key: key);

  @override
  State<AvailableProjectsPage> createState() => _AvailableProjectsPageState();
}

class _AvailableProjectsPageState extends State<AvailableProjectsPage> {
  late LoginService service;

  late Utils utils;

  @override
  Widget build(BuildContext context) {
    service = LoginService();
    utils = Utils();
    return Scaffold(
      appBar: AppBar(
        title: const Text('Proyectos disponibles'),
      ),
      body: createBody(),
    );
  }

  createBody() {
    return FutureBuilder(
        future: service.getAvailableProyectModule(),
        builder:
            (_, AsyncSnapshot<List<AvailableProjectsModuleInterface>> data) {
          if (!data.hasData) {
            return const Center(child: CircularProgressIndicator());
          }
          final listData = data.data ?? [];
          return ListView.builder(
              itemCount: listData.length,
              itemBuilder: (_, index) {
                return createAvailableProjectItem(listData[index], index);
              });
        });
  }

  createAvailableProjectItem(
      AvailableProjectsModuleInterface project, int index) {
    return Card(
      child: ListTile(
        title: Text(
            '${project.tituloDeProyecto?[0].toUpperCase()}${project.tituloDeProyecto!.substring(1).toLowerCase()}'),
        leading: Hero(
          tag: '${project.idArea}$index',
          child: Image(
            image: AssetImage(
              'assets/img/${utils.getNameImage(project.idArea ?? '')}',
            ),
            fit: BoxFit.cover,
            height: 45,
            width: 45,
          ),
        ),
        trailing: const Icon(Icons.arrow_forward_ios),
        onTap: () {
          showDetailsProject(project, index);
        },
      ),
    );
  }

  showDetailsProject(AvailableProjectsModuleInterface project, int index) {
    Navigator.push(
      context,
      MaterialPageRoute(
        builder: (_) => DetailsProyectPage(
          project: project,
          index: index,
        ),
      ),
    );
  }
}
