<?php

//
class Rocca_Collection
	implements Iterator, ArrayAccess, Countable
{
	
	use Rocca_Plugin_Assign;
	use Rocca_Collection_Array;
	use Rocca_HandleCall;
	
	
	protected $_aCallables = [ 'Collection' ];
	
	protected $_sInstanceClass = NULL;
	
	
	
	//
	public function __construct( $mMembers = NULL, $mPlugin = NULL ) {
		
		$this->addPlugins( $mPlugin );
		
		
		// used potentially by "related" classes
		$this->_sInstanceClass = get_class( $this );
		
		// hook method, gives sub-class opportunity to set up before members are added
		$this->collectionInit();
		
		// add members
		if ( $mMembers ) {
			$this->add( $mMembers );
		}
		
	}
	
	
	//
	public function collectionInit() {}
	
	
	// inspired by Backbone.js
	public function pluck() {
		
		$aArgs = func_get_args();
		
		// assemble
		$aRes = [];
		
		foreach ( $this as $i => $mRow ) {
			$aRes[] = $this->formatPlucked( $i, $mRow, $aArgs );
		}
		
		return $aRes;
	}
	
	
	//
	public function formatPlucked( $iIdx, $mRow, $aArgs ) {
		
		$sKey = $aArgs[ 0 ];
		
		if ( is_array( $mRow ) && array_key_exists( $sKey, $mRow ) ) {
			
			return $mRow[ $sKey ];
		}
		
		return NULL;
	}
	
	
	//
	public function implode() {
		
		$aArgs = func_get_args();
		
		$sFormat = array_shift( $aArgs );
		$sDelim = array_shift( $aArgs );
		
		if ( NULL === $sDelim ) {
			$sDelim = ', ';
		}
		
		// put it back into the beginning
		array_unshift( $aArgs, $sFormat );
		
		return implode( $sDelim, call_user_func_array( [ $this, 'pluck' ], $aArgs ) );
	}
	
	
	
	//// these are HandleCall methods (Collection)
	
	//
	public function handleCollectionCall( $sMethod, $aArgs ) {
		
		$aHandler = FALSE;
		
		if ( 0 === strpos( $sMethod, 'pluck' ) ) {
			
			$sProp = Rocca_Inflector::underscore( substr( $sMethod, 5 ) );
			$aHandler = [ 'pluck', $sProp ];
			
		} elseif ( 0 === strpos( $sMethod, 'implode' ) ) {
			
			$sProp = Rocca_Inflector::underscore( substr( $sMethod, 7 ) );
			$aHandler = [ 'implode', $sProp ];
		}
		
		return $aHandler;
	}
	
	//
	public function collectionCall( $aHandler, $aArgs ) {
		
		list( $sOp, $sProp ) = $aHandler;
		
		array_unshift( $aArgs, $sProp );
		
		if ( 'pluck' == $sOp ) {
			
			return call_user_func_array( [ $this, 'pluck' ], $aArgs );
			
		} elseif ( 'implode' == $sOp ) {
			
			return call_user_func_array( [ $this, 'implode' ], $aArgs );
		}
		
	}

	
	
}


