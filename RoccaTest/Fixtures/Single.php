<?php

//
class RoccaTest_Fixtures_Single
{
	
	use Rocca_Singleton;
	
	protected $_sOther = 'Init not called';
	protected $_sSome;
	protected $_sPassParam;


	//
	public function doInit( $sPassParam ) {
		
		Rocca_Singleton::doInit();
		
		$this->_sOther = 'Init was CALLED';
		$this->_sPassParam = $sPassParam;
		
	}
	
	
	//
	public function setSome( $sSome ) {
		
		$this->_sSome = $sSome;
		
		return $this;
	}
	
	//
	public function getSome() {
		return $this->_sSome;
	}
	
	
	//
	public function getOther() {
		return $this->_sOther;
	}
	
	//
	public function getPassParam() {
		return $this->_sPassParam;
	}
	
	
}


