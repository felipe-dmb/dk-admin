<?php
class Order {

	function __construct(){
		//Setting Connection
		$this->setPDO();

		//Setting Table Structure
		$this->setOrderTable($this->orderTableName,$this->pdo);
		$this->setOrderTableField();
	}

	//Order Table Info
	protected $orderTableName;

	protected $orderTable;

	protected $orderTableField;

	protected function setOrderTable($orderTableName,$pdo){
		$this->orderTable = new Table($orderTableName,$pdo);
	}

	protected function setOrderTableField(){
		$this->orderTableField = $this->orderTable->getTableField();
		$this->orderTableField = array_combine($this->orderFormFieldName, $this->orderTableField);
	}

	//End Order Table Info

	//Form Elements
	protected $orderIdFieldName;
	protected $orderPersonIdFieldName;
	protected $orderRegisteredFieldName;
	protected $orderLastUpdateFieldName;
	protected $orderTotalFieldName;

	protected $orderFormFieldName;

	public function getOrderFormFieldName(){
		return $this->orderFormFieldName;
	}

	protected function setOrderFormFieldName(){
		$this->orderFormFieldName = array_combine($this->orderFormFieldName, $this->orderFormFieldName);
	}

	protected function setOrderFormPost($orderForm = array() ){
		foreach ($orderFormFieldName as $key){
			$orderForm[$key] = $_POST[$key];
		}
		$orderForm[$this->orderRegisteredFieldName] = date('Y-m-d H:i:s',time());
		$orderForm[$this->orderLastUpdateFieldName] = date('Y-m-d H:i:s',time());
		return $orderForm;
	}
	//End Form Elements

	//Connection
	protected $pdo;

	protected function setPDO(){
		$this->pdo = connection();
	}

	//Check Methods
	public function hasOrderById($id = NULL){
		$idName = $this->orderIdFieldName;

		if(empty($id)){
			if(empty($_GET[$idName])){
				return FALSE;
			}
			$id = $_GET[$idName];
		}

		//Preparing SQL Statement
		//SELECT COUNT(*) FROM table WHERE id = :id
		$stm = "SELECT COUNT(*) FROM " . $this->orderTableName . " WHERE ";
		$stm .= $this->orderTableField[$idName]["Field"] . " = :" . $idName;

		//Connection
		$rc = $this->pdo->prepare($stm);

		//BindValues
		$rc->bindValue($idName,$id);

		//Execute and Return
		$rc->execute();
		$rc = $rc->fetchColumn();
		return $rc;
	}
	public function hasOrderByPersonId($id = NULL){
		$idName = $this->orderPersonIdFieldName;

		if(empty($id)){
			if(empty($_GET[$idName])){
				return FALSE;
			}
			$id = $_GET[$idName];
		}

		//Preparing SQL Statement
		//SELECT COUNT(*) FROM table WHERE id = :id
		$stm = "SELECT COUNT(*) FROM " . $this->orderTableName . " WHERE ";
		$stm .= $this->orderTableField[$idName]["Field"] . " = :" . $idName;

		//Connection
		$rc = $this->pdo->prepare($stm);

		//BindValues
		$rc->bindValue($idName,$id);

		//Execute and Return
		$rc->execute();
		$rc = $rc->fetchColumn();
		return $rc;
	}
	//End Check Methods

	//Select Method
	private function orderSelectAllStatement(){
		$formName = $this->orderFormFieldName;
		
		//Preparing SQL Statement
		//SELECT field as formname, .... FROM table
		$stm = "SELECT ";
		foreach ($formName as $key) {
			$stm_array[] = $this->orderTableField[$key]["Field"] . " as " . $key;
		}
		$stm .= implode(",", $stm_array) . " FROM ";
		unset($stm_array);
		$stm .= $this->orderTableName;
		return $stm;
	}

	
	public function getOrderByPersonId($id = NULL){
		$idName = $this->orderPersonIdFieldName;

		if(empty($id)){
			if(empty($_GET[$idName])){
				return FALSE;
			}
			$id = $_GET[$idName];
		}

		//Preparing SQL Statement
		//SELECT field as field, .... FROM table WHERE id = :id
		$stm = $this->orderSelectAllStatement() . " WHERE ";
		$stm .= $this->orderTableField[$idName]["Field"];
		$stm .= " = :" . $idName;


		//Connection
		$select = $this->pdo->prepare($stm);

		//BindValue
		$param = ":" . $idName;
		$select->bindValue($param,$id);
		$select->execute();

		$select = $select->fetchAll(PDO::FETCH_ASSOC);

		return $select;
	}
	//End Select Method

