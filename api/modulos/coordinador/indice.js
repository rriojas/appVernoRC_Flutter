var application = Object.create(app);
$(document).ready(function() {
    application.url = "coordinadorController.php";
});
$("body").delegate("button[data-accion='Seleccionar']", "click", function(e) {
    $.post( "form.php", { id:  $(e.currentTarget).data("value") }, function(data) {
        $("#divPrincipal").html(data);
    } );    
})
.delegate("button[data-accion='Eliminar']", "click", function(e) {
    var confirmacion = confirm("Realmente deseas eliminar el registro?");
    if(confirmacion) {
        let idCoordinador=  $(e.currentTarget).data("value");
        let data = new FormData();
        data.append("idCoordinador", idCoordinador);
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
    let data = ["form.php", 2];
    Catalog.OpenPage("../usuario/", vars, data);
})
.delegate("#btnCancelar", "click", function() {
    $("#divPrincipal").load("list.php");

})
.delegate("#btnAceptar", "click", function() {
    let idCoordinador = $("#idCoordinador").val() !== "" ? $("#idCoordinador").val() : 0;
    let data = new FormData($("#frmCoordinador")[0]);
        data.append("esCoordinadorInstitucional", $("#esCoordinadorInstitucional").is(":checked"))
    if(idCoordinador !== "" && idCoordinador > "0") {
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