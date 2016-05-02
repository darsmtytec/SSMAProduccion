<?php
/**
 * Created by PhpStorm.
 * User: L03037373
 * Date: 22/04/2016
 * Time: 02:51 PM
 */
// File: stream.php
define('TWITTER_USERNAME', 'foobar');
define('TWITTER_PASSWORD', 'baz');

$context = stream_context_create(array(
    'http' => array(
        'method'  => 'POST',
        'content' => 'track=#ipad,#iphone,#ipod', // The hashtags you want to follow, comma separated list
        'header' => array(
            'Content-type: application/x-www-form-urlencoded'
        )
    )
));
$stream  = fopen('https://'.TWITTER_USERNAME.':'.TWITTER_PASSWORD.'@stream.twitter.com/1/statuses/filter.json', 'r', false, $context);

while (!feof($stream)) {
    if (!($line = fgets($stream))) {
        continue;
    }
    $tweet = json_decode($line);

    $username = isset($tweet->user) && isset($tweet->user->screen_name) ? $tweet->user->screen_name : "?";
    echo '@' . $username . " - " . $tweet->text . PHP_EOL;
}