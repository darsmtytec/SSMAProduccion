<?php
/**
 * Created by PhpStorm.
 * User: Luis Ángel
 * Date: 14/03/2016
 * Time: 09:31 AM
 */
include 'header.php';
// Revisar el rol
if ($_SESSION["perfil"] == "admin") {
    echo '<!DOCTYPE html>
<html lang="en">';

    echo '
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
 <div class="col-md-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="icon-fire font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> Añadir usuario</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div id="new-form" class="form-group form-md-line-input has-info form-md-floating-label" style="text-align: center">
                            <!-- <div class="input-group input-group-lg">

                                    <!--<span class="input-group-btn btn-right">
                                        <button class="btn  blue-madison" id="addWord" type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </span>
                            </div> -->
                            <div class="input-group-control">
                                    <input type="text" class="form-control" id="nuevoUsername" placeholder="Username"/>
                            </div>
                            <div class="input-group-control">
                                    <input type="password" class="form-control" id="nuevoPwd" placeholder="Password"/>
                            </div>
                            <div class="input-group-control">
                                    <input type="email" class="form-control" id="nuevoMail" placeholder="E-mail"/>
                            </div>
                            <div class="input-group-control">
                                    <input type="text" class="form-control" id="nuevoNombre" placeholder="Nombre"/>
                            </div>
                            <div class="form-group form-md-line-input has-info">
                                    <select id="role-select" class="form-control" id="form_control_1">
                                        <option class="input-group-control" value="1">Usuario</option>
                                        <option class="input-group-control" value="0">Administrador</option>
                                    </select>
                            </div>
                            <!-- Boton de buscar-->
                            <div class="form-actions noborder">
                                <a id="add-btn" style="display: inline-block;" class="btn btn-lg btn-primary">
                                    Añadir
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--PortletBody-->
                </div>
                <!--Portlet-->
            </div>
        </div>
';

    include 'footer.php';
    echo '
 <script src="settings.js"></script>
</html>';
} else {
    // Redireccionar al dashboard
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/dashboard.php';
    header('Location: ' . $home_url);
    exit();
}
