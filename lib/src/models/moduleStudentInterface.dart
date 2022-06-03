// To parse this JSON data, do
//
//     final moduleStudentInterface = moduleStudentInterfaceFromJson(jsonString);

import 'package:meta/meta.dart';
import 'dart:convert';

List<ModuleStudentInterface> moduleStudentInterfaceFromJson(String str) =>
    List<ModuleStudentInterface>.from(
        json.decode(str).map((x) => ModuleStudentInterface.fromJson(x)));

String moduleStudentInterfaceToJson(List<ModuleStudentInterface> data) =>
    json.encode(List<dynamic>.from(data.map((x) => x.toJson())));

class ModuleStudentInterface {
  ModuleStudentInterface({
    @required this.idAlumno,
    @required this.matricula,
    @required this.idUsuario,
    @required this.idCarrera,
    @required this.campus,
    @required this.validado,
    @required this.carrera,
    @required this.nombreDelAlumno,
  });

  String? idAlumno;
  String? matricula;
  String? idUsuario;
  String? idCarrera;
  String? campus;
  String? validado;
  String? carrera;
  String? nombreDelAlumno;

  factory ModuleStudentInterface.fromJson(Map<String, dynamic> json) =>
      ModuleStudentInterface(
        idAlumno: json["idAlumno"],
        matricula: json["Matricula"],
        idUsuario: json["idUsuario"],
        idCarrera: json["idCarrera"],
        campus: json["campus"],
        validado: json["validado"],
        carrera: json["Carrera"],
        nombreDelAlumno: json["Nombre del alumno"],
      );

  Map<String, dynamic> toJson() => {
        "idAlumno": idAlumno,
        "Matricula": matricula,
        "idUsuario": idUsuario,
        "idCarrera": idCarrera,
        "campus": campus,
        "validado": validado,
        "Carrera": carrera,
        "Nombre del alumno": nombreDelAlumno,
      };
}
