<?php

//
class RoccaTest_String extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		
		$this

			//// Rocca_String::fromOb
			
			->assertGroup( 'fromOb()', function() {
				
				$this
					
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
			
			->assertGroup( 'fromObArray()', function() {
				
				$this
				
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


			//// Rocca_String::fromObArray
			
			->assertGroup( 'chunk()', function() {
				
				$sText = file_get_contents( sprintf(
					'%s/test_files/text/lorem_ipsum.txt',
					dirname( dirname( __FILE__ ) )
				) );
				
				$aChunks = Rocca_String::chunk( $sText );
				
				$this
					->assertType( 'chunked type', 'array', $aChunks )
					->assertArrayCount( 'chunked count', 7, $aChunks )
					->assertMd5Hash( 'chunked hash', 'd5cf6b9cf6e3651c19ffb2509f17050d', $aChunks[ 0 ] )
					->assertMd5Hash( 'chunked hash 2', '93b1ce46549b48728d84da4d21dc73e0', $aChunks[ 3 ] )
					->assertMd5Hash( 'chunked hash 3', '0045506f9ff3ee456878221746aa9a9c', $aChunks[ 6 ] )
				;
								
				/* /
				foreach ( $aChunks as $sChunk ) {
					printf( "[%s] (%d) [%s]\n\n", $sChunk, strlen( $sChunk ), md5( $sChunk ) );
				}
				/* */
				
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



