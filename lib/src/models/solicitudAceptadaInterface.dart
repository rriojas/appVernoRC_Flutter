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
        idSolicitud: json["idSolicitud"],
        nombreDelAlumno: json["Nombre del Alumno"],
        institucionDelAlumno: json["Institucion del Alumno"],
        titulo: json["Titulo del Proyecto"],
        nombreInvestigador: json["Nombre del investigador"],
        institucionDelInvestigador: json["Institucion del Investigador"],
        idUsuarioAlumno: json["idUsuarioAlumno"],
        idUsuarioInvestigador: json["idUsuarioInvestigador"],
        idCampusInvestigador: json["idCampusInvestigador"],
        idCampusAlumno: json["idCampusAlumno"],
        idInstitucionInvestigador: json["idInstitucionInvestigador"],
        idInstitucionAlumno: json["Institucion del alumno"],
        correoAlumno: json["Correo del Alumno"],
        correoInvestigador: json["Correo del Investigad"],
        modalidad: json["Modalidad"],
        estatus: json["estatus"],
      );

  Map<String, dynamic> toJson() => {
        "idSolicitud": idSolicitud,
        "Nombre del Alumno": nombreDelAlumno,
        "Institucion del Alumno": institucionDelAlumno,
        "Titulo del Proyecto": titulo,
        "Nombre del investigador": nombreInvestigador,
        "Institucion del Investigador": institucionDelInvestigador,
        "idUsuarioAlumno": idUsuarioAlumno,
        "idUsuarioInvestigador": idUsuarioInvestigador,
        "idCampusInvestigador": idCampusInvestigador,
        "idCampusAlumno": idCampusAlumno,
        "idInstitucionInvestigador": idInstitucionInvestigador,
        "Institucion del alumno": idInstitucionAlumno,
        "Correo del Alumno": correoAlumno,
        "Correo del Investigad": correoInvestigador,
        "Modalidad": modalidad,
        "estatus": estatus,
      };
}
