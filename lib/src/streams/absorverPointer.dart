import 'dart:async';

import 'package:flutter/material.dart';

class MyAbsorbPointer extends ChangeNotifier {
  bool _absorbState = false;

  set absorb(bool state) {
    _absorbState = state;
    notifyListeners();
  }

  bool get absorb {
    return _absorbState;
  }
}
