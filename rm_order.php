<?php
require "conn.php";

//Check if orderid was sent
if($_GET['orderid']){

	//Define orderid
	$orderid = $_GET['orderid'];

	//Check if order exists
	$rc = "SELECT COUNT(*) FROM orders WHERE orderid = :orderid";
	$rc = $pdo->prepare($rc);
	$rc->bindValue(":orderid",$orderid);
	$rc->execute();
	$rc = $rc->fetchColumn();
	if($rc){

		//Select order
		$sql = "SELECT * FROM orders WHERE orderid = :orderid";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(":orderid",$orderid);
		$sql->execute();
		$order = $sql->fetch();

		//Select client
		$sql = "SELECT * FROM clients WHERE clientid = :clientid";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(":clientid",$order['clientid']);
		$sql->execute();
		$client = $sql->fetch();

		//Check if confirmation was sent
		if(isset($_GET['confirm'])){

			//Define confirmation
			$conf = $_GET['confirm'];

			//Check confirmation for removing
			if($conf){

			//Preparing SQL Statement and Delete client
			$sql = "DELETE FROM orders WHERE orderid = :orderid";
			$sql = $pdo->prepare($sql);
			$sql->bindValue(':orderid',$orderid);
			$sql->execute();

			//Check if removed
			if($sql->rowCount()){
				header('Location:index.php');
			}else{
				print "Não foi possível remover.";
			}
			}
		}

	}else{
		//Order doesn't exist
		header("Location:index.php");
	}
}else{
	//Orderid wasn't sent
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
<h1><?=$client['name']?><br/><small>Remover Pedido</small></h1>

<p>Pedido No. <?=$order['orderid']?> Última Atualização <?=$order['lastupdate']?></p>
<p>Valor R$ <?=number_format($order['total'],2,',','.')?></p>
<div class="alert alert-danger">
	<form method="GET">
		<p>Tem certeza que deseja excluir esse pedido?</p>
		<input type="hidden" value="<?=$order['orderid']?>" name="orderid"/>
		<input type="hidden" value=1 name="confirm"/>
		<input type="submit" value="Sim" />
		<input type="button" value="Não" 
		onclick='location.href="client_info.php?clientid=<?=$order['clientid']?>"' />
	</form>
</div>
</div><!-- Main Content Ending -->

</div><!-- Main Row Ending -->

</div><!-- Container Ending -->

<!-- For Bootstrap -->
<script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="assets/js/popper.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>


</body>
</html>