<?php
spl_autoload_register(function($class){
	require_once "classes/" . $class . ".php";
});
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
/************** Validation Functions Begin *********************/
function validateName($str,$canBeEmpty = TRUE){
	
	$isEmpty = empty($str);

	if(!$canBeEmpty){
		if($isEmpty){
			return FALSE;
		}
	}else{
		if($isEmpty){
			return TRUE;
		}
	}
	return TRUE;
}
function validateEmail($email,$canBeEmpty = TRUE){
	
	$isEmpty = empty($email);

	if(!$canBeEmpty){
		if($isEmpty){
			return FALSE;
		}
	}else{
		if($isEmpty){
			return TRUE;
		}
	}

	//Validation pattern
	$isValid = (bool) preg_match('/@{1}/', $email);

	return $isValid;
}
function validateTel($telNo,$canBeEmpty = TRUE){

	$isEmpty = empty($telNo);

	if(!$canBeEmpty){
		if($isEmpty){
			return FALSE;
		}
	}else{
		if($isEmpty){
			return TRUE;
		}
	}
	$needle = array("(",")","-"," ");
	$telNo = str_replace($needle, "", $telNo);
	$pattern = '/^[0-9]{10,11}$/';
	$isValid = (bool) preg_match($pattern, $telNo);
	return $isValid;
}
function validateNum($number,$canBeEmpty = TRUE){

	$isEmpty = empty($number);

	if(!$canBeEmpty){
		if($isEmpty){
			return FALSE;
		}
	}else{
		if($isEmpty){
			return TRUE;
		}
	}

	$pattern = '/^[0-9]+$/';
	$isValid = (bool) preg_match($pattern, $number);
	return $isValid;
}
function validateCep($cep,$canBeEmpty = TRUE){

	$isEmpty = empty($cep);

	if(!$canBeEmpty){
		if($isEmpty){
			return FALSE;
		}
	}else{
		if($isEmpty){
			return TRUE;
		}
	}
	$pattern = '/^[0-9]{8}$|^[0-9]{5}-[0-9]{3}$/';
	$isValid =  (bool) preg_match($pattern, $cep);
	return $isValid;
}
function validateMoney($number){

	//If number is empty, return
	if(empty($number)){
		return boolval(0);
	}

	//Validation pattern
	$bool = preg_match('/^[0-9]+[\.|,]?[1-9]{0,2}[0]*$/', $number);

	if(strpos(",", $number)+1){
		$number = str_replace(",", ".", $number);
	}

	$bool = boolval($bool);
	return [$bool , $number];
}

/************** Validation Functions End *********************/
function dataSort($data,$sortParam,$order = 1){
	foreach ($data as $row) {
		$sort[] = $row[$sortParam];
	}
	if($order == 1){
		array_multisort($sort,SORT_ASC,$data,SORT_ASC);
	}elseif($order == -1){
		array_multisort($sort,SORT_DESC,$data,SORT_DESC);
	}
	return $data;
}