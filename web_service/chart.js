/**
 * Created by L03037373 on 30/03/2016.
 */




$.post("/ssma/web_service/chart.php", function (data) {
    },
    "json").done(function (data) {
    var klout;
    console.log(data.length);
    var array = [];
    for (i = 0; i < data.length; i++) {

        array = data[i];


        console.log(array);


    }
    Morris.Line({
        element: 'myfirstchart',
        data: array,
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B']
    });

}).fail(function (data) {
    console.log(data);

});


