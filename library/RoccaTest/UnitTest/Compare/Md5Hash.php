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
		
		$aExpectedResults = array(
			array(
				'Empty value',
				'Empty value: Success!'
			),
			array(
				'Plain vanilla string',
				'Plain vanilla string: Success!'
			),
			array(
				'Bad value type given',
				'Bad value type given: Fail Message: Exception thrown: Bad type given for md5(), expected: "null or scalar", result: "array".'
			)
		);
		
		
		// test all results
		$this->assertUnitTestResults( $aExpectedResults, $oUnitTest->getResults() );
		
		
		return $this;
	}


}



