import 'dart:convert';
import 'dart:developer';
import 'package:http/http.dart' as http;
import 'package:preyecto_tecnologico/src/models/menuOptionsInterface.dart';
import 'package:preyecto_tecnologico/src/models/solicitudAceptadaInterface.dart';

class LoginService {
  static final LoginService _loginData = new LoginService._internal();

  String? guidLoan;

  Map<String, String> headers = {
    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
  };

  factory LoginService() {
    return _loginData;
  }

  LoginService._internal();

  Future<bool> login(String email, String password) async {
    final body = {'correo': email, 'password': password, 'method': 'Login'};

    const url =
        'https://veranoregional.org/appVerano/modulos/usuario/usuarioController.php';

    final response = await http.post(
      Uri.parse(url),
      headers: headers,
      body: body,
    );

    String? rawCookie = response.headers['set-cookie'];
    int index = rawCookie!.indexOf(';');
    String refreshToken =
        (index == -1) ? rawCookie : rawCookie.substring(0, index);
    int idx = refreshToken.indexOf("=");

    headers['cookie'] = 'PHPSESSID=${refreshToken.substring(idx + 1).trim()}';

    if (rawCookie != null) {
      return true;
    }
    return false;
  }

  Future<List<MenuOptionsInterface>> getMenu() async {
    const url2 =
        'https://veranoregional.org/appVerano/modulos/tipousuariomodulo/tipousuariomoduloController.php?method=ByIdTipoUsuario';
    final res = await http.get(Uri.parse(url2), headers: headers);
    final response = menuOptionsInterfaceFromJson(res.body);

    return response;
  }

  Future<List<SolicitudAceptadaInterface>> fetchRequestAccepted() async {
    const url2 =
        'https://veranoregional.org/appVerano/modulos/solicitudaceptadamovil/solicitudaceptadamovilcontroller.php';
    final res = await http.get(Uri.parse(url2), headers: headers);
    print(res.body);
    final re = solicitudAceptadaInterfaceFromJson(res.body);

    print(re);
    return re;
  }
}

// To parse this JSON data, do
//
//     final loginResponse = loginResponseFromJson(jsonString);

LoginResponse loginResponseFromJson(String str) =>
    LoginResponse.fromJson(json.decode(str));

String loginResponseToJson(LoginResponse data) => json.encode(data.toJson());

class LoginResponse {
  LoginResponse({
    this.mensaje,
    this.acceso,
  });

  final String? mensaje;
  final String? acceso;

  factory LoginResponse.fromJson(Map<String, dynamic> json) => LoginResponse(
        mensaje: json["mensaje"] == null ? null : json["mensaje"],
        acceso: json["acceso"] == null ? null : json["acceso"],
      );

  Map<String, dynamic> toJson() => {
        "mensaje": mensaje == null ? null : mensaje,
        "acceso": acceso == null ? null : acceso,
      };
}
