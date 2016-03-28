<?php
/**
 * Created by PhpStorm.
 * User: L03037373
 * Date: 16/03/2016
 * Time: 01:03 PM
 */

include_once 'include/DB_Function.php';
$db = new DB_Function();


$response = array("success" => 0, "error" => 0, "msg" => '');


$login = "";
$user = "admin";
$password = "admin";

if (isset($_POST['username']) && $_POST['username'] != '') {
    $user = $_POST['username'];
}
if (isset($_POST['password']) && $_POST['password'] != '') {
    $password = $_POST['password'];
}


$login = $db->getUser($user, $password);


if ($login != "") {

    if (isset($login["user"])) {
        $response["success"] = 1;
        $response["error"] = 0;
        $response["msg"] = "accepted";
        $response["user"] = $login["user"];
        $response["nombre"] = $login["nombre"];
        $response["perfil"] = $login["perfil"];


        session_start();
        $_SESSION["user"] =  $login["user"];
        // Obtener el nombre del user
        $_SESSION["nombre"] = $login["nombre"];
        $_SESSION["perfil"] = $login["perfil"];
        // Registrar el primer timestamp
        $_SESSION['LAST_ACTIVITY'] = time();


    } else {
        $response["success"] = 0;
        $response["error"] = 1;
        $response["msg"] = $login;

    }
    //var_dump($response);

    echo json_encode($response);
} else {
    $response["success"] = 0;
    $response["error"] = 0;
    $response["msg"] = "Error en la conexion";

    echo json_encode($response);
}
