var application = Object.create(app);
$(document).ready(function() {
    application.url = "carreraController.php";
});
$("body").delegate("button[data-accion='Seleccionar']", "click", function(e) {
    $.post( "form.php", { id:  $(e.currentTarget).data("value") }, function(data) {
        $("#divPrincipal").html(data);
    } );    
})
.delegate("button[data-accion='Eliminar']", "click", function(e) {
    var confirmacion = confirm("Realmente deseas eliminar el registro?");
    if(confirmacion) {
        let idCarrera=  $(e.currentTarget).data("value");
        let data = new FormData();
        data.append("idCarrera", idCarrera);
        data.append("method", "Delete");
        application.sendRequest(data, this, function(data) {
            if(data.rowsAfectados > 0) {
                Mbox.Show("fas-ok-circle", "Exito", data.mensaje);
                location.reload();
            }
        });
    }
})
.delegate("#btnAgregar", "click", function() {
    $("#divPrincipal").load("form.php");
    if($("#idCampusPadre").val() !== undefined) {
        
    }
})
.delegate("#btnCancelar", "click", function() {
    location.reload();
})
.delegate("#btnAceptar", "click", function() {
    let idCarrera = $("#idCarrera").val() !== "" ? $("#idCarrera").val() : 0;
    if($("#txtNombre").val() === "") {
        Mbox.Error("Atencion", "No puedes dejar el nombre de la carrera en blanco");
        return;
    }
    let data = new FormData();
        data.append("idCarrera", idCarrera);
        data.append("nombre", $("#txtNombre").val());
        data.append("idCampus", $("#idCampus").val());
        
    if(idCarrera !== "" && idCarrera !== 0) {
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