<?php

//
class RoccaTest_Class_Handler extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		$this->assertStrictlyEqual( 'bogus for now', 'bogus', 'bogus' );
		
		return $this;
	}
	
	
}


