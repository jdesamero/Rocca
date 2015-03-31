<?php

//
class RoccaTest_String extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		$oThis = $this;
		
		$this

			//// Rocca_String::fromOb
			
			->assertGroup( 'fromOb()', function() use ( $oThis ) {
				
				$oThis
					
					->assertStrictlyEqual(
						'closure',
						'I am cool',
						Rocca_String::fromOb( function() {
							?>I am cool<?php
						} )
					)
					
					->assertStrictlyEqual(
						'closure with args',
						'I am color Red + Green',
						Rocca_String::fromOb( function( $sColor1, $sColor2 ) {
							?>I am color <?php echo $sColor1; ?> + <?php echo $sColor2;
						}, 'Red', 'Green' )
					)
					
					->assertStrictlyEqual(
						'method',
						'I am cool',
						Rocca_String::fromOb( array( $this, 'fixtureShowCool' ) )
					)
					
					->assertStrictlyEqual(
						'method with args',
						'I am color Red + Green',
						Rocca_String::fromOb( array( $this, 'fixtureShowColor' ), 'Red', 'Green' )
					)
				
				;
			
			} )
			
			
			
			//// Rocca_String::fromObArray
			
			->assertGroup( 'fromObArray()', function() use ( $oThis ) {
				
				$oThis
				
					->assertStrictlyEqual(
						'closure',
						'I am warm',
						Rocca_String::fromObArray( function() {
							?>I am warm<?php
						} )
					)
					
					->assertStrictlyEqual(
						'closure with args',
						'I am planet Mars + Uranus',
						Rocca_String::fromObArray( function( $sPlanet1, $sPlanet2 ) {
							?>I am planet <?php echo $sPlanet1; ?> + <?php echo $sPlanet2;
						}, array( 'Mars', 'Uranus' ) )
					)
					
					->assertStrictlyEqual(
						'method',
						'I am warm',
						Rocca_String::fromObArray( array( $this, 'fixtureShowWarm' ) )
					)
					
					->assertStrictlyEqual(
						'method with args',
						'I am planet Mars + Uranus',
						Rocca_String::fromObArray( array( $this, 'fixtureShowPlanet' ), array( 'Mars', 'Uranus' ) )
					)
					
				;
				
			} )

			
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



