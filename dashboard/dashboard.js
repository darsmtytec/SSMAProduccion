/**
 * Created by Davo on 1/20/2016.
 */

//indice Klout
$.post("/ssma/web_service/chart.php", function (data) {
}, "json").done(function (data) 
{


    if (data.success == 1) {
        $('.lod1').hide('200');
        Morris.Bar({
            element: 'klout',
            data: data["chart"],//la "y" es eje x y la "a" es el ejey
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Klout',]
        });
    }


}).fail(function (data) {
    console.log("Error de conexion");
    console.log(data);

});


//indice Klout
$.post("/ssma/web_service/chart.php", function (data) {
}, "json").done(function (data) 
{

    //console.debug(data);
    //console.debug(data['chart'].length);
    if (data.success == 1) {
        $('.lod4').hide();
        $('#kloutBar').show();

        var chart = AmCharts.makeChart("chartdiv", {
            "theme": "light",
            "type": "serial",
            "dataProvider": data["chart"] /*[{
             "country": "USA",
             "year2004": 3.5,
             "year2005": 4.2
             },
             {
             "country": "UK",
             "year2004": 1.7,
             "year2005": 3.1
             },
             {
             "country": "Canada",
             "year2004": 2.8,
             "year2005": 2.9
             },
             {
             "country": "Japan",
             "year2004": 2.6,
             "year2005": 2.3
             }, {
             "country": "France",
             "year2004": 1.4,
             "year2005": 2.1
             },
             {
             "country": "Brazil",
             "year2004": 2.6,
             "year2005": 4.9
             }, {
             "country": "Russia",
             "year2004": 6.4,
             "year2005": 7.2
             },
             {
             "country": "India",
             "year2004": 8,
             "year2005": 7.1
             },
             {
             "country": "China",
             "year2004": 9.9,
             "year2005": 10.1
             }]*/,
            "valueAxes": [{
                "stackType": "3d",
                "unit": "%",
                "position": "left",
                "title": "Sentimiento",
            }],
            "startDuration": 1,
            "graphs": [{
                "balloonText": "Sentimiento [[category]] (: <b>[[value]]</b>",
                "fillAlphas": 0.9,
                "lineAlpha": 0.2,
                "title": "Cantidad",
                "type": "column",
                "valueField": "a"
            }, /*
             {
             "balloonText": "GDP grow in [[category]] (2005): <b>[[value]]</b>",
             "fillAlphas": 0.9,
             "lineAlpha": 0.2,
             "title": "2005",
             "type": "column",
             "valueField": "year2005"
             }*/],
            "plotAreaFillAlphas": 0.1,
            "depth3D": 60,
            "angle": 30,
            "categoryField": "y",//Klout
            "categoryAxis": {
                "gridPosition": "start"
            },
            "export": {
                "enabled": true
            }
        });
        jQuery('.chart-input').off().on('input change', function () {
            var property = jQuery(this).data('property');
            var target = chart;
            chart.startDuration = 0;

            if (property == 'topRadius') {
                target = chart.graphs[0];
                if (this.value == 0) {
                    this.value = undefined;
                }
            }

            target[property] = this.value;
            chart.validateNow();
        });
    }

}).fail(function (data) {
    console.log("Error de conexion");
    console.log(data);

});

//sentimiento
$.post("/ssma/web_service/chart2.php", function (data) {
}, "json").done(function (data) 
{

    //console.debug(data);
    //console.debug(data['sentiment'].length);

    if (data.success == 1) {
        $('.lod2').hide();
        $('#sentimento').show();
        Morris.Donut({
            element: 'sentimentchart',
            data: data['sentiment']
        });
    }


}).fail(function (data) {
    console.log("Error de conexion");
    console.log(data);

});


//Sentimiento
$.post("/ssma/web_service/chart2.php", function (data) {
}, "json").done(function (data) 
{

    // console.log( data['sentiment']);

    if (data.success == 1) {
        $('.lod3').hide();
        $('#donutSentiment').show();

        var chart = AmCharts.makeChart("donutSentiment", {
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
        });
    }


}).fail(function (data) {
    console.log("Error de conexion");
    console.log(data);

});

$.post("/ssma/web_service/countPosts.php", function (data) {
}, "json").done(function (data)
{

     console.log( data.success);

    if (data.success == 1) {
        var chart = AmCharts.makeChart("datepost", {
            "type": "serial",
            "theme": "light",
            "marginRight":30,
            "legend": {
                "equalWidths": false,
                "periodValueText": "total: [[value.sum]]",
                "position": "top",
                "valueAlign": "left",
                "valueWidth": 100
            },
            "dataProvider":data["post"] ,
            "valueAxes": [{
                "stackType": "regular",
                "gridAlpha": 0.07,
                "position": "left",
                "title": "Post por rede social"
            }],
            "graphs": [{
                "balloonText": "<i class='fa fa-instagram fa-6'style='vertical-align:bottom; margin-right: 10px; width:28px; height:21px;'><span style='font-size:14px; color:#000000;'></i><b>[[value]]</b></span>",
                "fillAlphas": 0.6,
                //"hidden": true, //Ponerlo desavilitado desde el principio 
                "lineAlpha": 0.4,
                "title": "Instagram",
                "valueField": "instagram"
            }, {
                "balloonText": "<i class='fa fa-twitter-square fa-6'style='vertical-align:bottom; margin-right: 10px; width:28px; height:21px;'><span style='font-size:14px; color:#000000;'></i><b>[[value]]</b></span>",
                "fillAlphas": 0.6,
                "lineAlpha": 0.4,
                "title": "Twitter",
                "valueField": "twitter"
            }
            ],
            "plotAreaBorderAlpha": 0,
            "marginTop": 10,
            "marginLeft": 0,
            "marginBottom": 0,
            "chartScrollbar": {},
            "chartCursor": {
                "cursorAlpha": 0
            },
            "categoryField": "date",
            "categoryAxis": {
                "startOnAxis": true,
                "axisColor": "#DADADA",
                "gridAlpha": 0.07,
                "title": "Mes",
                "guides": [{
                    category: "2001",
                    toCategory: "2003",
                    lineColor: "#CC0000",
                    lineAlpha: 1,
                    fillAlpha: 0.2,
                    fillColor: "#CC0000",
                    dashLength: 2,
                    inside: true,
                    labelRotation: 90,
                    label: "fines for speeding increased"
                }, {
                    category: "2007",
                    lineColor: "#CC0000",
                    lineAlpha: 1,
                    dashLength: 2,
                    inside: true,
                    labelRotation: 90,
                    label: "motorcycle fee introduced"
                }]
            },
            "export": {
                "enabled": true
            }
        });
    }


}).fail(function (data) {
    console.log("Error de conexion");
    console.log(data);

});

$(document).ready(function () {



    setInterval(function () {
            $('#sentimentchart').load("/web_service/chart2.php").fadeIn("slow");
        },1000
    );

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

                    $('#sentimentchart').empty();

                    Morris.Donut({
                        element: 'sentimentchart',
                        data: data['sentiment']
                    });

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