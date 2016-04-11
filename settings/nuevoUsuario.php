<?php
/**
 * Created by PhpStorm.
 * User: Luis Ángel
 * Date: 15/03/2016
 * Time: 05:35 PM
 */

// Conexion a la base de datos
$connection = mysql_connect("localhost", "root", "RedesSociales"); // Establishing connection with server..
mysql_select_db("ssma");// Selecting Database.

// Obtener las variables
$username=$_POST['username']; // Fetching Values from URL.
$password= md5($_POST['password']);
$email=$_POST['email'];
$nombre=$_POST['nombre'];
$perfil=$_POST['perfil'];
$date = date('Y-m-d');
$date = date('Y-m-d', strtotime($date));
//Query para insertar el usuario
$sql = "INSERT INTO user (user, password, email, nombre, perfil,fecha_creado, fecha_modificado) VALUES ('". $username ."', '". $password ."', '". $email ."', '". $nombre ."', '". $perfil ."', \"". $date ."\",\"". $date ."\")";

if(! $connection )
{
    die('Could not connect: ' . mysql_error());

}
$result = mysql_query($sql) or die(mysql_error());
$result = mysql_fetch_array($result);
if ($result == ''){
    echo 'true';
} else {
    echo 'false';
}

mysql_close ($connection); // Connection Closed.