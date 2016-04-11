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
<!-- Añadir usuarios-->
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
                            <div class="input-group-control">
                                    <input type="text" class="form-control" id="nuevoUsername" placeholder="Usuario"/>
                            </div>
                            <div class="input-group-control">
                                    <input type="text" class="form-control" id="nuevoNombre" placeholder="Nombre"/>
                            </div>
                            <div class="input-group-control">
                                    <input type="password" class="form-control" id="nuevoPwd" placeholder="Contraseña"/>
                            </div>
                            <div class="input-group-control">
                                    <input type="email" class="form-control" id="nuevoMail" placeholder="E-mail"/>
                            <!--<div class="form-group form-md-line-input has-info"> -->
                                    <select id="role-select" class="form-control" id="form_control_1">
                                        <option class="input-group-control" value="1">Usuario</option>
                                        <option class="input-group-control" value="0">Administrador</option>
                                    </select>
                            <!-- </div> -->
                            <!-- Boton de buscar-->
                            <div class="form-actions noborder">
                                <a id="add-btn" style="display: inline-block;" class="btn btn-lg btn-primary">
                                    Añadir
                                </a>
                                <!-- Boton para limpiar los campos
                                <a id="clear-btn" style="display: inline-block;" class="btn btn-lg btn-primary">
                                    Limpiar
                                </a>
                                -->
                            </div>
                        </div>
                    </div>
                    <!--PortletBody-->
                </div>
                <!--Portlet-->
            </div>
        </div>
        </div>
<!-- Termina parte de añadir usuarios -->
<!-- Borrar usuarios -->
        <div class="col-md-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="icon-fire font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> Borrar usuario</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div id="new-form" class="form-group form-md-line-input has-info form-md-floating-label" style="text-align: center">
                            <div class="input-group-control">
                                    <input type="text" class="form-control" id="borrarUser" placeholder="Usuario"/>
                            </div>
                            <div class="input-group-control">
                                    <input type="text" class="form-control" id="borrarUserConf" placeholder="Confirmación de usuario"/>
                            </div>
                            <!-- Boton de borrar-->
                            <div class="form-actions noborder">
                                <a id="del-btn" style="display: inline-block;" class="btn btn-lg btn-primary">
                                    Borrar
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--PortletBody-->
                </div>
                <!--Portlet-->
            </div>
        </div>
<!-- Termina parte de borrar usuarios -->
<!-- Inicia la parte de modificar usuarios -->
        <div class="col-md-6">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="icon-fire font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> Modificar usuario</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <div id="new-form" class="form-group form-md-line-input has-info form-md-floating-label" style="text-align: center">
                            <div class="input-group-control">
                                    <input type="text" class="form-control" id="modificaUsuario" placeholder="Usuario"/>
                            </div>
                            <!-- Boton para buscar el usuario en la base de datos -->
                            <div class="form-actions noborder">
                                <a id="search-btn" style="display: inline-block;" class="btn btn-lg btn-primary">
                                    Seleccionar
                                </a>
                            </div>
                            <!-- Termina el div del campo de usuario y el botón para buscar -->
                            <div class="input-group-control">
                                    <input type="text" class="form-control" id="modificaUser" placeholder="Usuario"/>
                            </div>
                            <div class="input-group-control">
                                    <input type="text" class="form-control" id="modificaNombre" placeholder="Nombre"/>
                            </div>
                            <div class="input-group-control">
                                    <input type="password" class="form-control" id="modificaPwd" placeholder="Contraseña"/>
                            </div>
                            <div class="input-group-control">
                                    <input type="text" class="form-control" id="modificaMail" placeholder="E-mail"/>
                            </div>
                            <!-- Elegir si es usuario o admin -->
                                    <select id="selecciona-rol" class="form-control" >
                                        <option class="input-group-control" value="1">Usuario</option>
                                        <option class="input-group-control" value="0">Administrador</option>
                                    </select>
                            <!-- Boton de modificar-->
                            <div class="form-actions noborder">
                                <a id="modificar-btn" style="display: inline-block;" class="btn btn-lg btn-primary">
                                    Modificar
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--PortletBody-->
                </div>
                <!--Portlet-->
            </div>
        </div>
<!-- Termina la parte de modificar usuarios-->
';

    include 'footer.php';
    echo '
 <script src="settings.js"></script>
 <script language="Javascript">
function IsEmpty(){
if(document.form.question.value == "")
{
alert("Campo vacio");
}
    return;
}
</script>
</html>';
} else {
    // Redireccionar al dashboard
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/dashboard.php';
    header('Location: ' . $home_url);
    exit();
}
