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


$type = 'insert';
$id = '';
$words = 'itesm';
$active = '';
$created_date = '';
$created_by = '';

//<editor-fold desc="ISSET">
if (isset($_POST['type']) && $_POST['type'] != '') {
    $type = $_POST['type'];
}
if (isset($_POST['id']) && $_POST['id'] != '') {
    $id = $_POST['id'];
}
if (isset($_POST['word']) && $_POST['word'] != '') {
    $words = $_POST['word'];
}
if (isset($_POST['active']) && $_POST['active'] != '') {
    $active = $_POST['active'];
} else {
    if ($type == "insert") {
        $active = 1;
    }
}
if (isset($_POST['created_date']) && $_POST['created_date'] != '') {
    $created_date = $_POST['created_date'];
} else {
    if ($type == "insert") {
        $time = time();
        $server = date("y-m-d", $time);//fecha del servidor
        $created_date = date('Y-m-d', strtotime($server));
    }
}
//</editor-fold>

if ($type == "insert") {
    $word = $db->insertWords($id, $words, $active, $created_date, $created_by);

}
else if ($type == "get") {
    $word = $db->getWords();
}
else if ($type == "update") {
    $word = $db->updateWords($id, $word, $active, $created_date, $created_by);
}
else {
    $word = false;
}

if ($word != false) {
    if ($type == "insert") {
        $response["success"] = 1;
        $response["error"] = 0;
        $response["msg"] = "La palabra " . $words . " fue agregada exitosamente";
        $response["id"] = $word["id"];
    }
    elseif ($type == "get") {
        $response["success"] = 1;
        $response["error"] = 0;
        $response["msg"] = "Lista de palabras cargada correctamente";
        $a = 0;
        foreach ($word as $palabra) {
            $response["palabras"][$a]["word"] = $palabra["word"];
            $response["palabras"][$a]["id"] = $palabra["id"];
            $a++;
        }
    }
    elseif ($type == "update") {
        $response["success"] = 1;
        $response["error"] = 0;
        $response["msg"] = "Palabra actualizada";
    }

    echo json_encode($response);
} else {
    $response["success"] = 0;
    $response["error"] = 1;
    $response["msg"] = "No se a podido insertar la pabrabra correctamente";
    echo json_encode($response);
}