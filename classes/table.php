<?php
class Table {
	
	private $tableName;
	private $tableField;

	function __construct($tN,$pdo){
		$this->setTableName($tN);
		$this->setTableField($pdo);
	}

	private function setTableName($tN){
		$this->tableName = $tN;
	}
	
	private function setTableField($pdo){
			$sql = "DESCRIBE " . $this->tableName;
			$sql = $pdo->query($sql);
			$this->tableField = $sql->fetchAll(PDO::FETCH_ASSOC);
		}

	public function getTableName(){
		return $this->tableName;
	}

	public function getTableField(){
		return $this->tableField;
	}
}
