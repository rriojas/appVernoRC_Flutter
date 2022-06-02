import 'package:flutter/material.dart';
import 'package:preyecto_tecnologico/src/pages/auth/LoginPage.dart';
import 'package:preyecto_tecnologico/src/streams/absorverPointer.dart';
import 'package:provider/provider.dart';

void main() {
  WidgetsFlutterBinding.ensureInitialized();
  runApp(
    MultiProvider(
      providers: [
        ChangeNotifierProvider(
          create: (_) => MyAbsorbPointer(),
        ),
      ],
      child: const MyApp(),
    ),
  );
}

class MyApp extends StatefulWidget {
  const MyApp({Key? key}) : super(key: key);

  @override
  State<MyApp> createState() => _MyAppState();
}

class _MyAppState extends State<MyApp> {
  late MyAbsorbPointer absorbStream;

  @override
  Widget build(BuildContext context) {
    absorbStream = Provider.of<MyAbsorbPointer>(context);
    return AbsorbPointer(
      absorbing: absorbStream.absorb,
      child: MaterialApp(
          debugShowCheckedModeBanner: false,
          title: 'Flutter Demo',
          theme: ThemeData(
            primarySwatch: Colors.blue,
          ),
          home: const LoginPage()),
    );
  }
}
