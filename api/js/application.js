var app = {};
var modulo;
(function(modulo) {
    (function(modulo) {
        var api = {
            url: "",
            dataType: "json",
            type: "POST",
            check: true,
            sendRequest: function sendRequest(data, context, funcion) {
                "use strict";
                $.ajax({
                    url: this.url,
                    async: true,
                    context: context || null,
                    data: data,
                    type: this.type,
                    dataType: this.dataType,
                    xhr: function() {
                        var myXhr = $.ajaxSettings.xhr();
                        if(myXhr.upload) {
                        }
                        return myXhr;
                    },
                    beforeSend: function() {
                        app.Loading();
                    },
                    complete: function() {
                        app.DoneLoading();
                    },
                    success: funcion || function(data) {
                        alert(data);
                    },
                    error: function (data) {
                        alert(data);
                        console.log("Error fn -> ", data);
                        app.DoneLoading();
                        Mbox.Error("Error", data.mensaje);
                    },
                    processData: false,
                    contentType: false
                });
            },
            createMenu: function createMenu(data) {
                let html = '<ul class="navbar-nav mr-auto">';
                //console.log(data);
                for (let i = 0; i < data.length; i++) {
                    const element = data[i];
                    html += '<li class="nav-item"><a class="nav-link" href="#">'+ element.name +'</a></li>';
                }
                html += '</ul>';
                return html;
            },
            createSubmenu: function createSubmenu(data) {
                let html = '';
                //console.log(data);
                for (let i = 0; i < data.length; i++) {
                    const element = data[i];
                    html += '<a class="nav-link" href="#">'+ element.name +'</a>';
                }
                return html;
            },
            createOption: function createOption(data) {
                let html = '';
                //console.log(data);
                for (let i = 0; i < data.length; i++) {
                    const element = data[i];
                    html += '<option value="' + element.id + '">'+ element.descripcion +'</option>';
                }
                return html;
            },
            createTable: function createTable(data) {
                var table = '<table class="table">';
                let thead = '<thead>';
                let tbody = '<tbody>';
                var keys = Object.keys( data[0] );
                let inicio = 0;
                thead += '<tr>';
                if(this.check != 'undefined' && this.check == true) {
                    thead += '<th>Selecciona uno</th>';
                    inicio = 1;
                }
                for (let i = inicio; i < keys.length; i++) {
                    const element = keys[i];
                    thead += '<th>' + element + '</th>';
                }
                thead += '</tr></thead>';                
                for (let i = inicio; i < data.length; i++) {
                    const element = data[i];
                    tbody += '<tr>';
                    if(this.check !=  'undefined' && this.check == true) {
                        tbody += '<td class="text-center"><input type="checkbox" value="' + element[keys[0]] + '" /></td>';
                    }
                    for(let j = inicio; j < keys.length; j++) {
                        tbody += '<td>' + element[keys[j]] + '</td>';
                    }
                    tbody += '</tr>';
                }
                table += thead + tbody + '</tbody>' + '</table>';
                return table;
            },
            getSelected: function getSelected(obj) {
                let checkBox = $("#" + obj).find("input[type='checkbox']:checked");
                return checkBox;
            },
            DisabledActionNav: function DisabledActionNav() {
                $("#navFormModificar").fadeOut();
                $("#navFormEliminar").fadeOut();
            },
            EnabledActionNav: function EnabledActionNav() {
                let chk = arguments[0];
                if(chk.length == 1)
                    $("#navFormModificar").fadeIn();
                else 
                    $("#navFormModificar").fadeOut();
                $("#navFormEliminar").fadeIn();
            },
            Load: function Load(obj, file) {
                this.Loading();
                $("#" + obj).load(file, function(responseText, status, xhr) {
                    if( status === "error" ) {
                        Mbox.Error( "Error", "Ocurrio un error al realizar la operacion.");
                        return;
                    }
                    app.DoneLoading();
                    //Mbox.Success("Correcto", "Operacion realizada correctamente");
                });
            },
            Loading: function Loading(vh) {
                let html = '<div class="d-flex justify-content-center bg-light position-absolute" style="left:50vw; top:' + (vh || '50vh') + '"><div id="divLoadingRequest" class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div><div class="modal-backdrop fade show"></div></div>';
                $("body").append(html);
            },
            DoneLoading: function DoneLoading() {
                $("#divLoadingRequest").parent().remove();
            },
            ValidarTexto: function ValidarTexto(texto) {
                if(texto !== "")
                    return false;
                else
                    return true;
            },
            CerrarSesion: function CerrarSesion() {
                //window.location.href = "http://localhost/appVerano/lib/cerrarsesion.php";
                window.location.href = "https://veranoregional.org/appVerano/lib/cerrarsesion.php";
            },
            test: function test() {
                alert("si funca");
            }
        };
        $.extend(modulo, api);
    }((typeof modulo === 'undefined') ? window : modulo));
}(app));