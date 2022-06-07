var catalogo = Object.create(Catalog);
var application = Object.create(app);
$(document).ready(function () {
    catalogo.NombreModulo = "Usuario";
    catalogo.url = "usuarioController.php";
    application.url = "usuarioController.php";
    catalogo.PrimaryKey = "idusuario";
    catalogo.Container = "divPrincipal";
    catalogo.Form = "frmUsuario";

});
$("body").delegate("button[data-accion='Seleccionar']", "click", function() {
    catalogo.GetView("form.php", $(this).data("value"));
})
.delegate("#btnAgregar", "click", function() {
    catalogo.GetView("seleccionaTipoUsuario.php", "0");
})
.delegate("#btnCoordinadorInstitucional", "click", function() {
    app.Loading();
    $("#divPrincipal").load("form.php", {idTipoUsuario: 2}, function () {
        app.DoneLoading();
    });
})
.delegate("#btnCoordinadorCampus", "click", function() {
    app.Loading();
    $("#divPrincipal").load("form.php", {idTipoUsuario: 3}, function () {
        app.DoneLoading();
    });
})
.delegate("#btnInvestigador", "click", function() {
    app.Loading();
    $("#divPrincipal").load("form.php", {idTipoUsuario: 3}, function () {
        app.DoneLoading();
    });
})
.delegate("#btnAlumno", "click", function() {
    app.Loading();
    $("#divPrincipal").load("form.php", {idTipoUsuario: 4}, function () {
        app.DoneLoading();
    });
})
.delegate("#btnCancelar", "click", function() {
    //catalogo.GetView("list.php", "");
    window.location.href= "../../inicio.php";
})
.delegate("#btnAceptar", "click", function() {
    if(ValidaClave()) {
        Mbox.Error("Error", "Las contraseñas no coinciden");
        $("#descripcion").focus();
    } else {
        if($("#idUsuario").val() == "0" || $("#idUsuario").val() == "") {
            let IdTipoUsuario = $("#idTipoUsuario").val();
            catalogo.Insert(function(data) {
                console.log(data.IdInsertado);
                if(data.IdInsertado > 0)
                {
                    console.log(IdTipoUsuario);
                    switch (IdTipoUsuario) {
                        case "2":
                        case "3":
                            vars = ["file", "idUsuario"];
                            data = ["form.php", data.IdInsertado];
                            catalogo.OpenPage("../coordinador/", vars, data);
                        break;
                        case "4":
                            vars = ["file", "idUsuario"];
                            data = ["form.php", data.IdInsertado];
                            catalogo.OpenPage("../investigador/", vars, data);
                        break;
                        case "5":
                            vars = ["file", "idUsuario"];
                            data = ["form.php", data.IdInsertado];
                            catalogo.OpenPage("../alumno/", vars, data);    
                        break;
                        default:
                            break;
                    }
                }  else {
                    Mbox.Error("Error", data.mensaje);
                }
            });
        } else {
            catalogo.Update(function(data) {
                if(data.rowsAfectados > 0) {
                    Mbox.Show("fas-ok-circle", "Exito", data.mensaje);
                    $("#divPrincipal").load("list.php");
                }
            });
        }
    }
})
.delegate("button[data-accion='Eliminar']", "click", function (e) {
    var idUsuario =  $(e.currentTarget).data("value");
    var confirmacion = confirm("Realmente deseas eliminar el registro?");
    if(confirmacion) {
        let data = new FormData();
        data.append("idUsuario", idUsuario);
        data.append("method", "Delete");
        application.sendRequest(data, this, function(data) {
            if(data.rowsAfectados > 0) {
                Mbox.Show("fas-ok-circle", "Exito", data.mensaje);
                $("#divPrincipal").load("list.php");
            }
        });
    }
});
function ActualizaCampus(e) {
    let data = new FormData();
    data.append("method", "ByIdInstitucion");
    data.append("idInstitucion", $("#cmbInstitucion").val());
    let application = Object.create(app);
    application.url = "../campus/campusController.php?method=ByIdInstitucion&idInstitucion=" + $("#cmbInstitucion").val();
    application.type = "GET";
    application.dataType = 'json';
    application.sendRequest(data, this, function(data) {
       $("#cmbCampus").html(application.createOption(data)); 
    });
}
function ValidaClave() {
    var clave, confirmaClave;
    clave = $("#txtPassword").val();
    confirmaClave = $("#txtConfirmaPassword").val();
    return (clave != confirmaClave);
}