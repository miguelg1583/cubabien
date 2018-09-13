let App;
App = function () {
    let base_url = undefined;

    let handleAjax = function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ajaxStart(function () {
            NProgress.start();
        }).ajaxStop(function () {
            NProgress.done();
        }).ajaxComplete(function () {
            NProgress.done();
        }).ajaxError(function (event, request, ajaxSettings, thrownError) {
            request.status === 419 ? window.location.reload(true) : pNoty("Error :(", "Ha ocurrido un problema, recargue la página", "error");
            console.log(thrownError);
        });
    };

    let handleAjaxFront = function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ajaxError(function (data) {
            console.log(data);
        });
    };

    let handleVue = function () {
        // window.Vue = require('vue');
        Vue.use(VeeValidate, {locale: 'es'})
        // const vapp = new Vue({
        //     el: '#app'
        // });
    };

    let handleDatatable = function () {
        $("table[id^=DT]").each(function () {
            $(this).DataTable({
                'paging': true,
                'responsive': true,
                'lengthMenu': [[5, 10, 25, 50, -1], [5, 10, 25, 50, 'Todos']],
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': true,
                'language': {
                    'url': base_url + '/backend/js/Spanish.json'
                }
            });
        });
    };

    let pNoty = function (title, msg, type) {
        return new PNotify({
            title: title,
            text: msg,
            type: type,
            styling: "bootstrap3",
            buttons: {
                closer: true, //Provide a button for the user to manually close the notice.
                closer_hover: false, //Only show the closer button on hover.
                sticker: true, //Provide a button for the user to manually stick the notice.
                sticker_hover: true, //Only show the sticker button on hover.
                show_on_nonblock: false, //Show the buttons even when the nonblock module is in use.
                labels: {close: "Cerrar", stick: "Fijar"} //Lets you change the displayed text, facilitating internationalization.
            }
        })
    };

    let ajaxDelEntity = function (id, ruta) {
        $.ajax({
            type: 'DELETE',
            url: ruta + '/' + id,
            success: function (data) {
                if (data.errors) {
                    console.log(data);
                    App.showNotiError('Ha ocurrido un problema en el servidor');
                } else {
                    App.showNotiSuccess('Elemento eliminado satisfactoriamente');
                    // window.location.reload();
                }
            }
        });
    };


    return {
        init: function (url) {
            base_url = url;
        },
        initAjax: function () {
            handleAjax();
        },
        initVue: function () {
            handleVue();
        },
        initDatatable: function () {
            handleDatatable();
        },
        showNotiSuccess: function (msg) {
            pNoty("Completado!", msg, "success");
        },
        showNotiInfo: function (msg) {
            pNoty("Información:", msg, "info");
        },
        showNotiError: function (msg) {
            pNoty("Error :(", msg, "error");
        },
        showNotiNotice: function (msg) {
            pNoty("Error :(", msg, "notice");
        },
        getBaseUrl: function () {
            return base_url;
        },
        AjaxDel: function (id, ruta) {
            ajaxDelEntity(id, ruta);
        },
        initAjaxFront: function () {
            handleAjaxFront();
        }

    }
}
();

// window.Vue = require('vue');
// import es from 'vee-validate/dist/locale/es.js';
// import VeeValidate, { Validator } from 'vee-validate';
//
// // Localize takes the locale object as the second argument (optional) and merges it.
// Validator.localize('es', es);
//
// // Install the Plugin.
// Vue.use(VeeValidate);

