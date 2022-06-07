// To parse this JSON data, do
//
//     final availableProjectsModuleInterface = availableProjectsModuleInterfaceFromJson(jsonString);

import 'package:meta/meta.dart';
import 'dart:convert';

List<AvailableProjectsModuleInterface> availableProjectsModuleInterfaceFromJson(
        String str) =>
    List<AvailableProjectsModuleInterface>.from(json
        .decode(str)
        .map((x) => AvailableProjectsModuleInterface.fromJson(x)));

String availableProjectsModuleInterfaceToJson(
        List<AvailableProjectsModuleInterface> data) =>
    json.encode(List<dynamic>.from(data.map((x) => x.toJson())));

class AvailableProjectsModuleInterface {
  AvailableProjectsModuleInterface({
    @required this.idProyecto,
    @required this.tituloDeProyecto,
    @required this.porcentajeAvanceCarrera,
    @required this.carreraEnLaQueAplica,
    @required this.actividadesARealizar,
    @required this.habilidadesRequeridas,
    @required this.modalidadDeTrabajo,
    @required this.investigadorACargo,
    @required this.institucion,
    @required this.cantidadDeAlumnos,
    @required this.idArea,
    @required this.area,
    @required this.estadoDelProyecto,
  });

  String? idProyecto;
  String? tituloDeProyecto;
  String? porcentajeAvanceCarrera;
  String? carreraEnLaQueAplica;
  String? actividadesARealizar;
  String? habilidadesRequeridas;
  String? modalidadDeTrabajo;
  String? investigadorACargo;
  String? institucion;
  String? cantidadDeAlumnos;
  String? idArea;
  String? area;
  String? estadoDelProyecto;

  factory AvailableProjectsModuleInterface.fromJson(
          Map<String, dynamic> json) =>
      AvailableProjectsModuleInterface(
        idProyecto: json["idProyecto"],
        tituloDeProyecto: json["Titulo de proyecto"],
        porcentajeAvanceCarrera: json["Porcentaje Avance Carrera"],
        carreraEnLaQueAplica: json["Carrera en la que aplica"],
        actividadesARealizar: json["Actividades a realizar"],
        habilidadesRequeridas: json["Habilidades requeridas"],
        modalidadDeTrabajo: json["Modalidad de trabajo"],
        investigadorACargo: json["Investigador a cargo"],
        institucion: json["Institucion"],
        cantidadDeAlumnos: json["Cantidad de alumnos"],
        idArea: json["idArea"],
        area: json["Area"],
        estadoDelProyecto: json["Estado del proyecto"],
      );

  Map<String, dynamic> toJson() => {
        "idProyecto": idProyecto,
        "Titulo de proyecto": tituloDeProyecto,
        "Porcentaje Avance Carrera": porcentajeAvanceCarrera,
        "Carrera en la que aplica": carreraEnLaQueAplica,
        "Actividades a realizar": actividadesARealizar,
        "Habilidades requeridas": habilidadesRequeridas,
        "Modalidad de trabajo": modalidadDeTrabajo,
        "Investigador a cargo": investigadorACargo,
        "Institucion": institucion,
        "Cantidad de alumnos": cantidadDeAlumnos,
        "idArea": idArea,
        "Area": area,
        "Estado del proyecto": estadoDelProyecto,
      };
}
