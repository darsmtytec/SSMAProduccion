<?php

/**
 * Created by PhpStorm.
 * User: L03037373
 * Date: 07/03/2016
 * Time: 11:02 AM
 */
class DB_Function
{

    //<editor-fold desc="Funciones de la clase">
    private $db;

    // Constructor
    function __construct()
    {
        require_once 'DB_Connect.php';
        // conexion de base de datos
        $this->db = new DB_Connect();
        $this->db->connect();
        $GLOBALS["conexion"] = $this->db->connect();
    }

    // Destructor
    function __destruct()
    {
    }

    //</editor-fold>

    public function getUser($user, $password)
    {
        $password = md5($password);
        if ($user == '') {

        } else {
            $us = mysql_query("SELECT user FROM user WHERE user = '$user' ") or die(mysql_errno());
            if (mysql_num_rows($us) > 0) {
                $pass = mysql_query(" SELECT password FROM user WHERE  password = '$password' AND  user = '$user'") or die(mysql_errno());
                if (mysql_num_rows($pass) > 0) {
                    $query = mysql_query(" SELECT password,user,email,nombre,perfil FROM user WHERE  password = '$password' AND  user = '$user'") or die(mysql_errno());
                    $query = mysql_fetch_array($query);

                    return $query;
                } else {
                    return "wrong password";
                }
            } else {
                return "wrong user";
            }

        }

    }


    public function getWords()
    {

        $words = mysql_query("SELECT word, id FROM fav_words WHERE active = 1") or die(mysql_errno());

        $rawdata = array();
        while ($row = mysql_fetch_array($words)) {

            $row_array['word'] = $row['word'];
            $row_array['id'] = $row['id'];
            array_push($rawdata, $row_array);
        }
        return $rawdata;
    }


    public function insertWords($id, $word, $active, $created_date, $created_by)
    {

        $check = mysql_query("SELECT word FROM fav_words WHERE word = '$word' ") or die(mysql_errno());
        $check = mysql_fetch_array($check);
        //cheacar si la palabra ya existe en la taba, si ya existe la activa, si no cre un nuevo registro en la BD
        if ($check == false) {
            $query1 = " INSERT INTO fav_words(";
            $query2 = " VALUES (";
            $bool = false;
            $bool2 = false;

            if ($id != '') {
                $query1 = $query1 . "id" . ",";
                $query2 = $query2 . "'" . $id . "'" . ",";
                $bool = true;
            }
            if ($word != '') {
                $query1 = $query1 . "word" . ",";
                $query2 = $query2 . "'" . $word . "'" . ",";
                $bool = true;
            }
            if ($active != '') {
                $query1 = $query1 . "active" . ",";
                $query2 = $query2 . "'" . $active . "'" . ",";
                $bool = true;
            }
            if ($created_date != '') {
                $query1 = $query1 . "created_date" . ",";
                $query2 = $query2 . "'" . $created_date . "'" . ",";
                $bool = true;
            }
            if ($created_by != '') {
                $query1 = $query1 . "created_by";
                $query2 = $query2 . "'" . $created_by . "'";
                $bool = true;
                $bool2 = true;
            }
            if ($bool2 == false) {
                $query1 = trim($query1, ',');//Corta el ultimo caracter
                $query2 = trim($query2, ',');//Corta el ultimo caracter
            }


            if ($bool == true) {
                $query1 = $query1 . ")";
                $query2 = $query2 . ")";
                $query = $query1 . $query2;
                //var_dump($query);
                $result = mysql_query($query) or die(mysql_error());
                $result = mysql_query("SELECT id FROM fav_words WHERE word = '$word'") or die(mysql_errno());
                $result = mysql_fetch_array($result);

                return $result;
            } else {
                return false;
            }
        } else {
            $result = mysql_query("UPDATE fav_words SET active=1 WHERE  word = '$word'") or die(mysql_errno());
            $result = mysql_query("SELECT id FROM fav_words WHERE word = '$word'") or die(mysql_errno());
            $result = mysql_fetch_array($result);
            return $result;
        }

    }

