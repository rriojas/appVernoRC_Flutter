import 'package:flutter/material.dart';
import 'package:preyecto_tecnologico/src/models/solicitudAceptadaInterface.dart';
import 'package:preyecto_tecnologico/src/pages/detailRequestAcceptedPage.dart';
import 'package:preyecto_tecnologico/src/services/loginService.dart';

class RequestAcceptedPage extends StatefulWidget {
  const RequestAcceptedPage({Key? key}) : super(key: key);

  @override
  State<RequestAcceptedPage> createState() => _RequestAcceptedPageState();
}

class _RequestAcceptedPageState extends State<RequestAcceptedPage> {
  late LoginService fetchRequestAccepted;

  @override
  void initState() {
    fetchRequestAccepted = LoginService();
    // TODO: implement initState
    super.initState();

    WidgetsBinding.instance?.addPostFrameCallback((_) => {});
  }

  @override
  Widget build(BuildContext context) {
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
                        title: Text(request?[index].nombreInvestigador ?? ''),
                        subtitle: Text(request?[index].titulo ?? ''),
                        leading: const Hero(
                            tag: 'image',
                            child: Image(
                              image: AssetImage('assets/tecnologia.jpeg'),
                            )),
                        trailing: const Icon(Icons.arrow_forward_ios),
                        onTap: () => showDetailRequestAccepted(
                            request?[index] as SolicitudAceptadaInterface),
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

  showDetailRequestAccepted(SolicitudAceptadaInterface request) {
    Navigator.push(
        context,
        MaterialPageRoute(
            builder: (_) => DetailRequestAcceptedPAge(
                  request: request,
                )));
  }
}
