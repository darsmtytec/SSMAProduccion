/**
 * Created by Davo on 1/20/2016.
 */


$.post("/ssma/web_service/chart.php", function (data) {
    },"json").done(function (data) {

    //console.debug(data);
    //console.debug(data['chart'].length);

    Morris.Bar({
        element: 'myfirstchart',
        data: data["chart"],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Klout',]
    });

}).fail(function (data) {
    console.log("fail");
    console.log(data);

});
$.post("/ssma/web_service/chart2.php", function (data) {
},"json").done(function (data) {

    console.debug(data);
    console.debug(data['sentiment'].length);

    Morris.Donut({
        element: 'donut',
        data: data['sentiment']
    });

}).fail(function (data) {
    console.log("fail");
    console.log(data);

});

$(document).ready(function(){
    $('.page-title').html('<h1>Dashboard</h1>');
    $('#page-breadcrumb').remove();
    $('#menu-dashboard').addClass('active');




});