	//Insert Methods
	public function insertOrder(){
		if(empty($_POST)){
			return FALSE;
		}

		$orderForm = $this->setOrderFormPost();
		$stm = "INSERT INTO " . $this->orderTableName . " (";
		$formName = $this->orderFormFieldName;

		//Preparing SQL Statement
		//INSERT INTO table (field1,...) VALUES (:field1,...)
		unset($formName[$this->orderIdFieldName]);
		foreach($formName as $value){
			$stm_array[] = $this->orderTableField[$value]["Field"];
		}

		$stm .= implode(",", $stm_array) .") VALUES ";

		unset($stm_array);
		foreach($formName as $value){
			$stm_array[] = ":".$value;
		}
		$stm .= "(" . implode(",", $stm_array) . ")";
		unset($stm_array);
		//End Statement

		//Connection
		$add = $this->pdo->prepare($stm);
		
		//BindValues
		foreach($formName as $key){
			$isEmpty = empty($orderForm[$key]);
			if($isEmpty){
				$orderForm[$key] = NULL;
			}
			$param = ":" . $key;
			$value = $orderForm[$key];
			$add->bindValue($param,$value);
		}

		//Execute and Return
		$add->execute();
		return $add->rowCount();

	}
	//End Insert Methods

	//Update Methods
	public function updateOrder(){
		$idName = $this->orderIdFieldName;

		if(empty($_POST[$idName])){
			return FALSE;
		}

		$orderForm = $this->setOrderFormPost();
		$stm = "UPDATE " . $this->orderTableName . " SET ";
		$formName = $this->orderFormFieldName;
		$id = $orderForm[$idName];


		//Check if Order exist
		$hasOrder = $this->hasOrderById($id);

		if(!$hasOrder){
			return FALSE;
		}

		//Preparing SQL Statement
		//UPDATE table SET field1 = :field1, ... WHERE id = :id
		unset($formName[$idName]);
		unset($formName[$this->orderRegisteredFieldName]);
		foreach($formName as $key){
			$stm_array[] = $this->orderTableField[$key]["Field"] . " = :" . $key;
		}
		$stm .= implode(" , ", $stm_array);
		unset($stm_array);
		$stm .= " WHERE " . $this->orderTableField[$idName]["Field"] . " = :" . $idName;
		//End SQL Statement

		//Connection
		$edit = $this->pdo->prepare($stm);

		//Binding Values
		foreach ($formName as $key) {
			$isEmpty = empty($orderForm[$key]);
			if($isEmpty){
				$orderForm[$key] = NULL;
			}
			$param = ":". $key;
			$value = $orderForm[$key];
			$edit->bindValue($param,$value);
		}
		$param = ":" . $idName;
		$edit->bindValue($param,$id);
		
		$edit->execute();
		return $edit->rowCount();
	}
	//End Update Methods

	//Delete Methods
	public function deleteClient(){
		
		$idName = $this->orderIdFieldName;
		if(empty($_POST[$idName])){
			return FALSE;
		}

		$orderForm = $this->setOrderFormPost();
		$id = $orderForm[$idName];

		//Check if Order exist
		$hasOrder = $this->hasOrderById($id);

		if(!$hasOrder){
			return FALSE;
		}

		//Preparing SQL Statement
		//DELETE FROM table WHERE id = :id
		$stm = "DELETE FROM " . $this->orderTableName . " WHERE ";
		$stm .= $this->orderTableField[$idName]["Field"] . " = :" . $idName;

		//Connection
		$pdo = connection();
		$del = $pdo->prepare($stm);

		//BindValue
		$param = ":" . $idName;
		$del->bindValue($param,$id);
		$del->execute();

		return $del->rowCount();
	}
	//End Delete Methods
}

