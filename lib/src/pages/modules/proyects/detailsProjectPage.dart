import 'package:flutter/material.dart';
import 'package:preyecto_tecnologico/src/models/availableProjectsInterface.dart';
import 'package:preyecto_tecnologico/src/models/projectModuleInterface.dart';
import 'package:preyecto_tecnologico/src/utils/utils.dart';

class DetailsProyectPage extends StatelessWidget {
  final AvailableProjectsModuleInterface project;
  final int index;
  DetailsProyectPage({
    Key? key,
    required this.project,
    required this.index,
  }) : super(key: key);

  late Utils utils;
  @override
  Widget build(BuildContext context) {
    utils = Utils();
    return Scaffold(
      appBar: AppBar(
        title: const Text('Proyectos disponibles'),
      ),
      body: createBody(context),
    );
  }

  createBody(BuildContext context) {
    return SingleChildScrollView(
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Hero(
            tag: '${project.idArea}$index',
            child: Image(
              image: AssetImage(
                  'assets/img/${utils.getNameImage(project.idArea ?? '')}'),
            ),
          ),
          Padding(
            padding: const EdgeInsets.symmetric(horizontal: 20.0),
            child: Column(
              children: [
                const SizedBox(
                  height: 20,
                ),
                Text(
                  project.tituloDeProyecto ?? '',
                  style: const TextStyle(
                    fontWeight: FontWeight.w600,
                    fontSize: 18,
                  ),
                  textAlign: TextAlign.justify,
                ),
                createRichText(
                    'Investigador:', project.investigadorACargo ?? ''),
                createRichText('Carrera:', project.carreraEnLaQueAplica ?? ''),
                createRichText('Actividades a realizar:',
                    project.actividadesARealizar ?? ''),
                createRichText('Habilidades requeridas:',
                    project.habilidadesRequeridas ?? ''),
                SafeArea(
                  child: createRichText('Habilidades requeridas:',
                      project.habilidadesRequeridas ?? ''),
                ),
              ],
            ),
          )
        ],
      ),
    );
  }

  Widget createRichText(String title, String details) {
    return Padding(
      padding: const EdgeInsets.only(top: 10.0),
      child: RichText(
        text: TextSpan(
            style: const TextStyle(
              fontSize: 20,
              color: Colors.black,
            ),
            children: [
              TextSpan(text: title),
              TextSpan(
                text: details,
                style: const TextStyle(
                    fontSize: 17,
                    fontWeight: FontWeight.w600,
                    color: Colors.grey),
              ),
            ]),
      ),
    );
  }
}
