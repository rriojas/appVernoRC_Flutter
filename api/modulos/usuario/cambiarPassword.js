var application = Object.create(app);
$("body").delegate("#btnAceptar", "click", function() {
    if($("#txtPassword").val() === "") {
        Mbox.Error("Atencion", "El password no debe quedar vacio");
        return;
    }
    if($("#txtConfirmaPassword").val() != $("#txtPassword").val()) {
        Mbox.Error("Atencion", "El password no coincide");
        return;
    }
    application.url = "usuarioController.php";
   var data = new FormData();
   data.append("method", "CambiarPassword");
   data.append("clave", $("#txtPassword").val());
   application.sendRequest(data, this, function(data) {
        if(data.rowsAfectados == "1") {
            Mbox.Show("fas-ok-circle", "Exito", data.mensaje);
            window.location.href="../../inicio.php";
        }
   });
});