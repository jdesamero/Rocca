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
	public function __construct( $mMembers = NULL ) {
		
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
	public function pluck( $sKey ) {
		
		// assemble
		$aRes = [];
		
		foreach ( $this as $i => $mRow ) {
			if ( is_array( $mRow ) && array_key_exists( $sKey, $mRow ) ) {
				$aRes[] = $mRow[ $sKey ];
			}
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


