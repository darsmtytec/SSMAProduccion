<?php
include 'header.php';
// Revisar el rol
if ($_SESSION["perfil"] == "admin") {
    echo '<!DOCTYPE html>
<html lang="en">';

    echo '
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<style>
    .search-label {
        text-transform: none !important;
        padding: 4px 6px 4px 6px;
        font-size: 14px;
        font-weight: 300;
        color: #ffffff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25em;
        margin-top:.25em;
        margin-bottom:.25em;
        margin-right:.25em;
    }
    .search-label a{
        color: #ffffff;
    }
    .search-label.keyterm{
        background-color: #1caf9a;
    }
    .list-inline li{
        padding: 0px !important;
    }
</style>
<!--==============================
    Search Section
    ==================================-->
<div class="section">
    <div class="row">
        <!--==============================
            Config
            ==================================-->
        <div class="col-md-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="icon-settings font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> Términos de Búsqueda</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div class="form-group form-md-line-input has-info form-md-floating-label">
                            <div class="input-group input-group-lg">
                                <div class="input-group-control">
                                    <input type="text" class="form-control" id="wordToAdd" placeholder="Agrega los términos de búsqueda"/>
                                    <!--<label for="form_control_1">Agrega los términos de búsqueda</label>-->
                                </div>
                                    <span class="input-group-btn btn-right">
                                        <button class="btn  blue-madison" id="addWord" type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </span>
                            </div>
                        </div>
                    </div>
                    <!--PortletBody-->
                </div>
                <!--Portlet-->
            </div>
        </div>
        <!--==============================
            Terms
            ==================================-->
        <div class="col-md-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="icon-fire font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> Términos que se Buscarán</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form role="form">
                        <div class="form-body">
                            <ul class="list-inline" id="termsList">
                                <li id="plantillaTermino" style="display:none">
                                    <div name="searchterm N" class="search-label keyterm">Termino<a class="fa fa-times"></a></div>
                                </li>
                            </ul>
                        </div>
                        <div class="form-actions noborder">
                            <!--Add Buttons-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End Config Row-->
</div>
<!--End Search Section-->
<!--==============================
    Contents Section
    ==================================-->
<script src="consola/consola.js"></script>';
    include 'footer.php';
echo '</html>';
} else {
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/dashboard.php';
    header('Location: ' . $home_url);
    exit();
}