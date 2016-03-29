<?php
/**
 * Created by PhpStorm.
 * User: L03037373
 * Date: 28/08/2015
 * Time: 12:36 PM
 */

header("Access-Control-Allow-Origin: *");
require_once("twitteroauth.php");
require_once '/var/www/html/ssma/web_service/include/DB_Function.php';
$dbf = new DB_Function();

$m = new MongoClient();
$db = $m->selectDB("ssma");
$colName = date("dmy");
$colName = 'col' . $colName;
$collection = $db->selectCollection($colName);

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
    $a = array('?', '¿', '!', '¡', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', 'Ά', 'ά', 'Έ', 'έ', 'Ό', 'ό', 'Ώ', 'ώ', 'Ί', 'ί', 'ϊ', 'ΐ', 'Ύ', 'ύ', 'ϋ', 'ΰ', 'Ή', 'ή');
    $b = array(' ', ' ', ' ', ' ', 'A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', 'Α', 'α', 'Ε', 'ε', 'Ο', 'ο', 'Ω', 'ω', 'Ι', 'ι', 'ι', 'ι', 'Υ', 'υ', 'υ', 'υ', 'Η', 'η');
    return str_replace($a, $b, $str);
}

function remove_emoji($text)
{
    return preg_replace('/([0-9|#][\x{20E3}])|[\x{00ae}|\x{00a9}|\x{203C}|\x{2047}|\x{2048}|\x{2049}|\x{3030}|\x{303D}|\x{2139}|\x{2122}|\x{3297}|\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F6FF}][\x{FE00}-\x{FEFF}]?/u', '', $text);
}

//</editor-fold>


//<editor-fold desc="Variables">
$b = 0;
$word[] = '';
$topico[] = '';
$user[] = '';
$api = '';
$topics[] = '';
$accounts[] = '';
$post[] = '';
$bol = true;
$showSentiment = 'false';
$notweets = 100; //cantidad de tweets a mostrar
$sentiment = 'NONE';
$mod = '';

//</editor-fold>

