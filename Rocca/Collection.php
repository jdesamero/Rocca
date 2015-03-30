<?php

class Rocca_Collection
	implements Iterator, ArrayAccess, Countable
{
	
	use Rocca_Plugin_Assign;
	use Rocca_Collection_Array;
	use Rocca_HandleCall;
	
	
	protected $_aCallables = array( 'Collection' );
	
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
	
	
	// inspired by Backbone.js
	public function pluck( $mFormat ) {
		
		$oPlaceholder = Rocca_Utility_Placeholder::create( $mFormat );
		
		// assemble
		$aRes = array();
		
		foreach ( $this as $i => $oModel ) {
			
			$aRes[] = $oModel->modelFormattedGet(
				$oPlaceholder,
				array( '__idx' => $i )
			);			
		}
		
		return $aRes;
	}
	
	
	//
	public function implode( $sFormat, $sDelim = ', ' ) {
		return implode( $sDelim, $this->pluck( $sFormat ) );
	}
	
	
	
	//// these are HandleCall methods (Collection)
	
	//
	public function handleCollectionCall( $sMethod, $aArgs ) {
		
		$aHandler = FALSE;
		
		if ( 0 === strpos( $sMethod, 'pluck' ) ) {
			
			$sProp = Rocca_Inflector::underscore( substr( $sMethod, 5 ) );
			$aHandler = array( 'pluck', $sProp );
			
		} elseif ( 0 === strpos( $sMethod, 'implode' ) ) {
			
			$sProp = Rocca_Inflector::underscore( substr( $sMethod, 7 ) );
			$aHandler = array( 'implode', $sProp );
		}
		
		return $aHandler;
	}
	
	//
	public function collectionCall( $aHandler, $aArgs ) {
		
		list( $sOp, $sProp ) = $aHandler;
		
		array_unshift( $aArgs, $sProp );
		
		if ( 'pluck' == $sOp ) {
			
			return call_user_func_array( array( $this, 'pluck' ), $aArgs );
			
		} elseif ( 'implode' == $sOp ) {
			
			return call_user_func_array( array( $this, 'implode' ), $aArgs );
		}
		
	}

	
	
}


