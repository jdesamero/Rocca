<?php

//
class Rocca_UnitTest_Compare_Md5Hash extends Rocca_UnitTest_Compare
{
	
	protected $_sFailMessage = 'The calculated hash value does not match.';
	
	
	
	// perform comparison
	public function test() {
		return ( $this->_mValue === $this->_mTestValue );
	}
	
	
	
	//
	public function formatTestValue( $mCompare, $mValue ) {
		
		$mResult = parent::formatTestValue( $mCompare, $mValue );
		
		if (
			( !is_null( $mResult ) ) && 
			( !is_scalar( $mResult ) )
		) {
			
			$e = new Rocca_UnitTest_Exception_Type( '%s md5()' );
			$e
				->setExpectedValue( 'null or scalar' )
				->setResultValue( $mResult )
			;
			
			throw $e;
		}
		
		return md5( $mResult );
	}

	
	
	
}


