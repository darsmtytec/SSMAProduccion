<?php
/**
 * Created by PhpStorm.
 * User: L03037373
 * Date: 29/08/2015
 * Time: 03:17 PM
 */

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
    $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', 'Ά', 'ά', 'Έ', 'έ', 'Ό', 'ό', 'Ώ', 'ώ', 'Ί', 'ί', 'ϊ', 'ΐ', 'Ύ', 'ύ', 'ϋ', 'ΰ', 'Ή', 'ή');
    $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', 'Α', 'α', 'Ε', 'ε', 'Ο', 'ο', 'Ω', 'ω', 'Ι', 'ι', 'ι', 'ι', 'Υ', 'υ', 'υ', 'υ', 'Η', 'η');
    return str_replace($a, $b, $str);
}

function remove_emoji($text)
{
    return preg_replace('/([0-9|#][\x{20E3}])|[\x{00ae}|\x{00a9}|\x{203C}|\x{2047}|\x{2048}|\x{2049}|\x{3030}|\x{303D}|\x{2139}|\x{2122}|\x{3297}|\x{3299}][\x{FE00}-\x{FEFF}]?|[\x{2190}-\x{21FF}][\x{FE00}-\x{FEFF}]?|[\x{2300}-\x{23FF}][\x{FE00}-\x{FEFF}]?|[\x{2460}-\x{24FF}][\x{FE00}-\x{FEFF}]?|[\x{25A0}-\x{25FF}][\x{FE00}-\x{FEFF}]?|[\x{2600}-\x{27BF}][\x{FE00}-\x{FEFF}]?|[\x{2900}-\x{297F}][\x{FE00}-\x{FEFF}]?|[\x{2B00}-\x{2BF0}][\x{FE00}-\x{FEFF}]?|[\x{1F000}-\x{1F6FF}][\x{FE00}-\x{FEFF}]?/u', '', $text);
}

//</editor-fold>

//<editor-fold desc="KEYS">
$client_id = '79ef585f61934698943db989482d7258';
$client_secret = 'b9fd07119f7c4424ab90b7d98c37c9bd';
$client_token = '1690894050.79ef585.be4d8e2b93a9448e97d6765ff9542d86';
//</editor-fold>

//<editor-fold desc="KEY Klout">
// ************* Klout API ***************************
$kloutKey = 'hjsske2mer3th85ub6e5bw82';
//</editor-fold>

//<editor-fold desc="Sentiment API">
//https://www.meaningcloud.com/developer/apis

$api = 'http://api.meaningcloud.com/sentiment-2.0';
$txt = '';
$model = 'auto';
if (isset($_POST["sentiment"]) && $_POST["sentiment"] != '') {
    $showSentiment = $_POST["sentiment"];

    if ($showSentiment == 'true') {
        $showSentiment = true;
    }
    else {
        $showSentiment = false;
    }
}

//</editor-fold>

//<editor-fold desc="Define ">
$post = [];
$sentiment = 'NONE';
$showSentiment = false;
$topics = [];
$scoreKlout = '';


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
        //echo $topico[$a] . "<br>";
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
//</editor-fold>
/************INSTAGRAM API**///////////////////////
$c = 0;
for ($b = 0; $b < count($topico); $b++) {
    $topic[$b] = str_replace(' ', '', $topico[$b]);
    //$json1 = file_get_contents("https://api.instagram.com/v1/media/popular?client_id=".$client_id);// Most popular posts
    $json1 = file_get_contents("https://api.instagram.com/v1/tags/" . $topico[$b] . "/media/recent?client_id=" . $client_id);
    $posts = json_decode($json1, true);
    $children = $posts['data'];
    //var_dump($posts);
    //echo json_encode($children);

    foreach ($children as $child) {

        if ($showSentiment) {

            $txt = $child['caption']['text'];
            //echo $children['caption']['text'];
            $sentiment = $dbf->sentimentAnalysis($api, $model, $txt);
        }

        $id = $child['id'];
        $type = $child['type'];
        $desc = $child['caption']['text'];
        $location = $child['location'];//latitude, name,longitude,id
        $comments = $child['comments'];//,$children["comments"]["data"]"text":"@jerry_vzz @rogeliodlgg @emmanuelsm95 muy buena \ud83d\udc4c\ud83c\udffc",  "from":{  "username":"gmunozdiego","profile_picture":"https:\/\/scontent.cdninstagram.com\/hphotos-xaf1\/t51.2885-19\/s150x150\/12357627_555854394569519_142841922_a.jpg","id":"218239359","full_name":"Guillermo Mu\u00f1oz-Diego" },
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
            $instaClean = remove_emoji($instaClean);
        }
        //</editor-fold>

        $arraySearch[$c] = [
            "id_post" => $id,
            "likes" => $likes,
            "text_clean" => utf8_encode($instaClean),
            "created_at" => $created_time,
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

        try {
            if ($id != null) {
                //$collection->update($arraySearch[$c], array("upsert" => true));
                $collection->insert($arraySearch[$c]);
                $collection->ensureIndex(array('id_post' => 1), array('unique' => 1, 'dropDups' => 1));

            }
        } catch (MongoWriteConcernException $e) {
            //echo $e->getMessage(), "\n";
        }
        $c++;
    }

}
echo json_encode($arraySearch);

//$collection ->update($post,array("upsert" => true));

$m->close();