    public function updateWords($id, $word, $active, $created_date, $created_by)
    {

        $strQuery = "UPDATE fav_words SET ";
        $bool = false;
        $bool2 = false;

        if ($word != '') {
            $strQuery = $strQuery . "word = " . "'" . $word . "'" . " ,";
            $bool = true;
        }
        if ($active != '') {
            $strQuery = $strQuery . "active = " . "'" . $active . "'" . " ,";
            $bool = true;
        }
        if ($created_date != '') {
            $strQuery = $strQuery . "created_date = " . "'" . $created_date . "'" . " ,";
            $bool = true;
        }
        if ($created_by != '') {
            $strQuery = $strQuery . "created_by = " . "'" . $created_by . "'";
            $bool = true;
            $bool2 = true;
        }

        if (!$bool2) {
            $strQuery = trim($strQuery, ' ,');//Corta el ultimo caracter
        }

        if ($bool == true) {
            $strQuery = $strQuery . " WHERE id =" . "'" . "$id" . "'";
            //var_dump($strQuery);
            $result = mysql_query($strQuery) or die(mysql_error());
            return $result;
        } else {
            // cuendo no concatena nada regresa error
            return false;
        }


    }

    //<editor-fold desc="kiwi fresa">
    public function getData($word, $apis)
    {
        $twitter = false;
        $instagram = false;
        if (strpos($apis, 't')) {
            $twitter = 'true';
        }
        if (strpos($apis, 'i')) {
            $instagram = 'true';
        }
        $array = array();
        if ($twitter == 'true') {
            array_push($array, array("api" => 'twitter'));
        }
        if ($instagram == 'true') {
        }
        if ($twitter == 'true' && $instagram == 'true') {
            $Query = array("text_clean" => array('$regex' => $word), array('$or' => array(
                array("api" => "twitter"),
                array("api" => "instagram")
            )));
        }
        $m = new MongoClient();

        $db = $m->selectDB("ssma");
        $Query = array("text_clean" => array('$regex' => $word));
        /*$date = date("dmY", strtotime("2016-03-08"));
        $hoy = date ("dmY");
        $dateCols = [];
        while($date < $hoy){
            echo $date.'<br>';
            array_push($dateCols, $date);
            $date = date("dmY", strtotime($date . '+1 day'));
        }*/
        $dateCols = ['080316', '090316', '100316', '110316', '120316', '130316', '140316', '150316', '160316', '170316', '180316', '190316','290316'];
        $a = 0;
        for ($b = 0; $b < count($dateCols); $b++) {
            //$colName = date("dmy");
            $colName = 'col' . $dateCols[$b]; //'col'. $colName;
            $collection = $db->selectCollection($colName);

            $cursor = $collection->find($Query);

            foreach ($cursor as $col) {
                $arr[$a]["id_post"] = $col["id_post"];
                $arr[$a]["id_tweet"] = $col["id_tweet"];
                $arr[$a]["likes"] = $col["likes"];
                $arr[$a]["cant_retweet"] = $col["cant_retweet"];
                $arr[$a]["cuentas_que_sigue"] = $col["cuentas_que_sigue"];
                $arr[$a]["cuentas_que_lo_siguen"] = $col["cuentas_que_lo_siguen"];
                $arr[$a]["friends_count"] = $col["friends_count"];
                $arr[$a]["Klout"] = $col["Klout"];
                $arr[$a]["text_clean"] = $col["text_clean"];
                $arr[$a]["created_at"] = date_format(date_create($col["created_at"]), "d/m/Y");
                $arr[$a]["id_usuario"] = $col["id_usuario"];
                $arr[$a]["nombre_usuario"] = $col["nombre_usuario"];
                $arr[$a]["screen_name"] = $col["screen_name"];
                $arr[$a]["foto_perfil"] = $col["foto_perfil"];
                $arr[$a]["sentiment"] = $col["sentiment"];
                $arr[$a]["sentimiento"] = $col["sentimiento"];
                $arr[$a]["url"] = $col["url"];
                $arr[$a]["type"] = $col["type"];

                $arr[$a]["location"] = $col["location"];

                $arr[$a]["api"] = $col["api"];
                $a++;
            }
        }

        $m->close();
        return $arr;
    }

    public function changeSent($id, $sentiment)
    {
        $m = new MongoClient();

        $db = $m->selectDB("ssma");
        $colName = date("dmy");
        $colName = 'col'; //'100316'; //.;00316'; //.;
        $collection = $db->selectCollection($colName);
        $Query = array("id_post" => $id);
        $nuevosdatos = array('$set' => array("sentiment" => $sentiment));
        $cursor = $collection->update($Query, $nuevosdatos);
        $m->close();
        return $cursor;
    }

