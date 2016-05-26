<?php

class Some_Class
{


}


trait Some_Trait
{


}



//
class RoccaTest_Model extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		$this
			->assertEqual( 'Get int value', 101, 101 )
			->assertStrictlyEqual( 'Get int value', 101, 101 )
			->assertInstanceOf( 'Get int value', 101, 101 )
		;
		
		return $this;
	}


}



