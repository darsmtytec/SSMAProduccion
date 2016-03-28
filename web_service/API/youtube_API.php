<?php
/**
 * Created by PhpStorm.
 * User: L03037373
 * Date: 25/01/2016
 * Time: 05:17 PM
 */
require_once 'Google/Client.php';
require_once 'Google/Service/YouTube.php';

$m = new MongoClient();
$db = $m->selectDB("ssma");
$colName = date("dmy");
$colName = 'youtube_'.$colName;
$collection = $db->selectCollection($colName);


$topic = '';
$maxResults = 25;
$htmlBody = '';
$videos = '';
$channels = '';
$playlists = '';
$post = [];

if (isset($_POST['topic']) && $_POST['topic'] != '') {
    $topic = $_POST['topic'];
    foreach ($topic as $eachTopic) {
        array_push($topic, $eachTopic);
    }
}
else{
    include_once '../include/DB_Function.php';
    $db = new DB_Function();
    $word = $db->getWords();
    $a = 0;
    foreach($word as $palabra){
        $topic[$a]=$palabra["word"];
        //echo $topicsTumblr[$a];
        $a++;
    }
}



// This code will execute if the user entered a search query in the form
// and submitted the form. Otherwise, the page displays the form above.
//if ($_GET['topic'] && $_GET['maxResults']) {
// Call set_include_path() as needed to point to your client library.

/*
 * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
 * Google Developers Console <https://console.developers.google.com/>
 * Please ensure that you have enabled the YouTube Data API for your project.
 */
$DEVELOPER_KEY = 'AIzaSyC9KIroJs2GbaA-m1K2-X6xOdRdVVhY9VM';

$client = new Google_Client();
$client->setDeveloperKey($DEVELOPER_KEY);

// Define an object that will be used to make all API requests.
$youtube = new Google_Service_YouTube($client);

//$topic[0] = 'factor tec';
//$topic[1] = 'Tec de monterrey';


for ($i = 0; $i < count($topic); $i++) {
    // Call the search.list method to retrieve results matching the specified
    // query term.
    $searchResponse = $youtube->search->listSearch('id,snippet', array('q' => $topic[$i], 'maxResults' => $maxResults,));
    // Add each result to the appropriate list, and then display the lists of
    // matching videos, channels, and playlists.
    foreach ($searchResponse['items'] as $searchResult) {


        switch ($searchResult['id']['kind']) {
            case 'youtube#video':
                //var_dump($searchResult);
                $arraySearch = [
                    "title" => $searchResult['snippet']['title'],
                    "description" => $searchResult['snippet']['description'],
                    "id" => $searchResult['id']['videoId'],
                    "publishedAt" => $searchResult['snippet']['publishedAt'],
                    "channelTitle" => $searchResult['snippet']['channelTitle'],
                    "type" => "video",
                    "api" => 'youtube'
                ];
                break;
            case 'youtube#channel':
                $arraySearch = [
                    "title" => $searchResult['snippet']['title'],
                    "description" => $searchResult['snippet']['description'],
                    "channelTitle" => $searchResult['snippet']['channelTitle'],
                    "id" => $searchResult['id']['channelId'],
                    "type" => "channel",
                    "api" => 'youtube'
                ];
                break;
            case 'youtube#playlist':
                $arraySearch = [
                    "title" => $searchResult['snippet']['title'],
                    "publishedAt" => $searchResult['snippet']['publishedAt'],
                    "id" => $searchResult['id']['playlistId'],
                    "type" => "playlist",
                    "api" => 'youtube'
                ];
                break;
        }
        array_push($post, $arraySearch);
    }

}
$collection->insert($post);
echo json_encode($post);
$m ->close();
