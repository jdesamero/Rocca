<?php

class Rocca_Model_Plugin extends Rocca_Plugin
{
	
	protected $_aModelPropMapping = array();
	protected $_aModelDefaultValues = array();
	
	protected $_oMapping;
	
	
	
	//
	public function init() {
		
		$oMapping = new Rocca_Utility_Mapping( $this->_aModelPropMapping );
		
		$this->_oMapping = $oMapping;
	}
	
	//
	public function modelMapProp( $sProp ) {
		
		$oMapping = $this->_oMapping;
		
		return $oMapping->get( $sProp, TRUE );
	}
	
	
	//
	public function modelDefaultValues( $aValues ) {
		
		return array_merge( $aValues, $this->_aModelDefaultValues );
	}
	
	
}


