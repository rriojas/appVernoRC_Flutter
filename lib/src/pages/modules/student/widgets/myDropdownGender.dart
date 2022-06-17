import 'package:flutter/material.dart';

class MyDropdownGender extends StatefulWidget {
  final TextEditingController controller;
  const MyDropdownGender({
    Key? key,
    required this.controller,
  }) : super(key: key);

  @override
  State<MyDropdownGender> createState() => _MyDropdownGenderState();
}

class _MyDropdownGenderState extends State<MyDropdownGender> {
  String gender = 'Masculino';

  @override
  void initState() {
    widget.controller.text = 'Masculino';

    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return DropdownButtonFormField(
        value: gender,
        items: const [
          DropdownMenuItem<String>(
            child: Text(
              'Masculino',
            ),
            value: 'Masculino',
          ),
          DropdownMenuItem<String>(
            child: Text(
              'Femenino',
            ),
            value: 'Femenino',
          ),
        ],
        onChanged: (dynamic value) {
          setState(() {
            widget.controller.text = value;
          });
        });
  }
}
