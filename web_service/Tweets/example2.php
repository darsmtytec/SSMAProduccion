<?php
/**
 * Created by PhpStorm.
 * User: L03037373
 * Date: 22/04/2016
 * Time: 04:09 PM
 */
require "./TwitterAPIExchange.php";

$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=#nerd';
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();

var_dump(json_decode($response));