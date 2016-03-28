<?php
/**
 * Created by PhpStorm.
 * User: Edgardo Acosta
 * Date: 2/25/2016
 * Time: 7:39 PM
 */
// connect to mongodb
$m = new MongoClient();

//echo "Conexion establecida";
// select a database
$db = $m->selectDB("ssma");//mydb;
//echo "base de datos seleccionada<br>";

// select collection
$collection = $db->selectCollection("twitter_080316");
//Drop collection
//$collection->drop();
$post = [];

$cursor = $collection->find();
$cursor->limit(2);
$post = (iterator_to_array($cursor));
//var_dump($post);

//var_dump($post["56da7d6066428c30498b4567"][0]["nombre_usuario"]);

foreach ($post as $array) {
    for ($j = 0; $j < count($array); $j++) {
        echo $array[$j]["text_tweet"]." -> ". $array[$j]["text_clean"]."<br><br>";
    }

}
/*
for ($j = 0; $j < count($cursor[0]); $j++) {
    for ($i = 0; $i < count($cursor[0][$j]); $i++) {

        var_dump($cursor[0][$j][$i]["nombre_usuario"]);
        echo "<br>";

    }
}
//*/

//echo json_encode($post);


/*
//array whit information
$array = array(
    "id_tweet" => "703367807287689216",
    "cant_retweet" => "3",
    "text_tweet" => "RT @fernandeznorona: Estamos esperando a ver la explicaciÃ³n que nos dÃ© @TecdeMonterrey campus QuerÃ©taro https=>//t.co/dURvOyUVWM",
    "text_clean" => "RT @fernandeznorona: Estamos esperando a ver la explicacion que nos de @TecdeMonterrey campus Queretaro https=>//t.co/dURvOyUVWM",
    "id_usuario" => 551404830,
    "nombre_usuario" => "Rebeca",
    "screen_name" => "Rebe_mq",
    "user_description" => "Me encanta estar informada, mi entretenimiento es la polÃ­tica y amo debatir (no soy experta pero lo intento )",
    "foto_perfil" => "http=>//pbs.twimg.com/profile_images/2148533586/Jazm_n_normal.jpg",
    "cuentas_que_sigue" => "299",
    "cuentas_que_lo_siguen" => "231",
    "created_at" => "Fri Feb 26 23:55:27 +0000 2016",
    "in_reply_to_status_id" => "",
    "in_reply_to_screen_name" => "",
    "in_reply_to_user_id_str" => "",
    "location" => "D.F.",
    "protected" => "false",
    "friends_count" => "299",
    "verified" => "false",
    "api" => "twitter",
    "Klout" => 30,
    "model" => "general_es",
    "sentimiento" => "NU"
);

//inser in collection
$collection->insert($array);
//*/
$m->close();