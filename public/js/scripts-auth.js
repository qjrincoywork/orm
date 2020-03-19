var fxAuth = {
    'UIHelper': function () {
        console.log('fxAuth UIHelper');

        $("[data-toggle='tooltip']").tooltip();
        //form error message remove on input
        $('.form-control').on('input change', function () {
            $(this).next('.errors').fadeOut();
            // $(this).closest('.form-group').nextAll('.help-block').fadeOut();
        });

        if ($('input[type=radio]').is(':checked') == false) {
            $('input[type=radio]').on('change', function () {
                $(this).closest('.form-group').nextAll('.help-block').fadeOut();
            });
        }
    }
};

$(function () {
    fxAuth.UIHelper();
    $("body").on("click", ".register_user", function (event) {

        event.preventDefault();
        event.stopPropagation();
        var form = $(this).closest("form").not(".form-login"),
            action = form.attr("action"),
            className = $(this).attr("class").split(" ")[0],
            url = $(this).attr("href"),
            modal = false,
            laravelCSRFToken = $('meta[name="csrf-token"]').attr('content'),
            me = this,
            fd = new FormData();

        /*Preparation*/

        console.log('action: ' + action);
        /*Action*/
        if (action == undefined) {
            posting = $.get(url);
        } else {
            form.find("input, select").each(function () {
                if ($(this).attr("type") != "file") {
                    fd.append($(this).attr("name"), $(this).val());
                } else {
                    fd.append($(this).attr("name"), $(this)[0].files[0]);
                }
            });

            posting = $.ajax({
                type: "post",
                url: action,
                data: fd,
                headers: {
                    "X-CSRF-TOKEN": laravelCSRFToken
                },
                cache: false,
                processData: false,
                contentType: false
            });
        }

        posting.done(function (data) {
                console.log(data);
                console.log(action);
                if (data.success == 'true') {

                    var mssgStatus = className.split("_")[1],
                        action = className.split("_")[0];

                    switch (className) {
                        case "delete_project":
                            suffix = 'd';
                            break;
                        default:
                            suffix = 'ed';
                            break;
                    }

                    if (data.hasOwnProperty('success')) {

                        switch (data.success) {
                            case 'true':
                                fx.displayNotify(mssgStatus, "successfully " + action + suffix + ".", "success");

                                function pageRedirect() {
                                    window.location.replace("/dashboard");
                                }
                                setTimeout(pageRedirect(), 2500);
                                break;
                            case 'false':
                                fx.displayNotify(mssgStatus, "unsuccessfully " + action + suffix + ".", "danger");
                                break;
                        }
                    }
                }
            })
            .fail(function (xhr, status, error) {
                $(me).removeAttr('disabled');
                var response = xhr.responseJSON;
                if (response.hasOwnProperty("errors")) {
                    // fxAuth.UIHelper();
                    fx.displayFormErrorMessages(response, form);
                } else {
                    fx.displayNotify("User", error, "danger");
                }
            });
    });
});
