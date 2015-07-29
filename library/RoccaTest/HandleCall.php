<?php

//
class RoccaTest_HandleCall extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		
		$oMagic = new RoccaTest_Fixtures_HandleCall_Foo();
		
		$oMagic->fooBar( 'yes' );
		
		$this
			
			->assertStrictlyEqual( 'simple 1', 'Bar: yes', $oMagic->fooBar( 'yes' ) )
			->assertStrictlyEqual( 'simple 2', 'Baz: no', $oMagic->fooBaz( 'no' ) )

			->assertStrictlyEqual( 'simple 3', 'tok-en', $oMagic->bartok( 'en' ) )
			->assertStrictlyEqual( 'simple 4', 'ter-rain', $oMagic->barter( 'rain' ) )
			
			
			->assertThrowsException(
				'Throw exception 1',
				'Exception',
				function () use ( $oMagic ) {
					// this should throw an exception
					$oMagic->foodsOfMine( 'lots' );
				}
			)
			
			->assertThrowsException(
				'Throw exception 2',
				'Exception',
				function () use ( $oMagic ) {
					// this should throw an exception
					$oMagic->bArToK( 'bela' );
				}
			)
			
		;
		
		return $this;
	}
	
	
}



