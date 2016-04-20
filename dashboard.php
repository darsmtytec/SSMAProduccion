<!DOCTYPE html>
<html lang="en">
<?php include 'header.php'; ?>

<link rel="stylesheet" type="text/css" href="dashboard/dashboard.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/amstock.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<style>

</style>

<div class="container-fluid" style="display: block" id="charts">
    <div class="row">
        <div id="chartdiv" style="width: 100%; height: 355px; display: none;"></div>
    </div>


    <div class="row">
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
                            <input class="chart-input" data-property="angle" type="range" min="0" max="89" value="30"
                                   step="1"/>
                        </div>

                        <div class="col-sm-3" style="float: none !important;display: inline-block;">
                            <label class="text-left">Depth:</label>
                            <input class="chart-input" data-property="depth3D" type="range" min="1" max="120" value="60"
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
                <div class=" col-sm-6">
                    <select required class="form-control" name="" id="wordsBD">
                        <option value="" disabled="">Selecciona una opcion</option>
                    </select>
                    <br>
                    <h4 style="display:none;" id="h1">No existen resultados</h4>

                </div>
                <div id="donutSentiment" style="display: "></div>

                <button type="button" class="btn btn-primary" id="searchSentiment">Buscar</button>

            </div>
        </div>
    </div>
    <div class="row">
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
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
            <div id="postDate">
                <h4>Post por fecha</h4>
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
                <div id="post1">
                    <div id="datepost" style="display: none"></div>
                </div>
            </div>

        </div>
    </div>


    <div class="row">

    </div>

</div>
<?php include 'footer.php'; ?>
<!-- BEGIN PERSONAL SCRIPTS -->
<script src="dashboard/dashboard.js"></script>
<!-- END PERSONAL SCRIPTS -->
</html>