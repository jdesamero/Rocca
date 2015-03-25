<?php

//
class Some_Single
{
	
	protected $_aCallables = array( 'Echo', 'Model' );
	
	use Rocca_Singleton;
	use Rocca_Model_GetSet;
	use Rocca_Echoable;
	use Rocca_Data;
	use Rocca_Plugin_Assign;
	use Rocca_HandleCall;
	
	
	
}




