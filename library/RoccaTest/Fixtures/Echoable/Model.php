<?php

//
class RoccaTest_Fixtures_Echoable_Model
{
	
	use Rocca_Model_GetSet;
	use Rocca_Echoable;
	use Rocca_Plugin_Assign;
	use Rocca_HandleCall;
	
	
	protected $_aCallables = [ 'Echo', 'Model' ];
	
	
	
	//
	public function __construct() {
		
		$this->addPlugins( 'RoccaTest_Fixtures_Echoable_Model_Plugin' );
		
		$this->modelInit();
	}
	
	
	//
	public function getMessage() {
		return sprintf( 'I am %s!', $this->getName() );
	}
	
	
}


