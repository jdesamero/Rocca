<?php

// implements methods for Iterator, ArrayAccess, Countable
trait Rocca_Collection_Array
{
	
	protected $_aCollection = [];
	protected $_iPos = 0;	
	
	
	
	//// manage entities
	
	//
	public function add( $mMembers ) {
		
		if ( Rocca_Array::hasNumericIndex( $mMembers ) ) {
			
			foreach ( $mMembers as $mMember ) {
				$this->_aCollection[] = $this->formatMember( $mMember );		
			}
			
		} else {
			$this->_aCollection[] = $this->formatMember( $mMembers );
		}
		
		return $this;
	}
	
	// to be implemented by sub-class
	public function formatMember( $mMember ) {
		return $mMember;
	}
	
	
	//// Iterator interface methods
	
	//
	public function rewind() {
		$this->_iPos = 0;
	}
	
	//
	public function current() {
		return $this->_aCollection[ $this->_iPos ];
	}

	//
	public function key() {
		return $this->_iPos;
	}
	
	//
	public function next() {
		++$this->_iPos;
	}

	//
	public function valid() {
		return isset( $this->_aCollection[ $this->_iPos ] );
	}
	
	
	
	//// ArrayAccess interface methods
	
	//
	public function offsetSet( $iOffset, $mValue ) {
		
		if ( NULL === $iOffset ) {
			$this->_aCollection[] = $this->formatMember( $mValue );
		} else {
			$this->_aCollection[ $iOffset ] = $this->formatMember( $mValue );		
		}
	}
	
	//
	public function offsetExists( $iOffset ) {
		return isset( $this->_aCollection[ $iOffset ] );
	}
	
	//
	public function offsetUnset( $iOffset ) {
		unset( $this->_aCollection[ $iOffset ] );
	}
	
	//
	public function offsetGet( $iOffset ) {
		return $this->_aCollection[ $iOffset ];
	}
	
	
	
	//// Countable interface methods
	
	//
	public function count() {
		return count( $this->_aCollection );
	}
	
	
	
}



