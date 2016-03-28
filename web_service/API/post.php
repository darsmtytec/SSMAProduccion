<?php

/**
 * Created by PhpStorm.
 * User: L03037373
 * Date: 28/08/2015
 * Time: 12:36 PM
 */

header("Access-Control-Allow-Origin: *");

//<editor-fold desc="Remove accents">
/**
 * Replace accented characters with non accented
 *
 * @param $str
 * @return mixed
 * @link http://myshadowself.com/coding/php-function-to-convert-accented-characters-to-their-non-accented-equivalant/
 */
function removeAccents($str)
{
    $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'Ð', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', '?', '?', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', '?', '?', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', '?', 'O', 'o', 'O', 'o', 'O', 'o', 'Œ', 'œ', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'Š', 'š', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Ÿ', 'Z', 'z', 'Z', 'z', 'Ž', 'ž', '?', 'ƒ', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?');
    $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', '?', 'a', '?', 'e', '?', '?', 'O', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?');
    return str_replace($a, $b, $str);
}

//</editor-fold>

$b = 0;
require_once("twitteroauth.php");
$word[] = '';
$topico[] = '';
$user[] = '';
if (isset($_POST["user"][0]) && $_POST["user"][0] != '') {
    $user = $_POST["user"];
}
if (isset($_POST["topic"][0]) && $_POST["topic"][0] != '') {
    $topico = $_POST["topic"];
}
if (isset($_POST["search"][0]) && $_POST["search"][0] != '') {
    $word = $_POST["search"];
}
$topico[0] = 'semanai';
//$user[0]='valeacostaleal';

// ************* Klout API ***************************
$kloutKey = 'hjsske2mer3th85ub6e5bw82';
// ************** TWITTER API ***********************
$post[] = '';

$notweets = 5;
$consumerkey = "0O4NDYS28rd96Uh6uGENXvp5y";
$consumersecret = "5Bv5v0TwNctAX1XFp6IgiCNQWPIcBbbw2XjByIHKwTaTBglrp8";
$accesstoken = "2756750930-6YPZhJNzv8ndgJHM6SFY2zFJluiZRqSJjf4PpLr";
$accesstokensecret = "P29vdR1GVdDroA0UY5BGYmVGEDumuqdzfEBFevHAIAFWy";

function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret)
{
    $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
    return $connection;
}

$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);


// *********** TWITTER API - Tweets de un usuario **************************

$accounts = [];
if ($user[0] != '') {
    // Obtener lista de terminos
    // $users = $_POST["user"];
    foreach ($user as $eachUser) {
        array_push($accounts, $eachUser);
    }
}

// *********** TWITTER API - Palabra / Hashtag en tweets. ******************
$topics = [];

// Obtener lista de terminos
if ($topico[0] != '') {

    //$topic = $_POST["topic"];
    foreach ($topico as $eachTopic) {
        array_push($topics, $eachTopic);
    }
}


if ($word[0] != '') {
    //$word = $_POST["search"];
    foreach ($word as $eachWord) {
        array_push($topics, $eachWord);
    }
}
//}
///////////////////////////////////////////////////////////////////////////////////////////////////

//<editor-fold desc="Sentiment API">
// ************** Sentiment API ***********************

$key[0] = 'e9ce37fc21e2fbfba29bde1d2fbd3b61'; //socialmediadaac@gmail.com
$key[1] = '21089e2646a625584cee07cc52421d24'; //socialmediadaac0@gmail.com
$key[2] = '2662039e381619d652afa4bd08b11cf0'; //socialmediadaac1@gmail.com
$key[3] = '247d733eb8fc2c8e8fe8e2f5492f1598'; //socialmediadaac2@gmail.com
$key[4] = '6e09fa82b045b09fee2e0410baeee945'; //socialmediadaac3@gmail.com
$key[5] = '91aa5264fa77df2e3c928cce324d6658'; //socialmediadaac4@gmail.com
$key[6] = 'cf803ded8f0c20d1d3247694afb1a3b2'; //socialmediadaac5@gmail.com
$key[7] = ''; // Sacar del while
$txt = '';
$model = 'auto';//general_es general_en general_fr auto  // es-general/en-general/fr-general/en-reputation/es-reputation DEPRECATED
$keyIndex = 0;
//</editor-fold>


//$showSentiment = false;
//$showSentiment=$_POST["sentiment"];
$showSentiment = 'true';
if ($showSentiment == 'true') {
    $showSentiment = true;
}

