<?php 
require 'vendor/autoload.php';

$collection = (new MongoDB\Client)->dbforlab->rent;


// 86 400‬ = one day
$date = $_GET["date"];
$date = strtotime($date);

$cursor = $collection -> find();
$res = [];
foreach($cursor as $document){
    
    if($date >= $document["dateend"]){
        $rent = intdiv($document["dateend"] - $document["datestart"], 86400) * $document["cost"];
        $car[0] = $document["car"];
        $car[1] = $rent;
        $car[2] = $document["cost"];
        array_push($res, $car); 
        
    }else if($date < $document["dateend"] && $date >= $document["datestart"]){
        $rent = intdiv($date - $document["datestart"], 86400) * $document["cost"];
        $car[0] = $document["car"];
        $car[1] = $rent;
        $car[2] = $document["cost"];
        array_push($res, $car);  
    }
}
    echo json_encode($res);
?>