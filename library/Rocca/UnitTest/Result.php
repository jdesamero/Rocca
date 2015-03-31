<?php

//
class Rocca_UnitTest_Result extends Rocca_Model
{
	
	
	protected $_aModelDefaultValues = array(
		'key' => NULL,
		'fail_message' => NULL,
		'expected_value' => NULL,
		'result_value' => NULL,
		'grouping' => array()
	);
	
	
	
	//
	public function __construct( $sKey, $mResult, $aGrouping = array() ) {
		
		$aValues = array(
			'key' => $sKey,
			'grouping' => $aGrouping
		);
		
		if ( is_array( $mResult ) ) {
			
			// expecting keys: fail_message, expected_value, result_value
			$aValues = array_merge( $aValues, $mResult );
		
		} elseif ( TRUE === $mResult ) {
			
			$aValues[ 'fail_message' ] = FALSE;
			
		}
		
		parent::__construct( $aValues );
		
	}
	
	
	//
	public function getFailed() {
		
		// if value of "fail_message" is not FALSE, then test failed
		
		return ( FALSE !== $this->getFailMessage() );
	}
	
	
	// the title of the test that was run
	public function getTitle() {
		
		// which test was run?
		$sTitle = $this->getKey();
		
		if ( count( $aGrouping = $this->getGrouping() ) > 0 ) {
			$sTitle = sprintf( '%s: %s', implode( ': ', $aGrouping ), $sTitle );
		}
		
		return $sTitle;
	}
	
	
	
}



