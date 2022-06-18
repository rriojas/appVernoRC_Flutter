import 'dart:async';
import 'dart:convert' show json;
import 'package:http/http.dart' as http;
import 'package:preyecto_tecnologico/src/models/availableProjectsInterface.dart';
import 'package:preyecto_tecnologico/src/models/campusModuleInterface.dart';
import 'package:preyecto_tecnologico/src/models/infoAlumnoInterface.dart';
import 'package:preyecto_tecnologico/src/models/institutionCampusAvailable.dart';
import 'package:preyecto_tecnologico/src/models/investigatorModuleInterface.dart';
import 'package:preyecto_tecnologico/src/models/moduleStudentInterface.dart';
import 'package:preyecto_tecnologico/src/models/projectModuleInterface.dart';
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
    final url = '$baseUrl/modulos/alumno/editarAlumnoController.php';
    final body = {'id': id};

    final response =
        await http.post(Uri.parse(url), headers: service.headers, body: body);
    final data = inforAlumnoInterfaceFromJson(response.body);
    print(data.toJson()['Alumno']);
    //setInstitution(data);
    return data;
  }
}
