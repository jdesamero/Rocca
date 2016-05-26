<?php

require_once sprintf( '%s/Debug.php', dirname( __FILE__ ) );

//
trait Rocca_Singleton
{
	
	//// static properties and methods
	
	protected static $_aSingletonInstances = [];
	
	//
	public static function getInstance( $sInstanceClass = NULL ) {
		
		if ( $sInstanceClass ) {
			return $sInstanceClass::getInstance();
		}
		
		if ( NULL === $sInstanceClass ) {
			$sInstanceClass = get_called_class();
		}
		
		if ( !self::$_aSingletonInstances[ $sInstanceClass ] ) {
			
			self::$_aSingletonInstances[ $sInstanceClass ] = new $sInstanceClass();
			
			// Rocca_Debug::showLine( sprintf( 'New %s', $sInstanceClass ), __FILE__, __LINE__, __METHOD__ );
		
		} else {
			// Rocca_Debug::showLine( sprintf( 'Instantiated %s', $sInstanceClass ), __FILE__, __LINE__, __METHOD__ );
		}
		
		return self::$_aSingletonInstances[ $sInstanceClass ];
	}
	
	
	//// regular methods
	
	protected $_bSingletonCalledInit = FALSE;
	
	// disable regular instantiation
	protected function __construct() {
	
	}
	
	//
	public function init() {
		
		if ( !$this->_bSingletonCalledInit ) {
			
			$aArgs = func_get_args();
			
			call_user_func_array( [ $this, 'doInit' ], $aArgs );
			
			$this->_bSingletonCalledInit = TRUE;
		}
		
		return $this;
	}
	
	
	//
	public function getSingletonCalledInit() {
		return $this->_bSingletonCalledInit;
	}
	
	
	
	// hook method to be implemented by sub-class
	public function doInit() {}
	
	
	
	//
	public function reInit() {
		
		$aArgs = func_get_args();
		
		$this->_bSingletonCalledInit = FALSE;
		
		call_user_func_array( [ $this, 'init' ], $aArgs );
		
		return $this;
	}
	
	
}


