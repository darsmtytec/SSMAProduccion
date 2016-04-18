<!DOCTYPE html>
<html lang="en">
<?php include 'header.php'; ?>

<link href="dashboard/dashboard.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script>
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

<style>
    #donutSentiment {
        width		: 100%;
        height		: 500px;
        font-size	: 11px;
    }
</style>

<div class="col-md-6 col-sm-6">
    <h4>Indice Klout</h4>
    <div id="klout" style="height: 250px;"></div>
</div>
<div class="col-md-6 col-sm-6" id="sentiment">
    <h4>Sentimiento</h4>
            <div class=" col-sm-9">
                <select required class="form-control" name="" id="wordsBD">
                    <option value="" disabled="">Selecciona una opcion</option>
                </select>
                <div id="sentimentchart" style="height: 250px;"></div>

                <button type="button" class="btn btn-primary" id="searchSentiment">Buscar</button>
            </div>
</div>

<div class="col-md-6 col-sm-6">
    <h4>Indice Klout 2.0</h4>
    <div id="donutSentiment"></div>
</div>



<?php include 'footer.php'; ?>
<!-- BEGIN PERSONAL SCRIPTS -->
<script src="dashboard/dashboard.js"></script>
<!-- END PERSONAL SCRIPTS -->
</html>