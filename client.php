<?php
require "functions.php";

//Page Settings
$pageTitle = "Clientes";
$hasBackButton = TRUE;
$backButtonHref = "index.php";
$activeCode[1] = "active";
$client = new Client();
$firstLetter = $_GET['fl']??null;

if(!empty($firstLetter)){
	$clientData = $client->getPersonByFirstLetter($firstLetter);
}else{
	$clientData = $client->getPersonOrderBy("clientLastUpdate");
}


$clientRC = $client->rowCountAll();

require "view". strrchr(__FILE__, "/");