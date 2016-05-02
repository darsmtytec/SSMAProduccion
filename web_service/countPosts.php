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

$word = '';
$idate = '';
$fdate = '';
$typedate = 'dmy';
if (isset($_POST['word']) && $_POST['word'] != '') {
    $word = $_POST['word'];
}
if (isset($_POST['typeDate']) && $_POST['typeDate'] != '') {
    $typedate = $_POST['typeDate'];
}

$count = $dbf->getCountPost($word,$idate,$fdate,$typedate);

if($count!=0) {
    $response["post"] = $count;
}
else{
    $response = array("success" => 0, "error" => 1);

}
echo json_encode($response);