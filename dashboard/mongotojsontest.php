<?php
/**
 * Created by PhpStorm.
 * User: Neosony
 * Date: 3/14/2016
 * Time: 4:09 PM
 */

$m = new MongoClient();
// select a database
$db = $m->ssma;
//select a Collection

$collection = $db->selectCollection("col150316");
$collMerge = $db->selectCollection("testMerge");

$Query = array('api' => 'instagram');

$cursor = $collection->find();
var_dump($cursor->count());


    foreach ( $cursor as $id => $value )
    {
        try {
            if($value!=null) {
                //$collection->update($arraySearch[$c], array("upsert" => true));
                $collMerge->insert($value);
                $collMerge->ensureIndex(array('id_post' => 1), array('unique' => 1, 'dropDups' => 1));
            }

        }
        catch (MongoWriteConcernException $e) {
            echo $e->getMessage(), "\n";
        }

    }






?>

