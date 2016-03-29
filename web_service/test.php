<?php
/**
 * Created by PhpStorm.
 * User: L03037373
 * Date: 16/03/2016
 * Time: 04:45 PM
 */

include_once 'include/DB_Function.php';
$db = new DB_Function();

$text = "Hola a todo el mundo que lea esto el dia de hoy";
$api = 'http://api.meaningcloud.com/sentiment-2.0';
$model = 'auto';
$sentiment = $db ->sentimentAnalysis($api,$model,$text);

echo $sentiment;
