<?php

//
class RoccaTest_Utility_Mapping extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		
		$oMapping = new Rocca_Utility_Mapping( [
			'id:the_id|is_the_id',
			'fn:first_name',
			'ln:last_name|surname|family_name'
		] );
		
		
		
		$this
			
			->assertStrictlyEqual( 'Get same', 'id', $oMapping->get( 'id' ) )
			->assertStrictlyEqual( 'Get same 2', 'fn', $oMapping->get( 'fn' ) )
			
			->assertStrictlyEqual( 'Get alias', 'id', $oMapping->get( 'is_the_id' ) )
			->assertStrictlyEqual( 'Get alias 2', 'fn', $oMapping->get( 'first_name' ) )
			->assertStrictlyEqual( 'Get alias 3', 'ln', $oMapping->get( 'surname' ) )
			->assertStrictlyEqual( 'Get alias 4', 'ln', $oMapping->get( 'last_name' ) )
			
			->assertStrictlyEqual( 'Get return key', 'bogus', $oMapping->get( 'bogus', TRUE ) )
			->assertStrictlyEqual( "Don't get return key", NULL, $oMapping->get( 'bogus' ) )
			
		;
		
		
		return $this;
	}
	

}



