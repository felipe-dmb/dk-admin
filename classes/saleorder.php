<?php
class SaleOrder extends Order{

	function __construct(){
		//Setting Form Structure
		$this->setOrderFormFieldName();
		parent::__construct();
	}

	//Order Table Info
	protected $orderTableName = "orders";

	//Form Elements
	protected $orderIdFieldName = "orderId";
	protected $orderPersonIdFieldName = "clientId";
	protected $orderRegisteredFieldName = "orderRegistered";
	protected $orderLastUpdateFieldName = "orderLastUpdate";
	protected $orderTotalFieldName = "orderTotal";


	protected function setOrderFormFieldName(){
		$this->orderFormFieldName = array(
			$this->orderIdFieldName,
			$this->orderPersonIdFieldName,
			$this->orderRegisteredFieldName,
			$this->orderLastUpdateFieldName,
			$this->orderTotalFieldName
		);
		$this->orderFormFieldName = array_combine($this->orderFormFieldName, $this->orderFormFieldName);
	}
	//End Form Elements
}


