<?php
/**
 * Created by PhpStorm.
 * User: L03037373
 * Date: 29/08/2015
 * Time: 03:17 PM
 */

$m = new MongoClient();
$db = $m->selectDB("ssma");
$colName = date("dmy");
$colName = 'instagram_'.$colName;
$collection = $db->selectCollection($colName);





//<editor-fold desc="Remove accents">
/**
 * Replace accented characters with non accented
 *
 * @param $str
 * @return mixed
 * @link http://myshadowself.com/coding/php-function-to-convert-accented-characters-to-their-non-accented-equivalant/
 */
function removeAccents($str) {
    $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', 'Ά', 'ά', 'Έ', 'έ', 'Ό', 'ό', 'Ώ', 'ώ', 'Ί', 'ί', 'ϊ', 'ΐ', 'Ύ', 'ύ', 'ϋ', 'ΰ', 'Ή', 'ή');
    $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', 'Α', 'α', 'Ε', 'ε', 'Ο', 'ο', 'Ω', 'ω', 'Ι', 'ι', 'ι', 'ι', 'Υ', 'υ', 'υ', 'υ', 'Η', 'η');
    return str_replace($a, $b, $str);
}
function remove_emoji($text){
    return preg_replace('/([0-9|#][\x{20E3}])|[\x{00ae}|\x{00a9}|\x{203C}|\x{2047}|\x{2048}|\x{2049}|\x{3030}|\x{303D}|\x{2139}|\x{2122}|\x{3297}|\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F6FF}][\x{FE00}-\x{FEFF}]?/u', '', $text);
}
//</editor-fold>

$client_id = '79ef585f61934698943db989482d7258';
$client_secret = 'b9fd07119f7c4424ab90b7d98c37c9bd';
$client_token = '1690894050.79ef585.be4d8e2b93a9448e97d6765ff9542d86';

// ************* Klout API ***************************
$kloutKey = 'hjsske2mer3th85ub6e5bw82';

//<editor-fold desc="Sentiment API">
//https://www.meaningcloud.com/developer/apis

$api = 'http://api.meaningcloud.com/sentiment-2.0';
$key[0] = 'e9ce37fc21e2fbfba29bde1d2fbd3b61'; //socialmediadaac@gmail.com
$key[1] = '21089e2646a625584cee07cc52421d24'; //socialmediadaac0@gmail.com
$key[2] = '2662039e381619d652afa4bd08b11cf0'; //socialmediadaac1@gmail.com
$key[3] = '247d733eb8fc2c8e8fe8e2f5492f1598'; //socialmediadaac2@gmail.com
$key[4] = '6e09fa82b045b09fee2e0410baeee945'; //socialmediadaac3@gmail.com
$key[5] = '91aa5264fa77df2e3c928cce324d6658'; //socialmediadaac4@gmail.com
$key[6] = 'cf803ded8f0c20d1d3247694afb1a3b2'; //socialmediadaac5@gmail.com
$key[8] = 'd5af72bc04ee7c663840212cd71edd1a'; //e.acosta@itesm.mx
$key[9] = ''; // Sacar del while
$txt = '';
$model = 'auto'; //general_es general_en general_fr auto  // es-general/en-general/fr-general/en-reputation/es-reputation DEPRECATED
$keyIndex = 0;
if (isset($_POST["sentiment"]) && $_POST["sentiment"] != '') {
    $showSentiment = $_POST["sentiment"];

    if($showSentiment == 'true'){
        $showSentiment = true;
    }
    else{
        $showSentiment = false;
    }
}

// Auxiliary function to make a post request
function sendPost($api, $key, $model, $txt)
{
    $data = http_build_query(array('key' => $key,
        'model' => $model,
        'txt' => $txt,
        'src' => 'sdk-php-2.0')); // management internal parameter
    $context = stream_context_create(array('http' => array(
        'method' => 'POST',
        'header' =>
            'Content-type: application/x-www-form-urlencoded' . "\r\n" .
            'Content-Length: ' . strlen($data) . "\r\n",
        'content' => $data)));

    $fd = fopen($api, 'r', false, $context);
    $response = stream_get_contents($fd);
    fclose($fd);
    return $response;
} // sendPost


//</editor-fold>

$post = [];
$sentiment = '';
$showSentiment = true;
$topics= [];

if (isset($_POST["topic"][0]) && $_POST["topic"][0] != '') {
    $topico = $_POST["topic"];
}
else {

    include_once '../include/DB_Function.php';
    $db = new DB_Function();

    $word = $db->getWords();

    $a = 0;
    foreach($word as $palabra){
        $topico[$a]=$palabra["word"];
        //echo $topico[$a];
        $a++;
    }
    /*
    $topico[0] = 'tec de monterrey';
    $topico[1] = 'tecnologico de monterrey';
    $topico[2] = 'itesm';
    $topico[3] = 'factortec';
    $topico[4] = 'tecsalud';
    $topico[5] = 'distritotec';
    $topico[6] = 'incmty';
    $topico[7] = 'tecmilenio';
    $topico[8] = 'sorteos tec';
    $topico[9] = 'consejeros tec';
    $topico[10] = 'lideres del mañana';
    $topico[11] = 'semanai';
    $topico[12] = 'semestrei';
    $topico[13] = 'rayo emprendedor';
    $topico[14] = 'david noel';
    $topico[15] = 'borregostec';
    $topico[16] = 'yosoytec';
    $topico[17] = 'CAT';
    $topico[18] = 'carreras tec';
    $topico[19] = 'campus tec monterrey';
    $topico[20] = 'admisiones tec';
    $topico[21] = 'tecreview';
    $topico[22] = 'tecchallenge';
    $topico[23] = 'borntobetec';
    $topico[24] = 'soytec';
    $topico[25] = 'exatec';
    $topico[26] = 'egresadostec';
    $topico[27] = 'tecdemty';
    $topico[28] = 'egade';
    $topico[29] = 'egap';
    $topico[30] = 'posgradostec';
    $topico[31] = 'factor tec';
//$user[0]='TecdeMonterrey';
*/
}

