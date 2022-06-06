// To parse this JSON data, do
//
//     final projectModuleInterface = projectModuleInterfaceFromJson(jsonString);

import 'package:meta/meta.dart';
import 'dart:convert';

List<ProjectModuleInterface> projectModuleInterfaceFromJson(String str) =>
    List<ProjectModuleInterface>.from(
        json.decode(str).map((x) => ProjectModuleInterface.fromJson(x)));

String projectModuleInterfaceToJson(List<ProjectModuleInterface> data) =>
    json.encode(List<dynamic>.from(data.map((x) => x.toJson())));

class ProjectModuleInterface {
  ProjectModuleInterface({
    @required this.idProyecto,
    @required this.investigador,
    @required this.titulo,
    @required this.modalidad,
    @required this.cantidadDeAlumnos,
    @required this.avanceCarrera,
    @required this.validado,
  });

  String? idProyecto;
  String? investigador;
  String? titulo;
  String? modalidad;
  String? cantidadDeAlumnos;
  String? avanceCarrera;
  String? validado;

  factory ProjectModuleInterface.fromJson(Map<String, dynamic> json) =>
      ProjectModuleInterface(
        idProyecto: json["idProyecto"],
        investigador: json["Investigador"],
        titulo: json["Titulo"],
        modalidad: json["Modalidad"],
        cantidadDeAlumnos: json["Cantidad de Alumnos"],
        avanceCarrera: json["Avance Carrera %"],
        validado: json["validado"],
      );

  Map<String, dynamic> toJson() => {
        "idProyecto": idProyecto,
        "Investigador": investigador,
        "Titulo": titulo,
        "Modalidad": modalidad,
        "Cantidad de Alumnos": cantidadDeAlumnos,
        "Avance Carrera %": avanceCarrera,
        "validado": validado,
      };
}
