<?php

//
class RoccaTest_Autoload extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		Rocca_Autoload::getInstance()
			->registerPath( sprintf( '%s/test_files/library', dirname( dirname( __FILE__ ) ) ) )
			->registerNamespace( 'LoadMe' )
		;
		
		
		$this
			->assertStrictlyEqual( 'Root class loaded', TRUE, class_exists( 'LoadMe' ) )
			->assertStrictlyEqual( 'Class loaded', TRUE, class_exists( 'LoadMe_Some' ) )
			->assertStrictlyEqual( 'Class loaded 2', TRUE, class_exists( 'LoadMe_Some_Other' ) )
		;
		
		
		
		//// instantiate auto-loaded classes
		
		$oRoot = new LoadMe();
		$oSome = new LoadMe_Some();
		$oSomeOther = new LoadMe_Some_Other();
		
		
		$this
			
			->assertStrictlyEqual( 'Root instance get method', 'This is LoadMe', $oRoot->getMe() )
			->assertInstanceOf( 'Instance of root class', 'LoadMe', $oRoot )
			
			->assertStrictlyEqual( 'Class instance get method', 'LoadMe Some', $oSome->getMe() )
			->assertInstanceOf( 'Instance of class', 'LoadMe_Some', $oSome )
			
			->assertStrictlyEqual( 'Class instance 2 get method', 'LoadMe Other Some', $oSomeOther->getMe() )
			->assertInstanceOf( 'Instance of class 2', 'LoadMe_Some_Other', $oSomeOther )
			
		;
		
		
		return $this;
	}


}



