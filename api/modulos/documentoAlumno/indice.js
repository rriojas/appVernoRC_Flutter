var application = Object.create(app);
var formData;
$(document).ready(function() {
    application.url = "documentoAlumnoController.php";
    //$(".table tbody tr").children("");
});
$("body").delegate("button[data-accion='Seleccionar']", "click", function(e) {
    formData  = new FormData();
    formData.append("method", "Insert");
    formData.append("idDocumento", $(e.currentTarget).data("value"));
   $("#uploadFile").click();  
})
.delegate("button[data-accion='Ver']", "click", function(e) {
    $("#embedFile").attr("src", "../../documento/" + $(e.currentTarget).data("value") + "?" + Math.random());
})
.delegate("#uploadFile", "change", function() {
    formData.append("uploadFile", $('#uploadFile')[0].files[0]);
    application.sendRequest(formData, this, function(data) {
            if(data.IdInsertado > 0) {
                Mbox.Show("fas-ok-circle", "Exito", data.mensaje);
                window.location.href = "../../inicio.php";
            }
        });
});