<?php

// this is used to handle shared data between specific classes, but would be 
// repetitious if handled by the instances
class Rocca_Class_Registry
{
	
	use Rocca_Singleton;
	
	protected $_aRegistry = array();
	
	
	//
	public function register() {
		
		$aArgs = func_get_args();
		
		$sKey = array_shift( $aArgs );
		
		if ( !$this->_aRegistry[ $sKey ] ) {
			
			$sInstanceClass = array_shift( $aArgs );
			$sHandlerClass = array_shift( $aArgs );
			
			if ( is_subclass_of( $sHandlerClass, Rocca_Class_Registry_Handler ) ) {
				// instantiate
				$this->_aRegistry[ $sKey ] = new $sHandlerClass( $sInstanceClass, $aArgs );
			}
		}
		
		return $this;
	}
	
	
	//
	public function get() {

		$aArgs = func_get_args();
		
		$sKey = array_shift( $aArgs );
		
		if ( $oHandler = $this->_aRegistry[ $sKey ] ) {
			return call_user_func_array( array( $oHandler, 'get' ), $aArgs );
		}
		
		return NULL;
	}
	
	
	
	//
	public function __call( $sMethod, $aArgs ) {
		
		if ( 0 === strpos( $sMethod, 'get' ) ) {
			
			$sKey = Rocca_Inflector::underscore( substr( $sMethod, 3 ) );
			array_unshift( $aArgs, $sKey );
			
			return call_user_func_array( array( $this, 'get' ), $aArgs );
		
		} elseif ( 0 === strpos( $sMethod, 'register' ) ) {
			
			$sKey = Rocca_Inflector::underscore( substr( $sMethod, 8 ) );
			array_unshift( $aArgs, $sKey );
			
			return call_user_func_array( array( $this, 'register' ), $aArgs );
		}
		
		throw new Exception( sprintf( 'Invalid method %s::%s() called.', __CLASS__, $sMethod ) );
	}
	
}



