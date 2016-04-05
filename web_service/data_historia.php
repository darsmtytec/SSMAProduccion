<?php
/**
 * Created by PhpStorm.
 * User: L03037373
 * Date: 07/03/2016
 * Time: 12:39 PM
 */

include_once 'include/DB_Function.php';
$db = new DB_Function();

$fechaInicio = date('dmy', strtotime('03/04/2016'."+1 days"));
$fechaFin = date ("dmy");
echo $fechaInicio.'<br>';
echo $fechaFin.'<br><br><br>';
//while($fechaInicio < $fechaFin){
    //echo $fechaInicio.'<br>';
    //array_push($dateCols, $date);
   // $fechaInicio = date("dmy", strtotime($fechaInicio . '+1 day'));
   // echo $fechaInicio.'<br>';
//}
$date = "04/03/2016";
$dateTemp = strtotime($date . "+1 days");
$date =  date('dmy',$dateTemp);
echo $date.'<br>';

$date = date('Y/m/d', strtotime($date));
echo $date.'<br>';


/*for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
    echo date("dmy", $i)."<br>";
}*/
return;

$response = array("success" => 0, "error" => 0, "msg" => '');
$word = $_POST['word']; //'factorTec';
$apis = $_POST['apis'];
if($word == ''){
    $word = 'tecdemty';
}

$cols = $db->getData($word);
if ($cols != false) {
    echo json_encode($cols);
} else {
    echo json_encode($cols);
}