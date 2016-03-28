<?php
/**
 * Created by PhpStorm.
 * User: L03037373
 * Date: 07/03/2016
 * Time: 12:39 PM
 */

include_once 'include/DB_Function.php';
$db = new DB_Function();


$response = array("success" => 0, "error" => 0, "msg" => '');
$id = $_POST['id'];
$sentiment = $_POST['sentiment'];

$cols = $db->changeSent($id, $sentiment);
if ($cols != false) {
    echo json_encode($cols);
} else {
    echo json_encode($cols);
}