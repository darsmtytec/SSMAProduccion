<?php
/**
 * Created by PhpStorm.
 * User: L03037373
 * Date: 06/04/2016
 * Time: 02:09 PM
 */
ini_set('memory_limit', '512M');

require_once $_SERVER['DOCUMENT_ROOT'].'/ssma/web_service/include/DB_Function.php';
$dbf = new DB_Function();

if (isset($_POST['word']) && $_POST['word'] != '') {
    $search = $_POST['word'];
    $chart = $dbf->getData($search,'','','');
}
else{
    $chart = $dbf->getData('tec','','','');

}
//var_dump($chart);


$array = array("success" => 0, "error" => 0, "msg" =>'');

if($chart!='' || $chart!=null) {
    $array["success"]=1;
    $array["aerror"]=0;
    $array["msg"]="informacion recuperada";
//echo json_encode($chart)
//echo count($chart);
    $array["sentiment"][0]["value"] = 0;
    $array["sentiment"][0]["label"] = "P";

    $array["sentiment"][1]["value"] = 0;
    $array["sentiment"][1]["label"] = "P+";

    $array["sentiment"][2]["value"] = 0;
    $array["sentiment"][2]["label"] = "N";

    $array["sentiment"][3]["value"] = 0;
    $array["sentiment"][3]["label"] = "N+";

    $array["sentiment"][4]["value"] = 0;
    $array["sentiment"][4]["label"] = "None";
    $boolean = false;
    $k = 0;
    foreach ($chart as $ch) {

        if ($ch["sentiment"] == "P") {
            $array["sentiment"][0]["value"] = $array["sentiment"][0]["value"] + 1;
                $boolean =true;
        } else if ($ch["sentiment"] == "P+") {
            $array["sentiment"][1]["value"] = $array["sentiment"][1]["value"] + 1;
            $boolean =true;
        } else if ($ch["sentiment"] == "N" || $ch["sentiment"] == "NEU") {
            $array["sentiment"][2]["value"] = $array["sentiment"][2]["value"] + 1;
            $boolean =true;
        } else if ($ch["sentiment"] == "N+") {
            $array["sentiment"][3]["value"] = $array["sentiment"][3]["value"] + 1;
            $boolean =true;
        } else {
            $array["sentiment"][4]["value"] = $array["sentiment"][4]["value"] + 1;
            $boolean =true;
        }
    }

    if(!$boolean){
        $array["success"]=0;
        $array["aerror"]=1;
        $array["msg"]="No existen datos para mostar intentele de nuevo mas tarde";
    }

    echo json_encode($array);
}
else{
    $array["success"]=0;
    $array["aerror"]=1;
    $array["msg"]="No se pudieron obtener los datos";

}

