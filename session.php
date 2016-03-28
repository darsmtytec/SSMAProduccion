<?php
/**
 * Created by PhpStorm.
 * User: Luis Ángel
 * Date: 10/03/2016
 * Time: 12:10 PM
 */
// Comparar las versiones para iniciar la sesion
if (version_compare(PHP_VERSION, '5.4.0', '<')) {
    if(session_id() == '') {session_start();}
} else  {
    if (session_status() == PHP_SESSION_NONE) {session_start();}
}

// Revisar que exista una sesion activa
if( isset($_SESSION['user'])) {
    session_unset($_SESSION["user"]);
    session_destroy();
}
$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/';
header('Location: ' . $home_url);
exit();