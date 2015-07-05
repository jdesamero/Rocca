<?php

class Rocca_Model_ClassHandler extends Rocca_Class_Handler
{
	
	//
	public function __construct( $sHandledClass, $aArgs ) {
		
		parent::__construct( $sHandledClass, $aArgs );
		
		list( $aMapping ) = $aArgs;
		
		$this->setMapping( new Rocca_Utility_Mapping( $aMapping ) );
		
	}
	
	
	
}



