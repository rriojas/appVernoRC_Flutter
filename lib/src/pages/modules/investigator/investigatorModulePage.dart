import 'package:flutter/material.dart';
import 'package:preyecto_tecnologico/src/models/investigatorModuleInterface.dart';
import 'package:preyecto_tecnologico/src/services/loginService.dart';
import 'package:preyecto_tecnologico/src/utils/utils.dart';

class InvestigatorModulePage extends StatelessWidget {
  InvestigatorModulePage({Key? key}) : super(key: key);

  late LoginService service;
  late Utils utils;

  @override
  Widget build(BuildContext context) {
    service = LoginService();
    utils = Utils();
    return Scaffold(
      appBar: AppBar(
        title: const Text('Investigador'),
        centerTitle: true,
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: () {},
        child: const Icon(Icons.add),
        tooltip: 'Agregar investigador',
      ),
      body: createBody(),
    );
  }

  createBody() {
    return FutureBuilder(
        future: service.getInvestigatorModule(),
        builder: (_, AsyncSnapshot<List<InvestigatorModuleInterface>> data) {
          if (!data.hasData) {
            return const Center(
              child: CircularProgressIndicator(),
            );
          }
          final list = data.data ?? [];
          return ListView.builder(
              itemCount: list.length,
              itemBuilder: (_, index) {
                return createInvestigatorItem(list[index]);
              });
        });
  }

  createInvestigatorItem(InvestigatorModuleInterface investigator) {
    return Card(
      child: ListTile(
        title: Text(utils.capitalizer(investigator.usuario ?? '')),
      ),
    );
  }
}
