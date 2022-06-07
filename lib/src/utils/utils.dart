class Utils {
  String capitalizer(String text) {
    final array = text.split(' ');
    String textCapitalizer = '';
    for (var i = 0; i < array.length; i++) {
      if (array[i] != '') {
        textCapitalizer += array[i][0].toUpperCase() +
            array[i].substring(1).toLowerCase() +
            ' ';
      }
    }

    return textCapitalizer;
  }

  getNameImage(String idArea) {
    switch (idArea) {
      case '1':
        return "cienciasagropecuarias.jpg";
      case '2':
        return "cienciassalud.jpg";

      case '3':
        return "Ciencias_Exactas.jpg";

      case '4':
        return "cienciassociales.jpg";

      case '5':
        return "artes.jpg";

      case '6':
        return "tecnologia.jpg";

      case '7':
        return "economia.jpg";

      default:
    }
  }
}
