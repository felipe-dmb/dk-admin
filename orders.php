<?php
require "conn.php";

//Selecting orders
$sql = "SELECT orders.*, clients.name FROM orders 
		LEFT JOIN clients ON orders.clientid = clients.clientid 
		ORDER BY lastupdate DESC";
$sql = $pdo->query($sql);

//Check if any order exists and fetch
$rc = "SELECT COUNT(*) FROM orders";
$rc = $pdo->query($rc);
$rc = $rc->fetchColumn();
if($rc){
	$result = $sql->fetchAll();
}else{
	$result = array();//To avoid errors if empty
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
<h1>Pedidos</h1>
<table class="table">
	<tr>
		<th>No. Pedido</th>
		<th>Nome do Cliente</th>
		<th>Data</th>
		<th>Total</th>
		<th>Ações</th>
	</tr>
	<?php foreach($result as $row):?>
		<tr>
			<td><?=$row['orderid']?></td>
			<td><?=$row['name']?></td>
			<td><?=date('d/m/Y',strtotime($row['lastupdate']))?></td>
			<td>R$ <?=number_format($row['total'],2,",",".")?></td>
			<td>
				<a href="rm_orders.php?orderid=<?=$row['orderid']?>" class="btn btn-danger">Remover</a>
				<a href="edit_orders.php?orderid=<?=$row['orderid']?>" class="btn btn-primary">Editar</a>
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