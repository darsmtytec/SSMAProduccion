<?php
/**
 * Created by PhpStorm.
 * User: L03037373
 * Date: 01/09/2015
 */
require_once '/opt/lampp/htdocs/ssma/web_service/include/DB_Function.php';
$dbf = new DB_Function();
$m = new MongoClient();
$db = $m->selectDB("ssma");
$colName = date("dmy");
$colName = 'col' . $colName;
$collection = $db->selectCollection($colName);


//require_once("reddit.php");
//$reddit = new reddit();
$post = [];
$topicsReddit = [];
$accounts = [];
$topics = [];
$sentiment = 'NONE';

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

//</editor-fold>


//<editor-fold desc="Sentiment API">
//https://www.meaningcloud.com/developer/apis
$api = 'http://api.meaningcloud.com/sentiment-2.0';
$txt = '';
$model = 'auto'; //general_es general_en general_fr auto  // es-general/en-general/fr-general/en-reputation/es-reputation DEPRECATED
$keyIndex = 0;
if (isset($_POST["sentiment"]) && $_POST["sentiment"] != '') {
    $showSentiment = $_POST["sentiment"];

    if ($showSentiment == 'true') {
        $showSentiment = true;
    } else {
        $showSentiment = false;
    }
}

//</editor-fold>

//<editor-fold desc="Usuario y Topicos">
if (isset($_POST["accounts"][0]) && $_POST["accounts"][0] != '') {
    $accounts = $_POST["accounts"];
}
if (isset($_POST["topics"]) && $_POST["topics"] != '') {
    $topics = $_POST["topics"];
    if ($accounts != '') {
        foreach ($accounts as $eachAcc) {
            array_push($topicsReddit, $eachAcc);
        }
    }
    if ($topics != '') {
        foreach ($topics as $eachTopic) {
            array_push($topicsReddit, $eachTopic);
        }
    }
} else {

    include_once '../include/DB_Function.php';
    $db = new DB_Function();

    $word = $db->getWords();

    $a = 0;
    foreach ($word as $palabra) {
        $topicsReddit[$a] = $palabra["word"];
        //echo $topicsReddit[$a]."<br>";
        $a++;
    }
    $showSentiment = true;
}


//</editor-fold>

//$reddit->login("socialmediadaac", "socialMediaDaac123");
//$topicsReddit = ['TecdeMonterrey'];


$d = 0;
for ($d = 0; $d < count($topicsReddit); $d++) { // count($topicsReddit)
    // $user = $reddit->getUser();
    $string_reddit = file_get_contents("http://reddit.com/api/subreddits_by_topic.json?query=" . $topicsReddit[$d]); // GET [/r/subreddit]/search[ .json | .xml ]
    $json = json_decode($string_reddit, true);
    $count = count($json);
    // tenemos la lista de subreddits que tienen el tema buscado
    for ($c = 0; $c < $count; $c++) {
        $string_redditSub = file_get_contents("http://reddit.com/r/" . $json[$c]['name'] . ".json");
        $jsonSub = json_decode($string_redditSub, true);
        //var_dump($jsonSub);

        $children = $jsonSub['data']['children'];
        //var_dump($children);
        foreach ($children as $child) {


            $id = $child['data']['id'];
            $title = $child['data']['title'];
            $url = $child["data"]["url"];
            $num_comments = $child['data']['num_comments'];
            $permalink = $child['data']['permalink'];
            $author = $child['data']['author'];
            $name = $child['data']['name'];
            $likes = $child["data"]["likes"];
            $score = $child["data"]["score"];
            $over_18 = $child["data"]["over_18"];

            if ($showSentiment) {
                $txt = $title;
                $sentiment = $dbf->sentimentAnalysis($txt);
            }

            //limpieza reddit
            $redditClean = '';
            if ($child['data']['title'] != null && $child['data']['title'] != '') {
                $redditClean = removeAccents($child['data']['title']);
            }

            $arrayRedditTema[$d] = [
                "id_post" => $id,
                "num_comments" => $num_comments,
                "title" => $title,
                "text_clean" => $redditClean,
                "url" => $url,
                "nombre_usuario" => $author,
                "screen_name" => $name,
                "permalink" => $permalink,
                "likes" => $likes,
                "score" => $score,
                "over_18" => $over_18,
                "sentiment" => $sentiment,
                "api" => 'reddit'
            ];
            try {
                //$collection->update($arraySearch[$c], array("upsert" => true));
                $collection->insert($arrayRedditTema[$c]);
                $collection->ensureIndex(array('id_post' => 1), array('unique' => 1, 'dropDups' => 1));
            } catch (MongoWriteConcernException $e) {
                //echo $e->getMessage(), "\n";
            }
            $d++;
        }
    }
}
echo json_encode($arrayRedditTema);
$m->close();
