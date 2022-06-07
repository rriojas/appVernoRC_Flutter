var application = Object.create(app);
$("body").delegate("#btnUp", "click", function() {
    $("#btnUp").attr("disabled", "disabled");
    application.Loading();
    var idSolicitud = $("body").find("table tbody tr input[type='checkbox']:checked").val();
    if(idSolicitud !== undefined)
        OrdenarSolicitud(idSolicitud, "arriba");
    else {
        $("#btnUp").removeAttr("disabled");
        application.DoneLoading();
        Mbox.Error("Atencion", "Debes seleccionar un elemento de la lista");
    }
})
.delegate("#btnDown", "click", function() {
    $("#btnDown").attr("disabled", "disabled");
    application.Loading();
    var idSolicitud = $("body").find("table tbody tr input[type='checkbox']:checked").val();
    if(idSolicitud !== undefined)
        OrdenarSolicitud(idSolicitud, "abajo");
    else {
        $("#btnDown").removeAttr("disabled");
        application.DoneLoading();
        Mbox.Error("Atencion", "Debes seleccionar un elemento de la lista");
    }
})
.delegate("#btnEliminar", "click", function() {
    $("#btnEliminar").attr("disabled", "disabled");
    application.Loading();
    var idSolicitud = $("body").find("table tbody tr input[type='checkbox']:checked").val();
    if(idSolicitud !== undefined) {
        var data = new FormData();
        data.append("method", "Delete");
        data.append("idSolicitud", idSolicitud);
        application.url = "../solicitud/solicitudController.php";
        application.sendRequest(data, this, function(data) {
            application.DoneLoading();
            Mbox.Success("Atencion", data.mensaje);
            $("#btnEliminar").removeAttr("disabled");
            setTimeout(function() {
                $("#divPrincipal").load("missolicitudes.php");
            }, 1000);
        });
    } else {
        $("#btnEliminar").removeAttr("disabled");
        application.DoneLoading();
        Mbox.Error("Atencion", "Debes seleccionar un elemento de la lista");
    }
});
function OrdenarSolicitud(idSolicitud, orden) {
    var data = new FormData();
    data.append("method", "ActualizaOrden");
    data.append("idSolicitud", idSolicitud);
    data.append("orden", orden);
    application.url = "../solicitud/solicitudController.php";
    application.sendRequest(data, this, function(data) {
        $("#btnUp").removeAttr("disabled");
        $("#btnDown").removeAttr("disabled");
        application.DoneLoading();
        Mbox.Success("Atencion", data.mensaje);
        setTimeout(function() {
            $("#divPrincipal").load("missolicitudes.php");
        }, 1000);
    });
}