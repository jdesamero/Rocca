<?php

//
class RoccaTest_Fixtures_Class_Handler_Simple extends Rocca_Class_Handler
{
	
	protected $_sDefArg1 = '<arg 1 default>';
	protected $_sDefArg2 = '<arg 2 default>';
	
	protected $_sOnce1 = NULL;
	protected $_sOnce2 = NULL;
	
	
	
	//
	public function __construct( $sHandledClass, $aArgs ) {
		
		parent::__construct( $sHandledClass, $aArgs );
		
		list( $sOnce1, $sOnce2 ) = $aArgs;
		
		$this->_sOnce1 = $sOnce1;
		$this->_sOnce2 = $sOnce2;
	}
	
	
	//
	public function getDefArg1() {
		return $this->_sDefArg1;
	}
	
	//
	public function getDefArg2() {
		return $this->_sDefArg2;
	}
	
	
	//
	public function getOnce1() {
		return $this->_sOnce1;	
	}
	
	//
	public function getOnce2() {
		return $this->_sOnce2;	
	}
	
	
	
}



