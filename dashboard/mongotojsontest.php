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
$collection = $db->selectCollection("col140316");

$cursor = $collection->find();

echo json_encode(iterator_to_array($cursor, false), true);