/************INSTAGRAM API**///////////////////////


for ($b = 0; $b < count($topico); $b++) {
    $topic = str_replace(' ', '', $topico[$b]);
    //$json1 = file_get_contents("https://api.instagram.com/v1/media/popular?client_id=".$client_id);// Most popular posts
    $json1 = file_get_contents("https://api.instagram.com/v1/tags/" . $topico[$b] . "/media/recent?client_id=" . $client_id);
    $posts = json_decode($json1, true);
    $children = $posts['data'];
    //var_dump($posts);
    //echo json_encode($children);

    foreach ($children as $child) {

        if ($showSentiment) {

            $txt =  $child['caption']['text'];
            //echo $children['caption']['text'];

            $sentiment = '';
            // We make the request and parse the response to an array
            $response = sendPost($api, $key[$keyIndex], $model, $txt);

            $json = json_decode($response, true);
            if (isset($json['status']) && isset($json['status']['code'])) {
                if ($json['status']['code'] == '0') {

                    $sentiment = $json['score_tag'];
                    switch ($json['score_tag']) {
                        case "P+":
                            $sentiment = 'P+';
                            break;
                        case "P":
                            $sentiment = 'P';
                            break;
                        case "NEU":
                            $sentiment = 'NEU';
                            break;
                        case "N":
                            $sentiment = 'N';
                            break;
                        case "N+":
                            $sentiment = 'N+';
                            break;
                        case "NONE":
                            $sentiment = 'NONE';
                            break;
                    }
                }
                // 102: You have exceeded the maximum number of credits per month
                elseif ($json['status']['code'] == '102' || $json['status']['code'] == '101') {
                    $var = true;
                    while ($var) {
                        $keyIndex++;
                        // We make the request AGAIN WITH NEW KEY and parse the response to an array
                        $response = sendPost($api, $key[$keyIndex], $model, $txt);
                        $json = json_decode($response, true);
                        if (isset($json['status']) && isset($json['status']['code'])) {

                            if (isset($json['score']) && $json['status']['code'] == '0') {
                                $sentiment = $json['score_tag'];
                                $var = false;
                            } else if ($json['status']['code'] == '102') {
                                // nothing to do...while continue
                            } elseif ($json['status']['code'] == '100') { // Servicio denegado
                                $var = false;
                            } else {
                            }
                        }
                    }//endwhile;
                }
                elseif ($json['status']['code'] == '100' || $json['status']['code'] == '202' || $json['status']['code'] == '203') {
                    $sentiment = 'No disponible';
                }
                elseif ($json['status']['code'] == '103') {
                    $sentiment = 'Request too large.';
                }
                elseif ($json['status']['code'] == '104') {
                    $sentiment=' Request rate limit exceeded.';
                }
                elseif ($json['status']['code'] == '200') {
                    $sentiment='Parametro faltante.';
                }
                elseif ($json['status']['code'] == '201' || $json['status']['code'] == '204') {
                    $sentiment= 'Lenguaje no soportado.';
                }
                else {
                    $sentiment= 'NEU'; // No determino sentimiento positivo/negativo
                    //echo 'Sentimiento: <span class="label label-default">Neutral</span>';
                }
                //Ver la manera de mandar un email a los admin, avisando de la expiraci�n de la licencia.
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
        $id = $child['id'];
        $type = $child['type'];
        $desc = $child['caption']['text'];
        $location = $child['location'];//latitude, name,longitude,id
        $comments=$child['comments'];//,$children["comments"]["data"]"text":"@jerry_vzz @rogeliodlgg @emmanuelsm95 muy buena \ud83d\udc4c\ud83c\udffc",  "from":{  "username":"gmunozdiego","profile_picture":"https:\/\/scontent.cdninstagram.com\/hphotos-xaf1\/t51.2885-19\/s150x150\/12357627_555854394569519_142841922_a.jpg","id":"218239359","full_name":"Guillermo Mu\u00f1oz-Diego" },
        $created_time = $child['created_time'];
        $likes = $child['likes']['count'];
        $thumbnail = $child['images']['thumbnail'];
        $link = $child['link'];
        $user_id = $child['user']['id'];
        $user_name = $child['user']['username'];
        $full_name = $child['user']['full_name'];
        $location = $child["location"];
        //$website = $child['user']['website'];
        $profile_pic = $child['user']['profile_picture'];


        //<editor-fold desc="Limpiar texto">
        $instaClean = '';
        if ($child['caption']['text'] != null && $child['caption']['text'] != '') {
            $instaClean = removeAccents($child['caption']['text']);
            $instaClean =remove_emoji($instaClean);
        }
        //</editor-fold>

        $arraySearch = [
            "id_post" => $id,
            "likes" => $likes,
            "text_clean" => utf8_encode($instaClean),
            "created_time" => $created_time,
            "id_usuario" => $user_id,
            "nombre_usuario" => utf8_encode($user_name),
            "screen_name" => utf8_encode($full_name),
            "foto_perfil" => $profile_pic,
            //"description" => utf8_encode($desc),
            "comments" => $comments,
            "url" => $link,
            "type" => $type,
            "location" => $location,
            "sentiment" => $sentiment,
            "api" => 'instagram'
        ];

        array_push($post, $arraySearch);

        //$coll->insert($arraySearch);

    }
}
//echo json_encode($post);

//$collection ->update($post,array("upsert" => true));

$collection->insert($post);
$m ->close();
