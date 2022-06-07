var application = Object.create(app);
$(document).ready(function() {
    application.url = "solicitudController.php";
});
$("body").delegate("button[data-accion='Seleccionar']", "click", function(e) {
    $.post( "form.php", { id:  $(e.currentTarget).data("value") }, function(data) {
        $("#divPrincipal").html(data);
    } );    
})
.delegate("button[data-accion='Eliminar']", "click", function(e) {
    var confirmacion = confirm("Realmente deseas eliminar el registro?");
    if(confirmacion) {
        let idSolicitud=  $(e.currentTarget).data("value");
        let data = new FormData();
        data.append("idSolicitud", idSolicitud);
        data.append("method", "Delete");
        application.sendRequest(data, this, function(data) {
            if(data.rowsAfectados > 0) {
                Mbox.Show("fas-ok-circle", "Exito", data.mensaje);
                $("#divPrincipal").load("list.php");
            }
        });
    }
})
.delegate("#btnAgregar", "click", function() {
    $("#divPrincipal").load("form.php");
})
.delegate("#btnCancelar", "click", function() {
    $("#divPrincipal").load("list.php");
})
.delegate("#btnAceptar", "click", function() {
    let idSolicitud = $("#idSolicitud").val() !== "" ? $("#idSolicitud").val() : 0;
    let data = new FormData();
        data.append("idSolicitud", idSolicitud);
        data.append("comentario", $("#txtComentario").val());
        data.append("idProyecto", $("#cmbProyecto").val());
        
    if(idSolicitud !== "" && idSolicitud !== "0") {
        //Editando
        data.append("method", "Update");
        application.sendRequest(data, this, function(data) {
            if(data.rowsAfectados > 0) {
                Mbox.Show("fas-ok-circle", "Exito", data.mensaje);
                $("#btnCancelar").click();
            }
        });
    } else {
        //Agregando
        data.append("method", "Insert");     
        application.sendRequest(data, this, function(data) {
            if(data.IdInsertado > 0) {
                Mbox.Show("fas-ok-circle", "Exito", data.mensaje);
                $("#btnCancelar").click();
            }
        });
    }
});