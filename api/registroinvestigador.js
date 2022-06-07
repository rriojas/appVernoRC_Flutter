$(document).ready(function() {
    $.post( "modulos/usuario/form.php", { idTipoUsuario:  4 }, function(data) {
        $("#MainContainer").html(data);
    });
});
$("body").delegate("#frmUsuario #btnAceptar", "click", function() {
    var catalogo = Object.create(Catalog);
    catalogo.NombreModulo = "Usuario";
    catalogo.url = "modulos/usuario/usuarioController.php";
    catalogo.PrimaryKey = "idUsuario";
    catalogo.Container = "divPrincipal";
    catalogo.Form = "frmUsuario";
    var enBlanco = false;
    $("input:text").each(function(i) {
        if(this.value === "") {
            Mbox.Error("Atencion", "Error, el campo no puede quedar en blanco");
            $(this).focus();
            enBlanco = true;
            return false;
        }
    });
    if(!enBlanco) {
        if(ValidaClave()) {
            Mbox.Error("Error", "Las contraseñas no coinciden");
        } else {
            catalogo.Insert(function(data) {
                if(data.IdInsertado > 0) {                    
                    $.post( "modulos/investigador/form.php", { idUsuario:  data.IdInsertado }, function(data) {
                        $("#MainContainer").html(data);
                    });
                }  else {
                    Mbox.Error("Error", data.mensaje);
                }
            });
        }
    }
});
$("body").delegate("#frmUsuario #btnCancelar", "click", function() {
    window.location.href = "index.php"
})
.delegate("#frmInvestigador #btnCancelar", "click", function() {
    window.location.href = "index.php"
});
function ActualizaCampus(e) {
    let data = new FormData();
    data.append("method", "ByIdInstitucion");
    data.append("idInstitucion", $("#cmbInstitucion").val());
    let application = Object.create(app);
    application.url = "modulos/campus/campusController.php?method=ByIdInstitucion&idInstitucion=" + $("#cmbInstitucion").val();
    application.type = "GET";
    application.dataType = 'json';
    application.sendRequest(data, this, function(data) {
       $("#cmbCampus").html(application.createOption(data)); 
    });
}
$("body").delegate("#frmInvestigador #btnAceptar", "click", function() {
    let application = Object.create(app);
    application.url = "modulos/investigador/investigadorController.php";
    let idInvestigador = $("#idInvestigador").val() !== "" ? $("#idInvestigador").val() : 0;
    let data = new FormData();
    data.append("idInvestigador", idInvestigador);
    data.append("titulo", $("#cmbTitulo").val());
    data.append("departamento", $("#txtDepartamento").val());
    data.append("nivelSNI", $("#cmbNivelSNI").val());
    data.append("PRODEP", $("#cmbPRODEP").val());
    data.append("idUsuario", $("#idUsuario").val());
    var enBlanco = false;
    $("input:text").each(function(i) {
        if(this.value === "") {
            Mbox.Error("Atencion", "Error, el campo no puede quedar en blanco");
            $(this).focus();
            enBlanco = true;
            return false;
        }
    });
    if(!enBlanco) { 
        //Agregando
        data.append("method", "Insert");     
        application.sendRequest(data, this, function(data) {
            if(data.IdInsertado > 0) {
                Mbox.Show("fas-ok-circle", "Exito", data.mensaje);
                window.location.href = "login.php";
            }
        });
    }
});
function ValidaClave() {
    var clave, confirmaClave;
    clave = $("#txtPassword").val();
    confirmaClave = $("#txtConfirmaPassword").val();
    if(clave === "") {
        return false;
    }
    return (clave != confirmaClave);
}