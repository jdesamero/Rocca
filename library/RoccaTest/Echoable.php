<?php

//
class RoccaTest_Echoable extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		
		$oSimple = new RoccaTest_Fixtures_Echo_Simple();
		// $oSimple->echoMessage() should call'ed $oSimple->getMessage()

		$oModel = new RoccaTest_Fixtures_Echo_Model();

		
		$this
			
			->assertStrictlyEqual(
				'Get simple method',
				'I am simple!',
				Rocca_String::fromOb( array( $oSimple, 'echoMessage' ) )
			)
			
			->assertStrictlyEqual(
				'Get model prop',
				'37231',
				Rocca_String::fromOb( array( $oModel, 'echoId' ) )
			)
			
			->assertStrictlyEqual(
				'Get model prop 2',
				'Irving Ross',
				Rocca_String::fromOb( array( $oModel, 'echoName' ) )
			)
			
			->assertStrictlyEqual(
				'Get model method',
				'I am Irving Ross!',
				Rocca_String::fromOb( array( $oModel, 'echoMessage' ) )
			)
			
		;
		
		return $this;
	}


}



