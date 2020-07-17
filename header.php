<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<title>Admin</title>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body>

<div class="nav-bg">&nbsp;</div>
<div class="container-fluid">
<header class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-10">
		<p id="title-dk">DK Administração</p>
		<hr/>
	</div>
</header>

<div class="row">
<!-- Main row -->
<div class="col-sm-2 p-0">
<!-- Navel Panel -->
<nav>
	<ul class="list-unstyled">
		<a href="index.php" class="<?php echo isset($activeCode[0])?$activeCode[0]:''?>"><li>Home</li></a>
		<a href="client.php" class="<?php echo isset($activeCode[1])?$activeCode[1]:''?>"><li>Clientes</li></a>
		<a href="orders.php" class="<?php echo isset($activeCode[2])?$activeCode[2]:''?>"><li>Orçamentos</li></a>
		<a href="orders.php" class="<?php echo isset($activeCode[3])?$activeCode[3]:''?>"><li>Pedidos</li></a>
		<a href="#" class="<?php echo isset($activeCode[4])?$activeCode[4]:''?>"><li>Pagamentos</li></a>
		<a href="#" class="<?php echo isset($activeCode[5])?$activeCode[5]:''?>"><li>Importar Dados</li></a>
	</ul>
</nav>
<!-- Navel Panel Ending -->
</div>

<main class="col-sm-10">
<?php
if($hasBackButton) :?>
<a href="<?=$backButtonHref?>" class="btn-sm btn-secondary">Voltar</a>
<?php endif ?>
<h1><?=$pageTitle?>&nbsp;<small class="page-info"><?php echo isset($pageInfo)?$pageInfo:''?></small></h1>	
<!-- Main Content -->