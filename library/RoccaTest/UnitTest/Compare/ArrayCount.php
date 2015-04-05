<?php

//
class RoccaTest_UnitTest_Compare_ArrayCount extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		
		// IMPORTANT!!! Depends of RoccaTest_Autoload
		
		
		$oUnitTest = Other_UnitTest_Compare_ArrayCount::getInstance()
			->init()
			->run()
		;
		
		
		$aExpectedResults = array(
			array(
				'Empty',
				'Empty: Success!'
			),
			array(
				'Plain vanilla array',
				'Plain vanilla array: Success!'
			),
			array(
				'Bad value',
				'Bad value: Fail Message: Exception thrown: Bad type given for count(), expected: "array or Countable", result: "string".'
			),
			array(
				'Bad value 2',
				'Bad value 2: Fail Message: Exception thrown: Bad type given for count(), expected: "array or Countable", result: "object (stdClass)".'
			)
		);
		
		
		
		// test all results
		$this->assertUnitTestResults( $aExpectedResults, $oUnitTest->getResults() );
				
		
		return $this;
	}


}



