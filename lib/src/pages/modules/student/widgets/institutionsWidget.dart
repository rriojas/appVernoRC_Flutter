import 'package:flutter/material.dart';

class InstitutionsWidget extends StatefulWidget {
  const InstitutionsWidget({Key? key}) : super(key: key);

  @override
  State<InstitutionsWidget> createState() => _InstitutionsWidgetState();
}

class _InstitutionsWidgetState extends State<InstitutionsWidget> {
  @override
  Widget build(BuildContext context) {
    return FutureBuilder(builder: (_, data) {
      if (!data.hasData) {
        return const CircularProgressIndicator();
      }
      final list = data.data;
      return DropdownButtonFormField(items: const [
        DropdownMenuItem(
          child: Text('1'),
          value: '1',
        ),
        DropdownMenuItem(
          child: Text('1'),
          value: '1',
        ),
      ], onChanged: (onChanged) {});
    });
  }
}
