<?php
/**
 * Created by PhpStorm.
 * User: L03037373
 * Date: 01/09/2015
 */
include "./lib/tumblrPHP.php";
require_once '../include/DB_Function.php';
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
    $a = array('\/','À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', 'Ά', 'ά', 'Έ', 'έ', 'Ό', 'ό', 'Ώ', 'ώ', 'Ί', 'ί', 'ϊ', 'ΐ', 'Ύ', 'ύ', 'ϋ', 'ΰ', 'Ή', 'ή');
    $b = array('','A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', 'Α', 'α', 'Ε', 'ε', 'Ο', 'ο', 'Ω', 'ω', 'Ι', 'ι', 'ι', 'ι', 'Υ', 'υ', 'υ', 'υ', 'Η', 'η');
    return str_replace($a, $b, $str);
}

//</editor-fold>

$topicsTumblr = [];
$post[] = '';
$sentiment = "NONE";
$arraySearch = [];

//<editor-fold desc="Terminos">
if (isset($_POST['search']) && $_POST['search'] != '') {
    $word = $_POST['search'];
    foreach ($word as $eachWord) {
        array_push($topicsTumblr, $eachWord);
    }
}
if (isset($_POST['topic']) && $_POST['topic'] != '') {
    $topicTumblr = $_POST['topic'];
    foreach ($topicTumblr as $eachTopic) {
        array_push($topicsTumblr, $eachTopic);
    }
}
else{

    $word = $dbf->getWords();
    $a = 0;
    foreach($word as $palabra) {
        $topicsTumblr[$a] = $palabra["word"];
        //echo $topicsTumblr[$a];
        $a++;
    }
}
$showSentiment = true;
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

//$consumerKey = 'shETGvB4luJt7WZj48JWs2gjsbrbrE9gGYXeJWij3vypSwSBDA';
//$consumerSecret = 'lBVphsyJai5Lr500gbQ9KtuYASLrzEfAXeiVxLM84RJxVQ1XwM';


// Enter your Consumer (Also known as oyur API KEY)
$consumer = "shETGvB4luJt7WZj48JWs2gjsbrbrE9gGYXeJWij3vypSwSBDA";

// Create a new instance of the Tumblr Class with your Conumser when you create your app. You can pass an empty string for the secret, or you can add it.
$tumblr = new Tumblr($consumer, "");
$c = 0;
for ($b = 0; $b < count($topicsTumblr); $b++) {
    $word = '/search/' . $topicsTumblr[$b];
    $info = $tumblr->get($word);

    //Blogs contiene la respuesta de la busqueda
    $blogs = $info->response->blogs;

    //var_dump( $info);


    if (count($blogs) == 0) {
        continue;
    }
    foreach ($blogs as $blog) {
        $title = $blog->title;
        $description = $blog->description;
        $name = $blog->name;
        $url = $blog->url;
        $posts = $blog->posts;
        $id_post = $blog->updated;
        if ($blog->is_nsfw == true) {
            $nsfw = "true";
        }
        else {
            $nsfw = "false";
        }

        //Limpieza Tumblr
        $tumblrClean = '';
        if ($blog->description != null && $blog->description != '') {
            $tumblrClean = trim($description);
            $tumblrClean = removeAccents($description);

        }

        if ($showSentiment) {
            $txt = $title;
            $sentiment = $dbf->sentimentAnalysis($api, $model, $txt);
        }
        ///Arreglo
        $arraySearch[$c] = [
            "id_post" => $id_post,
            "title" => strip_tags($title),
            "name" => $name,
            "text_clean" => utf8_encode($tumblrClean),
            "url" => $url,
            "posts" => utf8_encode($posts),
            "nsfw" => $nsfw,
            "sentiment" => $sentiment,
            "api" => 'tumblr'
        ];
        try {
            //$collection->update($arraySearch[$c], array("upsert" => true));
            $collection->insert($arraySearch[$c]);
            $collection->ensureIndex(array('id_post' => 1), array('unique' => 1, 'dropDups' => 1));
        }
        catch (MongoWriteConcernException $e) {
            //echo $e->getMessage(), "\n";
        }
        $c++;
    }
}
//$collection ->update($post,array("upsert" => true));
//$collection->insert($post);
$m ->close();

echo json_encode($arraySearch);
