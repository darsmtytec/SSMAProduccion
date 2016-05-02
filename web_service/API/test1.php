<?php
/**
 * Created by PhpStorm.
 * User: L03037373
 * Date: 29/08/2015
 * Time: 03:17 PM
 */

date_default_timezone_set("America/Monterrey");
//require_once $_SERVER['DOCUMENT_ROOT'].'/ssma/web_service/include/DB_Function.php';
require_once '/opt/lampp/htdocs/ssma/web_service/include/DB_Function.php';
$dbf = new DB_Function();
$user = '';
$index = '';

$dbf ->klout2($user,$index);
/*
$m = new MongoClient();
$db = $m->selectDB("ssma");
$colName = date("dmy");
$colName = 'col'. $colName;
echo $colName;
$collection = $db->selectCollection($colName);

*/
//$klout = $dbf->klout();