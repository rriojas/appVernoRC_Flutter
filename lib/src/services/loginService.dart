import 'dart:convert' show json;
import 'package:http/http.dart' as http;
import 'package:preyecto_tecnologico/src/models/menuOptionsInterface.dart';
import 'package:preyecto_tecnologico/src/models/moduleStudentInterface.dart';
import 'package:preyecto_tecnologico/src/models/solicitudAceptadaInterface.dart';
import 'package:preyecto_tecnologico/src/providers/baseUrl.dart';

class LoginService {
  static final LoginService _loginData = LoginService._internal();

  String? guidLoan;

  Map<String, String> headers = {
    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
  };

  factory LoginService() {
    return _loginData;
  }

  LoginService._internal();

  Future<bool> login(String email, String password) async {
    print('quien te invoco');

    final body = {'correo': email, 'password': password, 'method': 'Login'};

    const url = '$baseUrl/modulos/usuario/usuarioController.php';

    final response = await http.post(
      Uri.parse(url),
      headers: headers,
      body: body,
    );

    if (response.statusCode >= 400) {
      return false;
    }

    String? rawCookie = response.headers['set-cookie'];

    if (rawCookie == null) {
      return false;
    }
    int index = rawCookie.indexOf(';');
    String refreshToken =
        (index == -1) ? rawCookie : rawCookie.substring(0, index);
    int idx = refreshToken.indexOf("=");

    headers['cookie'] = 'PHPSESSID=${refreshToken.substring(idx + 1).trim()}';

    return true;
  }

  Future<List<MenuOptionsInterface>> getMenu() async {
    const url2 =
        '$baseUrl/modulos/tipousuariomodulo/tipousuariomoduloController.php?method=ByIdTipoUsuario';
    final res = await http.get(Uri.parse(url2), headers: headers);
    final response = menuOptionsInterfaceFromJson(res.body);

    //veranoregional.org/appVerano/modulos/alumnomovil/alumnomovilController.php

    return response;
  }

  Future<List<SolicitudAceptadaInterface>> fetchRequestAccepted() async {
    const url2 =
        '$baseUrl/modulos/solicitudaceptada/solicitudaceptadacontroller.php';
    final res = await http.get(Uri.parse(url2), headers: headers);
    print(res.body);
    final re = solicitudAceptadaInterfaceFromJson(res.body);

    print(re);
    return re;
  }

  Future<List<ModuleStudentInterface>> getModuleStudent() async {
    const url3 = '$baseUrl/modulos/alumno/alumnoController.php';
    final re3 = await http.get(Uri.parse(url3), headers: headers);
    final resp3 = moduleStudentInterfaceFromJson(re3.body);
    print(resp3);

    return resp3;
  }
}
