<!DOCTYPE html>
<html lang="en">
<?php include 'header.php'; ?>

<link rel="stylesheet" type="text/css" href="dashboard/dashboard.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<!--
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
-->



<style>
    html,body        {height:100%;}
    .wrapper         {height:100%;margin:0 auto;background:#CCC}
    .h_iframe        {position:relative;}
    .h_iframe .ratio {display:block;width:100%;height:auto;}
    .h_iframe iframe {position:absolute;top:0;left:0;width:100%; height:100%;}

</style>
<div class="row" style="display: block" id="charts">
    <div class="wrapper col-sm-7">
        <div class="h_iframe">
            <!-- a transparent image is preferable -->
            <img class="ratio" src="http://placehold.it/16x9"/>
            <iframe src="dashboard/graph_2.php" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
    <div class="col-sm-1">
        &nbsp;
    </div>
    <div class="wrapper col-sm-4">
        <div class="h_iframe">
            <!-- a transparent image is preferable -->
            <img class="ratio" src="http://placehold.it/16x9"/>
            <iframe src="dashboard/embed.php" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
   <!-- <div class="row">
        <div class=" col-sm-4">
            <select required class="form-control" name="" id="wordsBD">
                <option value="" disabled="">Selecciona una opcion</option>
            </select>

            <button type="button" class="btn btn-primary" id="searchSentiment">Buscar</button>
            <br>
            <br>
        </div>
    </div>-->



        <!--<div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                <h4>Indice Klout </h4>
                <div id="loader" style="display: " class="lod4">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="lading"></div>
                </div>
                <div id="kloutBar" style="display: none">
                    <div id="chartdiv1"></div>
                    <div class="container-fluid">
                        <div class="row text-center" style="overflow:hidden;">
                            <div class="col-sm-3" style="float: none !important;display: inline-block;">
                                <label class="text-left">Angle:</label>
                                <input class="chart-input" data-property="angle" type="range" min="0" max="89"
                                       value="30"
                                       step="1"/>
                            </div>

                            <div class="col-sm-3" style="float: none !important;display: inline-block;">
                                <label class="text-left">Depth:</label>
                                <input class="chart-input" data-property="depth3D" type="range" min="1" max="120"
                                       value="60"
                                       step="1"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6" style="text-align: center" id="sentiment">

                <h4>Sentimiento</h4>
                <div id="loader" style="display: block" class="lod2">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="lading"></div>
                </div>
                <div style="display: none" id="sentimento">
                    <h4 style="display:none;" id="h1">No existen resultados</h4>

                </div>
                <div id="donutSentiment" style="display: "></div>


            </div>
        </div>-->

    <!--<div class="row">-->
        <!-- <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
             <h4>Sentimiento 2.0</h4>
             <div id="loader" style="display: block" class="lod3">
                 <div class="dot"></div>
                 <div class="dot"></div>
                 <div class="dot"></div>
                 <div class="dot"></div>
                 <div class="dot"></div>
                 <div class="dot"></div>
                 <div class="dot"></div>
                 <div class="dot"></div>
                 <div class="lading"></div>
             </div>
             <div id="donutSentiment1" style="display: none"></div>
         </div>-->
        <!--Barras Klout-->


        <!--POST de redes Sociales-->
        <!--<div class="col-md-12 col-sm-12 col-lg-12 col-xl-12" style="text-align: center">
            <div id="postDate">
                <h4>Post por fecha</h4>
                <br>
                <div id="loader" style="display: block" class="lod5">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="lading"></div>
                </div>
                <h4 style="display:none;" id="h2">No existen resultados</h4>
                <div id="post1">
                    <div id="datepost" style="display: none"></div>
                </div>
            </div>

        </div>-->
    <!--</div>-->
</div>
<div class="row" style="padding-top: 30px">
    <div class="wrapper col-sm-12">
        <br><br><br>
        &nbsp;
        <br><br><br>
    </div>
</div>
<?php include 'footer.php'; ?>
<!-- BEGIN PERSONAL SCRIPTS -->
<script src="dashboard/dashboard.js"></script>
<!-- END PERSONAL SCRIPTS -->
</html>
<script>
    $("#containerFluid").css('padding-left','1.5%');
    $("#containerFluid").css('padding-right','1.5%');
    $("#breadMenu").css('padding-left','30px');
</script>