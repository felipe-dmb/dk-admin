<?php
require "conn.php";

//Check if clientid was sent
if($_GET['clientid']){

	//Define id
	$clientid = $_GET['clientid'];

	//Check if client exists
	$rc = "SELECT COUNT(*) FROM clients WHERE clientid = :clientid";
	$rc = $pdo->prepare($rc);
	$rc->bindValue(":clientid",$clientid);
	$rc->execute();
	$rc = $rc->fetchColumn();
	if($rc){

		//Select client
		$sql = "SELECT * FROM clients WHERE clientid = :clientid";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(":clientid",$clientid);
		$sql->execute();
		$result = $sql->fetch();

		//Check if Order was sent
		if($_GET['total']){

			//Define variables
			$total = $_GET['total'];
			$total = str_replace(',', '.', $total);
			$registered = date('Y-m-d H:i:s',time());
			$lastupdate = date('Y-m-d H:i:s',time());

			//Preparing SQL statement
			$sql = "INSERT INTO orders 
			(clientid , registered, lastupdate , total) VALUES 
			(:clientid , :registered , :lastupdate , :total)";
			$sql = $pdo->prepare($sql);
			$sql->bindValue(":clientid",$result['clientid']);
			$sql->bindValue(":registered",$registered);
			$sql->bindValue(":lastupdate",$lastupdate);
			$sql->bindValue(":total",$total);
			$sql->execute();
			
			//Check if added
			if($sql->rowCount()){
				header("Location:index.php");
			}else{
				echo "Não foi possível adicionar.";
			}
		}
	}else{
		header("Location:index.php");
	}

}else{
	header("Location:index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>

	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body>


<div class="container-fluid">
<div class="row">
<!-- Main row -->

<div class="col-sm-2">
<!-- Navel Panel -->	

</div><!-- Navel Panel Ending -->

<div class="col-sm-10">
	<p id="title-dk">DK Administração</p>
	<hr/>
<!-- Main Content -->
<h1><?=$result['name']?></h1>

<h2>Adicionar Pedido</h2>
<form method="GET">
	Valor:<br /><br />
	<input type="hidden" name="clientid" value="<?=$result['clientid']?>">
	<input type="text" name="total"/>
	<input type="submit" class="btn btn-success" value="Enviar" />
	<input type="reset" class="btn btn-warning" value="Limpar" />
	<input type="button" class="btn btn-danger" value="Cancelar" 
	onclick="location.href='client_info.php?clientid=<?=$result['clientid']?>'" />
</form>
</div><!-- Main Content Ending -->

</div><!-- Main Row Ending -->

</div><!-- Container Ending -->

<!-- For Bootstrap -->
<script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="assets/js/popper.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>


</body>
</html>