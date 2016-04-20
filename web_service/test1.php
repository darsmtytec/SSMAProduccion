<!DOCTYPE html>
<html>
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqPlot/1.0.8/jquery.jqplot.min.js" type="text/javascript"></script>
    <link src="https://cdnjs.cloudflare.com/ajax/libs/jqPlot/1.0.8/jquery.jqplot.min.css"  rel="stylesheet" type="text/css" >
</head>
<script>
    /* store empty array or array of original data to plot on page load */

    var storedData = [3, 7];

    /* initialize plot*/

    var plot1;
    renderGraph();

    $('button').click( function(){
        doUpdate();
        $(this).hide();
    });

    function renderGraph() {
        if (plot1) {
            plot1.destroy();
        }
        plot1 = $.jqplot('chart1', [storedData]);
    }

    var newData = [9, 1, 4, 6, 8, 2, 5];


    function doUpdate() {
        if (newData.length) {
            var val = newData.shift();
            $.post('/echo/html/', {
                html: val
            }, function(response) {
                var newVal = new Number(response); /* update storedData array*/
                storedData.push(newVal);
                renderGraph();
                log('New Value '+ newVal+' added')
                setTimeout(doUpdate, 3000)
            })

        } else {
            log("All Done")
        }
    }

    function log(msg) {
        $('body').append('<div>'+msg+'</div>')
    }
</script>
<body>




<div id="chart1" style="height: 300px; width: 500px; position: relative;"></div>
<button>Start Updates</button>


</body>
</html>