// To parse this JSON data, do
//
//     final validateStudentInterface = validateStudentInterfaceFromJson(jsonString);

import 'dart:convert';

ValidateStudentInterface validateStudentInterfaceFromJson(String str) =>
    ValidateStudentInterface.fromJson(json.decode(str));

String validateStudentInterfaceToJson(ValidateStudentInterface data) =>
    json.encode(data.toJson());

class ValidateStudentInterface {
  ValidateStudentInterface({
    this.documentos,
    this.proyectos,
  });

  List<Documento>? documentos;
  List<Proyecto>? proyectos;

  factory ValidateStudentInterface.fromJson(Map<String, dynamic> json) =>
      ValidateStudentInterface(
        documentos: List<Documento>.from(
            json["documentos"].map((x) => Documento.fromJson(x))),
        proyectos: List<Proyecto>.from(
            json["proyectos"].map((x) => Proyecto.fromJson(x))),
      );

  Map<String, dynamic> toJson() => {
        "documentos": List<dynamic>.from(documentos!.map((x) => x.toJson())),
        "proyectos": List<dynamic>.from(proyectos!.map((x) => x.toJson())),
      };
}

class Documento {
  Documento({
    this.cantidadDocumentos,
  });

  int? cantidadDocumentos;

  factory Documento.fromJson(Map<String, dynamic> json) => Documento(
        cantidadDocumentos: json["cantidadDocumentos"] != null
            ? int.parse(json["cantidadDocumentos"])
            : null,
      );

  Map<String, dynamic> toJson() => {
        "cantidadDocumentos": cantidadDocumentos,
      };
}

class Proyecto {
  Proyecto({
    this.cantidad,
  });

  int? cantidad;

  factory Proyecto.fromJson(Map<String, dynamic> json) => Proyecto(
        cantidad: json["cantidad"] != null ? int.parse(json["cantidad"]) : null,
      );

  Map<String, dynamic> toJson() => {
        "cantidad": cantidad,
      };
}
