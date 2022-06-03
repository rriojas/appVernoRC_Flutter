import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:preyecto_tecnologico/src/models/menuOptionsInterface.dart';
import 'package:preyecto_tecnologico/src/pages/auth/myProjectsPage.dart';
import 'dart:io';

import 'package:preyecto_tecnologico/src/pages/changePasswordPage.dart';
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
      exit();
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
                    showRequestAccepted,
                  );
                });
          }),
    );
  }

  Card createItemsOptions(String title, String? subTitle, Function? onPress) {
    return Card(
      elevation: 5.0,
      child: Padding(
        padding: const EdgeInsets.all(8.0),
        child: ListTile(
          onTap: () => onPress != null ? onPress() : null,
          title: Text(title),
          subtitle: subTitle != null ? Text(subTitle) : null,
          trailing: IconButton(
            onPressed: () => onPress != null ? onPress() : null,
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
}
