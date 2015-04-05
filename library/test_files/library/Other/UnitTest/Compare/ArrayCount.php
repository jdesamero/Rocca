<?php

//
class Other_UnitTest_Compare_ArrayCount extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		
		$this
			
			->assertArrayCount( 'Empty', 0, array() )
			->assertArrayCount( 'Plain vanilla array', 5, array( 1, 2, 3, 4, 5 ) )
			// ->assertArrayCount( 'countable', 5, ??? )		// TO DO
			
			->assertArrayCount( 'Bad value', 7, 'fooo' )
			->assertArrayCount( 'Bad value 2', 7, new StdClass )
			
		;
		
		
		return $this;
	}


}



