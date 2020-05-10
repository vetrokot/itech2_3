<?php 
require 'vendor/autoload.php';
$collection = (new MongoDB\Client) -> dbforlab -> car;

$race = $_GET["race"];
$race = (integer)$race;
$cond=array("race"=> array('$lt' => $race));
$cursor = $collection -> find($cond);
$res = [];
foreach($cursor as $document){
    array_push($res, $document);   
}
    echo json_encode($res);
?>