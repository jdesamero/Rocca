<?php

//
class RoccaTest_String extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		$this
			
			
			//// Rocca_String::fromOb
			
			->assertStrictlyEqual(
				'From ob, closure',
				'I am cool',
				Rocca_String::fromOb( function() {
					?>I am cool<?php
				} )
			)
			
			->assertStrictlyEqual(
				'From ob, closure with args',
				'I am color Red + Green',
				Rocca_String::fromOb( function( $sColor1, $sColor2 ) {
					?>I am color <?php echo $sColor1; ?> + <?php echo $sColor2;
				}, 'Red', 'Green' )
			)
			
			->assertStrictlyEqual(
				'From ob, method',
				'I am cool',
				Rocca_String::fromOb( array( $this, 'fixtureShowCool' ) )
			)
			
			->assertStrictlyEqual(
				'From ob, method with args',
				'I am color Red + Green',
				Rocca_String::fromOb( array( $this, 'fixtureShowColor' ), 'Red', 'Green' )
			)
			
			
			
			//// Rocca_String::fromObArray
			
			->assertStrictlyEqual(
				'From obArray, closure',
				'I am warm',
				Rocca_String::fromObArray( function() {
					?>I am warm<?php
				} )
			)
			
			->assertStrictlyEqual(
				'From obArray, closure with args',
				'I am planet Mars + Uranus',
				Rocca_String::fromObArray( function( $sPlanet1, $sPlanet2 ) {
					?>I am planet <?php echo $sPlanet1; ?> + <?php echo $sPlanet2;
				}, array( 'Mars', 'Uranus' ) )
			)
			
			->assertStrictlyEqual(
				'From obArray, method',
				'I am warm',
				Rocca_String::fromObArray( array( $this, 'fixtureShowWarm' ) )
			)
			
			->assertStrictlyEqual(
				'From obArray, method with args',
				'I am planet Mars + Uranus',
				Rocca_String::fromObArray( array( $this, 'fixtureShowPlanet' ), array( 'Mars', 'Uranus' ) )
			)
			
			
		;
		
		
		
		return $this;
	}
	
	
	//
	public function fixtureShowCool() {
		?>I am cool<?php
	}
	
	//
	public function fixtureShowColor( $sColor1, $sColor2 ) {
		?>I am color <?php echo $sColor1; ?> + <?php echo $sColor2;
	}
	
	//
	public function fixtureShowWarm() {
		?>I am warm<?php
	}
	
	//
	public function fixtureShowPlanet( $sPlanet1, $sPlanet2 ) {
		?>I am planet <?php echo $sPlanet1; ?> + <?php echo $sPlanet2;
	}
	
	
}



