var application = Object.create(app);
$(document).ready(function() {
    application.url = "investigadorController.php";
    //$(".table tbody tr").children("");
    /*var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})*/

});
$("body").delegate("button[data-accion='Seleccionar']", "click", function(e) {
    $.post( "form.php", { id:  $(e.currentTarget).data("value") }, function(data) {
        $("#divPrincipal").html(data);
    } );    
})
.delegate("button[data-accion='Eliminar']", "click", function(e) {
    var confirmacion = confirm("Realmente deseas eliminar el registro?");
    if(confirmacion) {
        let idInvestigador=  $(e.currentTarget).data("value");
        let data = new FormData();
        data.append("idInvestigador", idInvestigador);
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
    let idInvestigador = $("#idInvestigador").val() !== "" ? $("#idInvestigador").val() : 0;
    let data = new FormData();
        data.append("idInvestigador", idInvestigador);
        data.append("titulo", $("#cmbTitulo").val());
        data.append("departamento", $("#txtDepartamento").val());
        data.append("nivelSNI", $("#cmbNivelSNI").val());
        data.append("PRODEP", $("#cmbPRODEP").val());
        data.append("idUsuario", $("#idUsuario").val());
        
    if(idInvestigador !== "" && idInvestigador !== 0) {
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
.delegate("button[data-accion='Validar']", "click", function(e) {
    let idInvestigador=  $(e.currentTarget).data("value");
    let data = new FormData();
    data.append("idInvestigador", idInvestigador);
    data.append("method", "ValidarUsuario");
    let UsuarioRequest = Object.create(application);
    UsuarioRequest.url = "../usuario/usuarioController.php";
    UsuarioRequest.sendRequest(data, this, function(data) {
        if(data.rowsAfectados > 0) {
            Mbox.Show("fas-ok-circle", "Exito", data.mensaje);
             $("#divPrincipal").load("list.php");
        }
    });
    //UsuarioRequest = null;
})
.delegate("button[data-accion='Invalidar']", "click", function(e) {
    let idInvestigador=  $(e.currentTarget).data("value");
    let data = new FormData();
    data.append("idInvestigador", idInvestigador);
    data.append("method", "InvalidarUsuario");
    let UsuarioRequest = Object.create(application);
    UsuarioRequest.url = "../usuario/usuarioController.php";
    UsuarioRequest.sendRequest(data, this, function(data) {
        if(data.rowsAfectados > 0) {
            Mbox.Show("fas-ok-circle", "Exito", data.mensaje);
             $("#divPrincipal").load("list.php");
        }
    });
    //UsuarioRequest = null;
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