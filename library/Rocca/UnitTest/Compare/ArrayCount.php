<?php

//
class Rocca_UnitTest_Compare_ArrayCount extends Rocca_UnitTest_Compare
{
	
	protected $_sFailMessage = 'The array has the wrong number of members.';
	
	
	
	// perform comparison
	public function test() {
		return ( $this->_mValue === $this->_mTestValue );
	}
	
	
	//
	public function formatTestValue( $mCompare, $mValue ) {
		
		$mResult = parent::formatTestValue( $mCompare, $mValue );
		
		if (
			( !is_array( $mResult ) ) && 
			!( $mResult instanceof Countable )
		) {
						
			$e = new Rocca_UnitTest_Exception_Type( '%s count()' );
			$e
				->setExpectedValue( 'array or Countable' )
				->setResultValue( $mResult )
			;
			
			throw $e;
		}
		
		return count( $mResult );
	}
	
	
	
}


