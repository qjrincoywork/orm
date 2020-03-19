$(function () {

    var table = $("#users_list").DataTable({
        scrollX: true,
        ajax: {
            type: "GET",
            url: "/user/ajax/",
            dataType: "json"
        },
        columns: [{
                data: 'id'
            },
            {
                data: 'username'
            },
            {
                mRender: function (data, type, row) {
                    return (row.is_active == 1) ? 'Active' : 'Inactive';
                }
            },
            { // this is Actions Column 
                mRender: function (data, type, row) {
                    var buttons = "",
                        actionClass = "",
                        icon = "",
                        actionTitle = "";

                    if (row.is_active == 1) {
                        actionClass = "confirm_delete_user",
                            icon = "<i class='far fa-trash-alt'></i>",
                            actionTitle = "Delete";

                        buttons += "<button href='/user/" + row.id + "/edit'  id='" + row.id + "' data-toggle='tooltip' data-placement='left' title='Edit' type='submit' class='edit_user btn btn-primary btn-sm'><i class= 'fas fa-edit'></i></button >  ";
                    } else if (row.is_active == 0) {
                        actionClass = "confirm_restore_user",
                            icon = "<i class='fas fa-recycle'></i>",
                            actionTitle = "Restore";
                    } else if (row.is_active == 2) {
                        buttons += "<button href='/user/unlock/" + row.id + "' id='" + row.id + "' data-toggle='tooltip' data-placement='left' title='Unlock' type='submit' class='confirm_unlock_user btn btn-primary btn-sm'><i class= 'fas fa-unlock'></i></button >  ";
                    }

                    buttons += " <button href='/user/delete/" + row.id + "' id = '" + row.id + "' data-toggle='tooltip' data-placement='left' title='" + actionTitle + "' type='submit' class='" + actionClass + " btn btn-primary btn-sm'>" + icon + "</button> ";

                    return buttons;
                }
            }
        ],
        dom: "lBfrtip",
        buttons: [{
            text: "Add User",
            className: "add_user btn btn-primary",
            attr: {
                href: "/user/create/"
            },
            init: function (api, node, config) {

                /* if (!access.data['user-create']) {
                    $(node).attr('hidden', 'hidden');
                } */

                $(node).removeClass("dt-button");
            }
        }, ],
        "fnRowCallback": function (nRow, aData, iDisplayIndex) {
            if (aData['no_access']) {
                table.columns([4]).visible(false);
                table.buttons('.add_user').nodes().hide();
            }

            if (aData.is_active == 1) {
                $(nRow).addClass('view_user')
                $(nRow).attr('id', aData.id);
            }
        },
    });

    /* if (!access.data['user-edit'] && !access.data['user-delete']) {
        var num = table.columns().count();
        table.columns(num - 1).visible(false);
    } */

    $('body').on('click', '.add_user, .edit_profile, .edit_user,' +
        '.confirm_delete_user, .delete_user, .confirm_restore_user, .restore_user, .view_user',
        function (event) {
            event.preventDefault();
            event.stopPropagation();

            var form = $('form').not('.form-header'),
                action = form.attr('action'),
                id = form.attr('id'),
                profileId = $('form').find('input[name="id"]').val(),
                className = $(this).attr('class').split(' ')[0],
                url = $(this).attr('href'),
                laravelCSRFToken = $('meta[name="csrf-token"]').attr('content'),
                me = this,
                fd = new FormData();

            $(me).attr('disabled', 'disabled');
            switch (className) {
                case "confirm_delete_user":
                case "confirm_restore_user":
                    // Delete User

                    posting = $.ajax({
                        type: "get",
                        url: url
                    });
                    console.log(url);
                    posting
                        .done(function (data) {
                            console.log(data);
                            fx.displayCustomizedDialogBox(data, className, undefined);
                            $(me).removeAttr('disabled');
                        })
                        .fail(function (xhr, status, error) {
                            $(me).removeAttr('disabled');
                        });

                    // End Delete user
                    break;
                case "delete_user":
                case "restore_user":
                    fd.append("_token", laravelCSRFToken);
                    fd.append("_method", "delete");
                    posting = $.ajax({
                        type: "post",
                        url: url,
                        data: fd,
                        headers: {
                            "X-CSRF-TOKEN": laravelCSRFToken
                        },
                        cache: false,
                        processData: false,
                        contentType: false
                    });

                    posting.done(function (data) {
                            $(me).removeAttr('disabled');
                            $(".modal").modal("hide");
                            $("#users_list").DataTable().ajax.reload();

                            var mssgStatus = className.split("_")[1],
                                action = className.split("_")[0];

                            if (data.hasOwnProperty('success')) {
                                switch (data.success) {
                                    case 'true':
                                        fx.displayNotify(mssgStatus, "successfully " + action + "d.", "success");
                                        break;
                                    case 'false':
                                        fx.displayNotify(mssgStatus, "unsuccessfully " + action + "d.", "danger");
                                        break;
                                }
                            }
                        })
                        .fail(function (xhr, status, error) {
                            $(me).removeAttr('disabled');
                            fx.displayNotify("User", "failed transaction", "danger");
                            console.log(status);
                            console.log(error);
                        });
                    break;
                    // End Delete User    
                case "add_user":
                case "edit_user":

                    if (action == undefined) {
                        posting = $.get(url);
                        console.log($.get(url));
                    } else {
                        form.find("input, select, file").each(function () {
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
                            action = form.attr('action');
                            $(me).removeAttr('disabled');
                            if (action == undefined) {
                                switch (className) {
                                    case "add_user":
                                    case "edit_user":
                                    default:
                                        width = undefined;
                                        break;
                                }

                                fx.displayCustomizedDialogBox(data, className, width);

                                switch (className) {
                                    default:
                                        fx.modalUiHelper();
                                        break;
                                }

                            } else {

                                if (data.hasOwnProperty("success") && data.success) {
                                    $(".modal").modal("hide");
                                    $("#users_list").DataTable().ajax.reload();

                                    var mssgStatus = className.split("_")[1],
                                        action = className.split("_")[0];

                                    switch (className) {
                                        case "delete_user":
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
                                                break;
                                            case 'false':
                                                fx.displayNotify(mssgStatus, "unsuccessfully " + action + suffix + ".", "danger");
                                                break;
                                        }
                                    }
                                }
                            }
                        })
                        .fail(function (xhr, status, error) {
                            $(me).removeAttr('disabled');
                            var response = xhr.responseJSON;
                            console.log(response.hasOwnProperty("errors"));
                            if (response.hasOwnProperty("errors")) {
                                fx.displayFormErrorMessages(response, form);
                            } else {
                                fx.displayNotify("User", error, "danger");
                            }
                        });

                    break;
                    //Edit Profile
                case "edit_profile":

                    if (action == undefined) {
                        posting = $.get(url);

                    } else {
                        form.find("input, select").each(function () {
                            fd.append($(this).attr("name"), $(this).val());
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
                            action = form.attr('action');
                            $(me).removeAttr('disabled');
                            if (action == undefined) {
                                //  alert(action)
                                switch (className) {
                                    case "edit_profile":
                                        /* $("#users_list").DataTable().ajax.reload();
                                        document.getElementById('users_list').rows[parseInt(rn,id)].click(); */
                                    default:
                                        width = undefined;
                                        break;
                                }
                                fx.displayCustomizedDialogBox(data, className, width);
                                switch (className) {
                                    default:
                                        fx.modalUiHelper();
                                        break;
                                }
                            } else {
                                if (data.hasOwnProperty("success") && data.success) {
                                    $(".modal").modal("hide");
                                    $("#users_list").DataTable().ajax.reload();
                                    $('table#users_list tbody tr#' + profileId).click();
                                    var mssgStatus = className.split("_")[1],
                                        action = className.split("_")[0];

                                    switch (className) {
                                        case "delete_user":
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
                                                break;
                                            case 'false':
                                                fx.displayNotify(mssgStatus, "unsuccessfully " + action + suffix + ".", "danger");
                                                break;
                                        }
                                    }
                                }
                            }
                        })
                        .fail(function (xhr, status, error) {
                            $(me).removeAttr('disabled');
                            console.log(status);
                            console.log(error);
                            var response = xhr.responseJSON;
                            if (response.hasOwnProperty("errors")) {
                                fx.displayFormErrorMessages(response, form);
                            } else {
                                fx.displayNotify("User", error, "danger");
                            }
                        });
                    break;
            }
        });
    // Right Pane

    $('body').on('click', '.view_user', function (event) {
        event.preventDefault();
        var id = $(this).attr('id'),
            url = '/userprofile/' + id;

        if (id) {
            posting = $.get(url);
            posting.done(function (data) {
                $(".right-pane div").replaceWith(data);
            });

            $(".modal").after(
                "<div class='right-pane-backdrop'><div class='right-pane hidden'><div></div></div></div>"
            );

            setTimeout(function () {
                $(".right-pane").removeClass("hidden");
            }, 50);
        }
    });

    $('body').on('click', '.right-pane-backdrop', function (event) {

        if (event.target !== this) {
            return;
        }

        $('.right-pane').addClass('hidden');

        setTimeout(function () {
            $('.right-pane-backdrop').remove();
        }, 200);

    });

    // End of Right Pane
    $('body').on('click', '.reset_field', function (event) {
        $('form').not('.form-header').find('input, select').each(function () {
            if ($(this).attr('type') != 'hidden') {
                $(this).val('');
            }
        });
        $('.img-upload').attr('src', '../img/avatar-01.jpg');

    });

});
