import 'package:flutter/material.dart';

class TextFormFieldStyle {
  final InputBorder _inputBorder = const OutlineInputBorder(
      borderSide: BorderSide(color: Colors.white, width: 1.0));
  bool _obscureText = false;

  createStyleForm() {
    return TextFormField(
      onEditingComplete: () {},
      decoration: InputDecoration(
        errorText: '',
        disabledBorder: _inputBorder,
        errorStyle: TextStyle(color: Colors.white.withOpacity(0.5)),
        enabledBorder: _inputBorder,
        border: _inputBorder,
        focusColor: Colors.white,
        errorBorder: _inputBorder,
        labelStyle: const TextStyle(color: Colors.white),
        focusedErrorBorder: _inputBorder,
        focusedBorder: _inputBorder,
        suffixIcon: IconButton(
          onPressed: () {
            _obscureText = !_obscureText;
          },
          icon: const Icon(
            Icons.remove_red_eye,
            color: Colors.white,
          ),
        ),
        labelText: 'Contraseña',
      ),
    );
  }
}
