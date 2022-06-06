// To parse this JSON data, do
//
//     final investigatorModuleInterface = investigatorModuleInterfaceFromJson(jsonString);

import 'package:meta/meta.dart';
import 'dart:convert';

List<InvestigatorModuleInterface> investigatorModuleInterfaceFromJson(
        String str) =>
    List<InvestigatorModuleInterface>.from(
        json.decode(str).map((x) => InvestigatorModuleInterface.fromJson(x)));

String investigatorModuleInterfaceToJson(
        List<InvestigatorModuleInterface> data) =>
    json.encode(List<dynamic>.from(data.map((x) => x.toJson())));

class InvestigatorModuleInterface {
  InvestigatorModuleInterface({
    @required this.idInvestigador,
    @required this.usuario,
    @required this.telefono,
    @required this.proyectosRegistrados,
    @required this.campus,
    @required this.validado,
  });

  String? idInvestigador;
  String? usuario;
  String? telefono;
  String? proyectosRegistrados;
  String? campus;
  String? validado;

  factory InvestigatorModuleInterface.fromJson(Map<String, dynamic> json) =>
      InvestigatorModuleInterface(
        idInvestigador: json["idInvestigador"],
        usuario: json["usuario"],
        telefono: json["telefono"],
        proyectosRegistrados: json["Proyectos registrados"],
        campus: json["campus"],
        validado: json["validado"],
      );

  Map<String, dynamic> toJson() => {
        "idInvestigador": idInvestigador,
        "usuario": usuario,
        "telefono": telefono,
        "Proyectos registrados": proyectosRegistrados,
        "campus": campus,
        "validado": validado,
      };
}
