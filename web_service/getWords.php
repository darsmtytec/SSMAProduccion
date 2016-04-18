<?php
/**
 * Created by PhpStorm.
 * User: L03037373
 * Date: 18/04/2016
 * Time: 11:48 AM
 */
require_once '/opt/lampp/htdocs/ssma/web_service/include/DB_Function.php';
$dbf = new DB_Function();


$word = $dbf->getWords();

$a = 0;
foreach ($word as $palabra) {
    $topico[$a] = $palabra["word"];
    //echo $topico[$a];
    $a++;
}

echo json_encode($topico);