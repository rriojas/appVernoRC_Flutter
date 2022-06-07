$(document).ready(function() {
    $.post( "modulos/alumno/form.php", { idTipoUsuario:  5 , idUsuario:$("#idUsuario").val()}, function(data) {
        $("#MainContainer").html(data);
   });
});
$("body").delegate("#frmAlumno #btnAceptar", "click", function() {
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
        let application = Object.create(app);
        application.url = "modulos/alumno/alumnoController.php";
        let idAlumno = $("#idAlumno").val() !== "" ? $("#idAlumno").val() : 0;
        let data = new FormData($("#frmAlumno")[0]);      
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

$("body").delegate("#frmAlumno #btnCancelar", "click", function() {
    window.location.href = "index.php"
});
/*
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
                    $.post( "modulos/alumno/form.php", { idUsuario:  data.IdInsertado }, function(data) {
                        $("#MainContainer").html(data);
                    });
                } else {
                    Mbox.Error("Error", data.mensaje);
                }
            });
        }

    }    
});
$("body").delegate("#frmUsuario #btnCancelar", "click", function() {
    window.location.href = "index.php"
})
.delegate("#frmAlumno #btnCancelar", "click", function() {
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
$("body").delegate("#frmAlumno #btnAceptar", "click", function() {
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
        let application = Object.create(app);
        application.url = "modulos/alumno/alumnoController.php";
        let idAlumno = $("#idAlumno").val() !== "" ? $("#idAlumno").val() : 0;
        let data = new FormData($("#frmAlumno")[0]);      
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
}*/