<?php

//
class RoccaTest_Fixtures_Collection_Simple extends Rocca_Collection
{
	
	protected $_sPrefix = '';
	
	
	//
	public function collectionInit() {
		
		// usually, something like this is determined on run-time, but hard-code for now
		$this->_sPrefix = 'some-';
		
	}
	
	
	// to be implemented by sub-class
	public function formatMember( $mMember ) {
		
		if ( is_array( $mMember ) ) {
			
			$mRet = array();
			
			foreach ( $mMember as $sKey => $mValue ) {
				$sPrefixedKey = sprintf( '%s%s', $this->_sPrefix, $sKey );
				$mRet[ $sPrefixedKey ] = $mValue;
			}
			
		} else {
			$mRet = $mMember;
		}
		
		return parent::formatMember( $mRet );
	}
	
	
}