// Auxiliary function to make a post request
$api = '';
function sendPost($api, $key, $model, $txt)
{
    /* Debug   echo' api:'.$api;
       echo' key:'.$key;
       echo' model:'.$model;
       echo' Text:'.$txt;*/
    $data = http_build_query(array('key' => $key,
        'model' => $model,
        'txt' => $txt,
        'src' => 'sdk-php-1.2')); // management internal parameter
    $context = stream_context_create(array('http' => array(
        'method' => 'POST',
        'header' =>
            'Content-type: application/x-www-form-urlencoded' . "\r\n" .
            'Content-Length: ' . strlen($data) . "\r\n",
        'content' => $data)));

    /*
              $fd = fopen($api, 'r', false, $context);
              $response = stream_get_contents($fd);
              fclose($fd);
              return $response;
    */
} // sendPost

/////////////////////////////////////////////////////////////////////////////////


for ($b = 0; $b < count($topics); $b++) {
    //echo '<br><STRONG>Topic Search:</STRONG> ' . $topics[$b] . ' <br><br>';
    $tweetsSearch = $connection->get("https://api.twitter.com/1.1/search/tweets.json?q=" . $topics[$b] . "&count=" . $notweets);

    $phpArraySearch = json_decode($tweetsSearch, true);
    //var_dump($phpArraySearch);
    //echo '<br>tweets Search: ' . count($phpArraySearch['statuses']) . '<br><br>';
    if (count($phpArraySearch['statuses']) == 0) {

    }
    $count = 0;
    for ($a = 0; $a < count($phpArraySearch['statuses']); $a++) {
        if ($phpArraySearch['statuses'] != null && $phpArraySearch['statuses'][$a] != null && $phpArraySearch['statuses'][$a]['id_str'] != '') {
            $rtImg = false;
            if ($phpArraySearch['statuses'][$a]['text'][0] == 'R' &&
                $phpArraySearch['statuses'][$a]['text'][1] == 'T' &&
                $phpArraySearch['statuses'][$a]['text'][2] == ' '
            ) {
                $rtImg = true;
            }

            if ($count <= 30) {
                $json = file_get_contents("http://api.klout.com/v2/identity.json/tw/" . $phpArraySearch['statuses'][$a]['user']['id'] . "?key=" . $kloutKey);
                $kloutID = json_decode($json, true);

                $json1 = file_get_contents("http://api.klout.com/v2/user.json/" . $kloutID['id'] . "?key=" . $kloutKey);
                $kloutScore = json_decode($json1, true);
                $kloutUser = $kloutScore['score']['score'];
                $scoreKlout = intval($kloutUser);
            }
            else { // esperar unos segundos y volver a realizar las peticiones
                sleep(15);
                $count = 0;
                $json = file_get_contents("http://api.klout.com/v2/identity.json/tw/" . $phpArraySearch['statuses'][$a]['user']['id'] . "?key=" . $kloutKey);
                $kloutID = json_decode($json, true);

                $json1 = file_get_contents("http://api.klout.com/v2/user.json/" . $kloutID['id'] . "?key=" . $kloutKey);
                $kloutScore = json_decode($json1, true);
                $kloutUser = $kloutScore['score']['score'];
                $scoreKlout = intval($kloutUser);
            }
            $count++;
            //////////BARRA
            //echo '<div class="row"><div class="col-md-12"><hr style="border-top: 1.5px solid gray;" width="85%"></div></div>';
            if ($rtImg) {
                //echo '<div class="row">';
                //echo '<img src="img/rt.jpg" style="weight:80px; height:80px" class="img-circle" alt="Circular Image"><br>';
                //echo '<span style="font-size:50px" class="glyphicon glyphicon-retweet"></span><br/> '; // glyphicon glyphicon-retweet
                //echo $phpArraySearch['statuses'][$a]['user']['name'] . "(Klout: " . $scoreKlout . ")<br>";
                //echo " <a class='twitter-follow-button' href='https://twitter.com/" . $phpArraySearch['statuses'][$a]['user']['screen_name'] . "' data-show-count='true' data-lang='es' data-show-screen-name='true'></a></div>";
            }
            /*
            echo '<div class="row">';
            echo '<div class="col-md-2"></div>';
            echo '<div class="col-md-6"><br/><blockquote class="twitter-tweet" lang="es"><a href="https://twitter.com/' . $phpArraySearch['statuses'][$a]['user']['screen_name'] . '/status/' . $phpArraySearch['statuses'][$a]['id_str'] . '"></a></blockquote></div>';
            echo '<div class="col-md-2" style="font-size:20px">';
            */
            if ($showSentiment) {

                $txt = $phpArraySearch['statuses'][$a]['text'];

                $sentiment = '';
                // We make the request and parse the response to an array
                $response = sendPost($api, $key[$keyIndex], $model, $txt);

                $json = json_decode($response, true);
                //var_dump($response);
                // echo 'Sentiment Api: '.$json['score_tag'].' - '.$json['score'].' - '.$json['status']. ' - '.$json['status']['code'];

                if (isset($json['status']) && isset($json['status']['code'])) {
                    if ($json['status']['code'] == '0') {

                        $sentiment = $json['score_tag'];
                        //echo $sentiment;
                        /*
                            P+: strong positive
                            P: positive
                            NEU: neutral
                            N: negative
                            N+: strong negative
                            NONE: without sentiment
                        */
                        switch ($json['score_tag']) {
                            case "P+":
                                //echo '</br> Sentimiento: Positivo Fuerte';
                                $sentiment = 'P+';
                                //echo 'Sentimiento: <span class="label label-success">Muy Positivo</span>';
                                break;
                            case "P":
                                $sentiment = 'P';
                                //echo '</br> Sentimiento: Positivo';
                                //echo 'Sentimiento: <span class="label label-success">Positivo</span>';
                                break;
                            case "NEU":
                                $sentiment = 'NEU';
                                //echo '</br> Sentimiento: Neutral';
                                //echo 'Sentimiento: <span class="label label-default">Neutral</span>';
                                break;
                            case "N":
                                $sentiment = 'N';
                                //echo '</br> Sentimiento: Negativo';
                                //echo 'Sentimiento: <span class="label label-danger">Negativo</span>';
                                break;
                            case "N+":
                                $sentiment = 'N+';
                                //echo '</br> Sentimiento: Negativo Fuerte';
                                //echo 'Sentimiento: <span class="label label-danger">Muy Negativo</span>';
                                break;
                            case "NONE":
                                $sentiment = 'NONE';
                                //echo '</br> Sentimiento: Negativo Fuerte';
                                //echo 'Sentimiento: <span class="label label-default">No determinado</span>';
                                break;
                        }
                    } elseif ($json['status']['code'] == '102' || $json['status']['code'] == '101') { // 102: You have exceeded the maximum number of credits per month
                        $var = true;
                        while ($var):
                            $keyIndex++;
                            // We make the request AGAIN WITH NEW KEY and parse the response to an array
                            $response = sendPost($api, $key[$keyIndex], $model, $txt);
                            $json = json_decode($response, true);
                            if (isset($json['status']) && isset($json['status']['code'])) {

                                if (isset($json['score']) && $json['status']['code'] == '0') {

                                    //echo '</br> Sentimiento TAG: ' . $json['score_tag'];
                                    $sentiment = $json['score_tag'];
                                    switch ($json['score_tag']) {
                                        case "P+":

                                            //echo '</br> Sentimiento: Positivo Fuerte';
                                            //echo 'Sentimiento: <span class="label label-success">Positivo+</span>';
                                            break;
                                        case "P":
                                            //echo '</br> Sentimiento: Positivo';
                                            //echo 'Sentimiento: <span class="label label-success">Positivo</span>';
                                            break;
                                        case "NEU":
                                            //echo '</br> Sentimiento: Neutral';
                                            //echo 'Sentimiento: <span class="label label-default">Neutral</span>';
                                            break;
                                        case "N":
                                            //echo '</br> Sentimiento: Negativo';
                                            //echo 'Sentimiento: <span class="label label-danger">Negativo</span>';
                                            break;
                                        case "N+":
                                            //echo '</br> Sentimiento: Negativo Fuerte';
                                            //echo 'Sentimiento: <span class="label label-danger">Negativo+</span>';
                                            break;
                                    }
                                    $var = false;
                                } else if ($json['status']['code'] == '102') {
                                    // nothing to do...while continue
                                } elseif ($json['status']['code'] == '100') { // Servicio denegado
                                    $var = false;
                                } else {
                                    //echo '<br> Sentimiento: Neutral'; // No determin? sentimiento positivo/negativo
                                    //echo 'Sentimiento: <span class="label label-default">Neutral</span>';
                                }
                            }
                        endwhile;
                    } elseif ($json['status']['code'] == '100' || $json['status']['code'] == '202' || $json['status']['code'] == '203') {
                        //echo '<br> Sentimiento: No disponible.';
                        $sentiment = 'No disponible';
                    } elseif ($json['status']['code'] == '103') {
                        $sentiment = 'No disponible';
                        //echo '<br> Request too large.';
                    } elseif ($json['status']['code'] == '104') {
                        //echo '<br> Request rate limit exceeded.';
                    } elseif ($json['status']['code'] == '200') {
                        //echo '<br> Par?metro faltante.';
                    } elseif ($json['status']['code'] == '201' || $json['status']['code'] == '204') {
                        //echo '<br> Lenguaje no soportado.';
                    } else {
                        //echo '<br> Sentimiento: Neutral'; // No determino sentimiento positivo/negativo
                        //echo 'Sentimiento: <span class="label label-default">Neutral</span>';
                    } //Ver la manera de mandar un email a los admin, avisando de la expiraci?n de la licencia.
                    // 101: The license has expire
                    /*
                        0: OK -- Listo
                        100: Operation denied -- Listo
                        101: License expired -- Listo
                        102: Credits per suscription exceeded -- Listo
                        103: Request too large -- Listo
                        104: Request rate limit exceeded
                        200: Missing required parameter(s) - [name of the parameter]
                        201: Model not supported
                        202: Engine internal error
                        203: Cannot connect to service
                        204: Model not suitable for the identified text language
                    */
                }
            }
            $strText = '';
            if ($phpArraySearch['statuses'][$a]['text'] != null && $phpArraySearch['statuses'][$a]['text'] != '') {
                $strText = removeAccents($phpArraySearch['statuses'][$a]['text']);//preg_replace('/\/[^@:.A-Za-z0-9\-]/', ' ', $phpArraySearch['statuses'][$a]['text']);;
            }

            if ($rtImg) {
                // Necesitamos calcular el klout de la persona RT
                $json = file_get_contents("http://api.klout.com/v2/identity.json/tw/" . $phpArraySearch['statuses'][$a]['retweeted_status']['user']['id_str'] . "?key=" . $kloutKey);
                $kloutID = json_decode($json, true);
                $json1 = file_get_contents("http://api.klout.com/v2/user.json/" . $kloutID['id'] . "?key=" . $kloutKey);
                $kloutScore = json_decode($json1, true);
                $kloutRT = $kloutScore['score']['score'];
                $scoreKlout = intval($kloutRT);
            } else {
                // si no es RT se coloca el klout del usuario que se busco
                $scoreKlout = intval($kloutUser);
            }
            // Button trigger modal
            // echo '<br/><br/>?ndice KLOUT: <button class="btn btn-default orange-circle-button" type="button" data-toggle="modal" data-target="#myModal'.$a.'">
            //                       <p style="font-size: 25px;">'.$scoreKlout.'
            //                     </button></div></div>';


            /*
            //<editor-fold desc="array">
            $arraySearch = [
                "id_tweet" => $phpArraySearch['statuses'][$a]['id_str'],
                "cant_retweet" => utf8_encode($phpArraySearch['statuses'][$a]['retweet_count']),
                "text_tweet" => utf8_encode($phpArraySearch['statuses'][$a]['text']),
                "text_clean" => utf8_encode($strText),
                "id_usuario" => $phpArraySearch['statuses'][$a]['user']['id'],
                "nombre_usuario" => utf8_encode($phpArraySearch['statuses'][$a]['user']['name']),
                "screen_name" => utf8_encode($phpArraySearch['statuses'][$a]['user']['screen_name']),
                "foto_perfil" => $phpArraySearch['statuses'][$a]['user']['profile_image_url'],
                "cuentas_que_sigue" => utf8_encode($phpArraySearch['statuses'][$a]['user']['friends_count']),
                "cuentas_que_lo_siguen" => utf8_encode($phpArraySearch['statuses'][$a]['user']['followers_count']),
                "api" => 'twitter',
                "Klout" => $scoreKlout,
                "sentimiento" => $sentiment
            ];
            //</editor-fold>
            */
            $arraySearch[$b]["id_tweet"] = $phpArraySearch['statuses'][$a]['id_str'];
            $arraySearch[$b]["cant_retweet"] = utf8_encode($phpArraySearch['statuses'][$a]['retweet_count']);
            $arraySearch[$b]["text_tweet"] = utf8_encode($phpArraySearch['statuses'][$a]['text']);
            $arraySearch[$b]["text_clean"] = utf8_encode($strText);
            $arraySearch[$b]["id_usuario"] = $phpArraySearch['statuses'][$a]['user']['id'];
            $arraySearch[$b]["nombre_usuario"] = utf8_encode($phpArraySearch['statuses'][$a]['user']['name']);
            $arraySearch[$b]["screen_name"] = utf8_encode($phpArraySearch['statuses'][$a]['user']['screen_name']);
            $arraySearch[$b]["foto_perfil"] = $phpArraySearch['statuses'][$a]['user']['profile_image_url'];
            $arraySearch[$b]["cuentas_que_sigue"] = utf8_encode($phpArraySearch['statuses'][$a]['user']['friends_count']);
            $arraySearch[$b]["cuentas_que_lo_siguen"] = utf8_encode($phpArraySearch['statuses'][$a]['user']['followers_count']);
            $arraySearch[$b]["api"] = 'twitter';
            $arraySearch[$b]["Klout"] = $scoreKlout;
            $arraySearch[$b]["sentimiento"] = $sentiment;

            //array_push($post,$arraySearch);
            $b++;
        }
    }
}


