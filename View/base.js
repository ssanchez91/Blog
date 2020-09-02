/**
 * Created by sstee on 27/08/2020.
 */
$(document).ready(function () {
    $("#btnPreviousPage").on("click", function () {
        window.history.back();
    });

    $(".confirm").on("show.bs.modal", function (e) {
        $(this).find(".btn-ok").attr("href", $(e.relatedTarget).data("href"));
        $(this).find(".btn-ok").attr("href");
    });

    $("a").hover(function () {
        $(this).popover("toggle");
    });
});

