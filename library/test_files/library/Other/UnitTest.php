<?php

//
class Other_UnitTest extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		
		
		// level 1 assertion
		$this
			->assertEqual( 'Match', 101, 101 )
			->assertEqual( 'No match', 101, 999 )
		;
		
		
		// grouped assertion
		
		$this
			
			->assertGroup( 'Group assert', function() {
				
				// level 2 assertion
				$this
					
					->assertEqual( 'Match', 201, 201 )
					->assertEqual( 'No match', 201, 999 )
					
					->assertGroup( 'Level 2', function() {
						
						$this
							->assertEqual( 'Match', 301, 301 )
							->assertEqual( 'No match', 301, 999 )
						;
						
					} )
					
				;
				
			} )
			
			
			// invalid comparison type
			
			->assertThrowsException(
				'Invalid comparison type',
				'Exception',
				function () {
					
					// this should throw an exception
					$this->assertBogus( 'Bogus assertions', 'should not', 'run' );
					
				}
			)
			
		;
		
		
		return $this;
	}


}



