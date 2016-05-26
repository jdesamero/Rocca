<?php

//
class RoccaTest_Class_Handler extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		$oHandlee1 = new RoccaTest_Fixtures_Class_Handler_Handlee();
		$oHandler1 = $oHandlee1->getClassHandler();
		
		$this
			->assertStrictlyEqual( 'default 1', '<arg 1 default>', $oHandlee1->getArg1() )
			->assertStrictlyEqual( 'default 2', '<arg 2 default>', $oHandlee1->getArg2() )
			->assertStrictlyEqual( 'handler once 1', '<apple>', $oHandler1->getOnce1() )
			->assertStrictlyEqual( 'handler once 2', '<banana>', $oHandler1->getOnce2() )
		;
		
		
		$oHandlee2 = new RoccaTest_Fixtures_Class_Handler_Handlee( 'foo', 'bar' );
		$oHandler2 = $oHandlee2->getClassHandler();
		
		$this
			->assertStrictlyEqual( "set'ed 1", 'foo', $oHandlee2->getArg1() )
			->assertStrictlyEqual( "set'ed 2", 'bar', $oHandlee2->getArg2() )
			->assertStrictlyEqual( 'same handler', $oHandler1, $oHandler2 )
		;
		
		
		// this should not affect the "once" values of the actual handler object
		$oHandlee1->callHandlerAgain();
		$oHandlee2->callHandlerAgain();
		
		
		$this
			->assertStrictlyEqual( 'handler 1 once again 1', '<apple>', $oHandler1->getOnce1() )
			->assertStrictlyEqual( 'handler 1 once again 2', '<banana>', $oHandler1->getOnce2() )
			->assertStrictlyEqual( 'handler 2 once again 1', '<apple>', $oHandler2->getOnce1() )
			->assertStrictlyEqual( 'handler 2 once again 2', '<banana>', $oHandler2->getOnce2() )
		;
		
		
		return $this;
	}
	
	
}


