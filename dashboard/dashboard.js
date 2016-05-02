/**
 * Created by Davo on 1/20/2016.
 */


function charts() {

//indice Klout
    $.post("/ssma/web_service/countKlout.php", function (data) {
    }, "json").done(function (data) 
    {

        //console.debug(data);
        //console.debug(data['chart'].length);
        if (data.success == 1) {
            $('.lod4').hide();
            $('#kloutBar').show();

            var chart = AmCharts.makeChart("countKlout", {
                "theme": "light",
                "type": "serial",
                "dataProvider": data["chart"],
                "valueAxes": [{
                    "stackType": "3d",
                    "unit": "%",
                    "position": "left",
                    "title": "Klout",
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
        $('.lod4').hide();
        console.log("Error de conexion");
        console.log(data);

    });

//Sentimiento
    $.post("/ssma/web_service/sentiment.php", function (data) {
    }, "json").done(function (data) 
    {

        console.log( data['sentiment']);

        if (data.success == 1) {
            $('#h1').hide();
            $('.lod2').hide();
            $('#sentimento').show();
            $('#donutSentiment').show();

            //console.log(data.sentiment);

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
        else if(data.success == 0){
            $('#h1').show();
            $('.lod2').hide();
            $('#sentimento').hide();


        }


    }).fail(function (data)
    {
       
        console.log("Error de conexion");
        console.log(data);

    });
//Total de post
    $.post("/ssma/web_service/countPosts.php", function (data) {
    }, "json").done(function (data)
    {

        //console.log(data.success);

        if (data.success == 1) {
            $('.lod5').hide();
            $('#datepost').show();
            var chart = AmCharts.makeChart("datepost", {
                "type": "serial",
                "theme": "light",
                "marginRight": 30,
                "legend": {
                    "equalWidths": false,
                    "periodValueText": "total: [[value.sum]]",
                    "position": "top",
                    "valueAlign": "left",
                    "valueWidth": 100
                },
                "dataProvider": data["post"],
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
                },{
                    "balloonText": "<i class='fa fa-tumblr fa-6'style='vertical-align:bottom; margin-right: 10px; width:28px; height:21px;'><span style='font-size:14px; color:#000000;'></i><b>[[value]]</b></span>",
                    "fillAlphas": 0.6,
                    "lineAlpha": 0.4,
                    "title": "Tumblr",
                    "valueField": "tumblr"
                },{
                    "balloonText": "<i class='fa fa-reddit fa-6'style='vertical-align:bottom; margin-right: 10px; width:28px; height:21px;'><span style='font-size:14px; color:#000000;'></i><b>[[value]]</b></span>",
                    "fillAlphas": 0.6,
                    "lineAlpha": 0.4,
                    "title": "Reddit",
                    "valueField": "reddit"
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
                    "title": "Dia",
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


    }).fail(function (data)
    {

        console.log("Error de conexion");
        console.log(data);

    });
}
function autoReloadChart() {
    var chartData1 = [];
    var chartData2 = [];
    var chartData3 = [];
    var chartData4 = [];


    function generateChartData() {
        var firstDate = new Date();
        firstDate.setDate(firstDate.getDate() - 500);
        firstDate.setHours(0, 0, 0, 0);
        //console.log(firstDate);

        $.post("/ssma/web_service/countPosts.php", function (data) {
        }, "json").done(function (data) {


            if (data.success == 1) {
                for (var i = 0; i < data.post.length; i++) {
                    //Twitter
                    chartData1.push({
                        date: data["post"][i]["date"],
                        value: data["post"][i]["twitter"],
                        volume: 0// data["post"][""]
                    });
                    //instagram
                    chartData2.push({
                        date: data["post"][i]["date"],
                        value: data["post"][i]["instagram"],
                        volume: 0// data["post"][""]
                    });
                    //reddit
                    chartData3.push({
                        date: data["post"][i]["date"],
                        value: data["post"][i]["reddit"],
                        volume: 0// data["post"][""]
                    });
                    //tumblr
                    chartData4.push({
                        date: data["post"][i]["date"],
                        value: data["post"][i]["tumblr"],
                        volume: 0// data["post"][""]
                    });
                }
                createStockChart();

            }

        }).fail(function (data) {
            console.log("Error de conexion");
            console.log(data);

        });


    }

    AmCharts.ready(function () {
        //console.log("entro1");
        //generateChartData();

    });


    function createStockChart() {
        var chart = new AmCharts.AmStockChart();
        //chart.glueToTheEnd = true;

        // DATASETS //////////////////////////////////////////
        // create data sets first
        var dataSet1 = new AmCharts.DataSet();
        dataSet1.title = "Twitter";
        dataSet1.fieldMappings = [{
            fromField: "value",
            toField: "value"
        },
            {
                fromField: "volume",
                toField: "volume"
            }];
        dataSet1.dataProvider = chartData1;
        dataSet1.categoryField = "date";

        var dataSet2 = new AmCharts.DataSet();
        dataSet2.title = "Instagram";
        dataSet2.fieldMappings = [{
            fromField: "value",
            toField: "value"
        },
            {
                fromField: "volume",
                toField: "volume"
            }];
        dataSet2.dataProvider = chartData2;
        dataSet2.categoryField = "date";

        var dataSet3 = new AmCharts.DataSet();
        dataSet3.title = "Reddit";
        dataSet3.fieldMappings = [{
            fromField: "value",
            toField: "value"
        },
            {
                fromField: "volume",
                toField: "volume"
            }];
        dataSet3.dataProvider = chartData3;
        dataSet3.categoryField = "date";

        var dataSet4 = new AmCharts.DataSet();
        dataSet4.title = "Tumblr";
        dataSet4.fieldMappings = [{
            fromField: "value",
            toField: "value"
        },
            {
                fromField: "volume",
                toField: "volume"
            }];
        dataSet4.dataProvider = chartData4;
        dataSet4.categoryField = "date";

        // set data sets to the chart
        chart.dataSets = [dataSet1, dataSet2, dataSet3, dataSet4];
        chart.mainDataSet = dataSet1; //valor que aparece por defautl

        // PANELS ///////////////////////////////////////////
        // first stock panel
        var stockPanel1 = new AmCharts.StockPanel();
        stockPanel1.showCategoryAxis = false;
        stockPanel1.title = "Posts";
        stockPanel1.percentHeight = 60;

        // graph of first stock panel
        var graph1 = new AmCharts.StockGraph();
        graph1.valueField = "value";
        graph1.comparable = true;
        graph1.compareField = "value";
        stockPanel1.addStockGraph(graph1);

        // create stock legend
        stockPanel1.stockLegend = new AmCharts.StockLegend();
        //console.log(1);

        // second stock panel
        var stockPanel2 = new AmCharts.StockPanel();
        stockPanel2.title = "Volume";
        stockPanel2.percentHeight = 40;
        var graph2 = new AmCharts.StockGraph();
        graph2.valueField = "volume";
        graph2.type = "column";
        graph2.showBalloon = false;
        graph2.fillAlphas = 1;
        stockPanel2.addStockGraph(graph2);
        stockPanel2.stockLegend = new AmCharts.StockLegend();

        // set panels to the chart
        chart.panels = [stockPanel1, stockPanel2];


        // OTHER SETTINGS ////////////////////////////////////
        var sbsettings = new AmCharts.ChartScrollbarSettings();
        sbsettings.graph = graph1;
        //sbsettings.usePeriod = "WW";
        sbsettings.usePeriod = "MM";
        chart.chartScrollbarSettings = sbsettings;


        // PERIOD SELECTOR ///////////////////////////////////
        var periodSelector = new AmCharts.PeriodSelector();
        periodSelector.position = "left";
        periodSelector.periods = [{
            period: "DD",
            count: 10,
            label: "10 days"
        },
        {
                period: "MM",
                selected: true,
                count: 10,
                label: "1 month"
        },
        {
                period: "YYYY",
                count: 1,
                label: "1 year"
        },
        {
                period: "YTD",
                label: "YTD"
        },
        {
                period: "MAX",
                label: "MAX"
        }
        ];
        chart.periodSelector = periodSelector;


        // DATA SET SELECTOR
        var dataSetSelector = new AmCharts.DataSetSelector();
        dataSetSelector.position = "left";
        chart.dataSetSelector = dataSetSelector;

        chart.addListener("rendered", function (event) {
            chart.mouseDown = false;
            chart.containerDiv.onmousedown = function () {
                chart.mouseDown = true;
            }
            chart.containerDiv.onmouseup = function () {
                chart.mouseDown = false;
            }
        });
        //console.log(2);

        chart.write('chartdiv');

        // set up the chart to update every second
        setInterval(function () {

            // if mouse is down, stop all updates
            if (chart.mouseDown)
                return;

            // normally you would load new datapoints here,
            // but we will just generate some random values
            // and remove the value from the beginning so that
            // we get nice sliding graph feeling

            // remove datapoint from the beginning
            var firstDate = new Date();

            chartData1.shift();
            chartData2.shift();
            chartData3.shift();
            chartData4.shift();

            $.post("/ssma/web_service/countPosts.php", function (data) {
            }, "json").done(function (data) {
                //console.log(3);
                //console.log(data["post"]);

                if (data.success == 1) {
                    for (var i = 0; i < data.post.length; i++) {
                        firstDate = (data["post"][i]["date"]);
                        //console.log(firstDate);

                        // add new datapoint at the end

                        //Twitter
                        chart.dataSets[0].dataProvider.push({
                            date: firstDate,
                            value: data["post"]["twitter"],
                            volume: 0// data["post"][""]
                        });
                        //instagram
                        chart.dataSets[1].dataProvider.push({
                            date: firstDate,
                            value: data["post"]["instagram"],
                            volume: 0// data["post"][""]
                        });
                        //reddit
                        chart.dataSets[2].dataProvider.push({
                            date: firstDate,
                            value: data["post"]["reddit"],
                            volume: 0// data["post"][""]
                        });
                        //tumblr
                        chart.dataSets[3].dataProvider.push({
                            date: firstDate,
                            value: data["post"]["tumblr"],
                            volume: 0// data["post"][""]
                        });
                    }
                }


            }).fail(function (data) {
                console.log("Error de conexion");
                console.log(data);

            });

            chart.validateData();

            // adjust zoom
            /*
             var newStartDate = new Date(chart.startDate.getTime());
             newStartDate.setDate(newStartDate.getDate() + 1);
             var newEndDate = new Date(chart.endDate.getTime());
             newEndDate.setDate(newEndDate.getDate() + 1);
             chart.zoom(newStartDate, newEndDate);
             */
        }, 60000);
    }

}


$(document).ready(function () {
    //autoReloadChart();
    charts();



    $('.page-title').html('<h1>Dashboard</h1>');
    $('#menu-dashboard').addClass('active');
    $("#breadMenu").append('<li><a href="dashboard/campus.php" target="_blank">Campus</a></li>').append(' <i class="fa fa-circle"></i> ');
    $("#breadMenu").append('<li><a href="dashboard/competidores.php" target="_blank">Competidores</a></li>');
    $('#page-breadcrumb').remove();

    $("#footerBar").css('background','#eff3f8');
    $("#footerText").css('color','#34495e');
    $("#containerFluid").css('padding-left','1.5%');
    $("#containerFluid").css('padding-right','1.5%');
    $("#breadMenu").css('padding-left','30px');
    $("#scrollImg").css('display','none');

    $("#searchSentiment").click(function () {

        if ($("#wordsBD").val() != '') {
            var palabra = $("#wordsBD").val();
            $.post("/ssma/web_service/sentiment.php", {'word': palabra}, function (data)
            {}, "json").done(function (data)
            {
                console.log(data);
                if (data.success == 1) {
                    $('#h1').hide();

                    $('#donutSentiment').empty();
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
                else if(data.success == 0){
                    $('.lod2').hide();
                    $('#donutSentiment').hide();
                    $('#h1').show();

                }


            }).fail(function (data)
            {
                console.log("Error de conexion");
                console.log(data);

            });

            //Total de post
            $.post("/ssma/web_service/countPosts.php",{'word': palabra},  function (data) {
            }, "json").done(function (data)
            {

                //console.log(data.success);

                if (data.success == 1) {
                    $('.lod5').hide();
                    $('#datepost').show();
                    $('#datepost').empty();
                   
                    var chart = AmCharts.makeChart("datepost", {
                        "type": "serial",
                        "theme": "light",
                        "marginRight": 30,
                        "legend": {
                            "equalWidths": false,
                            "periodValueText": "total: [[value.sum]]",
                            "position": "top",
                            "valueAlign": "left",
                            "valueWidth": 100
                        },
                        "dataProvider": data["post"],
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
                        },{
                            "balloonText": "<i class='fa fa-twitter-square fa-6'style='vertical-align:bottom; margin-right: 10px; width:28px; height:21px;'><span style='font-size:14px; color:#000000;'></i><b>[[value]]</b></span>",
                            "fillAlphas": 0.6,
                            "lineAlpha": 0.4,
                            "title": "Tumblr",
                            "valueField": "tumblr"
                        },{
                            "balloonText": "<i class='fa fa-twitter-square fa-6'style='vertical-align:bottom; margin-right: 10px; width:28px; height:21px;'><span style='font-size:14px; color:#000000;'></i><b>[[value]]</b></span>",
                            "fillAlphas": 0.6,
                            "lineAlpha": 0.4,
                            "title": "Reddit",
                            "valueField": "reddit"
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
                            "title": "Dia",
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
                else if(data.success == 0){
                    $('.lod5').hide();
                    $('#datepost').hide();
                    $('#h2').show();

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