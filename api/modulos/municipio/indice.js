var catalogo = Object.create(Catalog);
var application = Object.create(app);
$(document).ready(function () {
    catalogo.NombreModulo = "Municipio";
    catalogo.url = "municipioController.php";
    catalogo.PrimaryKey = "idmunicipio";
    catalogo.Container = "divPrincipal";
    catalogo.Form = "frmMunicipio";
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
    var idmunicipio = $("#idmunicipio").val();
    catalogo.Eliminar(idmunicipio);
});