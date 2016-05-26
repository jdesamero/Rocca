<?php

// allow magic get() and set() methods on entity
trait Rocca_Model_GetSet
{
	
	protected $_oModel = NULL;
	
	
	//
	public function modelInit() {

		if ( NULL === $this->_oModel ) {
			
			$this->_oModel = new StdClass;
			
			
			if ( $this->_bHasPlugin ) {
				
				$aModelDefaultValues = $this->applyPluginFilter( 'modelDefaultValues', array() );
				
				$this->modelRawSet( $aModelDefaultValues );
			}
			
		}
		
		return $this;
	}
	
	
	// map the given property, if applicable
	public function modelMapProp( $sProp ) {
		
		if ( $this->_bHasPlugin ) {
			$sProp = $this->applyPluginFilter( 'modelMapProp', $sProp );
		}
				
		return $sProp;
	}
	
	
	
	//// has/get/set methods
	
	//
	public function modelHasProp( $sProp ) {
		
		if ( $this->_oModel ) {

			// conditionally apply mapping to prop
			$sProp = $this->modelMapProp( $sProp );
			
			return property_exists( $this->_oModel, $sProp );
		}
		
		return FALSE;
	}
	
	//
	public function modelRawSet() {
		
		$this->modelInit();
		
		$aArgs = func_get_args();
		
		if ( is_array( $aData = $aArgs[ 0 ] ) ) {
			
			foreach ( $aData as $sProp => $mValue ) {
				$this->modelRawSet( $sProp, $mValue );
			}
			
		} else {
			
			list( $sProp, $mValue ) = $aArgs;
			
			// conditionally apply mapping to prop
			if ( $sProp = $this->modelMapProp( $sProp ) ) {
				$this->_oModel->$sProp = $mValue;
			}
			
		}
		
		return $this;
	}
	
	//
	public function modelRawGet( $sProp = NULL ) {
		
		$this->modelInit();
		
		if ( NULL === $sProp ) {
			return $this->_oModel;
		}

		// conditionally apply mapping to prop
		if ( $sProp = $this->modelMapProp( $sProp ) ) {
			return $this->_oModel->$sProp;
		}
		
		return NULL;
	}
	
	
	//
	public function modelFormattedGet( $mFormat, $aValues = [], $aArgs = [] ) {
		
		$oPlaceholder = Rocca_Utility_Placeholder::create( $mFormat );
		
		$fGetCallback = function( $sKey ) use ( $aArgs ) {
			
			$sGetMethod = sprintf( 'get%s', Rocca_Inflector::camelize( $sKey ) );
			
			return call_user_func_array( [ $this, $sGetMethod ], $aArgs );
		};
		
		return $oPlaceholder->getPopulated( $aValues, $fGetCallback, $fGetCallback );
	}
	
	
	
	//// these are HandleCall methods (Model)
	
	//
	public function handleModelCall( $sMethod, $aArgs ) {
		
		$aHandler = FALSE;
		
		if ( 0 === strpos( $sMethod, 'set' ) ) {
			
			$sProp = Rocca_Inflector::underscore( substr( $sMethod, 3 ) );
			$aHandler = [ 'set', $sProp ];
			
		} elseif ( 0 === strpos( $sMethod, 'get' ) ) {
			
			$sProp = Rocca_Inflector::underscore( substr( $sMethod, 3 ) );
			$aHandler = [ 'get', $sProp ];
		}
		
		if ( is_array( $aHandler ) ) {
			$aHandler[] = $sMethod;
		}
		
		return $aHandler;
	}
	
	//
	public function modelCall( $aHandler, $aArgs ) {
				
		list( $sOp, $sProp, $sMethod ) = $aHandler;
		
		if ( 'set' == $sOp ) {
			
			return $this->modelRawSet( $sProp, $aArgs[ 0 ] );
			
		} elseif ( 'get' == $sOp ) {

			if ( $this->_bHasPlugin ) {
				
				$sModelMethod = sprintf( 'model%s', ucfirst( $sMethod ) );
				$aPluginArgs = array_merge( array( $sModelMethod, NULL, $this ), $aArgs );
				
				$mOut = call_user_func_array( [ $this, 'applyPluginFilter' ], $aPluginArgs );
			}
			
			return ( $mOut ) ? $mOut : $this->modelRawGet( $sProp, $aArgs ) ;
		}
		
	}
	
	
}


