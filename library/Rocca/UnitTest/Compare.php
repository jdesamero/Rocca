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
			
			// return formatted values for display, should all be strings
			return array(
				'message' => $this->getFailMessage(),
				'expected_value' => $this->getExpectedFormatted(),
				'result_value' => $this->getResultFormatted()
			);
			
		}
		
		return TRUE;
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
	
	
	
	//// hook'ables and override'ables
	
	//
	public function formatTestValue( $mCompare, $mValue ) {

		if ( is_callable( $mCompare ) ) {
			return call_user_func( $mCompare, $mValue );
		}
		
		return $mCompare;
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
			
			$sFmtValue = $mValue;
			
			if ( is_string( $mValue ) ) {
				$sFmtValue = sprintf( '"%s"', $mValue );
			} elseif ( is_bool( $mValue ) ) {
				$sFmtValue = $mValue ? 'TRUE' : 'FALSE' ;
			} elseif ( is_null( $mValue ) ) {
				$sFmtValue = 'NULL';
			}
			
			$sRes = sprintf( '%s (%s)', $sFmtValue, gettype( $mValue ) );					
		
		} else {
			
			$sRes = sprintf( '"%s"', gettype( $mValue ) );		
		}
		
		return $sRes;	
	}
	
	
}






