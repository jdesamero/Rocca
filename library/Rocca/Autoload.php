<?php

// this is a singleton which needs to be loaded manually

require_once sprintf( '%s/Singleton.php', dirname( __FILE__ ) );

//
class Rocca_Autoload
{
	
	use Rocca_Singleton;
	
	protected $_aNameSpaces = [ 'Rocca' ];
	protected $_aPaths = [];
	
	
	//
	public function registerNamespace() {
		
		$aArgs = func_get_args();
		
		foreach ( $aArgs as $sNameSpace ) {
			
			if ( !in_array( $sNameSpace, $this->_aNameSpaces ) ) {
				$this->_aNameSpaces[] = $sNameSpace;
			}
			
		}
		
		return $this;
	}
	
	//
	public function registerPath() {
		
		$aArgs = func_get_args();
		
		foreach ( $aArgs as $sPath ) {
			
			if ( !in_array( $sPath, $this->_aPaths ) ) {
				$this->_aPaths[] = $sPath;
			}
			
		}
		
		return $this;
	}
	
	
	//
	public function doInit() {
		
		Rocca_Singleton::doInit();
		
		$this->registerPath( dirname( dirname( __FILE__ ) ) );
		
		spl_autoload_register( [ $this, 'doAutoload' ] );
	
	}
	
	//
	public function doAutoload( $sClass ) {
		
		// Rocca_Debug::showLine( sprintf( 'New %s', $sClass ), __FILE__, __LINE__, __METHOD__ );
		
		foreach ( $this->_aNameSpaces as $sNameSpace ) {
			
			if ( 0 === strpos( $sClass, $sNameSpace ) ) {
				
				foreach ( $this->_aPaths as $sPath ) {
					
					$sClassPath = sprintf( '%s/%s.php', $sPath, str_replace( '_', '/', $sClass ) );
					
					// Rocca_Debug::showLine( $sClassPath, __FILE__, __LINE__, __METHOD__ );
					
					if ( is_file( $sClassPath ) ) {
						require_once $sClassPath;
					}
				}
				
			}
			
		}
		
	}
	
}

