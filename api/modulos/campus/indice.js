var application = Object.create(app);
$(document).ready(function() {
    application.url = "campusController.php";
});
$("body").delegate("button[data-accion='Seleccionar']", "click", function(e) {
    $.post( "form.php", { id:  $(e.currentTarget).data("value") }, function(data) {
        $("#divPrincipal").html(data);
    } );    
})
.delegate("button[data-accion='Eliminar']", "click", function(e) {
    var confirmacion = confirm("Realmente deseas eliminar el registro?");
    if(confirmacion) {
        let idCampus=  $(e.currentTarget).data("value");
        let data = new FormData();
        data.append("idCampus", idCampus);
        data.append("method", "Delete");
        application.sendRequest(data, this, function(data) {
            if(data.rowsAfectados > 0) {
                Mbox.Show("fas-ok-circle", "Exito", data.mensaje);
                $("#divPrincipal").load("list.php");
            }
        });
    }
})
.delegate("button[data-accion='AdministrarCarrera']", "click", function(e) {
    let idCampus=  $(e.currentTarget).data("value");
    window.location.href="../carrera/index.php?idCampus=" + idCampus;
})
.delegate("#btnAgregar", "click", function() {
    $("#divPrincipal").load("form.php");
})
.delegate("#btnCancelar", "click", function() {
    $("#divPrincipal").load("list.php");
})
.delegate("#btnAceptar", "click", function() {
    let enBlanco = false;
    $("input:password").each(function(i) {
        if(this.value === "") {
            Mbox.Error("Atencion", "Error, el campo no puede quedar en blanco");
            $(this).focus();
            enBlanco = true;
            return false;
        }
    });
    $("input:text").each(function(i) {
        if(this.value === "") {
            Mbox.Error("Atencion", "Error, el campo no puede quedar en blanco");
            $(this).focus();
            enBlanco = true;
            return false;
        }
    });
    if(enBlanco) {
        Mbox.Error("Atencion", "No puedes dejar campos vacios");
        return;
    }
    let idCampus = $("#idCampus").val() !== "" ? $("#idCampus").val() : 0;
    let data = new FormData();
        data.append("idCampus", idCampus);
        data.append("nombre", $("#txtNombre").val());
        data.append("abreviaturaCampus", $("#txtAbreviatura").val());
        data.append("idInstitucion", $("#cmbInstitucion").val());
        data.append("idMunicipio", $("#cmbMunicipio").val());
        
    if(idCampus !== "" && idCampus !== 0) {
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
/*.delegate("#btnBuscar", "click", function() {
    let data = new FormData();
        data.append("nombre", $("#txtBuscar").val());
        data.append("method", "ByNombre");
        application.sendRequest(data, this, function(data) {
            if(data.IdInsertado > 0) {
                Mbox.Show("fas-ok-circle", "Exito", data.mensaje);
                $("#btnCancelar").click();
            }
        });
}) */