// To parse this JSON data, do
//
//     final institutionCampusAvailable = institutionCampusAvailableFromJson(jsonString);

import 'dart:convert';

InstitutionCampusAvailable institutionCampusAvailableFromJson(String str) =>
    InstitutionCampusAvailable.fromJson(json.decode(str));

String institutionCampusAvailableToJson(InstitutionCampusAvailable data) =>
    json.encode(data.toJson());

class InstitutionCampusAvailable {
  InstitutionCampusAvailable({
    this.instituciones,
    this.campus,
  });

  List<Campus>? instituciones;
  List<Campus>? campus;

  factory InstitutionCampusAvailable.fromJson(Map<String, dynamic> json) =>
      InstitutionCampusAvailable(
        instituciones: List<Campus>.from(
            json["instituciones"].map((x) => Campus.fromJson(x))),
        campus:
            List<Campus>.from(json["campus"].map((x) => Campus.fromJson(x))),
      );

  Map<String, dynamic> toJson() => {
        "instituciones":
            List<dynamic>.from(instituciones!.map((x) => x.toJson())),
        "campus": List<dynamic>.from(campus!.map((x) => x.toJson())),
      };
}

class Campus {
  Campus({
    this.id,
    this.descripcion,
  });

  String? id;
  String? descripcion;

  factory Campus.fromJson(Map<String, dynamic> json) => Campus(
        id: json["id"],
        descripcion: json["descripcion"],
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "descripcion": descripcion,
      };
}
