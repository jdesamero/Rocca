<?php

//
class RoccaTest_Utility_Placeholder extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		$oPlaceholder = Rocca_Utility_Placeholder::create( 'I am ##FirstName##, and I am ##Years## years old!' );
		$oSame = Rocca_Utility_Placeholder::create( $oPlaceholder );
		
		
		$oNoChange = Rocca_Utility_Placeholder::create( 'No change expected' );		
		
		
		$this
			
			->assertInstanceOf( 'Correct instance class', Rocca_Utility_Placeholder, $oPlaceholder )
			->assertStrictlyEqual( 'Get same', $oPlaceholder, $oSame )
			
			->assertStrictlyEqual(
				'Get populated',
				'I am Furdi, and I am 20 years old!',
				$oPlaceholder->getPopulated( [
					'FirstName' => 'Furdi',
					'Years' => 20
				] )
			)

			->assertStrictlyEqual(
				'Get populated callback',
				'I am Timmy, and I am 5 years old!',
				$oPlaceholder->getPopulated( [], function( $sKey ) {
					
					if ( 'FirstName' == $sKey ) {
						return 'Timmy';
					} elseif ( 'Years' == $sKey ) {
						return 5;
					}
					
				} )
			)
			
			->assertStrictlyEqual( 'No change', 'No change expected', $oNoChange->getPopulated() )

			->assertStrictlyEqual(
				'Get no placeholder callback',
				'CHANGE EXPECTED',
				$oNoChange->getPopulated( [], NULL, function( $sFormat ) {
					return substr( strtoupper( $sFormat ), 3 );
				} )
			)

			
		;
		
		
		return $this;
	}
	

}



