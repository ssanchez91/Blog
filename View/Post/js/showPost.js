function changeTextBtnAddComment() {
    if ($("#addCommentLink a").attr("aria-expanded") === "false") {
        $("#addCommentLink a").html("<i class=\"fa fa-window-close\"></i> Cancel");
    }
    else {
        $("#addCommentLink a").html("<i class=\"fa fa-plus\"></i> Add comment");
    }
}

$(document).ready(function () {
    $("#addCommentLink a").on("click", function () {
        changeTextBtnAddComment();
    });
});