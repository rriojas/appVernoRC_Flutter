import 'package:flutter/services.dart';
import 'package:mask_text_input_formatter/mask_text_input_formatter.dart';
import 'package:reactive_forms/reactive_forms.dart';

List<Map<String, Map<String, List<dynamic>>>> settingFormAddStudent = [
  {
    'Nombre': {
      'type': ['text'],
      'validators': [Validators.required, Validators.minLength(3)],
      'inputFormatted': []
    }
  },
  {
    'Apellido paterno': {
      'type': ['text'],
      'validators': [Validators.required],
      'inputFormatted': []
    }
  },
  {
    'Apellido materno': {
      'type': ['text'],
      'validators': [Validators.required],
      'inputFormatted': []
    }
  },
  {
    'Calle': {
      'type': ['text'],
      'validators': [Validators.required],
      'inputFormatted': []
    }
  },
  {
    'Numero': {
      'type': ['text'],
      'validators': [Validators.required],
      'inputFormatted': []
    }
  },
  {
    'Colonia': {
      'type': ['text'],
      'validators': [Validators.required],
      'inputFormatted': []
    }
  },
  {
    'Codígo postal': {
      'type': ['text'],
      'validators': [Validators.required],
      'inputFormatted': [
        (FilteringTextInputFormatter.allow(RegExp(r'[0-9]'))),
        LengthLimitingTextInputFormatter(5)
      ]
    }
  },
  {
    'Fecha de nacimiento': {
      'type': ['birth'],
      'validators': [Validators.required],
      'inputFormatted': []
    }
  },
  {
    'Genero': {
      'type': ['drop'],
      'validators': [Validators.required],
      'inputFormatted': []
    }
  },
  {
    'Telefono': {
      'type': ['text'],
      'validators': [Validators.required],
      'inputFormatted': [
        FilteringTextInputFormatter.allow(RegExp(r'[0-9]')),
        MaskTextInputFormatter(
            mask: '(###) ###-####', filter: {"#": RegExp(r'[0-9]')})
      ]
    }
  },
  {
    'Institución': {
      'type': ['drop'],
      'validators': [Validators.required],
      'inputFormatted': []
    }
  },
  {
    'Escuela/Facultad/Centro de investigación': {
      'type': ['drop'],
      'validators': [Validators.required],
      'inputFormatted': []
    }
  },
  {
    'Correo': {
      'type': ['text'],
      'validators': [Validators.required, Validators.email],
      'inputFormatted': []
    }
  },
  {
    'Contraseña': {
      'type': ['text'],
      'validators': [Validators.required],
      'inputFormatted': []
    }
  },
  {
    'Confirma contraseña': {
      'type': ['text'],
      'validators': [Validators.required],
      'inputFormatted': []
    }
  }
];

List<Map<String, Map<String, List<dynamic>>>> settingFormEditStudent = [
  {
    'matricula': {
      'label': ['Matricula'],
      'type': ['text'],
      'validators': [Validators.required, Validators.minLength(3)],
      'inputFormatted': []
    }
  },
  {
    'CURP': {
      'label': ['CURP'],
      'type': ['text'],
      'validators': [Validators.required],
      'inputFormatted': []
    }
  },
  {
    'semestre': {
      'label': ['Semestre'],
      'type': ['text'],
      'validators': [Validators.required],
      'inputFormatted': []
    }
  },
  {
    'promedio': {
      'label': ['Promedio'],
      'type': ['text'],
      'validators': [Validators.required],
      'inputFormatted': []
    }
  },
  {
    'porcentajeAvanceCarrera': {
      'label': ['Porcentaje Avance Carrera'],
      'type': ['text'],
      'validators': [Validators.required],
      'inputFormatted': []
    }
  },
  {
    'nombreInvestigadorRecomienda': {
      'label': ['Nombre del investigador y/o docente que lo recomienda'],
      'type': ['text'],
      'validators': [Validators.required],
      'inputFormatted': []
    }
  },
  {
    'correoInvestigadorRecomienda': {
      'label': ['Nombre del investigador y/o docente que lo recomienda'],
      'type': ['text'],
      'validators': [Validators.required, Validators.email],
      'inputFormatted': []
    }
  },
  {
    'telefonoInvestigadorRecomienda': {
      'label': ['Telefono Investigador Recomienda'],
      'type': ['text'],
      'validators': [Validators.required],
      'inputFormatted': [
        FilteringTextInputFormatter.allow(RegExp(r'[0-9]')),
        MaskTextInputFormatter(
            mask: '(###) ###-####', filter: {"#": RegExp(r'[0-9]')})
      ]
    }
  },
  {
    'Carrera': {
      'label': [''],
      'type': ['drop'],
      'validators': [Validators.required],
      'inputFormatted': []
    }
  }
];
