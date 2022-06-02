import 'dart:async';
import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart';
import 'package:preyecto_tecnologico/src/pages/homePage.dart';
import 'package:preyecto_tecnologico/src/services/loginService.dart';
import 'package:preyecto_tecnologico/src/streams/absorverPointer.dart';

import 'components/TextFormFieldStyle.dart';
import 'package:crypto/crypto.dart';

class LoginPage extends StatefulWidget {
  const LoginPage({Key? key}) : super(key: key);

  @override
  State<LoginPage> createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> with TickerProviderStateMixin {
  final formGlobalKey = GlobalKey<FormState>();

  final _usage = 'Usage: dart hash.dart <md5|sha1|sha256> <input_filename>';

  var data = utf8.encode("some text"); // data being hashed

  final InputBorder _inputBorder = const OutlineInputBorder(
      borderSide: BorderSide(color: Colors.white, width: 1.0));

  TextEditingController? _userTextEditingController;
  TextEditingController? _passwordTextEditingController;

  bool _validatePasswordLength = false;

  bool _validateUserLength = false;
  double borderRadius = 0;
  String? _user;
  String? _password;

  bool _obscureText = true;

  int state = 0;

  GlobalKey globalKeyButton = GlobalKey();

  late Animation _animation;

  late AnimationController controller;

  double width = double.infinity;

  final textFormFieldComponet = TextFormFieldStyle;

  LoginService? loginService;

  final absorb = MyAbsorbPointer();

  @override
  void initState() {
    loginService = LoginService();
    _userTextEditingController =
        TextEditingController(text: 'i11050252@monclova.tecnm.mx');
    controller = AnimationController(
        vsync: this, duration: const Duration(milliseconds: 400));

    _passwordTextEditingController =
        TextEditingController(text: 'Pa\$\$w0rdmx');

    WidgetsBinding.instance?.addPostFrameCallback((timeStamp) {});
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      //  appBar: AppBar(),
      backgroundColor: const Color.fromRGBO(19, 35, 88, 1.0),
      body: _crearLogin(context),
    );
  }

