<?php
// Defining DB variables
/*
$dbname = "dk";
//$dbname = "test";
$host = "127.0.0.1";
$user = "root";
$pass = "root";

// Try connecting and catch errors
try {
	$pdo = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
}catch(PDOException $e){
	print "Error!" . $e->getMessage() . "<br />";
	die();
}
*/
function connection(){
	$dbname = "dk";
	$host = "127.0.0.1";
	$user = "root";
	$pass = "root";
	try {
		$pdo = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
		return $pdo;
	}catch(PDOException $e){
		print "Error!" . $e->getMessage() . "<br />";
		die();
	}
}
$pdo = connection();
