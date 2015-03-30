<?php

//
class Rocca_UnitTest_Compare_Equal extends Rocca_UnitTest_Compare
{
	
	protected $_sFailMessage = 'Values are not equal!';
	
	
	
	// perform comparison
	public function test() {
		return ( $this->_mValue == $this->_mTestValue );
	}
	
	
	
}


