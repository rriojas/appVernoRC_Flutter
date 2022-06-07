import 'package:flutter/material.dart';
import 'package:preyecto_tecnologico/src/models/solicitudAceptadaInterface.dart';
import 'package:preyecto_tecnologico/src/utils/utils.dart';

class DetailRequestAcceptedPAge extends StatelessWidget {
  final SolicitudAceptadaInterface request;
  final num index;
  DetailRequestAcceptedPAge(
      {Key? key, required this.request, required this.index})
      : super(key: key);

  late Utils utils;
  @override
  Widget build(BuildContext context) {
    utils = Utils();
    return Scaffold(
      appBar: AppBar(
        title: const Text('Detalles de solicitud'),
        centerTitle: true,
      ),
      body: createBody(),
    );
  }

  createBody() {
    return Card(
      child: Column(
        children: [
          Hero(
              tag: 'image$index',
              child: const Image(image: AssetImage('assets/tecnologia.jpeg'))),
          Padding(
            padding: const EdgeInsets.symmetric(horizontal: 8.0),
            child: Text(
              request.titulo as String,
              style: const TextStyle(
                fontSize: 15,
                fontWeight: FontWeight.bold,
              ),
              textAlign: TextAlign.center,
            ),
          ),
          const SizedBox(
            height: 10,
          ),
          Text(
            utils.capitalizer(request.nombreInvestigador ?? ''),
            style: const TextStyle(
              fontSize: 18,
              fontWeight: FontWeight.bold,
            ),
            textAlign: TextAlign.left,
          )
        ],
      ),
    );
  }
}
