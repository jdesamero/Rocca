<?php

//
class RoccaTest_Fixtures_Echo_Model
{
	
	use Rocca_Model_GetSet;
	use Rocca_Echoable;
	use Rocca_HandleCall;
	
	
	protected $_aCallables = [ 'Echo', 'Model' ];
	
	protected $_aModelDefaultValues = [
		'id' => 37231,
		'name' => 'Irving Ross'
	];
	
	
	
	
	//
	public function __construct() {
		$this->modelInit();
	}
	
	
	//
	public function getMessage() {
		return sprintf( 'I am %s!', $this->getName() );
	}
	
	
}


