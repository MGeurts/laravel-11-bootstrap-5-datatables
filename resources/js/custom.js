/* -------------------------------------------------------------------------------------------- */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    error: function (jqXHR, textStatus, errorThrown) {
        showToast({
            type: 'error',
            title: 'ERROR ' + jqXHR.status,
            message: errorThrown + " ...<hr/>",
        });
    }
});
/* -------------------------------------------------------------------------------------------- */
$('select').select2({
    theme: "bootstrap-5",
    minimumResultsForSearch: 31,
    placeholder: "Choose ...",
    language: "en",
}).on('select2:open', function () {
    document.querySelector('.select2-search__field').focus();
});
/* -------------------------------------------------------------------------------------------- */
window.showToast = function showToast(parameters) {
    /* ---------------------------------------------------------------------------------------- */
    /* parameters:      type (string)                                                           */
    /*                  title (string)                                                          */
    /*                  message (string)                                                        */
    /* ---------------------------------------------------------------------------------------- */
    toastr.options = {
        closeButton: true,
        closeClass: "toast-close-button",
        closeDuration: 300,
        closeEasing: "swing",
        closeHtml: '<button><i class="bi bi-x"></i></button>',
        closeMethod: "fadeOut",
        closeOnHover: true,
        containerId: "toast-container",
        debug: false,
        escapeHtml: false,
        extendedTimeOut: 10000,
        hideDuration: 1000,
        hideEasing: "linear",
        hideMethod: "fadeOut",
        iconClass: "toast-info",
        iconClasses: {
            error: "toast-error",
            info: "toast-info",
            success: "toast-success",
            warning: "toast-warning"
        },
        messageClass: "toast-message",
        newestOnTop: false,
        onHidden: null,
        onShown: null,
        positionClass: "toast-bottom-left",
        preventDuplicates: true,
        progressBar: true,
        progressClass: "toast-progress",
        rtl: false,
        showDuration: 300,
        showEasing: "swing",
        showMethod: "fadeIn",
        tapToDismiss: true,
        target: "body",
        timeOut: 5000,
        titleClass: "toast-title",
        toastClass: "toast",
    };

    parameters.type = typeof parameters.type === "undefined" || !['error', 'warning', 'info', 'success'].includes(parameters.type) ? "info" : parameters.type;

    switch (parameters.type.toLowerCase()) {
        case "error":
            toastr.options.timeOut = 15000;
            break;
        case "warning":
            toastr.options.timeOut = 10000;
            break;
        case "info":
            toastr.options.timeOut = 5000;
            break;
        case "success":
            toastr.options.timeOut = 3000;
            break;
        default:
            toastr.options.timeOut = 5000;
    }

    toastr[parameters.type](parameters.message, parameters.title + "<hr />");
};
/* -------------------------------------------------------------------------------------------- */
