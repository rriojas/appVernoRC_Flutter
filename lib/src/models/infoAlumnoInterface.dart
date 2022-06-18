// To parse this JSON data, do
//
//     final inforAlumnoInterface = inforAlumnoInterfaceFromJson(jsonString);

import 'dart:convert';

InforAlumnoInterface inforAlumnoInterfaceFromJson(String str) =>
    InforAlumnoInterface.fromJson(json.decode(str));

String inforAlumnoInterfaceToJson(InforAlumnoInterface data) =>
    json.encode(data.toJson());

class InforAlumnoInterface {
  InforAlumnoInterface({
    this.optCarrera,
    this.alumno,
  });

  List<OptCarrera>? optCarrera;
  Alumno? alumno;

  factory InforAlumnoInterface.fromJson(Map<String, dynamic> json) =>
      InforAlumnoInterface(
        optCarrera: List<OptCarrera>.from(
            json["optCarrera"].map((x) => OptCarrera.fromJson(x))),
        alumno: Alumno.fromJson(json["Alumno"]),
      );

  Map<String, dynamic> toJson() => {
        "optCarrera": List<dynamic>.from(optCarrera!.map((x) => x.toJson())),
        "Alumno": alumno?.toJson(),
      };
}

class Alumno {
  Alumno({
    this.idAlumno,
    this.matricula,
    this.curp,
    this.semestre,
    this.promedio,
    this.porcentajeAvanceCarrera,
    this.idCarrera,
    this.nombreInvestigadorRecomienda,
    this.telefonoInvestigadorRecomienda,
    this.correoInvestigadorRecomienda,
    this.idUsuario,
    this.idVerano,
    this.fechaCreacion,
    this.fechaModifica,
    this.estatus,
    this.columnAlias,
  });

  String? idAlumno;
  String? matricula;
  String? curp;
  String? semestre;
  String? promedio;
  String? porcentajeAvanceCarrera;
  String? idCarrera;
  String? nombreInvestigadorRecomienda;
  String? telefonoInvestigadorRecomienda;
  String? correoInvestigadorRecomienda;
  String? idUsuario;
  String? idVerano;
  String? fechaCreacion;
  String? fechaModifica;
  String? estatus;
  Alumno? columnAlias;

  factory Alumno.fromJson(Map<String, dynamic> json) => Alumno(
        idAlumno: json["idAlumno"],
        matricula: json["matricula"],
        curp: json["CURP"],
        semestre: json["semestre"],
        promedio: json["promedio"],
        porcentajeAvanceCarrera: json["porcentajeAvanceCarrera"],
        idCarrera: json["idCarrera"],
        nombreInvestigadorRecomienda: json["nombreInvestigadorRecomienda"],
        telefonoInvestigadorRecomienda: json["telefonoInvestigadorRecomienda"],
        correoInvestigadorRecomienda: json["correoInvestigadorRecomienda"],
        idUsuario: json["idUsuario"],
        idVerano: json["idVerano"],
        fechaCreacion: json["fechaCreacion"],
        fechaModifica: json["fechaModifica"],
        estatus: json["estatus"],
        columnAlias: json["ColumnAlias"] == null
            ? null
            : Alumno.fromJson(json["ColumnAlias"]),
      );

  Map<String, dynamic> toJson() => {
        "idAlumno": idAlumno,
        "matricula": matricula,
        "CURP": curp,
        "semestre": semestre,
        "promedio": promedio,
        "porcentajeAvanceCarrera": porcentajeAvanceCarrera,
        "idCarrera": idCarrera,
        "nombreInvestigadorRecomienda": nombreInvestigadorRecomienda,
        "telefonoInvestigadorRecomienda": telefonoInvestigadorRecomienda,
        "correoInvestigadorRecomienda": correoInvestigadorRecomienda,
        "idUsuario": idUsuario,
        "idVerano": idVerano,
        "fechaCreacion": fechaCreacion,
        "fechaModifica": fechaModifica,
        "estatus": estatus,
        "ColumnAlias": columnAlias == null ? null : columnAlias!.toJson(),
      };
}

class OptCarrera {
  OptCarrera({
    this.id,
    this.descripcion,
  });

  String? id;
  String? descripcion;

  factory OptCarrera.fromJson(Map<String, dynamic> json) => OptCarrera(
        id: json["id"],
        descripcion: json["descripcion"],
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "descripcion": descripcion,
      };
}
