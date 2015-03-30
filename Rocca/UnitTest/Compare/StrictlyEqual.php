<?php

//
class Rocca_UnitTest_Compare_StrictlyEqual extends Rocca_UnitTest_Compare
{
	
	protected $_sFailMessage = 'Values are not strictly equal!';
	protected $_bIncludeObjectHash = TRUE;	
	
	
	
	// perform comparison
	public function test() {
		return ( $this->_mValue === $this->_mTestValue );
	}
	
	//
	public function getExpectedFormatted() {
		return $this->stringifyValue( $this->_mValue );
	}
	
	//
	public function getResultFormatted() {
		return $this->stringifyValue( $this->_mTestValue );
	}
	
		
	
}


