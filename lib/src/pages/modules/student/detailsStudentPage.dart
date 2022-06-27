import 'package:flutter/material.dart';
import 'package:preyecto_tecnologico/src/models/moduleStudentInterface.dart';
import 'package:preyecto_tecnologico/src/models/validateStudentInterface.dart';
import 'package:preyecto_tecnologico/src/pages/modules/student/editStudentPage.dart';
import 'package:preyecto_tecnologico/src/services/studentService.dart';
import 'package:preyecto_tecnologico/src/shared/loading/loading.dart';
import 'package:preyecto_tecnologico/src/shared/showMessage/myShowMessage.dart';

class DetailsStudentPage extends StatefulWidget {
  final ModuleStudentInterface student;

  const DetailsStudentPage({
    Key? key,
    required this.student,
  }) : super(key: key);

  @override
  State<DetailsStudentPage> createState() => _DetailsStudentPageState();
}

class _DetailsStudentPageState extends State<DetailsStudentPage> {
  List<String> listHeaders = [
    'Matricula',
    'idUsuario',
    'idCarrera',
    'campus',
    'validado',
    'Carrera',
  ];

  bool loadingInfoStudent = false;
  late MyShowMessages message;
  late Loading loading;

  late StudentService service;
  @override
  void initState() {
    message = MyShowMessages();
    service = StudentService();
    loading = Loading();
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Admon alumnos'),
        actions: [
          IconButton(
            tooltip: 'Editar alumno',
            onPressed: () async {
              loadingInfoStudent = true;
              setState(() {});
              final data =
                  await service.getStudent(widget.student.idAlumno ?? '');
              Future.delayed(const Duration(seconds: 3), () {
                loadingInfoStudent = false;
                setState(() {});
                Navigator.push(
                  context,
                  MaterialPageRoute(
                    builder: (_) => EditStudentPage(
                      student: data,
                    ),
                  ),
                );
              });
            },
            icon: !loadingInfoStudent
                ? const Icon(Icons.mode_edit_outline_outlined)
                : const SizedBox(
                    height: 17.0,
                    width: 17.0,
                    child: CircularProgressIndicator(
                      color: Colors.white,
                      strokeWidth: 2.0,
                    )),
          ),
          IconButton(
            onPressed: () {},
            icon: const Icon(Icons.cancel_outlined),
          ),
        ],
      ),
      body: createBody(),
    );
  }

  createBody() {
    return Padding(
      padding: const EdgeInsets.all(20.0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          AbsorbPointer(
            absorbing: true,
            child: ListView.builder(
                scrollDirection: Axis.vertical,
                shrinkWrap: true,
                itemCount: listHeaders.length,
                itemBuilder: (_, index) {
                  return createCustomTextField(widget.student, index);
                }),
          ),
          FutureBuilder(
              future: service.getStatusStudent(widget.student.idAlumno),
              builder: (context, AsyncSnapshot<ValidateStudentInterface> data) {
                if (!data.hasData) {
                  return const CircularProgressIndicator();
                }
                final status = data.data;
                return ((status!.documentos![0].cantidadDocumentos == 7) &&
                        (status.proyectos![0].cantidad! > 0))
                    ? SwitchListTile(
                        title: Text(widget.student.validado == '0'
                            ? 'Validar'
                            : 'Invalidar'),
                        value: widget.student.validado == '0' ? false : true,
                        onChanged: (onChanged) {
                          showMessageConfirm();
                        },
                      )
                    : const SizedBox.shrink();
              })
        ],
      ),
    );
  }

  showMessageConfirm() {
    message.myShowModalBottomSheet(
        container: '¿Deseas modificar este alumno?',
        context: context,
        icon: Icons.warning,
        colorIcon: Colors.orange,
        titleButtonTwo: 'Cancelar',
        callBackOne: () async => changeStatusValidateStudent(),
        titleButtonOne: 'Aceptar');
  }

  changeStatusValidateStudent() async {
    final method =
        widget.student.validado == '0' ? 'ValidarAlumno' : 'InValidarAlumno';
    Navigator.pop(context);
    loading.load(context);
    await Future.delayed(const Duration(seconds: 3));
    service
        .changeStatusValidateStudent(widget.student.idAlumno, method)
        .then((value) => null);
    Navigator.pop(context);
    Navigator.pop(context);
    Navigator.pop(context);
  }

  createCustomTextField(ModuleStudentInterface student, int index) {
    final Map<String, dynamic> headers = widget.student.toJson();

    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 10.0),
      child: TextFormField(
        initialValue: headers[listHeaders[index]],
        decoration:
            InputDecoration(label: Text(listHeaders[index].toUpperCase())),
      ),
    );
  }
}
