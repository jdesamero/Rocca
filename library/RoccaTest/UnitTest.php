<?php

//
class RoccaTest_UnitTest extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		$this
			->assertEqual( 'Get int value', 101, 101 )
			->assertStrictlyEqual( 'Get int value', 101, 101 )
		;
		
		return $this;
	}


}



