
(function (a) {
    a.createModal = function (b) {
        defaults = {
            title: "",
            message: "le fichier va ici!",
            closeButton: true,
            scrollable: false
        };
        var b = a.extend({}, defaults, b);
        var c = (b.scrollable === true) ? 'style="max-height: 980px; overflow-y: auto;"' : "";
        html = '<div class="modal fade" id="myModal">';
        html += '<div class="modal-dialog">';
        html += '<div class="modal-content">';
        html += '<div class="modal-header">';
        html += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>';
        if (b.title.length > 0) {
            html += '<h4 class="modal-title">' + b.title + "</h4>"
        }
        html += "</div>";
        html += '<div class="modal-body" ' + c + ">";
        html += b.message;
        html += "</div>";
        html += '<div class="modal-footer">';
        if (b.closeButton === true) {
            html += '<button type="button" class="btn btn-dark" data-dismiss="modal">Fermer</button>'
        }
        html += "</div>";
        html += "</div>";
        html += "</div>";
        html += "</div>";
        a("body").prepend(html);
        a("#myModal").modal().on("hidden.bs.modal", function () {
            a(this).remove()
        })
    }
})(jQuery);

$(function () {
    $('.view-pdf').on('click', function () {
        var pdf_link = $(this).attr('href');
        var iframe = '<div class="iframe-container"><iframe src="' + pdf_link + '"></iframe></div>'
        $.createModal({
            title: '&nbspAperçu pdf',
            message: iframe,
            closeButton: true,
            scrollable: false
        });
        return false;
    });
})