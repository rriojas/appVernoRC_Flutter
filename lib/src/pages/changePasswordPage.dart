import 'package:flutter/material.dart';

class ChangePasswordPage extends StatelessWidget {
  const ChangePasswordPage({Key? key}) : super(key: key);

  final InputBorder _inputBorder = const OutlineInputBorder(
      borderSide: BorderSide(color: Colors.white, width: 1.0));

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color.fromRGBO(19, 35, 88, 1.0),
      appBar: AppBar(
        title: const Text('Cambiar contraseña'),
        centerTitle: true,
      ),
      body: createBody(),
    );
  }

  createBody() {
    return Padding(
      padding: const EdgeInsets.all(20.0),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          createTextField('Contraseña'),
          createTextField('Confirma contraseña'),
          Container(
              width: double.infinity,
              height: 55,
              child: ElevatedButton(
                  onPressed: () {}, child: const Text('Aceptar')))
        ],
      ),
    );
  }

  createTextField(String label) {
    return TextFormField(
      keyboardType: TextInputType.text,
      decoration: InputDecoration(
          suffixIcon: const Icon(Icons.lock, color: Colors.white),
          errorBorder: _inputBorder,
          disabledBorder: _inputBorder,
          errorStyle: TextStyle(color: Colors.white.withOpacity(0.5)),
          enabledBorder: _inputBorder,
          focusColor: Colors.white,
          focusedErrorBorder: _inputBorder,
          focusedBorder: _inputBorder,
          border: _inputBorder,
          alignLabelWithHint: false,
          labelText: label,
          labelStyle: const TextStyle(
            color: Colors.white,
          ),
          errorText: ''),
      obscureText: true,
      cursorColor: Colors.white,
      style: const TextStyle(color: Colors.white),
    );
  }
}
