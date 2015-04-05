<?php

//
class RoccaTest_UnitTest extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		
		// IMPORTANT!!! Depends of RoccaTest_Autoload
		
		
		$oUnitTest = Other_UnitTest::getInstance()
			->init()
			->run()
		;
		
		
		//// expected results
		
		$aExpectedResults = array(
			array(
				'Match',
				'Match: Success!'
			),
			array(
				'No match',
				'No match: Fail Message: Values are not equal!, expected: "101", result: "999".'
			),
			array(
				'Group match',
				'Group assert: Match: Success!'
			),
			array(
				'Group no match',
				'Group assert: No match: Fail Message: Values are not equal!, expected: "201", result: "999".'
			),
			array(
				'Group level 2 match',
				'Group assert: Level 2: Match: Success!'
			),
			array(
				'Group level 2 no match',
				'Group assert: Level 2: No match: Fail Message: Values are not equal!, expected: "301", result: "999".'
			),
			array(
				'Invalid comparison type',
				'Invalid comparison type: Success!'
			)
		);
		
		
		$aExpectedErrorOnly = array(
			$aExpectedResults[ 1 ],
			$aExpectedResults[ 3 ],
			$aExpectedResults[ 5 ]
		);
		
		
		
		//// run mock test and compare results
		
		
		$this
			
			->assertGroup( 'All results', function() use ( $oUnitTest, $aExpectedResults ) {
				
				// test all results
				$this->assertUnitTestResults( $aExpectedResults, $oUnitTest->getResults() );
								
			} )
			
			->assertGroup( 'Failed only results', function() use ( $oUnitTest, $aExpectedErrorOnly ) {
				
				// failed only
				$this->assertUnitTestResults( $aExpectedErrorOnly, $oUnitTest->getResults( TRUE ) );
				
			} )
			
		;
		
				
		return $this;
	}


}



