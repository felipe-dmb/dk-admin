<?php
require "conn.php";
//Check if ClientID was sent
if($_GET['clientid']){

	//Define ClientID
	$clientid = $_GET['clientid'];

	//Check if client exists and fetch
	$rc = "SELECT Count(*) FROM clients WHERE clientid = :clientid";
	$rc = $pdo->prepare($rc);
	$rc->bindValue(':clientid',$clientid);
	$rc->execute();
	$rc = $rc->fetchColumn();
	if($rc){

		//Select client
		$sql = "SELECT * FROM clients WHERE clientid = :clientid";
		$sql = $pdo->prepare($sql);
		$sql->bindValue(':clientid',$clientid);
		$sql->execute();
		$clients = $sql->fetch();

		//Check if any order exists
		$rc_order = "SELECT Count(*) FROM orders WHERE clientid = :clientid";
		$rc_order = $pdo->prepare($rc_order);
		$rc_order->bindValue(':clientid',$clientid);
		$rc_order->execute();
		$rc_order = $rc_order->fetchColumn();
		if($rc_order){

			//Select orders
			$sql = "SELECT * FROM orders WHERE clientid = :clientid ORDER BY lastupdate DESC";
			$sql = $pdo->prepare($sql);
			$sql->bindValue(':clientid',$clientid);
			$sql->execute();
			$orders = $sql->fetchAll();

		}else{
			$orders = array();//To avoid errors if empty
		}

		
	}else{
		header('Location:index.php');
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

<h1>
	<?=$clients['name']?>&nbsp;
	<a class="btn btn-danger btn-sm" href="rm_client.php?clientid=<?=$clients['clientid']?>">- Remover</a>
	<a class="btn btn-primary btn-sm" href="edit_client.php?clientid=<?=$clients['clientid']?>">Editar</a>

</h1>
<h2>
	Pedidos
	<a class="btn btn-success btn-sm" href="add_order.php?clientid=<?=$clients['clientid']?>">
		+ Adicionar Pedido
	</a>
</h2>
<table class="table">
	<tr>
		<th>No. Pedido</th>
		<th>Última Atualização</th>
		<th>Total</th>
		<th>Ações</th>
	</tr>
	<?php 
	//Retrieving Orders
	foreach($orders as $row):?>
		<tr>
			<td><?=$row['orderid']?></td>
			<td><?=date('d/m/Y',strtotime($row['lastupdate']))?></td>
			<td><?="R$ ".number_format($row['total'],2,',','.')?></td>
			<td>
				<a href="rm_order.php?orderid=<?=$row['orderid']?>" class="btn btn-danger">Remover</a>
				<a href="edit_order.php?orderid=<?=$row['orderid']?>" class="btn btn-primary">Editar</a>
			</td>
		</tr>
	<?php endforeach;?>
</table>
</div><!-- Main Content Ending -->

</div><!-- Main Row Ending -->

</div><!-- Container Ending -->

<!-- For Bootstrap -->
<script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="assets/js/popper.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>


</body>
</html>