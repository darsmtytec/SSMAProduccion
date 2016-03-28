<?php
/**
 * Created by PhpStorm.
 * User: L03037373
 * Date: 02/09/2015
 */
include_once '../include/DB_Function.php';
$dbf = new DB_Function();
/*
$m = new MongoClient();
$db = $m->selectDB("ssma");
$colName = date("dmy");
$colName = 'col' . $colName;
$collection = $db->selectCollection($colName);
*/

function removeSpace($str)
{
    $a = array(' ', '  ');
    $b = array('%', '%');
    return str_replace($a, $b, $str);
}

$cont = 0;
$post = [];
$query = [];
$showSentiment = false;
$sentiment = '';
if (isset($_POST['topic']) && $_POST['topic'] != '') {
    $topic = $_POST['topic'];
    foreach ($topic as $eachTopic) {
        array_push($query, $eachTopic);
    }
}
else {
    /*
    $word = $dbf->getWords();
    $a = 0;
    foreach ($word as $palabra) {
        $query[$a] = $palabra["word"];
        $query[$a] = removeSpace($query[$a]);
        //echo $query[$a] . "<br>";
        $a++;
    }
    */
    $query[0] ="TecDeMonterrey";
}

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

    if ($showSentiment == 'true') {
        $showSentiment = true;
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


//var_dump($json->responseData);
//http://ajax.googleapis.com/ajax/services/search/images?v=1.0&q=$query&start=4


$showSentiment = false;

for ($i = 0; $i < count($query); $i) {
    $url = "http://ajax.googleapis.com/ajax/services/search/web?v=1.0&q=" . $query[$i] . "&key=AIzaSyBH7CCYp-F3REO_nVKPHeLHzW1sSnp6nGY&userip=USERS-IP-ADDRESS&rsz=large";//&start=".$cont;
    $body = file_get_contents($url);
    $json = json_decode($body);

    for ($x = 0; $x < count($json->responseData->results); $x++) {

        //var_dump($json->responseData->results);

        $GsearchResultClass = $json->responseData->results[$x]->GsearchResultClass;
        $unescapedUrl = $json->responseData->results[$x]->unescapedUrl;
        $url = $json->responseData->results[$x]->url;
        $urlvisbile = $json->responseData->results[$x]->visibleUrl;
        $cacheUrl = $json->responseData->results[$x]->cacheUrl;
        $titlulo = $json->responseData->results[$x]->title;
        $titlulo = removeAccents($titlulo);
        $titleNoFormatting = $json->responseData->results[$x]->titleNoFormatting;
        $titleNoFormatting = removeAccents($titleNoFormatting);
        $coment = $json->responseData->results[$x]->content;
        $coment = removeAccents($coment);
        $coment = strip_tags($coment);


        if ($showSentiment) {

            $txt = $coment;
            //echo $children['caption']['text'];

            $sentiment = '';
            // We make the request and parse the response to an array
            $response = sendPost($api, $key[$keyIndex], $model, $txt);

            $jsonS = json_decode($response, true);
            if (isset($jsonS['status']) && isset($jsonS['status']['code'])) {
                if ($jsonS['status']['code'] == '0') {

                    $sentiment = $jsonS['score_tag'];
                    switch ($jsonS['score_tag']) {
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
                } // 102: You have exceeded the maximum number of credits per month
                elseif ($jsonS['status']['code'] == '102' || $jsonS['status']['code'] == '101') {
                    $var = true;
                    while ($var) {
                        $keyIndex++;
                        // We make the request AGAIN WITH NEW KEY and parse the response to an array
                        $response = sendPost($api, $key[$keyIndex], $model, $txt);
                        $jsonS = json_decode($response, true);
                        if (isset($jsonS['status']) && isset($jsonS['status']['code'])) {

                            if (isset($jsonS['score']) && $json['status']['code'] == '0') {
                                $sentiment = $jsonS['score_tag'];
                                $var = false;
                            } else if ($jsonS['status']['code'] == '102') {
                                // nothing to do...while continue
                            } elseif ($jsonS['status']['code'] == '100') { // Servicio denegado
                                $var = false;
                            } else {
                            }
                        }
                    }//endwhile;
                } elseif ($jsonS['status']['code'] == '100' || $jsonS['status']['code'] == '202' || $jsonS['status']['code'] == '203') {
                    $sentiment = 'No disponible';
                } elseif ($jsonS['status']['code'] == '103') {
                    $sentiment = 'Request too large.';
                } elseif ($jsonS['status']['code'] == '104') {
                    $sentiment = ' Request rate limit exceeded.';
                } elseif ($jsonS['status']['code'] == '200') {
                    $sentiment = 'Parametro faltante.';
                } elseif ($jsonS['status']['code'] == '201' || $jsonS['status']['code'] == '204') {
                    $sentiment = 'Lenguaje no soportado.';
                } else {
                    $sentiment = 'NEU'; // No determino sentimiento positivo/negativo
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
               // */
            }
        }


        $responseData["responseData"]["results"][$x]["GsearchResultClass"] = $GsearchResultClass;
        $responseData["responseData"]["results"][$x]["unescapedUrl"] = $unescapedUrl; //URL sin modificar
        $responseData["responseData"]["results"][$x]["url"] = $url; //URL normal
        $responseData["responseData"]["results"][$x]["visibleUrl"] = $urlvisbile; //Nombre de la pagina
        $responseData["responseData"]["results"][$x]["titlulo"] = $titlulo;
        $responseData["responseData"]["results"][$x]["titleNoFormatting"] = $titleNoFormatting;
        $responseData["responseData"]["results"][$x]["coment"] = $coment;
        $responseData["responseData"]["results"][$x]["sentiment"] = $sentiment;


        array_push($post, $responseData);
    }

    $resultCount = $json->responseData->cursor->resultCount;
    $estimatedResultCount = $json->responseData->cursor->estimatedResultCount;
    $currentPageIndex = $json->responseData->cursor->currentPageIndex;
    $moreResultsUrl = $json->responseData->cursor->moreResultsUrl;
    $searchResultTime = $json->responseData->cursor->searchResultTime;

    $responseData["responseData"]["cursor"]["resultCount"] = $resultCount;
    $responseData["responseData"]["cursor"]["estimatedResultCount"] = $estimatedResultCount;
    $responseData["responseData"]["cursor"]["currentPageIndex"] = $currentPageIndex;
    $responseData["responseData"]["cursor"]["moreResultsUrl"] = $moreResultsUrl;
    $responseData["responseData"]["cursor"]["searchResultTime"] = $searchResultTime;
    array_push($post, $responseData);

    /*
    for ($a = 0; $a < count($json->responseData->cursor->pages); $a++) {

        $start = $json->responseData->cursor->pages[$a]->start;
        $label = $json->responseData->cursor->pages[$a]->label;
        $responseData["responseData"]["cursor"]["pages"][$a]["start"] = $start;
        $responseData["responseData"]["cursor"]["pages"][$a]["label"] = $label;

    }
    //*/
}

//$collection->insert($post);
echo json_encode($post);
//$m ->close();
