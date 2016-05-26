<?php

//
class Rocca_UnitTest_Exception extends Exception
{
	
	use Rocca_Model_GetSet;
	use Rocca_HandleCall;
	
	
	protected $_aCallables = [ 'Model' ];
	
	protected $_sBoilerPlate = '';
	
	
	
	//
	public function getExpectedFormatted() {
		return sprintf( '"%s"', $this->getExpectedValue() );
	}
	
	//
	public function getResultFormatted() {
		return sprintf( '"%s"', $this->getResultValue() );
	}
	
	
	//
	public function getMessageFormatted() {
		
		$sMessage = $this->getMessage();
		
		if (
			( $this->_sBoilerPlate ) && 
			( FALSE !== strpos( $sMessage, '%s' ) )
		) {
			$sMessage = sprintf( $sMessage, $this->_sBoilerPlate );
		}
		
		return $sMessage;
	}

	
}



