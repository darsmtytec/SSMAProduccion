<?php
/**
 * Created by PhpStorm.
 * User: L03037373
 * Date: 17/03/2016
 * Time: 05:15 PM
 */

include "./include/DB_Function.php";
$dbf = new DB_Function();


$api = "reddit";

$array1= $dbf->getData1($api);
echo json_encode($array1);
//$array = $dbf ->updateSentiment($api);

