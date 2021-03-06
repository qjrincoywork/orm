$(function () {
    //Fetching tables
    $("body").on(
        "click",
        ".get_therapists, .get_positions, .get_logic, .get_strmanipulation",
        function (event) {
            event.preventDefault();
            (className = $(this)
                .attr("class")
                .split(" ")[0]),
            (url = $(this).attr("href")),
            (me = this),
            (fd = new FormData());
            var modelContainer = className.split("_")[1];
            var rootUrl = window.location.href.match(/^.*\//)['input'];
            
            url = rootUrl + "/" + modelContainer;

            console.log(url);
            container = $(this)
                .closest("li")
                .closest(".nav-tabs")
                .parent(".default-tab")
                .find("." + modelContainer + "-container");

            posting = $.get(url);
            posting
                .done(function (data) {
                    // console.log(data);
                    var result = jQuery.parseJSON(data);
                    switch (className) {
                        case "get_therapists":
                        case "get_positions":
                        case "get_logic":
                                htmlVal = '<table class="table table-striped" style="width:100%"><tr>',
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
                                htmlVal += header;
                                htmlVal += "<tr><tbody>"
                                
                                $.each(result.data , function( key, employee ) {
                                    $.each(employee , function( key, emVal ) {
                                        if(className == 'get_therapists') {
                                            if(key != 'target_date')
                                                htmlVal += "<td>"+ emVal +"</td>";
                                        } else {
                                            htmlVal += "<td>"+ emVal +"</td>";
                                        }
                                    });
                                    htmlVal += "</tr>";
                                });
                                htmlVal += "</tbody></table>";
                            break;
                        default:
                            if(result) 
                            {
                                htmlVal = "Sample: " + result['sample'] + "<br>";
                                htmlVal += "Result: " + result['result'];
                            }
                            break;
                    }
                    container.html(htmlVal);
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