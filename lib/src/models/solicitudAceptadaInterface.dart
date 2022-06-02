// To parse this JSON data, do
//
//     final solicitudAceptadaInterface = solicitudAceptadaInterfaceFromJson(jsonString);

import 'dart:convert';

List<SolicitudAceptadaInterface> solicitudAceptadaInterfaceFromJson(
        String str) =>
    List<SolicitudAceptadaInterface>.from(
        json.decode(str).map((x) => SolicitudAceptadaInterface.fromJson(x)));

String solicitudAceptadaInterfaceToJson(
        List<SolicitudAceptadaInterface> data) =>
    json.encode(List<dynamic>.from(data.map((x) => x.toJson())));

class SolicitudAceptadaInterface {
  SolicitudAceptadaInterface({
    this.idSolicitud,
    this.nombreDelAlumno,
    this.institucionDelAlumno,
    this.titulo,
    this.nombreInvestigador,
    this.institucionDelInvestigador,
    this.idUsuarioAlumno,
    this.idUsuarioInvestigador,
    this.idCampusInvestigador,
    this.idCampusAlumno,
    this.idInstitucionInvestigador,
    this.idInstitucionAlumno,
    this.correoAlumno,
    this.correoInvestigador,
    this.modalidad,
    this.estatus,
  });

  final String? idSolicitud;
  final String? nombreDelAlumno;
  final String? institucionDelAlumno;
  final String? titulo;
  final String? nombreInvestigador;
  final String? institucionDelInvestigador;
  final String? idUsuarioAlumno;
  final String? idUsuarioInvestigador;
  final String? idCampusInvestigador;
  final String? idCampusAlumno;
  final String? idInstitucionInvestigador;
  final String? idInstitucionAlumno;
  final String? correoAlumno;
  final String? correoInvestigador;
  final String? modalidad;
  final String? estatus;

  factory SolicitudAceptadaInterface.fromJson(Map<String, dynamic> json) =>
      SolicitudAceptadaInterface(
        idSolicitud: json["idSolicitud"] == null ? null : json["idSolicitud"],
        nombreDelAlumno: json["Nombre del Alumno"] == null
            ? null
            : json["Nombre del Alumno"],
        institucionDelAlumno: json["Institucion del Alumno"] == null
            ? null
            : json["Institucion del Alumno"],
        titulo: json["Titulo del Proyecto"] == null
            ? null
            : json["Titulo del Proyecto"],
        nombreInvestigador: json["Nombre del investigador"] == null
            ? null
            : json["Nombre del investigador"],
        institucionDelInvestigador: json["Institucion del Investigador"] == null
            ? null
            : json["Institucion del Investigador"],
        idUsuarioAlumno:
            json["idUsuarioAlumno"] == null ? null : json["idUsuarioAlumno"],
        idUsuarioInvestigador: json["idUsuarioInvestigador"] == null
            ? null
            : json["idUsuarioInvestigador"],
        idCampusInvestigador: json["idCampusInvestigador"] == null
            ? null
            : json["idCampusInvestigador"],
        idCampusAlumno:
            json["idCampusAlumno"] == null ? null : json["idCampusAlumno"],
        idInstitucionInvestigador: json["idInstitucionInvestigador"] == null
            ? null
            : json["idInstitucionInvestigador"],
        idInstitucionAlumno: json["Institucion del alumno"] == null
            ? null
            : json["Institucion del alumno"],
        correoAlumno: json["Correo del Alumno"] == null
            ? null
            : json["Correo del Alumno"],
        correoInvestigador: json["Correo del Investigad"] == null
            ? null
            : json["Correo del Investigad"],
        modalidad: json["Modalidad"] == null ? null : json["Modalidad"],
        estatus: json["estatus"] == null ? null : json["estatus"],
      );

  Map<String, dynamic> toJson() => {
        "idSolicitud": idSolicitud == null ? null : idSolicitud,
        "Nombre del Alumno": nombreDelAlumno == null ? null : nombreDelAlumno,
        "Institucion del Alumno":
            institucionDelAlumno == null ? null : institucionDelAlumno,
        "Titulo del Proyecto": titulo == null ? null : titulo,
        "Nombre del investigador":
            nombreInvestigador == null ? null : nombreInvestigador,
        "Institucion del Investigador": institucionDelInvestigador == null
            ? null
            : institucionDelInvestigador,
        "idUsuarioAlumno": idUsuarioAlumno == null ? null : idUsuarioAlumno,
        "idUsuarioInvestigador":
            idUsuarioInvestigador == null ? null : idUsuarioInvestigador,
        "idCampusInvestigador":
            idCampusInvestigador == null ? null : idCampusInvestigador,
        "idCampusAlumno": idCampusAlumno == null ? null : idCampusAlumno,
        "idInstitucionInvestigador": idInstitucionInvestigador == null
            ? null
            : idInstitucionInvestigador,
        "Institucion del alumno":
            idInstitucionAlumno == null ? null : idInstitucionAlumno,
        "Correo del Alumno": correoAlumno == null ? null : correoAlumno,
        "Correo del Investigad":
            correoInvestigador == null ? null : correoInvestigador,
        "Modalidad": modalidad == null ? null : modalidad,
        "estatus": estatus == null ? null : estatus,
      };
}
