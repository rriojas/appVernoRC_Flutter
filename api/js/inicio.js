var application = Object.create(app);
$(document).ready(function() {
    application.url = "modulos/tipousuariomodulo/tipousuariomoduloController.php?method=ByIdTipoUsuario";
    application.type="GET";
    application.sendRequest("", this, function(data) {
        var html = '';
        if(data.hasOwnProperty('error')) {
            Mbox.Show("fas fa-circle", "Error", data.mensaje);
            window.location.href = "login.php";
        }
        for (let index = 0; index < data.length; index++) {
            if(data[index].estatus == 2  )
            {
                continue;
            }
            const element = data[index];            
            html += '<a href="' + element.ruta + '" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">';
            //<img src="img/no-image.png" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0"><div class="d-flex gap-2 w-100 justify-content-between">
            html += '<div><h6 class="mb-0">' + element.nombre + '</h6><p class="mb-0 opacity-75">' + element.descripcion + '</p></div></div></a>';
        }
        $("#MainContainer").html(html);
    });
});
/*
º
 */