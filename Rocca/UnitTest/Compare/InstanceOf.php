<?php

//
class Rocca_UnitTest_Compare_InstanceOf extends Rocca_UnitTest_Compare
{
	
	protected $_sFailMessage = 'Value is not the correct instance!';
	
	
	
	// perform comparison
	public function test() {
		return ( $this->_mTestValue instanceof $this->_mValue );
	}
	
	//
	public function getExpectedFormatted() {
		return sprintf( 'class %s', $this->_mValue );
	}
	
	//
	public function getResultFormatted() {		
		return $this->stringifyValue( $this->_mTestValue );
	}
	
		
	
}


