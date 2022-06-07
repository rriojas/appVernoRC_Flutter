function ZoomInFont() {
    var div = document.getElementById("ContenedorFormulario");
    if(div.style.fontSize === undefined || div.style.fontSize === "") {
        div.style.fontSize = "15px";
    } else {
        div.style.fontSize = (parseInt(div.style.fontSize) + 1) + "px";
    }                
}
function MuestraNumeracion() {
    var div = document.getElementById("ContenedorFormulario");
    div.innerHTML = "<h1>La numeracion es:</h1>";
    for (let index = 2; index < 101; index+=2) {
        div.innerHTML += "<h6>"+ index + "<h6";
    }
}
function AjaxRequest()
{
    var xhttp =                 new XMLHttpRequest();
    xhttp.onreadystatechange =  function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("ContenedorFormulario").innerHTML = this.responseText;
        }
    };
    var datoEnviar =    "";
    datoEnviar =        "nombre=" + document.getElementById("txtNombre").value;
    datoEnviar +=       "&apellidopaterno=" + document.getElementById("txtApellidoPaterno").value;
    datoEnviar +=       "&apellidomaterno=" + document.getElementById("txtApellidoMaterno").value;
    xhttp.open("GET", "prueba.php?" + datoEnviar, true);
    xhttp.send();
}
