<!DOCTYPE html>
<html lang="en">
<?php include 'header.php'; ?>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<div class="col-md-6 col-sm-6">
    <h4>Indice Klout</h4>
<div id="klout" style="height: 250px;"></div>
</div>
<div class="col-md-6 col-sm-6">
    <h4>Sentimiento<h4>
    <div id="sentiment" style="height: 250px;"></div>
</div>


<?php include 'footer.php'; ?>
<!-- BEGIN PERSONAL SCRIPTS -->
<script src="dashboard/dashboard.js"></script>
<!-- END PERSONAL SCRIPTS -->
</html>