  Widget _crearLogin(BuildContext context) {
    final size = MediaQuery.of(context).size;
    return SafeArea(
      child: Center(
        child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: <Widget>[
              SizedBox(
                  width: size.width * 0.75,
                  child: Form(
                    key: formGlobalKey,
                    child: Column(
                      children: <Widget>[
                        _crearUsuario(
                            //    _loginBloc,
                            ),
                        const SizedBox(
                          height: 10.0,
                        ),
                        _crearContrasena(
                            //    _loginBloc,
                            ),
                        const SizedBox(
                          height: 50.0,
                        ),
                        createButton()
                      ],
                    ),
                  )),
            ]),
      ),
    );
  }

  Widget createButton() {
    return SizedBox(
        key: globalKeyButton,
        height: 50.0,
        width: width,
        child: ElevatedButton(
          style: ElevatedButton.styleFrom(
            primary: const Color.fromRGBO(29, 92, 123, 1.0),
            padding: const EdgeInsets.all(5.0),
            shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(borderRadius)),
          ),
          child: buildButtonChild(),
          onPressed: () => _validate(),
        ));
  }

  Widget buildButtonChild() {
    if (state == 0) {
      return const Text('Aceptar',
          style: TextStyle(color: Colors.white, fontSize: 16.0));
    } else if (state == 1) {
      return const CircularProgressIndicator(
        value: null,
        valueColor: AlwaysStoppedAnimation<Color>(Colors.white),
      );
    } else {
      return Icon(Icons.check, color: Colors.green[100]);
    }
  }

  Widget _crearUsuario(
//  LoginBloc? _loginBloc,
      ) {
    return TextFormField(
      onEditingComplete: () {
        if (_validatePasswordLength && _validateUserLength) {
          _validate();
        } else {
          FocusScope.of(context).unfocus();
        }
      },
      // initialValue: 'ultrabox_198',

      controller: _userTextEditingController,
      onChanged: (user) {
        if (user.length > 2) {
          _validateUserLength = true;
        } else {
          _validateUserLength = false;
        }
      },
      validator: (onValue) {
        if (onValue!.length < 2) {
          return 'Mínimo 3 caracteres';
        }
        return null;
      },
      onSaved: (input) => _user = input,
      keyboardType: TextInputType.text,
      decoration: InputDecoration(
          suffixIcon: const Icon(Icons.person, color: Colors.white),
          errorBorder: _inputBorder,
          disabledBorder: _inputBorder,
          errorStyle: TextStyle(color: Colors.white.withOpacity(0.5)),
          enabledBorder: _inputBorder,
          focusColor: Colors.white,
          focusedErrorBorder: _inputBorder,
          focusedBorder: _inputBorder,
          border: _inputBorder,
          alignLabelWithHint: false,
          labelText: 'Usuario',
          labelStyle: const TextStyle(
            color: Colors.white,
          ),
          errorText: ''),
      cursorColor: Colors.white,
      style: const TextStyle(color: Colors.white),
    );
  }

  void _validate() {
    if (formGlobalKey.currentState!.validate()) {
      borderRadius = 30.0;
      absorb.absorb = true;

      if (state == 0) {
        animateButton();
      }

      loginService
          ?.login(_userTextEditingController!.text,
              _passwordTextEditingController!.text)
          .then((value) {
        absorb.absorb = false;
        Navigator.push(
            context, MaterialPageRoute(builder: (_) => const HomePAge()));
        controller.reverse();
        state = 0;
        borderRadius = 0;
      });

      //   _absorber.absorb = true;
      FocusScope.of(context).unfocus();

      Timer(const Duration(milliseconds: 500), () {
        formGlobalKey.currentState!.save();

        /* _sessionProvider.obtenerImages(_user, context).then((onValue) {
          if (onValue != null) {
            if (onValue) {
              Navigator.pushNamed(context, 'images', arguments: {
                'user': _user,
                'password': _password,
              }).then((onValue) {
                if (onValue == false) {
                  _passwordTextEditingController!.clear();
                }
              });
            } else {
              aviso.myShowModalBottomSheet(
                  context: context,
                  title: 'Aviso',
                  icon: Icons.warning,
                  colorIcon: Colors.red,
                  container:
                      'Tenemos problemas de comunicación, intenta más tarde.');
            }
          }
          controller.reverse();
          Timer(Duration(milliseconds: 300), () {
            state = 0;
            borderRadius = 0;
            _absorber.absorb = false;
          });
        }); */
      });
    }
  }

  void animateButton() {
    double initialWidth = globalKeyButton.currentContext!.size!.width;

    _animation = Tween(begin: 0.0, end: 1.0).animate(controller)
      ..addListener(() {
        setState(() {
          width = initialWidth - ((initialWidth - 48) * _animation.value);
        });
      });

    controller.forward();
    setState(() {
      state = 1;
    });
  }

  Widget _crearContrasena(
      // LoginBloc? _loginBloc,
      ) {
    return TextFormField(
      onEditingComplete: () {
        if (_validatePasswordLength && _validateUserLength) {
          _validate();
        } else {
          FocusScope.of(context).unfocus();
        }
      },
      controller: _passwordTextEditingController,
      //  focusNode: _passwordFocusNode,
      onChanged: (password) {
        //  _loginBloc!.changePassword(password);
        if (password.length > 7) {
          _validatePasswordLength = true;
        } else {
          _validatePasswordLength = false;
        }
        setState(() {});
      },
      validator: (onValue) {
        if (onValue!.length < 7) {
          return 'Mínimo 8 caracteres';
        }
        return null;
      },
      textCapitalization: TextCapitalization.none,
      onSaved: (password) {
        _password = password;
      },
      style: const TextStyle(color: Colors.white, fontSize: 15.0),
      keyboardType: TextInputType.text,
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
            setState(() {
              _obscureText = !_obscureText;
            });
          },
          icon: const Icon(
            Icons.remove_red_eye,
            color: Colors.white,
          ),
        ),
        labelText: 'Contraseña',
      ),
      cursorColor: Colors.white,
      obscureText: _obscureText,
    );
  }
}
