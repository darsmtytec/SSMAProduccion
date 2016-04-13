<?php
/**
 * Created by PhpStorm.
 * User: L03037373
 * Date: 07/03/2016
 * Time: 12:39 PM
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/ssma/web_service/include/DB_Function.php';
$db = new DB_Function();

$response = array("success" => 0, "error" => 0, "msg" => '');

$word = $_POST['word']; //'factorTec';
$apis = $_POST['apis'];
$idate = $_POST['idate'];
$fdate = $_POST['fdate'];


$cols = $db->getData($word, $apis, $idate, $fdate);


if ($cols != false) {
    echo json_encode($cols);
} else {
    echo json_encode($cols);
}