var application = Object.create(app);
function AplicarSolicitud(id) {
    /*var data = Array();
    data.push(id);
   Catalog.OpenPage(, Array('id'), data);*/
    Catalog.GetView("realizaSolicitud.php", id);
}
$("body").delegate("#btnAceptar", "click", function() {
    var data = new FormData($("#frmSolicitud")[0]);
    data.append("method", "Insert");
    //var application = Object.create(app);
    application.url = "../solicitud/solicitudController.php";
    application.sendRequest(data, this, function(data) {
        if(data.IdInsertado == 1) {
            Mbox.Show("fas-ok-circle", "Exito", data.mensaje);
            window.location.href= "inicio.php";
        }
        else {
            Mbox.Error("Atencion", data.mensaje);
        }
        setTimeout(function() {
            $("#btnCancelar").click();
        }, 1000);
    });
})
.delegate("#btnCancelar", "click", function() {
    window.location.reload();
})
.delegate("#btnBuscar", "click", function() {
    application.Loading();
    var idArea = $("#cmbArea").val();
    var titulo = $("#txtBuscar").val();
    $("#divPrincipal").load("proyectodisponible.php", {idArea: idArea, descripcion: titulo}, function () {
        application.DoneLoading();
    });
});