$(document).ready(function () {
    let data;
/*
    let txtSearch = '';
*/
    $.ajax({
        url: "http://127.0.0.1:8000/api/singer",
        data: {},
        type: "GET",
        dataType: "json"
    }).done(function (response) {
        console.log(response)
        data = response;
        display(response);
    }).fail(function () {
        console.log("Fail")
    });
    function display(response) {
        console.log(response)
        $('#table-data').html("");
        let str = "";
        jQuery.each(response, function (key, val) {
            console.log(val)
            // $( "#" + val ).text( "Mine is " + val + "." );
            str += ("<tr>" +
                "<td>" + val.id + "</td>" +
                "<td>" + val.name + "</td>" +
                "</tr>");
            // Will stop running after "three"
        });
        $('#table-data').html(str);
        //Highlight text search
    }
});
