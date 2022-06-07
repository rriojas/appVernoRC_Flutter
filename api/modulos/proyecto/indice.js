var application = Object.create(app);
$(document).ready(function() {
    application.url = "proyectoController.php";
});
$("body").delegate("button[data-accion='Seleccionar']", "click", function(e) {
    $.post( "form.php", { id:  $(e.currentTarget).data("value") }, function(data) {
        $("#divPrincipal").html(data);
    } );    
})
.delegate("button[data-accion='Eliminar']", "click", function(e) {
    var confirmacion = confirm("Realmente deseas eliminar el registro?");
    if(confirmacion) {
        let idProyecto=  $(e.currentTarget).data("value");
        let data = new FormData();
        data.append("idProyecto", idProyecto);
        data.append("method", "Delete");
        application.sendRequest(data, this, function(data) {
            if(data.rowsAfectados > 0) {
                Mbox.Show("fas-ok-circle", "Exito", data.mensaje);
                $("#divPrincipal").load("list.php");
            }
        });
    }
})
.delegate("button[data-accion='Validar']", "click", function(e) {
    var confirmacion = confirm("Realmente deseas validar el proyecto?");
    if(confirmacion) {
        let idProyecto=  $(e.currentTarget).data("value");
        let data = new FormData();
        data.append("idProyecto", idProyecto);
        data.append("method", "Validar");
        application.sendRequest(data, this, function(data) {
            if(data.rowsAfectados > 0) {
                Mbox.Show("fas-ok-circle", "Exito", data.mensaje);
                $("#divPrincipal").load("list.php");
            }
        });
    }
})
.delegate("button[data-accion='Invalidar']", "click", function(e) {
    var confirmacion = confirm("Realmente deseas invalidar el proyecto?");
    if(confirmacion) {
        let idProyecto=  $(e.currentTarget).data("value");
        let data = new FormData();
        data.append("idProyecto", idProyecto);
        data.append("method", "Invalidar");
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
    let idProyecto = $("#idProyecto").val() !== "" ? $("#idProyecto").val() : 0;
    let data = new FormData($("#frmProyecto")[0]);        
    if(idProyecto !== "" && idProyecto !== "0") {
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