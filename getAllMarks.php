<?php 
 require 'vendor/autoload.php';
 $client = new MongoDB\Client;
 $collection = $client->dbforlab->car;

$cursor = $collection -> find();
$res = [];
foreach($cursor as $document){
    array_push($res, $document);   
}
    echo json_encode($res);
?>