<?php
/**
 * Created by PhpStorm.
 * User: L03037373
 * Date: 03/09/2015
 * Time: 05:27 PM
 */

/*
https:www.googleapis.com/plus/v1/people/userId;

//248216383615-68qoeelrngd9qi7jelo21u5a6ksusvob.apps.googleusercontent.com
//ZeUrOcVbgBEnG0adWwS4snfu



require_once 'Google/Client.php';
require_once 'Google/Service/Books.php';

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


  /* * Copyright 2011 Google Inc.
  *
  * Licensed under the Apache License, Version 2.0 (the "License");
  * you may not use this file except in compliance with the License.
  * You may obtain a copy of the License at
  *
  * http://www.apache.org/licenses/LICENSE-2.0
  *
  * Unless required by applicable law or agreed to in writing, software
  * distributed under the License is distributed on an "AS IS" BASIS,
  * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  * See the License for the specific language governing permissions and
  * limitations under the License.
  */
  require_once 'Google/apiClient.php';
  require_once 'Google/apiPlusService.php';
session_start();
//$id = $_POST['id'];
$id="117958415902860169334";
$client = new apiClient();
  $client->setApplicationName("Google+ PHP Starter Application");
  // oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
  $client->setClientId('248216383615-68qoeelrngd9qi7jelo21u5a6ksusvob.apps.googleusercontent.com');
  $client->setClientSecret('ZeUrOcVbgBEnG0adWwS4snfu');
  //$client->setRedirectUri('http://www.w3resource.com/API/google-plus/example.php');
  $client->setDeveloperKey('AIzaSyDfUPx0k8wv8LLwBOTtyApkFT2LNh8jE_c');
  $plus = new apiPlusService($client);
if (isset($_REQUEST['logout'])) {
    unset($_SESSION['access_token']);
}
if (isset($_GET['code'])) {
    $client->authenticate();
    $_SESSION['access_token'] = $client->getAccessToken();
    header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}
if (isset($_SESSION['access_token'])) {
    $client->setAccessToken($_SESSION['access_token']);
}
if ($client->getAccessToken()) {
    $me = $plus->people->get($id);
    $optParams = array('maxResults' => 100);
    $activities = $plus->activities->listActivities($id, 'public', $optParams);
// The access token may have been updated lazily.
    $_SESSION['access_token'] = $client->getAccessToken();
} else {
    $authUrl = $client->createAuthUrl();
}
  ?>
<!doctype html>
<html>
<head><link rel='stylesheet' href='style.css' /></head>
<body>
<header><h1>Google+ Sample App</h1></header>
<div class="box">
    <?php if(isset($me) && isset($activities)): ?>
        <div class="me">
            <p><a rel="me" href="<?php echo $me['url'] ?>"><?php print $me['displayName'] ?></a></p>
            <p><?php print $me['tagline'] ?></p>
            <p><?php print $me['aboutMe'] ?></p>
            <div><img src="<?php echo $me['image']['url']; ?>?sz=82" /></div>
        </div>
        <div class="activities">Your Activities:
            <?php foreach($activities['items'] as $activity): ?>
                <div class="activity">
                    <p><a href="<?php print $activity['url'] ?>"><?php print $activity['title'] ?></a></p>
                </div>
            <?php endforeach ?>
        </div>
    <?php endif ?>
    <?php
    if(isset($authUrl)) {
        print "<a class='login' href='$authUrl'>Connect Me!</a>";
    } else {
        //print "<a class='logout' href='?logout'>Logout</a>";
    }
    ?>
</div>
</body>
</html>