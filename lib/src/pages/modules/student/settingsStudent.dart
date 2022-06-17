import 'package:flutter/services.dart';
import 'package:mask_text_input_formatter/mask_text_input_formatter.dart';
import 'package:reactive_forms/reactive_forms.dart';

final listTextFieldMap = [
  {
    'Nombre': {
      'validators': () => [Validators.required, Validators.minLength(3)],
      'inputFormatted': () => []
    }
  },
  {
    'Apellido paterno': {
      'validators': () => [Validators.required],
      'inputFormatted': () => []
    }
  },
  {
    'Apellido materno': {
      'validators': () => [Validators.required],
      'inputFormatted': () => []
    }
  },
  {
    'Calle': {
      'validators': () => [Validators.required],
      'inputFormatted': () => []
    }
  },
  {
    'Numero': {
      'validators': () => [Validators.required],
      'inputFormatted': () => []
    }
  },
  {
    'Colonia': {
      'validators': () => [Validators.required],
      'inputFormatted': () => []
    }
  },
  {
    'Codígo postal': {
      'validators': () => [Validators.required],
      'inputFormatted': () => [
            (FilteringTextInputFormatter.allow(RegExp(r'[0-9]'))),
            LengthLimitingTextInputFormatter(5)
          ]
    }
  },
  {
    'Fecha de nacimiento': {
      'validators': () => [Validators.required],
      'inputFormatted': () => []
    }
  },
  {
    'Genero': {
      'validators': () => [Validators.required],
      'inputFormatted': () => []
    }
  },
  {
    'Telefono': {
      'validators': () => [Validators.required],
      'inputFormatted': () => [
            FilteringTextInputFormatter.allow(RegExp(r'[0-9]')),
            MaskTextInputFormatter(
                mask: '(###) ###-####', filter: {"#": RegExp(r'[0-9]')})
          ]
    }
  },
  {
    'Institución': {
      'validators': () => [Validators.required],
      'inputFormatted': () => []
    }
  },
  {
    'Escuela/Facultad/Centro de investigación': {
      'validators': () => [Validators.required],
      'inputFormatted': () => []
    }
  },
  {
    'Correo': {
      'validators': () => [Validators.required, Validators.email],
      'inputFormatted': () => []
    }
  },
  {
    'Contraseña': {
      'validators': () => [Validators.required],
      'inputFormatted': () => []
    }
  },
  {
    'Confirma contraseña': {
      'validators': () => [Validators.required],
      'inputFormatted': () => []
    }
  }
];
