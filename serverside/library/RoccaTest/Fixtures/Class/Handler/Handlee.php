<?php

//
class RoccaTest_Fixtures_Class_Handler_Handlee
{
	
	protected $_sArg1 = NULL;
	protected $_sArg2 = NULL;
	
	protected $_sInstanceClass = NULL;
	
	
	
	//
	public function __construct( $sArg1 = NULL, $sArg2 = NULL ) {
		
		$this->_sInstanceClass = get_class( $this );
		
		// class handler init, this can only happen once
		$oHandler = Rocca_Class_Handler::factory(
			$this->_sInstanceClass, 'RoccaTest_Fixtures_Class_Handler_Simple', '<apple>', '<banana>'
		);
		
		$this->_sArg1 = $sArg1 ?: $oHandler->getDefArg1();
		$this->_sArg2 = $sArg2 ?: $oHandler->getDefArg2();
	}
	
	
	
	//
	public function getArg1() {
		return $this->_sArg1;
	}
	
	//
	public function getArg2() {
		return $this->_sArg2;
	}
	
	
	
	
	// get the handler of the handlee
	public function getClassHandler() {
		return Rocca_Class_Handler::factory( $this->_sInstanceClass );
	}
	
	
	
	// this should have no effect
	public function callHandlerAgain() {

		// class handler init, this can only happen once
		Rocca_Class_Handler::factory(
			$this->_sInstanceClass, 'RoccaTest_Fixtures_Class_Handler_Simple', '<cabbage>', '<onion>'
		);
		
	}

	
	
}


