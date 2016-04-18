/**
 * Created by Davo on 1/20/2016.
 */


$.post("/ssma/web_service/chart.php", function (data) {
}, "json").done(function (data) {

    //console.debug(data);
    //console.debug(data['chart'].length);

    Morris.Bar({
        element: 'klout',
        data: data["chart"],//la "y" es eje x y la "a" es el ejey
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Klout',]
    });

}).fail(function (data) {
    console.log("Error de conexion");
    console.log(data);

});

$.post("/ssma/web_service/chart2.php", function (data) {
}, "json").done(function (data) {

    //console.debug(data);
    //console.debug(data['sentiment'].length);
    Morris.Donut({
        element: 'sentimentchart',
        data: data['sentiment']
    });


}).fail(function (data) {
    console.log("Error de conexion");
    console.log(data);

});



$.post("/ssma/web_service/chart2.php", function (data) {
}, "json").done(function (data) {

    console.log( data['sentiment']);

    var chart = AmCharts.makeChart( "donutSentiment", {
        "type": "pie",
        "theme": "light",
        "dataProvider": data['sentiment'],
        "titleField": "label",
        "valueField": "value",
        "labelRadius": 5,

        "radius": "42%",
        "innerRadius": "60%",
        "labelText": "[[title]]",
        "export": {
            "enabled": true
        }
    } );


}).fail(function (data) {
    console.log("Error de conexion");
    console.log(data);

});




$(document).ready(function () {
   

    $('.page-title').html('<h1>Dashboard</h1>');
    $('#page-breadcrumb').remove();
    $('#menu-dashboard').addClass('active');


    $("#searchSentiment").click(function () {

        if ($("#wordsBD").val() != '') {
            var palabra = $("#wordsBD").val();
            $.post("/ssma/web_service/chart2.php", {'word': palabra}, function (data) {
                //console.log(data);
            }, "json").done(function (data) {
                //console.log(data.success);

                if (data.success == 1) {
                    /*
                    $('#sentimentchart').empty();

                    Morris.Donut({
                        element: 'sentimentchart',
                        data: data['sentiment']
                    });
                    */
                }


            }).fail(function (data) {
                console.log("Error de conexion");
                console.log(data);

            });

        }
        else {
            alert("Selecciona una palabra");
        }


    });

    $.post("/ssma/web_service/getWords.php", function (data) {
        },
        "json").done(function (data) {
        //console.log(data.length);

        var palabra;
        for (var i = 0; i < data.length; i++) {
            palabra = data[i];
            $('#wordsBD').append($('<option></option>').attr('value', palabra).text(palabra));
        }


    });


});