<?php
require "conn.php";

//Check if orderid was sent
if($_GET['orderid']){
	
	//Define orderid
	$orderid = $_GET['orderid'];

	//Check if order exist
	$rc = "SELECT COUNT(*) FROM orders WHERE orderid = :orderid";
	$rc = $pdo->prepare($rc);
	$rc->bindValue(":orderid",$orderid);
	$rc->execute();
	$rc = $rc->fetchColumn();
	if($rc){

		//Select order
		$order = "SELECT * FROM orders WHERE orderid = :orderid";
		$order = $pdo->prepare($order);
		$order->bindValue(':orderid', $orderid);
		$order->execute();
		$order = $order->fetch();

		//Select client
		$client = "SELECT * FROM clients WHERE clientid = :clientid";
		$client = $pdo->prepare($client);
		$client->bindValue(':clientid',$order['clientid']);
		$client->execute();
		$client = $client->fetch();

		//Check if data was sent for update
		if($_GET['total']){
			
			//Define variables
			$total = $_GET['total'];
			$total = str_replace(",", ".", $total);
			$lastupdate = date('Y-m-d H:i:s', time());

			//Preparing SQL Statement and execute
			$sql = "UPDATE orders SET 
			total = :total,
			lastupdate = :lastupdate
			WHERE orderid = :orderid";
			$sql = $pdo->prepare($sql);
			$sql->bindValue(':total',$total);
			$sql->bindValue(':lastupdate',$lastupdate);
			$sql->bindValue(':orderid',$order['orderid']);
			$sql->execute();

			//Check if edited
			if($sql->rowCount()){
				header('Location:client_info.php?clientid=' . $order['clientid']);
			}else{
				echo "Não foi possível editar.";
			}
		}
	}else{
		//Order doesn't exist
		header('Location:index.php');
	}
}else{
	//Orderid wasn't sent
	header('Location:index.php');
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
<h1><?=$client['name']?><br><small>Editar Pedido</small></h1>

<form>
	<input type="hidden" name="orderid" value="<?=$order['orderid']?>">
	<p>Valor:
		<input type="text" name="total" value="<?=$order['total']?>" />
	</p>
	<input type="submit" value="Editar" class="btn btn-success" />
	<input type="reset" value="Limpar" class="btn btn-warning" />
	<input type="button" value="Cancela" class="btn btn-danger" /	>	
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