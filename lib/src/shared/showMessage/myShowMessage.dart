import 'package:flutter/material.dart';

class MyShowMessages {
  Future<bool> myShowModalBottomSheet(
      {required BuildContext context,
      Function? callBackOne,
      Function? callBackTwo,
      bool? isDismissible,
      IconData? icon,
      Color? colorIcon,
      Color? backGroundColor,
      Color? colorAvatar,
      String? title,
      String? titleButtonOne,
      String? container,
      double? heightBoxContainer,
      String? titleButtonTwo}) async {
    bool result = false;
    showModalBottomSheet(
        barrierColor: backGroundColor,
        enableDrag: false,
        isDismissible: isDismissible ?? false,
        context: context,
        builder: (_) {
          return WillPopScope(
            onWillPop: () => Future.value(false),
            child: MediaQuery(
              data: newMethod(context).copyWith(
                  textScaleFactor: MediaQuery.of(context).textScaleFactor.clamp(
                        0.8,
                        1.3,
                      )),
              child: Wrap(
                crossAxisAlignment: WrapCrossAlignment.center,
                alignment: WrapAlignment.center,
                children: <Widget>[
                  Container(
                      padding: const EdgeInsets.only(top: 16.0),
                      height: heightBoxContainer ?? 300,
                      child: Column(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: <Widget>[
                          CircleAvatar(
                            backgroundColor: colorAvatar ?? Colors.white12,
                            child: Icon(
                              icon,
                              color: colorIcon,
                              size: 35.0,
                            ),
                          ),
                          const Padding(
                            padding: EdgeInsets.only(top: 10.0),
                          ),
                          title != null
                              ? Text(
                                  title,
                                  textAlign: TextAlign.center,
                                  style: const TextStyle(
                                      fontWeight: FontWeight.bold,
                                      fontSize: 17.0),
                                )
                              : Container(),
                          const SizedBox(
                            height: 10,
                          ),
                          FractionallySizedBox(
                            widthFactor: 0.85,
                            child: Text(
                              container!,
                              textAlign: TextAlign.center,
                              style:
                                  const TextStyle(fontStyle: FontStyle.italic),
                            ),
                          ),
                          const Padding(
                            padding: EdgeInsets.only(top: 10.0),
                          ),
                          FractionallySizedBox(
                            child: Column(
                              children: <Widget>[
                                ElevatedButton(
                                  style: ElevatedButton.styleFrom(
                                    padding: const EdgeInsets.symmetric(
                                        horizontal: 20.0),
                                    primary:
                                        const Color.fromRGBO(00, 77, 116, 1.0),
                                  ),
                                  child: Text(
                                    titleButtonOne ?? 'Aceptar',
                                    style: const TextStyle(
                                        color: Colors.white, fontSize: 17),
                                  ),
                                  onPressed: () {
                                    if (callBackOne != null) {
                                      callBackOne();
                                      result = true;
                                    } else {
                                      Navigator.pop(context);
                                    }
                                    result = true;
                                  },
                                ),
                                titleButtonTwo != null
                                    ? TextButton(
                                        style: TextButton.styleFrom(
                                            textStyle: TextStyle(
                                          color:
                                              Color.fromRGBO(00, 77, 116, 1.0),
                                        )),
                                        onPressed: () {
                                          if (callBackTwo != null) {
                                            callBackTwo();
                                          } else {
                                            Navigator.pop(context);
                                          }
                                        },
                                        child: Text(
                                          titleButtonTwo,
                                          style: TextStyle(
                                            color: Color.fromRGBO(
                                                00, 77, 116, 1.0),
                                          ),
                                        ),
                                      )
                                    : Container()
                              ],
                            ),
                          ),
                        ],
                      )),
                ],
              ),
            ),
          );
        }).then((_) {
      return result;
    }).then((_) {
      return result;
    });
    return result;
  }

  MediaQueryData newMethod(BuildContext context) => MediaQuery.of(context);
}