//<editor-fold desc="ISSET">
if (isset($_POST["user"][0]) && $_POST["user"][0] != '') {
    $user = $_POST["user"];
}
if (isset($_POST["topic"][0]) && $_POST["topic"][0] != '') {
    $topico = $_POST["topic"];
}
else {

    //$topico[0] = 'tec de monterrey';

    include_once "/var/www/html/ssma/web_service/include/DB_Function.php";
    $db = new DB_Function();

    $word = $db->getWords();

    $a = 0;
    foreach ($word as $palabra) {
        $topico[$a] = $palabra["word"];
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
if (isset($_POST["search"][0]) && $_POST["search"][0] != '') {
    $word = $_POST["search"];
}
if (isset($_POST["sentiment"]) && $_POST["sentiment"] != '') {
    $showSentiment = $_POST["sentiment"];
}
//</editor-fold>


//<editor-fold desc="Klout">
// ************* Klout API ***************************
$kloutKey = 'hjsske2mer3th85ub6e5bw82';

if ($showSentiment == 'true') {
    $showSentiment = true;
} else {
    $showSentiment = false;
}
//</editor-fold>


//<editor-fold desc="Conexion API Twitter">
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
//var_dump( $connection);
//</editor-fold>


//<editor-fold desc="Por cuenta">
if ($user[0] != '') {
    // Obtener lista de terminos
    // $users = $_POST["user"];
    foreach ($user as $eachUser) {
        array_push($accounts, $eachUser);
    }
}
//</editor-fold>

//<editor-fold desc="Por palabra o Hashtag">
if ($topico[0] != '') {

    //$topic = $_POST["topic"];
    foreach ($topico as $eachTopic) {
        array_push($topics, $eachTopic);
    }
    //var_dump($topics);
}
if ($word[0] != '') {
    //$word = $_POST["search"];
    foreach ($word as $eachWord) {
        array_push($topics, $eachWord);
    }
}
//</editor-fold>

//<editor-fold desc="Sentiment API">
//$api = 'http://textalytics.com/core/sentiment-1.1';

//https://www.meaningcloud.com/developer/apis

$api = 'http://api.meaningcloud.com/sentiment-2.0';
$model = 'auto';
$txt = '';

//</editor-fold>

$topics[0] = $topico[0];
$accounts[0] = $user[0];
$c = 0;

if ($topics[0] != '') {

    for ($b = 0; $b < count($topics); $b++) {
        $tweetsSearch = $connection->get("https://api.twitter.com/1.1/search/tweets.json?q=" . $topics[$b] . "&count=" . $notweets);
        $phpArraySearch = json_decode($tweetsSearch, true);
        if (count($phpArraySearch['statuses']) == 0) {

        }
        $count = 0;
        for ($a = 0; $a < count($phpArraySearch['statuses']); $a++) {
            if ($phpArraySearch['statuses'] != null && $phpArraySearch['statuses'][$a] != null && $phpArraySearch['statuses'][$a]['id_str'] != '') {
                $rtImg = false;
                if ($phpArraySearch['statuses'][$a]['text'][0] == 'R' && $phpArraySearch['statuses'][$a]['text'][1] == 'T' && $phpArraySearch['statuses'][$a]['text'][2] == ' ') {
                    $rtImg = true;//Si es un re twitt sirve para calcular el del usuario que lo re twittero
                }

                if ($count <= 10) {
                    $scoreKlout = $dbf->klout( $phpArraySearch['statuses'][$a]['user']['id']);
                }
                else {
                    sleep(1.5);// esperar unos segundos y volver a realizar las peticiones

                    $count = 0;
                    $scoreKlout = $dbf->klout( $phpArraySearch['statuses'][$a]['user']['id']);
                }
                $count++;
                if ($showSentiment) {
                   $txt = $phpArraySearch['statuses'][$a]['text'];
                   $sentiment = $dbf->sentimentAnalysis($api,$model,$txt);

                }
            //<editor-fold desc="Clean text">
            $strText = '';
            if ($phpArraySearch['statuses'][$a]['text'] != null && $phpArraySearch['statuses'][$a]['text'] != '') {
                $strText = removeAccents($phpArraySearch['statuses'][$a]['text']);//preg_replace('/\/[^@:.A-Za-z0-9\-]/', ' ', $phpArraySearch['statuses'][$a]['text']);;
                $strText = remove_emoji($strText);
            }
            //</editor-fold>
            //Si es un RT se calcula el KLOUT de la persona que realizo el RT
            if ($rtImg) {
                $scoreKlout = $dbf->klout( $phpArraySearch['statuses'][$a]['user']['id'] );
            }

            //<editor-fold desc="Arreglo con parametros">
            $arraySearch[$c]["id_post"] = $phpArraySearch['statuses'][$a]['id_str'];
            $arraySearch[$c]["cant_retweet"] = utf8_encode($phpArraySearch['statuses'][$a]['retweet_count']);
            //$arraySearch[$c]["text_tweet"] = utf8_encode($phpArraySearch['statuses'][$a]['text']);
            $arraySearch[$c]["text_clean"] = utf8_encode($strText);
            $arraySearch[$c]["id_usuario"] = $phpArraySearch['statuses'][$a]['user']['id'];
            $arraySearch[$c]["nombre_usuario"] = utf8_encode($phpArraySearch['statuses'][$a]['user']['name']);
            $arraySearch[$c]["screen_name"] = utf8_encode($phpArraySearch['statuses'][$a]['user']['screen_name']);
            $arraySearch[$c]["user_description"] = utf8_encode($phpArraySearch['statuses'][$a]['user']['description']);
            $arraySearch[$c]["foto_perfil"] = $phpArraySearch['statuses'][$a]['user']['profile_image_url'];
            $arraySearch[$c]["cuentas_que_sigue"] = utf8_encode($phpArraySearch['statuses'][$a]['user']['friends_count']);
            $arraySearch[$c]["cuentas_que_lo_siguen"] = utf8_encode($phpArraySearch['statuses'][$a]['user']['followers_count']);
            $arraySearch[$c]["created_at"] = $phpArraySearch['statuses'][$a]['created_at'];
            $arraySearch[$c]["in_reply_to_status_id"] = utf8_encode($phpArraySearch['statuses'][$a]['in_reply_to_status_id']);
            $arraySearch[$c]["in_reply_to_screen_name"] = utf8_encode($phpArraySearch['statuses'][$a]['in_reply_to_screen_name']);
            $arraySearch[$c]["in_reply_to_user_id_str"] = utf8_encode($phpArraySearch['statuses'][$a]['in_reply_to_user_id_str']);
            $arraySearch[$c]["location"] = utf8_encode($phpArraySearch['statuses'][$a]['user']['location']);
            if ($phpArraySearch['statuses'][$a]['user']['protected']) {
                $arraySearch[$c]["protected"] = "true";
            } else {
                $arraySearch[$c]["protected"] = "false";

            }
            $arraySearch[$c]["friends_count"] = utf8_encode($phpArraySearch['statuses'][$a]['user']['friends_count']);
            if ($phpArraySearch['statuses'][$a]['user']['verified']) {
                $arraySearch[$c]["verified"] = "true";
            } else {
                $arraySearch[$c]["verified"] = "false";

            }
            $arraySearch[$c]["api"] = 'twitter';
            $arraySearch[$c]["Klout"] = $scoreKlout;
            $arraySearch[$c]["model"] = $mod;
            $arraySearch[$c]["sentiment"] = $sentiment;
            //</editor-fold>
            //$collection->insert($arraySearch[$c]);

            try {
                if ($phpArraySearch['statuses'][$a]['id_str'] != null) {
                    //$collection->update($arraySearch[$c], array("upsert" => true));
                    $collection->insert($arraySearch[$c]);
                    $collection->ensureIndex(array('id_post' => 1), array('unique' => 1, 'dropDups' => 1));
                }

            } catch (MongoWriteConcernException $e) {
                //echo $e->getMessage(), "\n";
            }
            //array_push($post, $arraySearch);
            $c++;
            // $b++;
        }
    }
}


echo json_encode($arraySearch);
}
else if ($accounts[0] != '') {

    for ($c = 0; $c < count($accounts); $c++) {
        $tweetsAccount = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=" . $accounts[$c] . "&count=" . $notweets);
        $jsonData = $tweetsAccount;
        $phpArrayAccount = json_decode($jsonData, true);
        //var_dump($phpArrayAccount);
        $kloutUser = 0;
        $kloutRT = 0;

        for ($a = 0; $a < count($phpArrayAccount); $a++) {
            $rtImg = false;
            if ($phpArrayAccount[$a] != null && $phpArrayAccount[$a]['id_str'] != null) {

                if ($phpArrayAccount[$a]['text'][0] == 'R' && $phpArrayAccount[$a]['text'][1] == 'T' && $phpArrayAccount[$a]['text'][2] == ' ') {
                    $rtImg = true;
                }

                if ($a == 0) {
                    $jsonK = file_get_contents("http://api.klout.com/v2/identity.json/tw/" . $phpArrayAccount[$a]['user']['id_str'] . "?key=" . $kloutKey);
                    $kloutID = json_decode($jsonK, true);
                    $json1 = file_get_contents("http://api.klout.com/v2/user.json/" . $kloutID['id'] . "?key=" . $kloutKey);
                    $kloutScore = json_decode($json1, true);
                    $kloutUser = $kloutScore['score']['score'];
                    $scoreKlout = intval($kloutUser);
                }
                $strText = '';
                if ($phpArrayAccount[$a]['text'] != null && $phpArrayAccount[$a]['text'] != '') {
                    $strText = removeAccents($phpArrayAccount[$a]['text']); //preg_replace('/\/[^@:.A-Za-z0-9\-]/', ' ', $phpArrayAccount[$a]['text']);;
                }


                if ($showSentiment) {
                    $txt = $phpArrayAccount[$a]['text'];
                    $sentiment = '';
                    // We make the request and parse the response to an array
                    $response = sendPost($api, $key[$keyIndex], $model, $txt);
                    $json = json_decode($response, true);
                    //  echo $response;
                    if (isset($json['status']) && isset($json['status']['code'])) {
                        if (isset($json['score']) && $json['status']['code'] == '0') {
                            /*
                                P+: strong positive
                                P: positive
                                NEU: neutral
                                N: negative
                                N+: strong negative
                                NONE: without sentiment
                            */
                            $sentiment = $json['score_tag'];
                            switch ($json['score_tag']) {
                                case "P+":
                                    break;
                                case "P":

                                    break;
                                case "NEU":

                                    break;
                                case "N":

                                    break;
                                case "N+":

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
                                        $sentiment = $json['score_tag'];//sentiment tag
                                        $var = false;
                                    } else if ($json['status']['code'] == '102') {
                                        // nothing to do...while continue
                                    } elseif ($json['status']['code'] == '100') { // Servicio denegado
                                        $var = false;
                                    } else {
                                        //echo '<br> Sentimiento: Neutral'; // No determin� sentimiento positivo/negativo

                                    }
                                }
                            endwhile;
                        } elseif ($json['status']['code'] == '100' || $json['status']['code'] == '202' || $json['status']['code'] == '203') {
                            //echo '<br> Sentimiento: No disponible.';
                        } elseif ($json['status']['code'] == '103') {
                            //echo '<br> Request too large.';
                        } elseif ($json['status']['code'] == '104') {
                            //echo '<br> Request rate limit exceeded.';
                        } elseif ($json['status']['code'] == '200') {
                            //echo '<br> Par�metro faltante.';
                        } elseif ($json['status']['code'] == '201' || $json['status']['code'] == '204') {
                            //echo '<br> Lenguaje no soportado.';
                        } else {
                            //echo '<br> Sentimiento: Neutral'; // No determino sentimiento positivo/negativo
                            //echo 'Sentimiento: <span class="label label-default">Neutral</span>';
                        } //Ver la manera de mandar un email a los admin, avisando de la expiraci�n de la licencia.
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

                if ($rtImg) {
                    // Necesitamos calcular el klout de la persona RT
                    $jsonK = file_get_contents("http://api.klout.com/v2/identity.json/tw/" . $phpArrayAccount[$a]['retweeted_status']['user']['id_str'] . "?key=" . $kloutKey);
                    $kloutID = json_decode($jsonK, true);
                    $json1 = file_get_contents("http://api.klout.com/v2/user.json/" . $kloutID['id'] . "?key=" . $kloutKey);
                    $kloutScore = json_decode($json1, true);
                    $kloutRT = $kloutScore['score']['score'];
                    $scoreKlout = intval($kloutRT);
                } else {
                    // si no es RT se coloca el klout del usuario que se busco
                    $scoreKlout = intval($kloutUser);
                }


                //<editor-fold desc="Arrego de resultados">
                $arraySearch[$c]["id_tweet"] = $phpArrayAccount[$a]['id_str'];
                $arraySearch[$c]["created_at"] = $phpArrayAccount[$a]['created_at'];
                //$arraySearch[$c]["text_tweet"] = utf8_encode($phpArrayAccount[$a]['text']);
                $arraySearch[$c]["text_clean"] = utf8_encode($strText);
                $arraySearch[$c]["cant_retweet"] = $phpArrayAccount[$a]['retweet_count'];
                $arraySearch[$c]["cant_favoritos"] = $phpArrayAccount[$a]['favorite_count'];
                $arraySearch[$c]["geolocalizacion"] = $phpArrayAccount[$a]['geo'];
                $arraySearch[$c]["id_usuario"] = $phpArrayAccount[$a]['user']['id_str'];
                $arraySearch[$c]["nombre_usuario"] = $phpArrayAccount[$a]['user']['name'];
                $arraySearch[$c]["screen_name"] = $phpArrayAccount[$a]['user']['screen_name'];
                $arraySearch[$c]["imagen_perfil"] = $phpArrayAccount[$a]['user']['profile_image_url'];
                $arraySearch[$c]["usuario_desde"] = $phpArrayAccount[$a]['user']['screen_name'];
                $arraySearch[$c]["cuentas_que_sigue"] = $phpArrayAccount[$a]['user']['friends_count'];
                $arraySearch[$c]["cuentas_que_lo_siguen"] = $phpArrayAccount[$a]['user']['followers_count'];
                $arraySearch[$c]["cuenta_privada"] = $phpArrayAccount[$a]['user']['protected'];
                $arraySearch[$c]["api"] = 'twitter';
                $arraySearch[$c]["Klout"] = $scoreKlout;
                $arraySearch[$c]["sentimiento"] = $sentiment;
                //</editor-fold>
                $collection->insert($arraySearch[$c]);
                array_push($post, $arraySearch);
                $c++;

                //$coll->insert($array);
                //$coll->ensureIndex(array('id_tweet' => 1), array('unique' => 1, 'dropDups' => 1));
            } else {
                $response["msg"] = "No existe resultado para mostrar";
                //echo '<div id="alertBox" class="alert alert-danger" role="alert" style="display:block">No existen resultados para mostrar.</div>';
            }
        }

    }

    echo json_encode($post);


} else {
    $response['msg'] = "No se tienen topicos ni # para buscar";
    json_encode($response);
}

$m->close();
