<?php
require "functions.php";

$client = new Client();
$order = new SaleOrder();

//Page Settings
$pageTitle = "Cliente";
$pageInfo = "Informações";
$activeCode[1] = "active";
$hasBackButton = TRUE;
$backButtonHref = "client.php";

$clientData = $client->getPersonById();
$orderData = $order->getOrderByPersonId();

$rc = $order->hasOrderByPersonId();

require "view" . strrchr(__FILE__, "/");