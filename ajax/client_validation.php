<?php
require "../functions.php";
if(!empty($_POST)){
	
	$client = new Client();
	
	if(!empty($_POST["clientId"])){
		$clientData = $client->getPersonById($_POST["clientId"]);
	}


	$dataOut = array(
		"clientName" => array(
			"valid" => TRUE,
			"hasClient" => ($client->hasPersonByName($_POST['clientName'])) AND 
							($_POST['clientName'] != $clientData['clientName'])
		),
		"clientEmail" => array(
			"valid" => validateEmail($_POST['clientEmail'],FALSE),
			"hasClient" => ($client->hasPersonByEmail($_POST['clientEmail'])) AND 
							($_POST['clientEmail'] != $clientData['clientEmail'])
		),
		"clientMobile" => array(
			"valid" => validateTel($_POST['clientMobile'],FALSE)
		),
		"clientTel1" => array(
			"valid" => validateTel($_POST['clientTel1'],TRUE)
		),
		"clientTel2" => array(
			"valid" => validateTel($_POST['clientTel2'],TRUE)
		),
		"clientCep" => array(
			"valid" => validateCep($_POST['clientCep'])
		),
		"clientUf" => array(
			"valid" => TRUE
		),
		"clientCity" => array(
			"valid" => validateName($_POST['clientCity'])
		),
		"clientAddress" => array(
			"valid" => validateName($_POST['clientAddress'])
		),
		"clientAddressNum" => array(
			"valid" => validateNum($_POST['clientAddressNum'])
		),
	);
	print json_encode($dataOut);
}

