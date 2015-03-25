<?php

require_once sprintf( '%s/Debug.php', dirname( __FILE__ ) );

//
trait Rocca_Singleton
{
	
	//// static properties and methods
	
	protected static $_aSingletonInstances = array();
	
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
			
			$this->doInit();
			
			$this->_bSingletonCalledInit = TRUE;
		}
		
		return $this;
	}
	
	// hook method to be implemented by sub-class
	public function doInit() {
	
	}
	
}


