$(document).ready(function() {
    $('.btn-sideBar-SubMenu').on('click', function(e) {
        e.preventDefault();
        var SubMenu = $(this).next('ul');
        var iconBtn = $(this).children('.zmdi-caret-down');
        if (SubMenu.hasClass('show-sideBar-SubMenu')) {
            iconBtn.removeClass('zmdi-hc-rotate-180');
            SubMenu.removeClass('show-sideBar-SubMenu');
        } else {
            iconBtn.addClass('zmdi-hc-rotate-180');
            SubMenu.addClass('show-sideBar-SubMenu');
        }
    });

    $('.btn-menu-dashboard').on('click', function(e) {
        e.preventDefault();
        var body = $('.dashboard-contentPage');
        var sidebar = $('.dashboard-sideBar');
        if (sidebar.css('pointer-events') == 'none') {
            body.removeClass('no-paddin-left');
            sidebar.removeClass('hide-sidebar').addClass('show-sidebar');
        } else {
            body.addClass('no-paddin-left');
            sidebar.addClass('hide-sidebar').removeClass('show-sidebar');
        }
    });

    $('.FormularioAjax').submit(function(e) {
        e.preventDefault();

        var form = $(this);

        var tipo = form.attr('data-form');
        var accion = form.attr('action');
        var metodo = form.attr('method');
        var respuesta = form.children('.RespuestaAjax');
        var titulo = "¿Desea continuar?"
        var msjError = "<script>swal('Ocurrió un error inesperado','Por favor recargue la página','error');</script>";
        var formdata = new FormData(this);

        var textoAlerta;

        if (tipo === "save") {
            textoAlerta = "Los datos que envías quedarán almacenados en el sistema.";
        } else if (tipo === "delete") {
            textoAlerta = "Los datos serán eliminados completamente del sistema.";
        } else if (tipo === "update") {
            textoAlerta = "Los datos del sistema serán actualizados.";
        } else if (tipo === "descarga") {
            textoAlerta = "El archivo será descargado.";
        } else {
            textoAlerta = "";
        }

        swal({
            title: titulo,
            text: textoAlerta,
            type: "question",
            showCancelButton: true,
            confirmButtonColor: '#03A9F4',
            cancelButtonColor: '#F44336',
            confirmButtonText: '<i class="zmdi zmdi-check"></i> Aceptar',
            cancelButtonText: '<i class="zmdi zmdi-close-circle"></i> Cancelar'
        }).then(function() {
            $.ajax({
                type: metodo,
                url: accion,
                data: formdata ? formdata : form.serialize(),
                cache: false,
                contentType: false,
                processData: false,
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            if (percentComplete < 100) {
                                respuesta.html('<p class="text-center">Procesando... (' + percentComplete + '%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: ' + percentComplete + '%;"></div></div>');
                            } else {
                                respuesta.html('<p class="text-center"></p>');
                            }
                        }
                    }, false);
                    return xhr;
                },
                success: function(data) {
                    respuesta.html(data);
                },
                error: function() {
                    respuesta.html(msjError);
                }
            });
            return false;
        });
    });

});
(function($) {
    $(window).on("load", function() {
        $(".dashboard-sideBar-ct").mCustomScrollbar({
            theme: "rounded-dots",
            scrollbarPosition: "inside",
            autoHideScrollbar: true,
            scrollButtons: { enable: true }
        });
        $(".dashboard-contentPage, .Notifications-body").mCustomScrollbar({
            theme: "rounded-dots-dark",
            scrollbarPosition: "inside",
            autoHideScrollbar: true,
            scrollButtons: { enable: true }
        });
    });
})(jQuery);

(function(a) {
    a.createModal = function(b) {
        defaults = { title: "", message: "Your Message Goes Here!", closeButton: true, scrollable: false };
        var b = a.extend({}, defaults, b);
        var c = (b.scrollable === true) ? 'style="max-height: 100%;overflow-y: auto;"' : "";
        html = '<div class="modal fade" id="myModal">';
        html += '<div class="modal-dialog">';
        html += '<div class="modal-content" style="border-radius:15px;">';
        html += '<div class="modal-header">';
        //html += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
        if (b.title.length > 0) { html += '<h3 class="modal-title text-center" style="margin-bottom:10px;margin-top:-5px;">' + b.title + "</h3>" }
        html += "</div>";
        html += '<div class="modal-body" ' + c + ">";
        html += b.message;
        html += "</div>";
        html += '<div class="modal-footer" style="text-align:center;">';
        if (b.closeButton === true) { html += '<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>' }
        html += "</div>";
        html += "</div>";
        html += "</div>";
        html += "</div>";
        a("body").prepend(html);
        a("#myModal").modal().on("hidden.bs.modal", function() { a(this).remove() })
    }
})(jQuery);