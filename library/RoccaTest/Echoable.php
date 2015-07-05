<?php

//
class RoccaTest_Echoable extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		
		$oSimple = new RoccaTest_Fixtures_Echoable_Simple();
		// $oSimple->echoMessage() should call'ed $oSimple->getMessage()

		$oModel = new RoccaTest_Fixtures_Echoable_Model();

		
		$this
			
			->assertStrictlyEqual(
				'Get simple method',
				'I am simple!',
				Rocca_String::fromOb( [ $oSimple, 'echoMessage' ] )
			)
			
			->assertStrictlyEqual(
				'Get model prop',
				'37231',
				Rocca_String::fromOb( [ $oModel, 'echoId' ] )
			)
			
			->assertStrictlyEqual(
				'Get model prop 2',
				'Irving Ross',
				Rocca_String::fromOb( [ $oModel, 'echoName' ] )
			)
			
			->assertStrictlyEqual(
				'Get model method',
				'I am Irving Ross!',
				Rocca_String::fromOb( [ $oModel, 'echoMessage' ] )
			)
			
		;
		
		return $this;
	}
	
	
}



