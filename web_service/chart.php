<?php
/**
 * Created by PhpStorm.
 * User: L03037373
 * Date: 30/03/2016
 * Time: 09:58 AM
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/ssma/web_service/include/DB_Function.php';
$dbf = new DB_Function();
$chart = $dbf->getData('tec', 'twitter', '', '');


$response = array("success" => 1, "error" => 0);


//echo json_encode($chart);
//echo count($chart);
$c=0;
$array = array();
for ($i = 0; $i < count($chart); $i++) {

    if ($chart[$i]["Klout"] != "") {
        $j = $chart[$i]["Klout"];

        $key = $dbf->multidimensional_search($array, array('Klout' => $j));

        if (is_int($key)) {
            //echo "la llave de ".$j ." es -> ".$key."<br>";
            $array[$key]["Klout"] = $chart[$key]["Klout"];
            $array[$key]["count"]++;
        }
        else {
            //echo "Se creo para el :".$j."<br>";
            $array[$i]["Klout"] = $chart[$i]["Klout"];
            $array[$i]["count"] = 0;
        }
    }
}

$k = 0;
foreach ($array as $arr) {
    //echo $arr["Klout"]."<br>";
    $response["chart"][$k]["y"] = $arr["Klout"];//eje x de la tabla
    $response["chart"][$k]["a"] = $arr["count"];//eje y de la tabla
    $k++;
}
sort($response["chart"]);


echo json_encode($response);

/*
$k= array_search("10", array_column($array, 'Klout'));
$k= multidimensional_search($array, array('Klout'=>10));

//var_dump( $array[$k] );

*/

//var_dump(json_encode($array));

//echo json_encode($response);

