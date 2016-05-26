<?php

//
class RoccaTest_Array extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		
		$this->assertGroup( 'hasNumericIndex()', function() {
			
			$this
				
				->assertStrictlyEqual(
					'not an array or Iterator',
					NULL,
					Rocca_Array::hasNumericIndex( 'Foo' )
				)
				
				->assertStrictlyEqual(
					'not an array or Iterator 2',
					NULL,
					Rocca_Array::hasNumericIndex( new StdClass )
				)
				
				->assertStrictlyEqual(
					'numerically indexed',
					TRUE,
					Rocca_Array::hasNumericIndex( [ 'a', 'b', 'c' ] )
				)
				
				->assertStrictlyEqual(
					'numerically indexed 2',
					TRUE,
					Rocca_Array::hasNumericIndex( [ 3 => 'a', 10 => 'b', 101 => 'c' ] )
				)
				
				->assertStrictlyEqual(
					'mixed index',
					FALSE,
					Rocca_Array::hasNumericIndex( [ 1 => 'a', 'foo' => 'bar' ] )
				)

				->assertStrictlyEqual(
					'associative index',
					FALSE,
					Rocca_Array::hasNumericIndex( [ 'id' => 101, 'name' => 'John', 'age' => 25 ] )
				)
				
			;
			
		} );
		
		return $this;
	}


}



