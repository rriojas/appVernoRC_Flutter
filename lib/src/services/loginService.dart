import 'dart:async';
import 'dart:convert' show json;
import 'package:http/http.dart' as http;
import 'package:preyecto_tecnologico/src/models/availableProjectsInterface.dart';
import 'package:preyecto_tecnologico/src/models/campusModuleInterface.dart';
import 'package:preyecto_tecnologico/src/models/institutionCampusAvailable.dart';
import 'package:preyecto_tecnologico/src/models/investigatorModuleInterface.dart';
import 'package:preyecto_tecnologico/src/models/menuOptionsInterface.dart';
import 'package:preyecto_tecnologico/src/models/moduleStudentInterface.dart';
import 'package:preyecto_tecnologico/src/models/projectModuleInterface.dart';
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

  final _institutionController =
      StreamController<InstitutionCampusAvailable>.broadcast();
  Stream<InstitutionCampusAvailable> get getInstitutionStream =>
      _institutionController.stream;
  void setInstitution(InstitutionCampusAvailable ins) {
    _institutionController.add(ins);
  }

  Future<bool> login(String email, String password) async {
    final body = {'correo': email, 'password': password, 'method': 'Login'};

    print(body);
    const url = '$baseUrl/modulos/usuario/usuarioController.php';
    print(url);

    final response = await http.post(
      Uri.parse(url),
      headers: headers,
      body: body,
    );
    print(response.statusCode);

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

    final re = solicitudAceptadaInterfaceFromJson(res.body);

    return re;
  }

  Future<List<ModuleStudentInterface>> getModuleStudent() async {
    const url3 = '$baseUrl/modulos/alumno/alumnoController.php';
    final re3 = await http.get(Uri.parse(url3), headers: headers);

    final resp3 = moduleStudentInterfaceFromJson(re3.body);

    return resp3;
  }

  Future<List<CampusModuleInterface>> getModuleCampus() async {
    const url3 = '$baseUrl/modulos/campus/campusController.php?';

    final response = await http.get(Uri.parse(url3), headers: headers);

    final campus = campusModuleInterfaceFromJson(response.body);

    return campus;
  }

  Future<List<InvestigatorModuleInterface>> getInvestigatorModule() async {
    const url3 = '$baseUrl/modulos/investigador/investigadorController.php?';

    final response = await http.get(Uri.parse(url3), headers: headers);

    final investators = investigatorModuleInterfaceFromJson(response.body);

    getProjectModule();
    return investators;
  }

  Future<List<ProjectModuleInterface>> getProjectModule() async {
    const url = '$baseUrl/modulos/proyecto/proyectoController.php?method=All';

    final response = await http.get(Uri.parse(url), headers: headers);

    final projects = projectModuleInterfaceFromJson(response.body);

    return projects;
  }

  Future<List<AvailableProjectsModuleInterface>>
      getAvailableProyectModule() async {
    const url = '$baseUrl/modulos/proyectodisponible/proyectodisponible.php';

    final response = await http.get(Uri.parse(url), headers: headers);
    final proyects = availableProjectsModuleInterfaceFromJson(response.body);
    getAvailableInstitutions();
    return proyects;
  }

  Future<InstitutionCampusAvailable> getAvailableInstitutions() async {
    const url =
        '$baseUrl/modulos/usuario/instituciones.php?id=5&idTipoUsuario=5';
    final body = {'id': '5', 'method': 'Login'};

    final response =
        await http.post(Uri.parse(url), headers: headers, body: body);
    final data = institutionCampusAvailableFromJson(response.body);

    setInstitution(data);
    return data;
  }
}
