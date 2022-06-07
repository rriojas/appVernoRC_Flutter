var application = Object.create(app);
$(document).ready(function() {
    application.url = "alumnoController.php";
    //$(".table tbody tr").children("");
});
$("body").delegate("button[data-accion='Seleccionar']", "click", function(e) {
    $.post( "form.php", { id:  $(e.currentTarget).data("value") }, function(data) {
        $("#divPrincipal").html(data);
    } );    
})
.delegate("button[data-accion='Eliminar']", "click", function(e) {
    var confirmacion = confirm("Realmente deseas eliminar el registro?");
    if(confirmacion) {
        let idAlumno=  $(e.currentTarget).data("value");
        let data = new FormData();
        data.append("idAlumno", idAlumno);
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
    let vars = ["file", "idTipoUsuario"];
    let data = ["form.php", 5];
    Catalog.OpenPage("../usuario/", vars, data);
})
.delegate("#btnCancelar", "click", function() {
    $("#divPrincipal").load("list.php");
})
.delegate("#btnAceptar", "click", function() {
    let idAlumno = $("#idAlumno").val() !== "" ? $("#idAlumno").val() : 0;
    let data = new FormData($("#frmAlumno")[0]);
        
    if(idAlumno !== "" && idAlumno !== 0) {
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
})
.delegate("button[data-accion='Ver']", "click", function(e) {
    $("#embedFile").attr("src", "../../documento/" + $(e.currentTarget).data("value") + "?" + Math.random());
})
.delegate("button[data-accion='AceptarValidar']", "click", function(e) {
    let idAlumno=  $(e.currentTarget).data("value");
    let data = new FormData();
    data.append("idAlumno", idAlumno);
    data.append("method", "ValidarAlumno");
    let UsuarioRequest = Object.create(application);
    UsuarioRequest.url = "../usuario/usuarioController.php";
    UsuarioRequest.sendRequest(data, this, function(data) {
        if(data.rowsAfectados > 0) {
            Mbox.Show("fas-ok-circle", "Exito", data.mensaje);
            $("#btnCancelar").click();
        } else {
            Mbox.Show("fas-ok-circle", "Atencion", data.mensaje);
        }
    });
})
.delegate("button[data-accion='Invalidar']", "click", function(e) {
    let idAlumno=  $(e.currentTarget).data("value");
    let data = new FormData();
    data.append("idAlumno", idAlumno);
    data.append("method", "InValidarAlumno");
    let UsuarioRequest = Object.create(application);
    UsuarioRequest.url = "../usuario/usuarioController.php";
    UsuarioRequest.sendRequest(data, this, function(data) {
        if(data.rowsAfectados > 0) {
            Mbox.Show("fas-ok-circle", "Exito", data.mensaje);
            $("#divPrincipal").load("list.php");
        } else {
            Mbox.Show("fas-ok-circle", "Atencion", data.mensaje);
        }
    });
})
.delegate("button[data-accion='Validar']", "click", function(e) {
    $.post( "validar.php", { id:  $(e.currentTarget).data("value") }, function(data) {
        $("#divPrincipal").html(data);
    } );
})
.delegate("button[data-accion='Ver']", "click", function(e) {
    $.post( "validar.php", { id:  $(e.currentTarget).data("value") }, function(data) {
        $("#divPrincipal").html(data);
    } );
});