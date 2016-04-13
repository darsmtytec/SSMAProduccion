<?php
/**
 * Created by PhpStorm.
 * User: Edgardo Acosta
 * Date: 4/11/2016
 * Time: 11:08 PM
 */
require_once '/opt/lampp/htdocs/ssma/web_service/include/DB_Function.php';
$dbf = new DB_Function();

$inidate = new DateTime('2016-03-04');
$inidateStr = $inidate->format('dmy');

$colName = 'col' . $inidateStr;

$data = $dbf->getAll($colName);
$c = 0;
foreach ($data as $newData) {

    if ($newData["id_post"] != '' && $newData["sentiment"] != 'P+' && $newData["sentiment"] != 'P' && $newData["sentiment"] != 'N+'
        && $newData["sentiment"] != 'N' && $newData["sentiment"] != 'NEU')
    {

        $sentiment = $dbf->sentimentAnalysis($newData["text_clean"]);

        $renew = $dbf->renewSentiment($newData["id_post"],$sentiment,$newData["collection"]);


        /*
           if($c>3){
            break;
        }
                echo "ID-> ".$newData["id_post"]."<br>";
                echo "Text-> ".$newData["text_clean"]."<br>";
                echo "Sentiment-> ".$newData["sentiment"]."<br>";
                echo "api-> ".$newData["api"]."<br>";
                echo "collection-> ".$newData["collection"]."<br>"."<br>";


        */
        $c++;
    }


}


//echo json_encode($data);
