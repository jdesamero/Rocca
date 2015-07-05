<?php

// this collection class works specifically with Rocca_Model's
class Rocca_Model_Collection extends Rocca_Collection {
	
	protected $_sModelClass = NULL;
	
	
	
	//
	public function collectionInit() {
		
		// resolve related classes
		$this->_sModelClass = Rocca_Class::resolveRelated(
			$this->_sInstanceClass, NULL, '_Collection', $this->_sModelClass
		);
		
	}
	
	
	// implement member formatter
	public function formatMember( $mMember ) {
		
		if ( is_array( $mMember ) ) {
			$mRes = new $this->_sModelClass( $mMember );
		} else {
			$mRes = $mMember;
		}
		
		// parent is in "trait Rocca_Collection_Array"
		return parent::formatMember( $mRes );
	}
	
	
	// override default
	public function pluck( $mFormat ) {
		
		$oPlaceholder = Rocca_Utility_Placeholder::create( $mFormat );
		
		// assemble
		$aRes = [];
		
		foreach ( $this as $i => $oModel ) {
			$aRes[] = $oModel->modelFormattedGet( $oPlaceholder, [ '__idx' => $i ] );
		}
		
		return $aRes;
	}
	
	
	
}



