<?php
/**
 * Created by PhpStorm.
 * User: L03037373
 * Date: 19/04/2016
 * Time: 04:38 PM
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/ssma/web_service/include/DB_Function.php';
$dbf = new DB_Function();
$response = array("success" => 1, "error" => 0);

$idate = '';
$fdate = '';
$count = $dbf->getCountPost($idate,$fdate);
$response["post"]=$count;

echo json_encode($response);