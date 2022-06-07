var catalogo = Object.create(Catalog);
$(document).ready(function () {
    catalogo.NombreModulo = "Estado";
    catalogo.url = "estadoController.php";
    catalogo.PrimaryKey = "idestado";
    catalogo.Container = "divPrincipal";
    catalogo.Form = "frmEstado";
});
$("body").delegate("table button", "click", function() {
    catalogo.GetView("form.php", $(this).data("value"));
})
.delegate("#btnAgregar", "click", function() {
    catalogo.GetView("form.php", "0");
})
.delegate("#btnCancelar", "click", function() {
    catalogo.GetView("list.php", "");
})
.delegate("#btnAceptar[data-editando='1']", "click", function() {
    if(app.ValidarTexto($("#descripcion").val())) {
        Mbox.Error("Error", "EL nombre no puede estar vacio");
        $("#descripcion").focus();
    }
    else
        catalogo.Update();
})
.delegate("#btnAceptar[data-editando='0']", "click", function() {
    if(app.ValidarTexto($("#descripcion").val())) {
        Mbox.Error("Error", "EL nombre no puede estar vacio");
        $("#descripcion").focus();
    }
    else
        catalogo.Insert();
})
.delegate("#btnEliminar", "click", function () {
    var idarea = $("#idestado").val();
    catalogo.Eliminar(idarea);
});