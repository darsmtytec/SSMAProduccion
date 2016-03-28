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
        if ($user == '') {

        } else {
            $result = mysql_query("SELECT user FROM user WHERE user = '$user' AND password = '$password' ") or die(mysql_errno());
            $result = mysql_fetch_array($result);
        }
        return $result;

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
        $check =mysql_fetch_array($check);
        //cheacar si la palabra ya existe en la taba, si ya existe la activa, si no cre un nuevo registro en la BD
        if($check == false) {
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
                $result =mysql_fetch_array($result);

                return $result;
            } else {
                return false;
            }
        }
        else{
            $result = mysql_query("UPDATE fav_words SET active=1 WHERE  word = '$word'") or die(mysql_errno());
            $result = mysql_query("SELECT id FROM fav_words WHERE word = '$word'") or die(mysql_errno());
            $result =mysql_fetch_array($result);
            return $result;
        }

    }

    public function updateWords($id, $word, $active, $created_date, $created_by){

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
        if(strpos($apis,'t')){
            $twitter = 'true';
        }
        if(strpos($apis,'i')){
            $instagram = 'true';
        }
        $array = array();
        if($twitter == 'true'){
            array_push($array,array("api" => 'twitter'));
        }
        if($instagram == 'true'){
        }
        if($twitter == 'true' && $instagram == 'true'){
            $Query = array("text_clean" => array('$regex' =>  $word), array('$or' => array(
                array("api" => "twitter"),
                array("api" => "instagram")
            )));
        }
        $m = new MongoClient();

        $db = $m->selectDB("ssma");
        $Query = array("text_clean" => array('$regex' =>  $word));
        /*$date = date("dmY", strtotime("2016-03-08"));
        $hoy = date ("dmY");
        $dateCols = [];
        while($date < $hoy){
            echo $date.'<br>';
            array_push($dateCols, $date);
            $date = date("dmY", strtotime($date . '+1 day'));
        }*/
        $dateCols = ['080316','090316','100316','110316','120316','130316','140316','150316','160316','170316','180316','190316'];
        $a = 0;
        for($b = 0; $b< count($dateCols); $b++){
            //$colName = date("dmy");
            $colName = 'col'.$dateCols[$b]; //'col'. $colName;
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
                $arr[$a]["created_at"] = date_format(date_create($col["created_at"]),"d/m/Y");
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
    public function changeSent($id, $sentiment){
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
    public function getProfilePic($name, $api){
        if($api == 'twitter'){
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


        }else if($api="instagram"){

        }
    }
    //</editor-fold>
}