import 'package:flutter/material.dart';

class Loading {
  void load(BuildContext context) {
    showDialog(
        useSafeArea: false,
        barrierDismissible: false,
        context: context,
        builder: (_) {
          return WillPopScope(
            onWillPop: () => Future.value(false),
            child: Container(
              color: Colors.black12,
              child: const Center(child: CircularProgressIndicator()),
            ),
          );
        });
  }
}
