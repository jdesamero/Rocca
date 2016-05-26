<?php

//
class Rocca_UnitTest_Compare_ThrowsException extends Rocca_UnitTest_Compare
{
	
	protected $_sFailMessage = 'Exception was not thrown!';
	
	
	// do this so we can catch an exception if it is thrown
	public function formatTestValue( $mCompare, $mValue ) {
		
		try {
			
			parent::formatTestValue( $mCompare, $mValue );
			
		} catch ( Exception $e ) {
			
			// return the exact class of exception thrown
			return get_class( $e );
		}
		
		return NULL;
	}
	
	
	// perform comparison
	public function test() {
		return ( $this->_mValue === $this->_mTestValue );
	}
	
	
	
}


