// To parse this JSON data, do
//
//     final campusModuleInterface = campusModuleInterfaceFromJson(jsonString);

import 'package:meta/meta.dart';
import 'dart:convert';

List<CampusModuleInterface> campusModuleInterfaceFromJson(String str) =>
    List<CampusModuleInterface>.from(
        json.decode(str).map((x) => CampusModuleInterface.fromJson(x)));

String campusModuleInterfaceToJson(List<CampusModuleInterface> data) =>
    json.encode(List<dynamic>.from(data.map((x) => x.toJson())));

class CampusModuleInterface {
  CampusModuleInterface({
    @required this.idCampus,
    @required this.nombre,
    @required this.institucion,
    @required this.municipio,
  });

  String? idCampus;
  String? nombre;
  String? institucion;
  String? municipio;

  factory CampusModuleInterface.fromJson(Map<String, dynamic> json) =>
      CampusModuleInterface(
        idCampus: json["idCampus"],
        nombre: json["Nombre"],
        institucion: json["Institucion"],
        municipio: json["Municipio"],
      );

  Map<String, dynamic> toJson() => {
        "idCampus": idCampus,
        "Nombre": nombre,
        "Institucion": institucion,
        "Municipio": municipio,
      };
}
