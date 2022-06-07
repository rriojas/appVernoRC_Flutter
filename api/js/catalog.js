var Catalog = {};
var modulo;
(function( modulo ) {
    (function( modulo ) {
        var api = {
            NombreCatalog: "",
            NombreModulo: "",
            url: "",
            Container: "",
            PrimaryKey: "",
            Form: "",
            Dato: "",
            GetAll: function GetAll(container) {
                ////app.showLoading("45%", "45%", $("body"));
                app.url = this.url;
                var frmData = new FormData();
                frmData.append("method", "GetAll");
                app.sendRequest(frmData, "html", function(data) {
                    let table  = app.createTable(data);
                    $("#" + container).html(table);
                    console.log("#" + container);
                    //app.hideLoading();
                }, this, false);
            },
            EjecutarConsulta: function EjecutarConsulta(method, dato, fn) {
                app.url = this.url;
                var frmData = new FormData();
                frmData.append("method", method);
                frmData.append("dato", dato);
                app.sendRequest(frmData, "html", fn, this, false);
            },
            CrearNuevo: function CrearNuevo() {
                //app.showLoading("45%", "45%", $("body"));
                $("#hdnAccion").val("1");
                app.url = this.url;
                var frmData = new FormData();
                frmData.append("method", "GetForm");
                frmData.append(this.PrimaryKey, "0");
                app.sendRequest(frmData, "html", function(data) {
                    $("#" + this.Container).html(data);
                    //app.hideLoading();
                }, this, false);
            },
            CargarForm: function CargarForm( frm ) {
                $("#" + this.Container).load(frm);
            },
            Editar: function Editar(id) {
                //app.showLoading("45%", "45%", $("body"));
                $("#hdnAccion").val("2");
                app.url = this.url;
                var frmData = new FormData();
                frmData.append("method", "GetForm");
                frmData.append(this.PrimaryKey, id);
                app.sendRequest(frmData, "html", function(data) {
                    $("#" + this.Container).html(data);
                    //app.hideLoading();
                }, this, false);
            },
            Eliminar: function Eliminar(id) {
                //Mbox.Show("fas fa-exclamation-triangle", "Atención", "Realmente deseas eliminar el registro?")
                app.url = this.url;
                var frmData = new FormData();
                frmData.append("method", "Delete");
                frmData.append(this.PrimaryKey, id);
                if(window.confirm("Realmente deseas eliminar el registro?")) {                    
                    app.sendRequest(frmData, "json", function(data) {
                        Mbox.Success("Atencion", data.mensaje);
                        window.location.href = "index.php";
                        //app.hideLoading();
                    }, this, false);
                }
            },
            Insert: function Insert(func) {
                app.url = this.url;
                var frm = document.getElementById(this.Form);
                console.log(frm);
                var frmData = new FormData(frm);
                frmData.append("method", "Insert");
                
                app.sendRequest(frmData, "json", (func || function(data) {
                    //app.hideLoading();
                    //app.mostrarMensaje("45%", "45%", data.mensaje, null, "alert-info");
                    window.location.href = "index.php";
                }), this, false);
            },            
            Update: function Update(func) {
                var frm = document.getElementById(this.Form);
                app.url = this.url;
                var frmData = new FormData(frm);
                frmData.append("method", "Update");
                app.sendRequest(frmData, "json", (func || function(data) {
                    //app.hideLoading();
                    //app.mostrarMensaje("45%", "45%", data.mensaje, null, "alert-info");
                    window.location.href = "index.php";
                }), this, false);
            },
            GetView: function GetView(file, value) {
                app.Loading();
                var frm = document.getElementById(this.Form);
                $("#divPrincipal").load(file, {id: value}, function () {
                    app.DoneLoading();
                });
            },
            OpenPage: function OpenPage(url, vars, data) {
                var frm = document.createElement("form");
                frm.setAttribute("method", "post");
                frm.setAttribute("action", url);
                if(vars != null) {
                    for (let index = 0; index < vars.length; index++) {
                        var hdnData = document.createElement("input");
                        hdnData.setAttribute("type", "hidden");
                        hdnData.setAttribute("name", vars[index]);
                        hdnData.setAttribute("value", data[index]);
                        frm.appendChild(hdnData);
                    }
                }                           

                document.body.appendChild(frm);
                frm.submit();
            }
        };
        $.extend( modulo, api );
    }(( typeof modulo === 'undefined' ) ? window : modulo));
}( Catalog ));