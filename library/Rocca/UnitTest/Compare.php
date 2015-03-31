<?php

//
class Rocca_UnitTest_Compare
{
	
	use Rocca_Singleton;
	
	
	
	protected $_mValue;
	protected $_mTestValue;
	
	protected $_sFailMessage = 'This test failed!';
	protected $_bIncludeObjectHash = FALSE;						// include object hash in stringify
	
	
	
	//
	public function setValues( $mValue, $mTestValue ) {
		
		$this->_mValue = $mValue;
		$this->_mTestValue = $mTestValue;
		
		return $this;
	}
	
	
	//
	public function getResult() {
		
		if ( !$this->test() ) {
			return $this->getResultMessage();
		}
		
		return TRUE;
	}
	
	// get meaningful message regarding error
	public function getResultMessage() {
		
		return sprintf(
			'%s Expected: %s, result: %s.',
			$this->getFailMessage(),
			$this->getExpectedFormatted(),
			$this->getResultFormatted()
		);
	}
	
	
	
	//// to be implemented by sub-classes
	
	// perform comparison
	public function test() {
		return FALSE;
	}
	
	//
	public function getFailMessage() {
		return $this->_sFailMessage;
	}
	
	//
	public function getExpectedFormatted() {
		return sprintf( '"%s"', $this->_mValue );
	}
	
	//
	public function getResultFormatted() {
		return sprintf( '"%s"', $this->_mTestValue );
	}
	
	
	
	//// helpers
	
	//
	public function stringifyValue( $mValue ) {
		
		$sRes = '';
		
		if ( is_object( $mValue ) ) {
			
			$sRes = sprintf( '"class %s"', get_class( $mValue ) );
			
			if ( $this->_bIncludeObjectHash ) {
				$sRes .= sprintf( ' (%s)', spl_object_hash( $mValue ) );
			}
			
		} elseif ( is_scalar( $mValue ) || empty( $mValue ) ) {
			
			$sRes = sprintf( '"%s" (%s)', $mValue, gettype( $mValue ) );					
		
		} else {
			
			$sRes = sprintf( '"%s"', gettype( $mValue ) );		
		}
		
		return $sRes;	
	}
	
	
}






