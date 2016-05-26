<?php

//
class RoccaTest_Fixtures_HandleCall_Foo
{
	
	use Rocca_HandleCall;
	
	
	//
	protected $_aCallables = array( 'Foo', 'Bar' );
	
	
	
	//
	public function handleFooCall( $sMethod, $aArgs ) {
		
		$aRegs = array();
		if ( preg_match( '/^foo([^a-z].*)/', $sMethod, $aRegs ) ) {
			
			// return the remainder
			return $aRegs[ 1 ];
		}
		
	}
	
	//
	public function fooCall( $sRemainder, $aArgs ) {
		return sprintf( '%s: %s', $sRemainder, $aArgs[ 0 ] );
	}
	
	
	
	//
	public function handleBarCall( $sMethod, $aArgs ) {

		$aRegs = array();
		if ( preg_match( '/^bar(.*)/', $sMethod, $aRegs ) ) {
			
			// return the remainder
			return $aRegs[ 1 ];
		}
		
	}
	
	//
	public function barCall( $sRemainder, $aArgs ) {
		return sprintf( '%s-%s', $sRemainder, $aArgs[ 0 ] );	
	}
	
	
	
}


