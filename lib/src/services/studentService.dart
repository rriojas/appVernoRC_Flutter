import 'dart:async';
import 'dart:convert' show Utf8Decoder;
import 'package:http/http.dart' as http;
import 'package:preyecto_tecnologico/src/models/infoAlumnoInterface.dart';
import 'package:preyecto_tecnologico/src/models/institutionCampusAvailable.dart';
import 'package:preyecto_tecnologico/src/models/moduleStudentInterface.dart';
import 'package:preyecto_tecnologico/src/models/validateStudentInterface.dart';
import 'package:preyecto_tecnologico/src/providers/baseUrl.dart';
import 'package:preyecto_tecnologico/src/services/loginService.dart';

class StudentService {
  final service = LoginService();

  final _institutionController =
      StreamController<InstitutionCampusAvailable>.broadcast();
  Stream<InstitutionCampusAvailable> get getInstitutionStream =>
      _institutionController.stream;
  void setInstitution(InstitutionCampusAvailable ins) {
    _institutionController.add(ins);
  }

  Future<List<ModuleStudentInterface>> getModuleStudent() async {
    const url3 = '$baseUrl/modulos/alumno/alumnoController.php';
    final re3 = await http.get(Uri.parse(url3), headers: service.headers);

    final resp3 = moduleStudentInterfaceFromJson(re3.body);

    return resp3;
  }

  Future<InstitutionCampusAvailable> getAvailableInstitutions() async {
    const url =
        '$baseUrl/modulos/usuario/instituciones.php?id=5&idTipoUsuario=5';
    final body = {'id': '5', 'method': 'Login'};

    final response =
        await http.post(Uri.parse(url), headers: service.headers, body: body);
    final data = institutionCampusAvailableFromJson(response.body);

    setInstitution(data);
    return data;
  }

  Future<InforAlumnoInterface> getStudent(String id) async {
    const url = '$baseUrl/modulos/alumno/editarAlumnoController.php';
    final body = {'id': id};

    final http.Response response =
        await http.post(Uri.parse(url), headers: service.headers, body: body);

    final data = inforAlumnoInterfaceFromJson(
        const Utf8Decoder().convert(response.bodyBytes));

    //setInstitution(data);
    return data;
  }

  Future updateStudent(dynamic body) async {
    const url = '$baseUrl/modulos/alumno/alumnoController.php?method=Update';

    final http.Response response =
        await http.post(Uri.parse(url), headers: service.headers, body: body);

    print(response.body);

    // final data = inforAlumnoInterfaceFromJson(
    //   const Utf8Decoder().convert(response.bodyBytes));

    //setInstitution(data);
    return null;
  }

  Future<ValidateStudentInterface> getStatusStudent(dynamic body) async {
    const url = '$baseUrl/modulos/alumno/validar.php';
    final data = {'id': body};
    final http.Response response =
        await http.post(Uri.parse(url), headers: service.headers, body: data);

    final statusStudent = validateStudentInterfaceFromJson(response.body);

    // final data = inforAlumnoInterfaceFromJson(
    //   const Utf8Decoder().convert(response.bodyBytes));

    //setInstitution(data);
    return statusStudent;
  }

  Future changeStatusValidateStudent(dynamic body, String method) async {
    const url = '$baseUrl/modulos/usuario/usuarioController.php';

    final data = {'idAlumno': body, 'method': method};
    print(data);
    final http.Response response =
        await http.post(Uri.parse(url), headers: service.headers, body: data);

    print(response.body);

    // final data = inforAlumnoInterfaceFromJson(
    //   const Utf8Decoder().convert(response.bodyBytes));

    //setInstitution(data);
    return null;
  }
}
