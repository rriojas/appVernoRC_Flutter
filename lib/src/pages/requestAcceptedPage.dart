import 'package:flutter/material.dart';
import 'package:preyecto_tecnologico/src/models/solicitudAceptadaInterface.dart';
import 'package:preyecto_tecnologico/src/pages/detailRequestAcceptedPage.dart';
import 'package:preyecto_tecnologico/src/services/loginService.dart';
import 'package:preyecto_tecnologico/src/utils/utils.dart';

class RequestAcceptedPage extends StatefulWidget {
  const RequestAcceptedPage({Key? key}) : super(key: key);

  @override
  State<RequestAcceptedPage> createState() => _RequestAcceptedPageState();
}

class _RequestAcceptedPageState extends State<RequestAcceptedPage> {
  late LoginService fetchRequestAccepted;
  late Utils utils;

  @override
  void initState() {
    fetchRequestAccepted = LoginService();
    // TODO: implement initState
    super.initState();

    WidgetsBinding.instance?.addPostFrameCallback((_) => {});
  }

  @override
  Widget build(BuildContext context) {
    utils = Utils();
    return Scaffold(
      appBar: AppBar(),
      body: createBody(),
    );
  }

  createBody() {
    return FutureBuilder(
        future: fetchRequestAccepted.fetchRequestAccepted(),
        builder: (_, AsyncSnapshot<List<SolicitudAceptadaInterface>> data) {
          if (data.hasData) {
            final request = data.data;

            return Padding(
              padding: const EdgeInsets.all(10.0),
              child: ListView.builder(
                  itemCount: request?.length,
                  itemBuilder: (_, index) {
                    return Card(
                      child: ListTile(
                        title: Text(utils.capitalizer(
                            request?[index].nombreInvestigador ?? '')),
                        subtitle: Text(request?[index].titulo ?? ''),
                        leading: Hero(
                            tag: 'image$index',
                            child: const ClipRRect(
                              borderRadius:
                                  BorderRadius.all(Radius.circular(50)),
                              child: SizedBox(
                                child: Image(
                                  image: AssetImage('assets/tecnologia.jpeg'),
                                  width: 50,
                                  height: 50,
                                  fit: BoxFit.cover,
                                ),
                              ),
                            )),
                        trailing: const Icon(Icons.arrow_forward_ios),
                        onTap: () => showDetailRequestAccepted(
                            request?[index] as SolicitudAceptadaInterface,
                            index),
                      ),
                    );
                  }),
            );
          }
          return const Center(
            child: CircularProgressIndicator(),
          );
        });
  }

  showDetailRequestAccepted(SolicitudAceptadaInterface request, num index) {
    Navigator.push(
        context,
        MaterialPageRoute(
            builder: (_) => DetailRequestAcceptedPAge(
                  request: request,
                  index: index,
                )));
  }
}
