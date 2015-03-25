<?php

class Rocca_Model_RegistryHandler extends Rocca_Class_Registry_Handler
{
	
	//
	public function __construct( $sInstanceClass, $aArgs ) {
	
	}
	
	//
	public function get() {
		
		$aArgs = func_get_args();
		
		$sKey = array_shift( $aArgs );
		
		return array( $sKey, $aArgs );
	}
	
}



