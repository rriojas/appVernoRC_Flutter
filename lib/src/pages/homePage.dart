import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:preyecto_tecnologico/src/models/menuOptionsInterface.dart';
import 'package:preyecto_tecnologico/src/pages/auth/LoginPage.dart';
import 'package:preyecto_tecnologico/src/pages/auth/myProjectsPage.dart';
import 'dart:io';

import 'package:preyecto_tecnologico/src/pages/changePasswordPage.dart';
import 'package:preyecto_tecnologico/src/pages/modules/campus/campusModulePage.dart';
import 'package:preyecto_tecnologico/src/pages/modules/investigator/investigatorModulePage.dart';
import 'package:preyecto_tecnologico/src/pages/modules/project/projectModulePage.dart';
import 'package:preyecto_tecnologico/src/pages/modules/proyects/availableProjectsPage.dart';
import 'package:preyecto_tecnologico/src/pages/modules/student/studentModulePage.dart';
import 'package:preyecto_tecnologico/src/pages/requestAcceptedPage.dart';
import 'package:preyecto_tecnologico/src/services/loginService.dart';

class HomePAge extends StatefulWidget {
  const HomePAge({Key? key}) : super(key: key);

  @override
  State<HomePAge> createState() => _HomePAgeState();
}

class _HomePAgeState extends State<HomePAge> {
  late LoginService service;

  @override
  void initState() {
    service = LoginService();
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      endDrawer: createDrawer(context),
      appBar: AppBar(
        title: const Text('Inicio'),
      ),
      body: createBody(),
    );
  }

  Drawer createDrawer(BuildContext context) => Drawer(
        child: SafeArea(
          child: Padding(
            padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 15),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                const Image(
                  image: AssetImage('assets/logo_navbar.png'),
                  height: 80,
                ),
                TextButton(
                  onPressed: showChangePassword,
                  child: const Text('Cambia contraseña'),
                ),
                TextButton(
                  onPressed: exit,
                  child: const Text('Cerrar sesión'),
                )
              ],
            ),
          ),
        ),
      );

  void exit() async {
    if (Platform.isIOS) {
      Navigator.pushAndRemoveUntil(
          context,
          MaterialPageRoute(builder: (builder) => const LoginPage()),
          (d) => false);
    }

    SystemChannels.platform.invokeMethod('SystemNavigator.pop');
  }

  showChangePassword() {
    Navigator.pop(context);
    Navigator.push(
        context, MaterialPageRoute(builder: (_) => const ChangePasswordPage()));
  }

  Widget createBody() {
    return Padding(
      padding: const EdgeInsets.all(8.0),
      child: FutureBuilder(
          future: service.getMenu(),
          builder: (_, AsyncSnapshot<List<MenuOptionsInterface>> data) {
            if (!data.hasData) {
              return const Center(child: CircularProgressIndicator());
            }
            final options = data.data;
            return ListView.builder(
                itemCount: options?.length,
                itemBuilder: (_, index) {
                  return createItemsOptions(
                    options![index].nombre!,
                    options[index].descripcion,
                    options[index].ruta,
                  );
                });
          }),
    );
  }

  Card createItemsOptions(String title, String? subTitle, String? onPress) {
    return Card(
      elevation: 5.0,
      child: Padding(
        padding: const EdgeInsets.all(8.0),
        child: ListTile(
          onTap: () => checkOptions(onPress!),
          title: Text(title),
          subtitle: subTitle != null ? Text(subTitle) : null,
          trailing: IconButton(
            onPressed: () => checkOptions(onPress!),
            icon: const Icon(Icons.arrow_forward_ios),
          ),
        ),
      ),
    );
  }

  showMyProyects() {
    return Navigator.push(
      context,
      MaterialPageRoute(
        builder: (_) => const MyProjectsPage(),
      ),
    );
  }

  showRequestAccepted() {
    return Navigator.push(
      context,
      MaterialPageRoute(
        builder: (_) => const RequestAcceptedPage(),
      ),
    );
  }

  checkOptions(String module) {
    final ruta = module.split('/')[1];

    switch (ruta) {
      case 'alumno':
        Navigator.push(
            context, MaterialPageRoute(builder: (_) => ModuleStudentPage()));

        break;
      case 'campus':
        Navigator.push(
            context, MaterialPageRoute(builder: (_) => CampusModulePage()));

        break;
      case 'solicitudaceptada':
        Navigator.push(context,
            MaterialPageRoute(builder: (_) => const RequestAcceptedPage()));

        break;

      case 'investigador':
        Navigator.push(context,
            MaterialPageRoute(builder: (_) => InvestigatorModulePage()));

        break;

      case 'proyecto':
        Navigator.push(
            context, MaterialPageRoute(builder: (_) => ProjectModulePage()));

        break;
        print(ruta);
      case 'proyectodisponible':
        Navigator.push(context,
            MaterialPageRoute(builder: (_) => AvailableProjectsPage()));

        break;
      default:
    }
  }
}
