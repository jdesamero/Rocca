<?php

// assign plugins to class
trait Rocca_Plugin_Assign
{
	
	protected $_aPlugins = [];
	
	protected $_bHasPlugin = FALSE;
	
	
	
	//
	public function addPlugins( $mPlugin = NULL ) {
		
		if ( $mPlugin ) {
		
			if ( is_array( $mPlugin ) ) {
				
				foreach ( $mPlugin as $mItem ) {
					$this->addPlugin( $mItem );
				}
				
			} else {
				
				$this->addPlugin( $mPlugin );
			}
			
		}
		
		
		return $this;
	}
	
	
	
	//
	public function addPlugin( $mPlugin ) {
		
		$oPlugin = NULL;
		
		if ( is_string( $mPlugin ) ) {
			
			$oPlugin = Rocca_Singleton::getInstance( $mPlugin );
			
		} elseif ( is_object( $mPlugin ) ) {
			
			$oPlugin = $mPlugin;
		}
		
		
		if ( is_object( $oPlugin ) ) {
			
			if ( method_exists( $oPlugin, 'init' ) ) {
				$oPlugin->init();
			}
			
			$this->_aPlugins[] = $oPlugin;
			
			$this->_bHasPlugin = TRUE;
			
		} else {
			throw new Exception( sprintf( 'Value provided to %s is invalid.', __METHOD__ ) );
		}
		
		return $this;
	}
	
	//
	public function applyPluginFilter() {
		
		$aArgs = func_get_args();
		
		$sMethod = array_shift( $aArgs );
		
		// go through each plugin and apply
		foreach ( $this->_aPlugins as $oPlugin ) {
			
			if ( method_exists( $oPlugin, $sMethod ) ) {
				
				$mRet = call_user_func_array( [ $oPlugin, $sMethod ], $aArgs );
				$aArgs[ 0 ] = $mRet;
			}
		}
		
		return $aArgs[ 0 ];
	}
	
	//
	public function doFilterAction() {
	
	
	}
	
	//
	public function showPlugins() {
		
		echo "\n\n";
		print_r( $this->_aPlugins );
		echo "\n\n";
		
		return $this;
	}
	
	

}


