$(document).ready(function() {

    var max_value = 60

    chartOptions = {
        segmentShowStroke: false,
        percentageInnerCutout: 75,
        animation: false
    };

    chartData = [{
        value: 0,
        color: '#4FD134'
    },{
        value: max_value,
        color: '#DDDDDD'
    }];

    var ctx = $('#chart').get(0).getContext("2d");
    var theChart = new Chart(ctx).Doughnut(chartData,chartOptions);

    theInterval = setInterval(function(){
        if (theChart.segments[0].value == max_value) {
            clearInterval(theInterval);
        } else {
            theChart.segments[0].value = theChart.segments[0].value+1
            theChart.segments[1].value = theChart.segments[1].value-1
            theChart.update()
        }
    }, 10);


setInterval(function () {


},1000);
});
