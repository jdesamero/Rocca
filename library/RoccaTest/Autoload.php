<?php

//
class RoccaTest_Autoload extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		Rocca_Autoload::getInstance()
			->registerPath( sprintf( '%s/test_files/library', dirname( dirname( __FILE__ ) ) ) )
			->registerNamespace( 'Other' )
		;
		
		
		$this
			
			->assertGroup( 'class_exists()', function() {
				
				$this
					->assertStrictlyEqual( 'Root class', TRUE, class_exists( 'Other' ) )
					->assertStrictlyEqual( 'Level 1 class', TRUE, class_exists( 'Other_LoadMe' ) )
					->assertStrictlyEqual( 'Level 2 class', TRUE, class_exists( 'Other_LoadMe_Some' ) )
					->assertStrictlyEqual( 'Level 3 class', TRUE, class_exists( 'Other_LoadMe_Some_Other' ) )
				;
				
			} )
			
		;
		
		
		
		//// instantiate auto-loaded classes
		
		$oRoot = new Other();
		$oLevel1 = new Other_LoadMe();
		$oLevel2 = new Other_LoadMe_Some();
		$oLevel3 = new Other_LoadMe_Some_Other();
		
		
		$this

			->assertGroup( 'getMe()', function() use ( $oRoot, $oLevel1, $oLevel2, $oLevel3 ) {
				
				$this
					->assertStrictlyEqual( 'Root instance', 'This is the ROOT', $oRoot->getMe() )
					->assertStrictlyEqual( 'Level 1 instance', 'This is LoadMe', $oLevel1->getMe() )
					->assertStrictlyEqual( 'Level 2 instance', 'LoadMe Some', $oLevel2->getMe() )
					->assertStrictlyEqual( 'Level 3 instance', 'LoadMe Other Some', $oLevel3->getMe() )
				;
				
			} )
			
			->assertGroup( 'Instance of', function() use ( $oRoot, $oLevel1, $oLevel2, $oLevel3 ) {

				$this
					->assertInstanceOf( 'Root instance', 'Other', $oRoot )
					->assertInstanceOf( 'Level 1 instance', 'Other_LoadMe', $oLevel1 )
					->assertInstanceOf( 'Level 2 instance', 'Other_LoadMe_Some', $oLevel2 )
					->assertInstanceOf( 'Level 3 instance', 'Other_LoadMe_Some_Other', $oLevel3 )
				;
				
			} )
			
		;
		
		
		return $this;
	}


}



