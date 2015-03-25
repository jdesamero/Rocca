<?php

class Rocca_Collection
	implements Iterator, ArrayAccess, Countable
{
	
	use Rocca_Plugin_Assign;
	use Rocca_Collection_Array;
	
	
	protected $_sInstanceClass = NULL;
	protected $_sModelClass = NULL;
	
	
	//
	public function __construct( $mMembers = NULL ) {
		
		
		// resolve related classes
		
		$this->_sInstanceClass = get_class( $this );
		
		$this->_sModelClass = Rocca_Class::resolveRelated(
			$this->_sInstanceClass, NULL, '_Collection', $this->_sModelClass
		);
		
		
		// add members
		
		if ( $mMembers ) {
			$this->add( $mMembers );
		}
		
	}
	
	// implement member formatter
	public function formatMember( $mMember ) {
		
		if ( is_array( $mMember ) ) {
			return new $this->_sModelClass( $mMember );
		}
		
		return $mMember;
	}
	
	
}


