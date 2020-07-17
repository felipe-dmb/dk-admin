<?php
$headTitle = "Head Title";
$pageTitle = "Page Title";
$pageInfo = "Page Info";
$boolBackButton = false;
$backButtonHref = "#";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<title><?=$headTitle?></title>
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
		<a href="index.php" class="active"><li>Home</li></a>
		<a href="clients.php"><li>Clientes</li></a>
		<a href="orders.php"><li>Orçamentos</li></a>
		<a href="orders.php"><li>Pedidos</li></a>
		<a href="#"><li>Pagamentos</li></a>
		<a href="#"><li>Importar Dados</li></a>
	</ul>
</nav>
<!-- Navel Panel Ending -->
</div>

<main class="col-sm-10">
<?php
if($boolBackButton) :?>
<a href="<?=$backButtonHref?>" class="btn-sm btn-secondary">Voltar</a>
<?php endif ?>
<h1><?=$pageTitle?>&nbsp;<small class="page-info"><?=$pageInfo?></small></h1>	
<!-- Main Content -->

</main><!-- Main Content Ending -->

</div><!-- Main Row Ending -->

</div><!-- Container Ending -->

<!-- For Bootstrap -->
<script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="assets/js/popper.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>


</body>
</html>