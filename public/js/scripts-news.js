var fxNews = {
    'accordionHelper': function (id) {
        $('#comment_list').DataTable({
            scrollX: true,
            ajax: {
                type: "GET",
                url: "/comment/ajax/" + id,
                dataType: "json"
            },
            columns: [{
                    'data': 'id'
                },
                {
                    'data': 'body'
                },
                {
                    mRender: function (data, type, row) {
                        var buttons = "",
                            actionClass = "",
                            icon = "",
                            actionTitle = "";

                        if (row.is_active == 1) {
                            actionClass = "confirm_delete_comment",
                                icon = "<i class='far fa-trash-alt'></i>",
                                actionTitle = "Delete",
                                buttons += "<button href='/comment/" + row.id + "/edit'  id='" + row.id + "' data-toggle='tooltip' data-placement='left' title='Edit' type='submit' class='edit_comment btn btn-primary btn-sm'><i class= 'fas fa-edit'></i></button >  ";
                        } else if (row.is_active == 0) {
                            actionClass = "confirm_restore_comment",
                                icon = "<i class='fas fa-recycle'></i>",
                                actionTitle = "Restore";
                        }

                        buttons += " <button href='/comment/delete/" + row.id + "' id = '" + row.id + "' data-toggle='tooltip' data-placement='left' title='" + actionTitle + "' type='submit' class='" + actionClass + " btn btn-primary btn-sm'>" + icon + "</button> ";

                        return buttons;
                    }
                }
            ],
            dom: "lBfrtip",
            buttons: [{
                text: "Add Comment",
                className: "add_comment btn btn-primary",
                attr: {
                    href: "/comment/create/" + id
                },
                init: function (api, node, config) {
                    $(node).removeClass("dt-button");
                }
            }],
        });
    }
}
$(function () {
    var table = $("#news_list").DataTable({
        scrollX: true,
        ajax: {
            type: "GET",
            url: "/news/ajax/",
            dataType: "json"
        },
        columns: [{
                data: 'id'
            },
            {
                data: 'title'
            },
            {
                data: 'body'
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
                        actionClass = "confirm_delete_news",
                            icon = "<i class='far fa-trash-alt'></i>",
                            actionTitle = "Delete";

                        buttons += "<button href='/news/" + row.id + "/edit'  id='" + row.id + "' data-toggle='tooltip' data-placement='left' title='Edit' type='submit' class='edit_news btn btn-primary btn-sm'><i class= 'fas fa-edit'></i></button >  ";
                    } else if (row.is_active == 0) {
                        actionClass = "confirm_restore_news",
                            icon = "<i class='fas fa-recycle'></i>",
                            actionTitle = "Restore";
                    } else if (row.is_active == 2) {
                        buttons += "<button href='/news/unlock/" + row.id + "' id='" + row.id + "' data-toggle='tooltip' data-placement='left' title='Unlock' type='submit' class='confirm_unlock_news btn btn-primary btn-sm'><i class= 'fas fa-unlock'></i></button >  ";
                    }

                    buttons += " <button href='/news/delete/" + row.id + "' id = '" + row.id + "' data-toggle='tooltip' data-placement='left' title='" + actionTitle + "' type='submit' class='" + actionClass + " btn btn-primary btn-sm'>" + icon + "</button> ";

                    return buttons;
                }
            }
        ],
        dom: "lBfrtip",
        buttons: [{
            text: "Add News",
            className: "add_news btn btn-primary",
            attr: {
                href: "/news/create/"
            },
            init: function (api, node, config) {
                $(node).removeClass("dt-button");
            }
        }, ],
        "fnRowCallback": function (nRow, aData, iDisplayIndex) {
            if (aData.is_active == 1) {
                $(nRow).attr('id', aData.id);
            }
        },
    });

    //CRUD Item
    $('body').on('click', '.add_news, .edit_news, .delete_news, .confirm_delete_news, .restore_news, .confirm_restore_news,' +
        '.add_comment, .edit_comment, .delete_comment, .confirm_delete_comment, .restore_comment, .confirm_restore_comment',
        function (event) {

            event.preventDefault();
            event.stopPropagation();

            var form = $('form').not('.form-header'),
                action = form.attr('action'),
                id = form.attr('id'),
                newsId = $('form').find('input[name="news_id_fk"]').val(),
                className = $(this).attr('class').split(' ')[0],
                url = $(this).attr('href'),
                laravelCSRFToken = $('meta[name="csrf-token"]').attr('content'),
                me = this,
                fd = new FormData();
            console.log(className);

            switch (className) {
                case "add_news":
                case "edit_news":
                case "add_comment":
                case "edit_comment":
                    if (action == undefined) {
                        posting = $.get(url);
                    } else {
                        form.find("input, select, textarea").each(function () {
                            if ($(this).attr("type") != "file") {
                                fd.append($(this).attr("name"), $(this).val());
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

                    posting
                        .done(function (data) {

                            var mssgStatus = className.split("_")[1],
                                actionTitle = className.split("_")[0];
                            if (action == undefined) {
                                switch (className) {
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
                                switch (className) {
                                    case "add_comment":
                                    case "edit_comment":
                                        $(".modal").modal("hide");
                                        $("#comment_list").DataTable().ajax.reload();
                                        break;
                                    case "add_news":
                                    case "edit_news":
                                        $(".modal").modal("hide");
                                        $("#news_list").DataTable().ajax.reload();
                                        break;
                                }

                                switch (className) {
                                    /* case "edit_comment":
                                        suffix = 'd';
                                        break; */
                                    default:
                                        suffix = 'ed';
                                        break;
                                }
                                if (data.hasOwnProperty('success')) {

                                    switch (data.success) {
                                        case 'true':
                                            fx.displayNotify(mssgStatus, "successfully " + actionTitle + suffix, "success");
                                            break;
                                        case 'false':
                                            fx.displayNotify(mssgStatus, "unsuccessfully " + actionTitle + suffix, "danger");
                                            break;
                                    }
                                }
                            }
                        })
                        .fail(function (xhr, status, error) {
                            $(me).removeAttr("disabled");
                            console.log(status);
                            console.log(error);
                            var response = xhr.responseJSON;
                            if (response.hasOwnProperty("errors")) {
                                fx.displayFormErrorMessages(response);
                            } else {
                                fx.displayNotify("News", error, "danger");
                            }
                        });
                    break;
                case "confirm_delete_news":
                case "confirm_restore_news":
                case "confirm_delete_comment":
                case "confirm_restore_comment":
                    posting = $.ajax({
                        type: "get",
                        url: url
                    });

                    posting
                        .done(function (data) {
                            fx.displayCustomizedDialogBox(data, className, undefined);
                            $(me).removeAttr("disabled");
                        })
                        .fail(function (xhr, status, error) {
                            $(me).removeAttr("disabled");
                            console.log(status);
                            console.log(error);
                        });

                    break;
                case "delete_news":
                case "restore_news":
                case "delete_comment":
                case "restore_comment":
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
                            var mssgStatus = className.split("_")[1],
                                actionTitle = className.split("_")[0];
                            switch (className) {
                                case "delete_comment":
                                case "restore_comment":
                                    $(".modal").modal("hide");
                                    $("#comment_list").DataTable().ajax.reload();
                                    break;
                                case "delete_news":
                                case "restore_news":
                                    $(".modal").modal("hide");
                                    $("#news_list").DataTable().ajax.reload();
                                    break;
                            }

                            if (data.hasOwnProperty('success')) {

                                switch (data.success) {
                                    case 'true':
                                        fx.displayNotify(mssgStatus, "successfully " + actionTitle + "d.", "success");
                                        break;
                                    case 'false':
                                        fx.displayNotify(mssgStatus, "unsuccessfully " + actionTitle + "d.", "danger");
                                        break;
                                }
                            }
                        })
                        .fail(function (xhr, status, error) {

                            fx.displayNotify("Variant", "failed transaction", "danger");
                            console.log(status);
                            console.log(error);
                        });
                    break;
            }

        });

    $('body').on('click', '.reset_field', function (event) {
        $('form').not('.form-header').find('input, select, textarea').each(function () {
            if ($(this).attr('type') != 'hidden') {
                $(this).val('');
            }
        });
        $('.img-upload').attr('src', '../img/gd-white.png');
    });

    // Right Pane
    $('body').on('click', '#news_list tr', function (event) {
        event.preventDefault();
        var id = $(this).attr('id'),
            url = '/comment';

        if (id) {
            posting = $.get(url);
            posting.done(function (data) {
                $(".right-pane div").replaceWith(data);
                fxNews.accordionHelper(id);
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
});
