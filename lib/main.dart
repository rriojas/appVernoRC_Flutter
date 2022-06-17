import 'package:flutter/material.dart';
import 'package:preyecto_tecnologico/src/pages/auth/LoginPage.dart';
import 'package:preyecto_tecnologico/src/streams/absorverPointer.dart';
import 'package:provider/provider.dart';

import 'package:flutter_localizations/flutter_localizations.dart';

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
  static final navKey = new GlobalKey<NavigatorState>();
  const MyApp({Key? navKey}) : super(key: navKey);

  @override
  State<MyApp> createState() => _MyAppState();
}

class _MyAppState extends State<MyApp> {
  late MyAbsorbPointer absorbStream;

  @override
  Widget build(BuildContext context) {
    absorbStream = Provider.of<MyAbsorbPointer>(context);
    return MaterialApp(
        localizationsDelegates: [
          // ... app-specific localization delegate[s] here
          GlobalMaterialLocalizations.delegate,
          GlobalWidgetsLocalizations.delegate,
          GlobalCupertinoLocalizations.delegate,
        ],
        supportedLocales: [
          const Locale('es', 'ES')
        ],
        navigatorKey: MyApp.navKey,
        debugShowCheckedModeBanner: false,
        title: 'Flutter Demo',
        theme: ThemeData(
          primarySwatch: Colors.orange,
          inputDecorationTheme: const InputDecorationTheme(
            border: OutlineInputBorder(),
            contentPadding: EdgeInsets.symmetric(
              vertical: 22,
              horizontal: 26,
            ),
          ),
        ),
        home: const LoginPage());
  }
}
