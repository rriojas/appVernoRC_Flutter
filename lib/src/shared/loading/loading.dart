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
              color: Colors.white.withOpacity(
                0.7,
              ),
              child: const Center(child: CircularProgressIndicator()),
            ),
          );
        });
  }
}