    public function getProfilePic($name, $api)
    {
        if ($api == 'twitter') {
            header("Access-Control-Allow-Origin: *");
            require_once("/API/twitteroauth.php");

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

            $tweetsAccount = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=" . $accounts[$c]);
            $jsonData = $tweetsAccount;
            $phpArrayAccount = json_decode($jsonData, true);
            //var_dump($phpArrayAccount);
            for ($a = 0; $a < count($phpArrayAccount); $a++) {
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
            }
            /* $m = new MongoClient();
            $db = $m->selectDB("ssma");
            $colName = date("dmy");
            $colName = 'col' . $colName;
            $collection = $db->selectCollection($colName);
             $m->close();
            */


        } else if ($api = "instagram") {

        }
    }

    //</editor-fold>

    //<editor-fold desc="Sentiment">
    private function sendPost($api, $key, $model, $txt){
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

    }

    public function sentimentAnalysis($api, $model, $txt)
    {
        $dbf = new DB_Function();
        $boolean = true;
        $cont = 0;
        $sentiment = "";

        //<editor-fold desc="KEY Sentiment API">
        //$api = 'http://textalytics.com/core/sentiment-1.1';

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
        $model = 'auto'; //general_es general_en general_fr auto  // es-general/en-general/fr-general/en-reputation/es-reputation DEPRECATED
        $keyIndex = 0;

        //</editor-fold>

         while($boolean) {
             $response = $dbf->sendPost($api, $key[$keyIndex], $model, $txt);

             $json = json_decode($response, true);
             //$json['status']['remaining_credits'] //Creditos restantes
             if (isset($json['status']) && isset($json['status']['code'])) {
                 if ($json['status']['code'] == '0') {
                     $boolean = false;

                     $sentiment = $json['score_tag'];
                     $mod = $json['model'];

                 } // 102: You have exceeded the maximum number of credits per month
                 //Creditos agotados
                 elseif ($json['status']['code'] == '102' || $json['status']['code'] == '101') {
                     $var = true;
                     while ($var):
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
                     endwhile;
                 }
                 elseif ($json['status']['code'] == '100' || $json['status']['code'] == '202' || $json['status']['code'] == '203') {
                     sleep(5);
                     //$sentiment = 'No disponible';
                 }
                 //Contenido demasiado largo
                 elseif ($json['status']['code'] == '103') {
                     $boolean = false;
                     //$sentiment = 'Request too large.';
                     $sentiment = 'NONE';
                 }
                 elseif ($json['status']['code'] == '104') {
                     sleep(5);
                     //echo '<br> Request rate limit exceeded.';
                     //$sentiment = 'Request rate limit exceeded.';
                 }
                 elseif ($json['status']['code'] == '200') {
                     sleep(5);
                     //echo '<br> Par�metro faltante.';
                     //$sentiment = ' Parametro faltante.';
                 }
                 //Lenguaje no soportado
                 elseif ($json['status']['code'] == '201' || $json['status']['code'] == '204') {
                     $sentiment = "NONE";
                     $boolean =false;
                     //$sentiment = 'Lenguaje no soportado.';
                 }
                 else {
                     $sentiment = 'N';
                 }
                 //<editor-fold desc="CODE">
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
                 //</editor-fold>
             }

             // contador para salir del while en caso no realizar ninguna accion
             if($cont > 2){
                 $boolean = false;
             }
             $cont++;


         }
        return $sentiment;

    }
    //</editor-fold>

    //<editor-fold desc="Klout">
    public function klout($user){
        $kloutKey[0] = 'hjsske2mer3th85ub6e5bw82';
        $kloutKey[1] = 'bjp5e6qzeq7ay9yzydh2uq2d'; //darstecmty@gmail.com RedesSociales1
        $kloutKey[2] = 'fwfzgh4g55mcrytauvew9pmv'; //e.acosta@itesm.mx

        $i=0;
        $bol= false;

        while(!$bol) {
            $jsonK = file_get_contents("http://api.klout.com/v2/identity.json/tw/" . $user . "?key=" . $kloutKey[$i]);
            if($jsonK== false){
                $i++;
            }
            else{
                $bol=true;
            }

            //echo "http://api.klout.com/v2/identity.json/tw/" . $user . "?key=" . $kloutKey[$i];
        }
        $kloutID = json_decode($jsonK, true);
        //var_dump($kloutID['id']);

        $json1 = file_get_contents("http://api.klout.com/v2/user.json/" . $kloutID['id'] . "?key=" . $kloutKey[$i]);
        $kloutScore = json_decode($json1, true);
        $kloutUser = $kloutScore['score']['score'];
        $scoreKlout = intval($kloutUser);

        return $scoreKlout;

    }
    //</editor-fold>

}