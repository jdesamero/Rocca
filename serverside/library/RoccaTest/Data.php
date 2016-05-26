<?php

//
class RoccaTest_Data extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		
		$oSimple = new RoccaTest_Fixtures_Data_Simple();
		
		$oSimple->dataSet( [
			'id' => 5637,
			'first_name' => 'Elizabeth',
			'last_name' => 'Banks'
		] );
		
		
		$this
			->assertStrictlyEqual( 'set array', 5637, $oSimple->dataGet( 'id' ) )
			->assertStrictlyEqual( 'set array 2', 'Banks', $oSimple->dataGet( 'last_name' ) )
		;
		
		$oSimple
			->dataSet( 'last_name', 'Hurley' )
			->dataSet( 'occupation', 'Model/Actress' )
			->dataSet( 'gender', 'Female' )
		;
		
		
		$this
			->assertStrictlyEqual( 'set key/value pair', 'Model/Actress', $oSimple->dataGet( 'occupation' ) )
			->assertStrictlyEqual( 'set key/value pair 2', 'Female', $oSimple->dataGet( 'gender' ) )
			->assertStrictlyEqual( 'set key/value pair 3', 'Hurley', $oSimple->dataGet( 'last_name' ) )
		;
		
		$aCompare = [
			'id' => 5637,
			'first_name' => 'Elizabeth',
			'last_name' => 'Hurley',
			'occupation' => 'Model/Actress',
			'gender' => 'Female'
		];
		
		
		$this->assertStrictlyEqual( 'entire data', $aCompare, $oSimple->dataGet() );
		
		
		return $this;
	}


}



