<?php

//
class RoccaTest_Fixtures_Echo_Simple
{
	
	use Rocca_Echoable;
	use Rocca_HandleCall;
	
	protected $_aCallables = array( 'Echo' );
	
	
	
	//
	public function getMessage() {
		return 'I am simple!';
	}
	
	
}


