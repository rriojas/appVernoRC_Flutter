"use strict";
var Mbox = {}, MboxModulo;
(function(MboxModulo) {
    (function(MboxModulo) {
        var api = {
            delay: 200,
            Show: function Show(icono, titulo, mensaje) {
                let html = '<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center position-absolute" style="min-height: 200px;left:50vw; top:50vh;"><div id="divToastMbox" role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-autohide="true" data-delay="' + Mbox.delay + '" style="z-index:1072!important;"><div class="toast-header"><span class="fa ' + icono + ' mr-1"></span><strong class="mr-auto">' + titulo + '</strong><button type="button" class="ml-2 mb-1 close" data-bs-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="toast-body">' + mensaje + '</div></div><div class="modal-backdrop fade show"></div></div>';
                $("body").append(html);
                $("#divToastMbox").toast('show');
            },
            Success: function Success(titulo, mensaje) {
                Mbox.Show("fas fa-check-circle text-success", titulo, mensaje);
            },
            Error: function Error(titulo, mensaje) {
                Mbox.Show("fas fa-ban text-danger", titulo, mensaje);
            },
            Hide: function Hide() {
                $("#divToastMbox").parent().remove();
            },
            ConfirmBox: function ConfirmBox(icono, titulo, mensaje) {
                let html = '<div id="divConfirmBox" class="modal" tabindex="-1"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title"><span class="fa ' + icono + ' mr-1"></span>' + titulo + '</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"><p>' + mensaje + '</p></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button><button type="button" class="btn btn-primary">Aceptar</button></div></div></div></div>';
                $("body").append(html);
                var myModal = new bootstrap.Modal(document.getElementById('divConfirmBox'), {
                    keyboard: false
                });
               //myModal.Show();
            }
        };
        $.extend(MboxModulo, api);
    }((typeof MboxModulo === 'undefined') ? window : MboxModulo));
}(Mbox));
$("body").delegate("#divToastMbox", "hidden.bs.toast", Mbox.Hide);