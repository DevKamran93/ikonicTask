$(document).ready(function () {
    // Spinner Hide/Show
    $("#save_update_btn").on("click", function () {
        var save_update_btn = $(this);
        save_update_btn.attr("disabled", true);
        save_update_btn.find("#save_update_btn_spinner").removeClass("d-none");
    });

    // For Restore/Delete
    var delete_restore_modal = $("#delete_restore_modal");

    $(document).on("click", ".delete_restore_data", function () {
        var action_btn = $(this);
        var delete_restore_modal_heading = delete_restore_modal.find(
            "#delete_restore_modal_heading"
        );
        var delete_restore_modal_btn = delete_restore_modal.find(
            "#delete_restore_modal_btn"
        );
        var delete_restore_modal_body = delete_restore_modal.find(
            "#delete_restore_modal_body"
        );

        if (action_btn.data("action") == "delete") {
            delete_restore_modal_heading
                .removeClass("bg-success")
                .addClass("bg-danger");
            delete_restore_modal_heading.children("h5").html("Delete ?");
            delete_restore_modal_body
                .children("h6")
                .html("Are You Sure, You Want To Delete ?");
            delete_restore_modal_btn
                .removeClass("btn-outline-success")
                .addClass("btn-outline-danger");
            delete_restore_modal_btn.find("#confirm_btn_text").text("Delete");
            delete_restore_modal_btn.attr(
                "data-action",
                action_btn.data("action")
            );
        } else {
            delete_restore_modal_heading
                .removeClass("bg-danger")
                .addClass("bg-success");
            delete_restore_modal_heading.children("h5").html("Restore ?");
            delete_restore_modal_body
                .children("h6")
                .html("Are You Sure, You Want To Restore ?");
            delete_restore_modal_btn
                .removeClass("btn-outline-danger")
                .addClass("btn-outline-success");
            delete_restore_modal_btn.find("#confirm_btn_text").text("Restore");
            delete_restore_modal_btn.attr(
                "data-action",
                action_btn.data("action")
            );
        }

        delete_restore_modal
            .find("#delete_restore_form #id")
            .val(action_btn.data("id"));
    });
});
