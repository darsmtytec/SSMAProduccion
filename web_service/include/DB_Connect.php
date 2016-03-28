<?php

/*
* DB_Conect.php fue llamado por DB_Function
* Realiza la conexion con la base de datos
*/

class DB_Connect
{

    // constructor
    function __construct()
    {
    }

    // destructor
    function __destruct()
    {
    }

    // Conexion
    public function connect()
    {
        //Archivo config.php con la definiciones de la base de datos
        //require_once 'include/config.php';

        // conexion con mysql
        $con = mysql_connect('localhost', 'root', 'RedesSociales');
        // echo mysql_client_encoding($con);



        // seleccion de la base de datos
        mysql_select_db("ssma");

        // regresa la base de datos
        return $con;
    }

    // cierre de conexion
    public function close()
    {
        mysql_close();
    }

}

