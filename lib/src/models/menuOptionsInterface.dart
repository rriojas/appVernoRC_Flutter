// To parse this JSON data, do
//
//     final menuOptionsInterface = menuOptionsInterfaceFromJson(jsonString);

import 'package:meta/meta.dart';
import 'dart:convert';

List<MenuOptionsInterface> menuOptionsInterfaceFromJson(String str) =>
    List<MenuOptionsInterface>.from(
        json.decode(str).map((x) => MenuOptionsInterface.fromJson(x)));

String menuOptionsInterfaceToJson(List<MenuOptionsInterface> data) =>
    json.encode(List<dynamic>.from(data.map((x) => x.toJson())));

class MenuOptionsInterface {
  MenuOptionsInterface({
    @required this.idmodulo,
    @required this.nombre,
    @required this.descripcion,
    @required this.ruta,
    @required this.idtipousuario,
    @required this.estatus,
  });

  String? idmodulo;
  String? nombre;
  String? descripcion;
  String? ruta;
  String? idtipousuario;
  String? estatus;

  factory MenuOptionsInterface.fromJson(Map<String, dynamic> json) =>
      MenuOptionsInterface(
        idmodulo: json["idmodulo"],
        nombre: json["nombre"],
        descripcion: json["descripcion"],
        ruta: json["ruta"],
        idtipousuario: json["idtipousuario"],
        estatus: json["estatus"],
      );

  Map<String, dynamic> toJson() => {
        "idmodulo": idmodulo,
        "nombre": nombre,
        "descripcion": descripcion,
        "ruta": ruta,
        "idtipousuario": idtipousuario,
        "estatus": estatus,
      };
}
