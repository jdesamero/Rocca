<?php

//
class RoccaTest_Fixtures_Collection_Array_Simple
	implements Iterator, ArrayAccess, Countable
{
	
	use Rocca_Collection_Array;
	
	
	//
	public function __construct( $mMembers = NULL ) {
		
		
		// add members
		if ( $mMembers ) {
			$this->add( $mMembers );
		}
		
	}
	
	
}


