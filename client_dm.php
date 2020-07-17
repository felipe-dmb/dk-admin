<?php
require "functions.php";
$client = new Client();

if (!empty($_POST['st'])) {
//Check if data was sent for manipulation
	switch ($_POST['st']) {

		//Edit Manipulation
		case 'edit':
			$clientEdit = $client->updatePerson();
			if($clientEdit){
				header("Location:client.php");
			}
			else{
				$msg = "Falha ao editar.";
			}
			break;

		//Delete Manipulation
		case 'rm':
			$clientDelete = $client->deletePerson();
			if($clientDelete){
				header("Location:client.php");
			}else{
				$msg = "Falha ao excluir.";
			}
			break;

		//Insert Manipulation
		case 'add':
			$clientAdd = $client->insertPerson();
			if($clientAdd){
				header("Location:client.php");
			}else{
				$msg = "Falha ao adicionar.";
			}
			break;
		
		default:
			break;
	}
}
//Page Settings
$pageTitle = "Clientes";
$hasBackButton = TRUE;
$backButtonHref = "client.php";
$activeCode[1] = "active";


//Page Variables
$st = $_GET['st']?? "add";
$hasClient = $client->hasPersonById();
if ($hasClient) {
	$clientData = $client->getPersonById();
} else {
	$clientData = null;
}




switch ($st) {
	case 'edit':
		$pageInfo = "Editar";
		$disabled = "";
		if(!$hasClient){
			header("Location:client.php");
		}
		break;

	case 'rm':
		$pageInfo = "Remover";
		$disabled = "disabled";
		if(!$hasClient){
			header("Location:client.php");
		}
		break;

	default:
		$pageInfo = "Adicionar";
		$disabled = "";
		break;
}

require "view" . strrchr(__FILE__, "/");