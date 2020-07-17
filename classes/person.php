<?php
class Person {

	function __construct(){
		$this->setPDO();
		$this->setPersonTable($this->personTableName,$this->pdo);
		$this->setPersonTableField();
	}
	
	//Table Info
	protected $personTableName;
	protected $personTable;
	protected $personTableField;

	protected function setPersonTable($personTableName,$pdo){
		$this->personTable = new Table($personTableName,$pdo);
	}

	protected function setPersonTableField(){
		$this->personTableField = $this->personTable->getTableField();
		$this->personTableField = array_combine($this->personFormFieldName, $this->personTableField);
	}

	public function getPersonTable(){
		return $this->personTable;
	}

	public function getPersonTableField(){
		return $this->personTableField;
	}

	public function getPersonTableName(){
		return $this->personTableName;
	}
	//End Table Info

	//Connection
	protected $pdo;

	protected function setPDO(){
		$this->pdo = connection();
	}

	//Form Elements
	protected $personIdFieldName;
	protected $personNameFieldName;
	protected $personEmailFieldName;
	protected $personAddressFieldName;
	protected $personAddressNoFieldName;
	protected $personCityFieldName;
	protected $personUfFieldName;
	protected $personCepFieldName;
	protected $personRegisteredFieldName;
	protected $personLastUpdateFieldName;

	protected $personFormFieldName;

	public function getPersonFormFieldName(){
		$this->personFormFieldName;
	}

	protected function setPersonFormFieldName(){
		$this->personFormFieldName = array_combine($this->personFormFieldName, $this->personFormFieldName);
	}

	protected function setPersonFormPost($personForm = array() ){
		if(empty($personForm)){
			if(empty($_POST)){
				return;
			}
			foreach($this->personFormFieldName as $key){
				$personForm[$key] = $_POST[$key];
			}
		}
		
		$personForm[$this->personRegisteredFieldName] = date('Y-m-d H:i:s',time());
		$personForm[$this->personLastUpdateFieldName] = date('Y-m-d H:i:s',time());
		return $personForm;
	}
	//End Form Elements

	//Check Methods

	public function hasPersonById($id = NULL){
		$idFieldName = $this->personIdFieldName;

		if(empty($id)){
			if(empty($_GET[$idFieldName])){
				return false;
			}
			$id = $_GET[$idFieldName];
		}

		//Preparing SQL Statement
		//Select Count(*) FROM table WHERE id = :id
		$stm = "SELECT COUNT(*) FROM " . $this->personTableName . " WHERE ";
		$stm .= $this->personTableField[$idFieldName]["Field"] . " = :" . $idFieldName;

		//Connection and Executing
		$rc = $this->pdo->prepare($stm);
		$param = ":" . $idFieldName;
		$rc->bindValue($param,$id);
		$rc->execute();
		$rc->fetchColumn();

		return (bool) $rc;	
	}

	public function hasPersonByName($name = NULL){
		$nameFieldName = $this->personNameFieldName;

		if(empty($name)){
			if(empty($_GET[$nameFieldName])){
				return false;
			}
			$name = $_GET[$nameFieldName];
		}

		//Preparing SQL Statement
		//Select Count(*) FROM table WHERE name = :name
		$stm = "SELECT COUNT(*) FROM " . $this->personTableName . " WHERE ";
		$stm .= $this->personTableField[$nameFieldName]["Field"] . " = :" . $nameFieldName;

		//Connection and Executing
		$rc = $this->pdo->prepare($stm);
		$param = ":" . $nameFieldName;
		$rc->bindValue($param,$name);
		$rc->execute();
		$rc = $rc->fetchColumn();

		return (bool) $rc;	
	}

	public function hasPersonByEmail($email = NULL){
		$emailFieldName = $this->personEmailFieldName;

		if(empty($email)){
			if(empty($_GET[$emailFieldName])){
				return false;
			}
			$email = $_GET[$emailFieldName];
		}

		//Preparing SQL Statement
		//Select Count(*) FROM table WHERE id = :id
		$stm = "SELECT COUNT(*) FROM " . $this->personTableName . " WHERE ";
		$stm .= $this->personTableField[$emailFieldName]["Field"] . " = :" . $emailFieldName;

		//Connection and Executing
		$rc = $this->pdo->prepare($stm);
		$param = ":" . $emailFieldName;
		$rc->bindValue($param,$email);
		$rc->execute();
		$rc = $rc->fetchColumn();

		return (bool) $rc;	
	}

