<?php

//
class RoccaTest_Singleton extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		
		$oSingle = RoccaTest_Fixtures_Single::getInstance();
		
		$oSingle->setSome( 'This is me...' );
		
		$oSame = RoccaTest_Fixtures_Single::getInstance();
		$oSameDyn = Rocca_Singleton::getInstance( 'RoccaTest_Fixtures_Single' );
		
		
		$this
			->assertStrictlyEqual( 'Same', 'This is me...', $oSame->getSome() )
			->assertStrictlyEqual( 'Same 2', 'This is me...', $oSameDyn->getSome() )
			->assertStrictlyEqual( 'Before init', 'Init not called', $oSingle->getOther() )
			->assertStrictlyEqual( 'Before init flag', FALSE, $oSingle->getSingletonCalledInit() )
		;
		
		$oSingle->init( 'Pass Param' );
		
		$this
			->assertStrictlyEqual( 'After init', 'Init was CALLED', $oSingle->getOther() )
			->assertStrictlyEqual( 'After init flag', TRUE, $oSingle->getSingletonCalledInit() )
			->assertStrictlyEqual( 'After init param', 'Pass Param', $oSingle->getPassParam() )
		;
		
		
		$oSingle->init( 'Change Param' );		// should have no effect since init() only gets called once
		
		$this->assertStrictlyEqual( 'After init param again', 'Pass Param', $oSingle->getPassParam() );
		
		$oSingle->reInit( 'ReInit Param' );		// re-initialize
		
		$this
			->assertStrictlyEqual( 'Re-init', 'Init was CALLED', $oSingle->getOther() )
			->assertStrictlyEqual( 'Re-init flag', TRUE, $oSingle->getSingletonCalledInit() )
			->assertStrictlyEqual( 'Re-init param', 'ReInit Param', $oSingle->getPassParam() )
		;
		
		
		return $this;
	}
	
	
	
}