echo json_encode($arraySearch);
//var_dump($post);


/*

    for($c=0; $c< count($accounts); $c++){
        echo '<br><Strong> tweets de la Cuenta: </Strong>'.$accounts[$c].' <br><br>';
        $tweetsAccount = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$accounts[$c]."&count=".$notweets);
        $jsonData = $tweetsAccount;
        $phpArrayAccount = json_decode($jsonData,true);
        $kloutUser = 0;
        $kloutRT = 0;

        for($a=0; $a< count($phpArrayAccount); $a++){
            $rtImg = false;
            if($phpArrayAccount[$a] != null && $phpArrayAccount[$a]['id_str'] != null){

                if($phpArrayAccount[$a]['text'][0] == 'R' &&
                    $phpArrayAccount[$a]['text'][1] == 'T' &&
                    $phpArrayAccount[$a]['text'][2] == ' '){
                    $rtImg = true;
                }

                if($a == 0){
                    $json = file_get_contents("http://api.klout.com/v2/identity.json/tw/".$phpArrayAccount[$a]['user']['id_str']."?key=".$kloutKey);
                    $kloutID = json_decode($json, true);
                    $json1 = file_get_contents("http://api.klout.com/v2/user.json/".$kloutID['id']."?key=".$kloutKey);
                    $kloutScore = json_decode($json1, true);
                    $kloutUser = $kloutScore['score']['score'];
                    $scoreKlout = intval($kloutUser);
                }
                $strText = '';
                if($phpArrayAccount[$a]['text'] != null && $phpArrayAccount[$a]['text'] != ''){
                    $strText = removeAccents($phpArrayAccount[$a]['text']); //preg_replace('/\/[^@:.A-Za-z0-9\-]/', ' ', $phpArrayAccount[$a]['text']);;
                }

                echo '<div class="row">
                                            <div class="col-md-12">
                                                <hr style="border-top: 1.5px solid gray;" width="85%">
                                            </div>
                                        </div>';

                if($rtImg){
                    echo '<div class="row">';
                    //echo '<img src="img/rt.jpg" style="weight:80px; height:80px" class="img-circle" alt="Circular Image"><br>';
                    echo '<span style="font-size:50px" class="glyphicon glyphicon-retweet"></span><br/> '; // glyphicon glyphicon-retweet
                    $scoreKlout = intval($kloutUser);
                    echo $phpArrayAccount[$a]['user']['name']."(Klout: ".$scoreKlout.")<br>";
                    echo " <a class='twitter-follow-button' href='https://twitter.com/".$phpArrayAccount[$a]['user']['screen_name']."' data-show-count='true' data-lang='es' data-show-screen-name='true'></a></div>";
                }
                echo '<div class="row">';
                echo'<div class="col-md-2"></div>';
               // echo '<div class="col-md-6"><br/><blockquote class="twitter-tweet" lang="es"><a href="https://twitter.com/'.$phpArrayAccount[$a]['user']['screen_name'].'/status/'.$phpArrayAccount[$a]['id_str'].'"></a></blockquote></div>';
                echo'<div class="col-md-2" style="font-size:20px">';
                if($showSentiment){
                    $txt = $phpArrayAccount[$a]['text'];
                    $sentiment = '';
                    // We make the request and parse the response to an array
                    $response = sendPost($api, $key[$keyIndex], $model, $txt);
                    $json = json_decode($response, true);
                    //  echo $response;
                    if(isset($json['status']) && isset($json['status']['code'])){
                        if(isset($json['score']) && $json['status']['code'] == '0'){
                            /*
                                P+: strong positive
                                P: positive
                                NEU: neutral
                                N: negative
                                N+: strong negative
                                NONE: without sentiment
                            *
                            $sentiment = $json['score_tag'];
                            switch ($json['score_tag']) {
                                case "P+":
                                    //echo '</br> Sentimiento: Positivo Fuerte';
                                    echo 'Sentimiento: <span class="label label-success">Muy Positivo</span>';
                                    break;
                                case "P":
                                    //echo '</br> Sentimiento: Positivo';
                                    echo 'Sentimiento: <span class="label label-success">Positivo</span>';
                                    break;
                                case "NEU":
                                    //echo '</br> Sentimiento: Neutral';
                                    echo 'Sentimiento: <span class="label label-default">Neutral</span>';
                                    break;
                                case "N":
                                    //echo '</br> Sentimiento: Negativo';
                                    echo  'Sentimiento: <span class="label label-danger">Negativo</span>';
                                    break;
                                case "N+":
                                    //echo '</br> Sentimiento: Negativo Fuerte';
                                    echo 'Sentimiento: <span class="label label-danger">Muy Negativo</span>';
                                    break;
                            }
                        }elseif($json['status']['code'] == '102' || $json['status']['code'] == '101'){ // 102: You have exceeded the maximum number of credits per month
                            $var = true;
                            while ($var):
                                $keyIndex++;
                                // We make the request AGAIN WITH NEW KEY and parse the response to an array
                                $response = sendPost($api, $key[$keyIndex], $model, $txt);
                                $json = json_decode($response, true);
                                if(isset($json['status']) && isset($json['status']['code'])){
                                    if(isset($json['score']) && $json['status']['code'] == '0'){
                                        //  echo '</br> Sentimiento TAG: '.$json['score_tag'];
                                        $sentiment = $json['score_tag'];
                                        switch ($json['score_tag']) {
                                            case "P+":
                                                //echo '</br> Sentimiento: Positivo Fuerte';
                                                echo 'Sentimiento: <span class="label label-success">Positivo+</span>';
                                                break;
                                            case "P":
                                                //echo '</br> Sentimiento: Positivo';
                                                echo 'Sentimiento: <span class="label label-success">Positivo</span>';
                                                break;
                                            case "NEU":
                                                //echo '</br> Sentimiento: Neutral';
                                                echo 'Sentimiento: <span class="label label-default">Neutral</span>';
                                                break;
                                            case "N":
                                                //echo '</br> Sentimiento: Negativo';
                                                echo  'Sentimiento: <span class="label label-danger">Negativo</span>';
                                                break;
                                            case "N+":
                                                //echo '</br> Sentimiento: Negativo Fuerte';
                                                echo 'Sentimiento: <span class="label label-danger">Negativo+</span>';
                                                break;
                                        }
                                        $var = false;
                                    }else if($json['status']['code'] == '102'){
                                        // nothing to do...while continue
                                    }elseif($json['status']['code'] == '100'){ // Servicio denegado
                                        $var = false;
                                    }else{
                                        //echo '<br> Sentimiento: Neutral'; // No determin? sentimiento positivo/negativo
                                        echo 'Sentimiento: <span class="label label-default">Neutral</span>';
                                    }
                                }
                            endwhile;
                        }elseif($json['status']['code'] == '100' || $json['status']['code'] == '202' || $json['status']['code'] == '203'){
                            echo '<br> Sentimiento: No disponible.';
                        }elseif($json['status']['code'] == '103'){
                            echo '<br> Request too large.';
                        }elseif($json['status']['code'] == '104'){
                            echo '<br> Request rate limit exceeded.';
                        }elseif($json['status']['code'] == '200'){
                            echo '<br> Par?metro faltante.';
                        }elseif($json['status']['code'] == '201' || $json['status']['code'] == '204'){
                            echo '<br> Lenguaje no soportado.';
                        }else{
                            //echo '<br> Sentimiento: Neutral'; // No determino sentimiento positivo/negativo
                            echo 'Sentimiento: <span class="label label-default">Neutral</span>';
                        } //Ver la manera de mandar un email a los admin, avisando de la expiraci?n de la licencia.
                        // 101: The license has expire
                        /*
                            0: OK -- Listo
                            100: Operation denied -- Listo
                            101: License expired -- Listo
                            102: Credits per suscription exceeded -- Listo
                            103: Request too large -- Listo
                            104: Request rate limit exceeded
                            200: Missing required parameter(s) - [name of the parameter]
                            201: Model not supported
                            202: Engine internal error
                            203: Cannot connect to service
                            204: Model not suitable for the identified text language
                        *
                    }
                }

                if($rtImg){
                    // Necesitamos calcular el klout de la persona RT
                    $json = file_get_contents("http://api.klout.com/v2/identity.json/tw/".$phpArrayAccount[$a]['retweeted_status']['user']['id_str']."?key=".$kloutKey);
                    $kloutID = json_decode($json, true);
                    $json1 = file_get_contents("http://api.klout.com/v2/user.json/".$kloutID['id']."?key=".$kloutKey);
                    $kloutScore = json_decode($json1, true);
                    $kloutRT = $kloutScore['score']['score'];
                    $scoreKlout = intval($kloutRT);
                }else{
                    // si no es RT se coloca el klout del usuario que se busco
                    $scoreKlout = intval($kloutUser);
                }
                // Button trigger modal
                echo '<br/><br/>?ndice KLOUT: <button class="btn btn-default orange-circle-button" type="button" data-toggle="modal" data-target="#myModal'.$a.'">
                                        <p style="font-size: 25px;">'.$scoreKlout.'
                                        </button></div></div>';

                echo '<div class="modal fade" id="myModal'.$a.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                        <h2 class="modal-title" id="myModalLabel"></h2><img src="img/klout.png"/>
                                                      </div>
                                                      <div class="modal-body">
                                                      <div class="row"><div class="col-md-12"><p style="font-size:16px">El <Strong>Indice Klout</Strong> es un numero entre 1 y 100 que representa tu influencia. Lo mas influyente que seas, lo mas alto sera tu
                                                      <strong>Indice Klout</strong></p></div></div>
                                                      <div class="row"><div class="col-md-12"><h3>Como se calcula?</h3><br><img src="img/kloutsteps.png"/></div> </div>
                                                      <div class="row"><div class="col-md-12"><h3>Rangos</h3><br><img src="img/rango.png"/></div> </div>
                                                      </div>

                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>';

                $array = [
                    "id_tweet" => $phpArrayAccount[$a]['id_str'],
                    "fecha_tweet" => $phpArray[$a]['created_at'],
                    "text_tweet" => $phpArrayAccount[$a]['text'],
                    "text_clean" => $strText,
                    "cant_retweet" => $phpArrayAccount[$a]['retweet_count'],
                    "cant_favoritos" => $phpArrayAccount[$a]['favorite_count'],
                    "geolocalizacion" => $phpArrayAccount[$a]['geo'],
                    "id_usuario" => $phpArrayAccount[$a]['user']['id_str'],
                    "nombre_usuario" => $phpArrayAccount[$a]['user']['name'],
                    "screen_name" => $phpArrayAccount[$a]['user']['screen_name'],
                    "imagen_perfil" => $phpArrayAccount[$a]['user']['profile_image_url'],
                    "usuario_desde" => $phpArrayAccount[$a]['user']['created_at'],
                    "cuentas_que_sigue" => $phpArrayAccount[$a]['user']['friends_count'],
                    "cuentas_que_lo_siguen" => $phpArrayAccount[$a]['user']['followers_count'],
                    "cuenta_privada" => $phpArrayAccount[$a]['user']['protected'],
                    "api" => 'twitter',
                    "sentimiento" => $sentiment
                ];
                $coll->insert($array);
                $coll->ensureIndex(array('id_tweet' => 1), array('unique' => 1, 'dropDups' => 1));
            }else{
                echo '<div id="alertBox" class="alert alert-danger" role="alert" style="display:block">No existen resultados para mostrar.</div>';
            }
        }
    }
    echo '</p>
						</div>';
*/