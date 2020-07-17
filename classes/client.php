<?php
class Client extends Person{
	
	function __construct(){
		$this->setPersonFormFieldName();
		parent::__construct();
		
		}

	//Table Info
	protected $personTableName = 'clients';

	//Form elements
	protected $personIdFieldName = 'clientId';
	protected $personNameFieldName = 'clientName';
	protected $personEmailFieldName = 'clientEmail';
	protected $personAddressFieldName = 'clientAddress';
	protected $personAddressNoFieldName = 'clientAddressNum';
	protected $personCityFieldName = 'clientCity';
	protected $personUfFieldName = 'clientUf';
	protected $personCepFieldName = 'clientCep';
	protected $personRegisteredFieldName = 'clientRegistered';
	protected $personLastUpdateFieldName = 'clientLastUpdate';

	protected function setPersonFormFieldName(){
		$this->personFormFieldName = array(
			$this->personIdFieldName,
			$this->personNameFieldName,
			$this->personEmailFieldName,
			'clientMobile',
			'clientTel1',
			'clientTel2',
			$this->personCepFieldName,
			$this->personUfFieldName,
			$this->personCityFieldName,
			$this->personAddressFieldName,
			$this->personAddressNoFieldName,
			$this->personRegisteredFieldName,
			$this->personLastUpdateFieldName
		);
		$this->personFormFieldName = array_combine($this->personFormFieldName, $this->personFormFieldName);
	}
}