	//Select Methods

	protected function personSelectAllStatement(){
		$formFieldName = $this->personFormFieldName;

		//Preparing SQL Statement
		//SELECT field as fieldName, ... FROM table
		$stm = "SELECT ";
		foreach($formFieldName as $key){
			$stm_array[] = $this->personTableField[$key]['Field'] . ' as ' . $key;
		}
		$stm .= implode(",",$stm_array) . ' FROM ';
		unset($stm_array);
		$stm .= $this->personTableName;

		return $stm;
	}

	public function getPersonOrderBy($orderBy, $limitRow = NULL, $limitOffset = 0){
		$stm = $this->personSelectAllStatement();
		$stm .= " ORDER BY " . $this->personTableField[$orderBy]["Field"];

		if(!empty($limitRow)){
			$stm .= " LIMIT :limitOffset , :limitRow";
			$limitRow = (int) $limitRow;
			$limitOffset = (int) $limitOffset;
		}

		$person = $this->pdo->prepare($stm);

		if(!empty($limitRow)){
			$person->bindValue(":limitRow", $limitRow, PDO::PARAM_INT);
			$person->bindValue(":limitOffset", $limitOffset, PDO::PARAM_INT);
		}

		$person->execute();
		$person = $person->fetchAll(PDO::FETCH_ASSOC);
		return $person;
	}

	public function getPersonByFirstLetter($firstLetter, $limitRow = NULL, $limitOffset = 0){
		$stm = $this->personSelectAllStatement();
		$nameFieldName = $this->personNameFieldName;

		$stm .= " WHERE " . $this->personTableField[$nameFieldName]["Field"] . " LIKE :firstLetter";
		$stm .= " ORDER BY " . $this->personTableField[$nameFieldName]["Field"];
		if(!empty($limitRow)){
			$stm .= " LIMIT :limitOffset , :limitRow";
			$limitRow = (int) $limitRow;
			$limitOffset = (int) $limitOffset;
		}

		$person = $this->pdo->prepare($stm);

		$firstLetter .= "%";
		$person->bindValue(":firstLetter",$firstLetter);

		if(!empty($limitRow)){
			$person->bindValue(":limitRow", $limitRow, PDO::PARAM_INT);
			$person->bindValue(":limitOffset", $limitOffset, PDO::PARAM_INT);
		}

		$person->execute();
		$person = $person->fetchAll(PDO::FETCH_ASSOC);
		return $person;

	}

	public function getPersonSelectAll($limitRow = NULL, $limitOffset = 0){
		$stm = $this->personSelectAllStatement();

		if(!empty($limitRow)){
			$stm .= " LIMIT :limitOffset , :limitRow";
			$limitRow = (int) $limitRow;
			$limitOffset = (int) $limitOffset;
		}

		$person = $this->pdo->prepare($stm);

		if(!empty($limitRow)){
			$person->bindValue(":limitRow", $limitRow, PDO::PARAM_INT);
			$person->bindValue(":limitOffset", $limitOffset, PDO::PARAM_INT);
		}

		$person->execute();
		$person = $person->fetchAll(PDO::FETCH_ASSOC);

		return $person;
	}

	public function getPersonById($id = NULL){
		$idFieldName = $this->personIdFieldName;

		if(empty($id)){
			if(empty($_GET[$idFieldName])){
				return FALSE;
			}
			$id = $_GET[$idFieldName];
		}

		$hasPerson = $this->hasPersonById($id);
		if(!$hasPerson){
			return FALSE;
		}

		//Preparing SQL Statement
		//Select * FROM table WHERE id = :id
		$stm = $this->personSelectAllStatement();
		$stm .= ' WHERE ' . $this->personTableField[$idFieldName]["Field"] . " = :" . $idFieldName;

		//Connection and Executing
		$person = $this->pdo->prepare($stm);
		$param = ":" . $idFieldName;
		$person->bindValue($param,$id);
		$person->execute();
		$person = $person->fetch(PDO::FETCH_ASSOC);

		return $person;
	}

