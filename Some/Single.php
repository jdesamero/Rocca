<?php

//
class Some_Single
{
	
	protected $_aCallables = array( 'Echo', 'Model' );
	
	use Rocca_Singleton;
	use Rocca_Model_Trait;
	use Rocca_Echoable;
	use Rocca_Data;
	use Rocca_Plugin_Trait;
	use Rocca_HandleCall;
	
	
	
}




