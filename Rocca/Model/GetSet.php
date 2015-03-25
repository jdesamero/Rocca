<?php

// allow magic get() and set() methods on entity
trait Rocca_Model_GetSet
{
	
	protected $_oModel = NULL;
	
	
	//
	public function modelInit() {

		if ( NULL === $this->_oModel ) {
			$this->_oModel = new StdClass;
		}
		
		return $this;
	}
	
	//
	public function modelRawSet() {
		
		$this->modelInit();
		
		$aArgs = func_get_args();
		
		if ( is_array( $aData = $aArgs[ 0 ] ) ) {
			
			foreach ( $aData as $sProp => $mValue ) {
				$this->_oModel->$sProp = $mValue;
			}
			
		} else {
			
			list( $sProp, $mValue ) = $aArgs;
			
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
		
		return $this->_oModel->$sProp;
	}
		
	
	//
	public function handleModelCall( $sMethod, $aArgs ) {
		
		$aHandler = FALSE;
		
		if ( 0 === strpos( $sMethod, 'set' ) ) {
			
			$sProp = Rocca_Inflector::underscore( substr( $sMethod, 3 ) );
			$aHandler = array( 'set', $sProp );
			
		} elseif ( 0 === strpos( $sMethod, 'get' ) ) {
			
			$sProp = Rocca_Inflector::underscore( substr( $sMethod, 3 ) );
			
			$this->modelInit();
						
			// only kicks in if property exists
			if ( property_exists( $this->_oModel, $sProp ) ) {
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