	public function searchPerson($searchValue, $seachFieldName, $limitRow = NULL , $limitOffset = 0){
		
	}

	public function rowCountAll(){

		$stm = "SELECT COUNT(*) FROM " . $this->personTableName;

		//Connection
		$rc = $this->pdo->query($stm);
		$rc = $rc->fetchColumn();
		return $rc;
	}

	//Insert Methods

	public function insertPerson(){
		if(empty($_POST)){
			return FALSE;
		}

		$personForm = $this->setPersonFormPost();
		$formFieldName = $this->personFormFieldName;
		unset($formFieldName[$this->personIdFieldName]);

		//Preparing SQL Statement
		//INSERT INTO table (field, ...) VALUES (:fieldName, ....)
		$stm = "INSERT INTO " . $this->personTableName;
		foreach($formFieldName as $key){
			$stm_array[0][] = $this->personTableField[$key]['Field'];
			$stm_array[1][] = ":" . $key;
		}
		$stm .= " (" . implode(",", $stm_array[0]) . ") VALUES";
		$stm .= " (" . implode(",", $stm_array[1]) . ")";
		unset($stm_array);

		$add = $this->pdo->prepare($stm);
		foreach ($formFieldName as $key) {
			$isEmpty = empty($personForm[$key]);
			if($isEmpty){
				$personForm[$key] = NULL;
			}
			$param = ":" . $key;
			$value = $personForm[$key];
			$add->bindValue($param,$value);
		}
		$add->execute();
		return $add->rowCount();
	}
	//End Insert Methods

	//Update Methods
	public function updatePerson(){
		$idFieldName = $this->personIdFieldName;

		if(empty($_POST[$idFieldName])){
			return FALSE;
		}

		$hasPerson = $this->hasPersonById($_POST[$idFieldName]);
		if(!$hasPerson){
			return FALSE;
		}

		$personForm = $this->setPersonFormPost();
		$id = $personForm[$idFieldName];
		$formFieldName = $this->personFormFieldName;
		unset($formFieldName[$personRegisteredFieldName]);
		unset($formFieldName[$personIdFieldName]);

		//Preparin SQL Statement
		$stm = "UPDATE " . $this->personTableName . " SET ";
		foreach($formFieldName as $key){
			$stm_array[] = $this->personTableField[$key]["Field"] . " = :" . $key;
		}
		$stm .= implode(" , ", $stm_array);
		unset($stm_array);
		$stm .= " WHERE " . $this->personTableField[$idFieldName]["Field"] . " = :" . $idFieldName;

		//Connection and Executing
		$edit = $this->pdo->prepare($stm);
		foreach($formFieldName as $key){
			$isEmpty = empty($personForm[$key]);
			if($isEmpty){
				$personForm[$key] = NULL;
			}
			$param = ":" . $key;
			$value = $personForm[$key];
			$edit->bindValue($param,$value);
		}
		$param = ":" . $idFieldName;
		$value = $id;
		$edit->bindValue($param,$value);
		$edit->execute();

		return $edit->rowCount();

	}

	//Remove Methods
	public function deletePerson(){
		$idFieldName = $this->personIdFieldName;

		if(empty($_POST[$idFieldName])){
			return FALSE;
		}
		$hasPerson = $this->hasPersonById($_POST[$idFieldName]);
		if(!$hasPerson){
			return FALSE;
		}
		$id = $_POST[$idFieldName];

		$stm = "DELETE FROM " . $this->personTableName . " WHERE ";
		$stm .= $this->personTableField[$idFieldName]["Field"] . " = :" . $idFieldName;

		$del = $this->pdo->prepare($stm);
		$param = ":" . $idFieldName;
		$del->bindValue($param,$id);
		$del->execute();

		return $del->rowCount();
	}
}