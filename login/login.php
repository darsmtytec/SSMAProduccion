<?php

$connection = mysql_connect("localhost", "root", "RedesSociales"); // Establishing connection with server..
mysql_select_db("ssma");// Selecting Database.

$email=$_POST['email1']; // Fetching Values from URL.
$password= $_POST['password1'];

$result = mysql_query("SELECT * FROM user WHERE user = '$email' and password = '$password'") or die(mysql_error());
$no_of_rows = mysql_num_rows($result);

if ($no_of_rows > 0) {
    $result = mysql_fetch_array($result);
    // Iniciar la sesion //&m
    session_start();
    $_SESSION["user"] = $email;
    // Obtener el nombre del user
    $_SESSION["nombre"] = $result["nombre"];
    $_SESSION["perfil"] = $result["perfil"];
    // Registrar el primer timestamp
    $_SESSION['LAST_ACTIVITY'] = time();
    echo 'true';
} else {
    echo 'false';
}
mysql_close ($connection); // Connection Closed.
