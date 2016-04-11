<?php
/**
 * Created by PhpStorm.
 * User: L03037373
 * Date: 30/03/2016
 * Time: 09:58 AM
 */

require_once $_SERVER['DOCUMENT_ROOT'].'/ssma/web_service/include/DB_Function.php';
$dbf = new DB_Function();
$chart = $dbf->getData('tec','twitter','','');


$response = array("success" => 1, "error" => 0);


//echo json_encode($chart)
//echo count($chart);
$array = array();
for($i =0; $i<count($chart); $i++){

    if( $chart[$i]["Klout"]!="") {


        $array[ $chart[$i]["Klout"]]  ["ID"] =  $array[ $chart[$i]["Klout"] ]["ID"] +1; //cantidad de personas con ese Klout
        $array[ $chart[$i]["Klout"]]  ["Klout"] =  $chart[$i]["Klout"];
        //echo $chart[$i]["Klout"] . "<br>";
    }

}

$k = 0;
foreach($array as $arr){
    //echo $arr["Klout"]."<br>";
    $response["chart"][$k]["y"] = $arr["Klout"];
    $response["chart"][$k]["a"] = $arr["ID"];
    $k++;
}

//var_dump(json_encode($array));

  echo json_encode($response);

