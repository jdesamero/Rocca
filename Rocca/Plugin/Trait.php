<?php

trait Rocca_Plugin_Trait
{
	
	protected $_aPlugins = array();
	
	//
	public function addPlugin( $sPluginClass ) {
		
		$oPlugin = Rocca_Singleton::getInstance( $sPluginClass );
		
		if ( $oPlugin instanceof Rocca_Plugin ) {
			
			$oPlugin->init();
			
			$this->_aPlugins[] = $sPluginClass;
			
		} else {
			throw new Exception( sprintf( '%s is not an instance of class Rocca_Plugin', $sPluginClass ) );
		}
		
		return $this;
	}
	
	//
	public function applyPluginFilter() {
		
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


