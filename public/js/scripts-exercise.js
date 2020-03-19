$(function () {
    //Fetching tables
    $("body").on(
        "click",
        ".get_therapists, .get_positions, .get_logic",
        function (event) {
            event.preventDefault();
            (className = $(this)
                .attr("class")
                .split(" ")[0]),
            (url = $(this).attr("href")),
            (me = this),
            (fd = new FormData());
            var modelContainer = className.split("_")[1];
            
            var rootUrl = window.location.href.match(/^.*\//)[0];

            /* switch (className) {
                case "get_therapists":
                    btnClass = "therapists";
                    break;
                case "get_sdms":
                    btnClass = "sdm";
                    break;
                case "get_positions":
                    btnClass = "positions";
                    break;
                case "get_positions":
                    btnClass = "position";
                    break;
                case "get_reasons":
                    btnClass = "reason";
                    break;
            } */
            
            url = rootUrl + "SQLProblems/" + modelContainer;
            
            container = $(this)
                .closest("li")
                .closest(".nav-tabs")
                .parent(".default-tab")
                .find("." + modelContainer + "-container");

            posting = $.get(url);
            posting
                .done(function (data) {
                    var result = jQuery.parseJSON(data),
                        table = '<table class="table table-striped" style="width:100%"><tr>',
                        header = '';
                        
                        if(result.data.length > 0) 
                        {
                            $.each(result.data[0] , function( eKey, eVal ) {
                                if(className == 'get_therapists') {
                                    if(eKey != 'target_date') {
                                        str = eKey.replace('_', ' ');
                                        header += "<th>"+ str.substr(0,1).toUpperCase() + str.substr(1) + "</th>";
                                    }
                                } else {
                                    str = eKey.replace('_', ' ');
                                    header += "<th>"+ str.substr(0,1).toUpperCase() + str.substr(1) + "</th>";
                                }
                            });
                        }

                        header += "</tr>";
                        table += header;
                        table += "<tr><tbody>"
                        
                        $.each(result.data , function( key, employee ) {
                            $.each(employee , function( key, emVal ) {
                                if(className == 'get_therapists') {
                                    if(key != 'target_date')
                                        table += "<td>"+ emVal +"</td>";
                                } else {
                                    table += "<td>"+ emVal +"</td>";
                                }
                            });
                            table += "</tr>";
                        });
                        table += "</tbody></table>";
                        container.html(table);
                })
                .fail(function (xhr, status, error) {
                    var response = xhr.responseJSON;
                    if (response.hasOwnProperty("errors")) {
                        fx.displayFormErrorMessages(response);
                    } else {
                        fx.displayNotify("Forms Signatory", error, "danger");
                    }
                });
        }
    );
    //End of Fetching tables
});