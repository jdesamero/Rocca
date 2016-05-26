<?php

//
class RoccaTest_UnitTest_Compare_Md5Hash extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		
		// IMPORTANT!!! Depends of RoccaTest_Autoload
		
		
		$oUnitTest = Other_UnitTest_Compare_Md5Hash::getInstance()
			->init()
			->run()
		;
		
		$aExpectedResults = [
			[	'Empty value',
				'Empty value: Success!'
			],
			[	'Plain vanilla string',
				'Plain vanilla string: Success!'
			],
			[	'Bad value type given',
				'Bad value type given: Fail Message: Exception thrown: Bad type given for md5(), expected: "null or scalar", result: "array".'
			]
		];
		
		
		// test all results
		$this->assertUnitTestResults( $aExpectedResults, $oUnitTest->getResults() );
		
		
		return $this;
	}


}



