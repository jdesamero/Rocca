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
		
		if (
			( is_object( $mMember ) ) &&
			( $mMember instanceof Rocca_Model )
		) {
			
			// already a model
			$mRes = $mMember;
			
		} elseif ( $mMember ) {
			
			$mPlugins = NULL;
			
			if ( $this->_bHasPlugin ) {
				// pass my plugins to the model
				$mPlugins = $this->_aPlugins;
			}
			
			$mRes = new $this->_sModelClass( $mMember, $mPlugins );	
		}
		
		
		// parent is in "trait Rocca_Collection_Array"
		return parent::formatMember( $mRes );
	}
	
	
	//
	public function formatPlucked( $iIdx, $mRow, $aArgs ) {
		
		$mFormat = array_shift( $aArgs );

		$oPlaceholder = Rocca_Utility_Placeholder::create( $mFormat );
		
		return $mRow->modelFormattedGet( $oPlaceholder, [ '__idx' => $iIdx ], $aArgs );
	}
	
	
	
}



