/**
 * Created by Davo on 1/20/2016.
 */


$.post("/ssma/web_service/chart.php", function (data) {
    },"json").done(function (data) {

    //console.debug(data);
    console.debug(data['chart'].length);

    Morris.Bar({
        element: 'myfirstchart',
        data: data["chart"],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Klout',]
    });



    //console.log(data.chart[0]);
    //data = JSON.parse(data);
    /*
    var arr = $.map(data, function(el) { return el });
    var array = [];

    console.debug(arr["0"]["a"]);
    console.debug(arr["0"]["y"]);


   console.log(array);





    Morris.Line({
        element: 'myfirstchart',
        data: array,
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B']
    });
     */

}).fail(function (data) {
    console.log("fail");
    console.log(data);

});

$(document).ready(function(){
    $('.page-title').html('<h1>Dashboard</h1>');
    $('#page-breadcrumb').remove();
    $('#menu-dashboard').addClass('active');




});