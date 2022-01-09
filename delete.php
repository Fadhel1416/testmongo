<?php

  require 'vendor/autoload.php';  
  Use MongoDB\Client as MongoClient ;
  use MongoDB\BSON\ObjectId as MongoId;

  /*
// Creating Connection  
/*$con = new MongoDB\Client("mongodb://localhost:27017");  
// Creating Database  
$db = $con->javatpoint;  
// Creating Document  
$collection = $db->employee;  
// Insering Record  
$collection->insertOne( [ 'name' =>'ali', 'email' =>'alifadhel@abc.com' ] );  
// Fetching Record  
$record = $collection->find( [ 'name' =>'ali'] );  
foreach ($record as $employe) {  
echo $employe['name'], ': ', $employe['email']."<br>";  
} */
session_start();
$m =new MongoClient("mongodb+srv://Fadhelali:Fadhel1416$@cluster0.cp4ra.mongodb.net/");

// select a database
$db = $m->test2;
$collection = $db->campagne;
// iterate cursor to display title of documents
$cursor=$collection->findOne(["_id"=> new MongoId($_REQUEST["id"])]);
$message="compagnie avec le nom ".$cursor["name"]." a ete supprimer avec sucess";

$cursor2=$collection->deleteOne(["_id"=> new MongoId($_REQUEST["id"])]);
$_SESSION["message"]=$message;
header("Location:index.php");


?>