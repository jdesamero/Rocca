<?php

//
class Rocca_UnitTest_Compare_Type extends Rocca_UnitTest_Compare
{
	
	protected $_sFailMessage = 'The given value has the incorrect type.';
	
	
	
	// perform comparison
	public function test() {
		return ( $this->_mValue === $this->_mTestValue );
	}
	
	
	//
	public function formatTestValue( $mCompare, $mValue ) {
		return gettype(
			parent::formatTestValue( $mCompare, $mValue )
		);
	}
	
	
	
}


