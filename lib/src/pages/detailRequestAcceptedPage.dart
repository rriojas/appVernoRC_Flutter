import 'package:flutter/material.dart';
import 'package:preyecto_tecnologico/src/models/solicitudAceptadaInterface.dart';

class DetailRequestAcceptedPAge extends StatelessWidget {
  final SolicitudAceptadaInterface request;
  final num index;
  const DetailRequestAcceptedPAge(
      {Key? key, required this.request, required this.index})
      : super(key: key);

  @override
  Widget build(BuildContext context) {
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
              child: Image(image: AssetImage('assets/tecnologia.jpeg'))),
          Text(
            request.titulo as String,
            style: const TextStyle(
              fontSize: 18,
              fontWeight: FontWeight.bold,
            ),
          ),
          Row(
            children: [
              Text(
                '${request.nombreInvestigador}',
                style: const TextStyle(
                  fontSize: 18,
                  fontWeight: FontWeight.bold,
                ),
                textAlign: TextAlign.left,
              ),
            ],
          )
        ],
      ),
    );
  }
}
