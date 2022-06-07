$("#btnAceptar").click(function() {
    let data = new FormData($("#frmLogin")[0]);
    data.append("method", "Login");
    app.url = "modulos/usuario/usuarioController.php";
    app.sendRequest(data, this, function(data) {
        if(data.acceso == 1) {
            Mbox.Show("fas-ok-circle", "Exito", data.mensaje);
            window.location.href= "inicio.php";
        }
        else if(data.acceso == 5) {
            Mbox.Show("fas-ok-circle", "Continuar Registro", data.mensaje);
            window.location.href= "continuaregistro.php";
        }
        else {
            Mbox.Error("Atencion", data.mensaje);
        }
    }); 
});