import 'package:flutter/material.dart';

class MyProjectsPage extends StatelessWidget {
  const MyProjectsPage({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Mis proyectos'),
        centerTitle: true,
      ),
    );
  }
}
