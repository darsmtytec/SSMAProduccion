<?php
/**
 * Created by PhpStorm.
 * User: L03037373
 * Date: 03/09/2015
 * Time: 05:44 PM
 */


require_once 'Google/Client.php';
require_once 'Google/Service/Blogger.php';
/*
$client = new Google_Client();
$client->setApplicationName("ExtractTweetsDAAC");
$client->setDeveloperKey('AIzaSyDfUPx0k8wv8LLwBOTtyApkFT2LNh8jE_c'); // MY_SIMPLE_API_KEY

$service = new Google_Service_Books($client);
$optParams = array('filter' => 'free-ebooks');
$results = $service->volumes->listVolumes('Henry David Thoreau', $optParams);

foreach ($results as $item) {
    echo $item['volumeInfo']['title'], "<br /> \n";
}
*/
$url = "https://www.googleapis.com/blogger/v3/blogs/3213900/posts/search?q=documentation&key=AIzaSyDfUPx0k8wv8LLwBOTtyApkFT2LNh8jE_c";
$response = file_get_contents($url);
echo $response;


