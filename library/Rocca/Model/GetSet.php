<?php

// allow magic get() and set() methods on entity
trait Rocca_Model_GetSet
{
	
	protected $_oModel = NULL;
	
	/* NOTE: These should be implemented by the class use'ing this
	 *    protected $_sInstanceClass = NULL;
	 *    protected $_bUseModelPropMapping = TRUE | FALSE;
	 *    protected $_aModelDefaultValues = NULL | array();
	 */
	
	
	//
	public function modelInit() {

		if ( NULL === $this->_oModel ) {
			
			$this->_oModel = new StdClass;
			
			if ( is_array( $this->_aModelDefaultValues ) ) {
				$this->modelRawSet( $this->_aModelDefaultValues );
			}
			
		}
		
		return $this;
	}
	
	
	// map the given property, if applicable
	public function modelMapProp( $sProp ) {
		
		if ( $this->_bUseModelPropMapping ) {
			
			$oClassHandler = Rocca_Class_Handler::factory( $this->_sInstanceClass );
			
			if (
				( $oMapping = $oClassHandler->getMapping() ) && 
				( $oMapping instanceof Rocca_Utility_Mapping )
			) {
				$sProp = $oMapping->get( $sProp, TRUE );
			}
			
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
			$sProp = $this->modelMapProp( $sProp );
			
			$this->_oModel->$sProp = $mValue;
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
		$sProp = $this->modelMapProp( $sProp );
		
		return $this->_oModel->$sProp;
	}
	
	
	//
	public function modelFormattedGet( $mFormat, $aValues = array() ) {
		
		$oPlaceholder = Rocca_Utility_Placeholder::create( $mFormat );
		
		$fGetCallback = function ( $sKey ) {
			$sGetMethod = sprintf( 'get%s', Rocca_Inflector::camelize( $sKey ) );
			return $this->$sGetMethod();
		};
		
		return $oPlaceholder->getPopulated( $aValues, $fGetCallback, $fGetCallback );
	}
	
	
	
	//// these are HandleCall methods (Model)
	
	//
	public function handleModelCall( $sMethod, $aArgs ) {
		
		$aHandler = FALSE;
		
		if ( 0 === strpos( $sMethod, 'set' ) ) {
			
			$sProp = Rocca_Inflector::underscore( substr( $sMethod, 3 ) );
						
			$aHandler = array( 'set', $sProp );
			
			
		} elseif ( 0 === strpos( $sMethod, 'get' ) ) {
			
			$sProp = Rocca_Inflector::underscore( substr( $sMethod, 3 ) );
						
			// only kicks in if property exists
			if ( $this->modelHasProp( $sProp ) ) {
				$aHandler = array( 'get', $sProp );			
			}
			
		}
		
		return $aHandler;
	}
	
	//
	public function modelCall( $aHandler, $aArgs ) {
				
		list( $sOp, $sProp ) = $aHandler;
		
		if ( 'set' == $sOp ) {
			
			return $this->modelRawSet( $sProp, $aArgs[ 0 ] );
			
		} elseif ( 'get' == $sOp ) {
			
			return $this->modelRawGet( $sProp, $aArgs );
			
		}
		
	}
	
	
}


