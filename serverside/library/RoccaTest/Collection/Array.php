<?php

//
class RoccaTest_Collection_Array extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		
		$aSimple = new RoccaTest_Fixtures_Collection_Array_Simple( [ 'Roland', 'Kurt' ] );
		
		
		//
		$this->assertGroup( 'count', function() use( $aSimple ) {
			
			$this->assertArrayCount( 'init', 2, $aSimple );
			
			$aSimple->add( 'Gary' );
			
			$this->assertArrayCount( 'add', 3, $aSimple );
			
			$aSimple->add( [ 'Simon', 'Tony' ] );
			
			$this->assertArrayCount( 'add more', 5, $aSimple );
			
		} );
		
		
		//
		$this->assertGroup( 'index', function() use( $aSimple ) {
			
			$this
				->assertStrictlyEqual( 'access', 'Gary', $aSimple[ 2 ] )
				->assertStrictlyEqual( 'access 2', 'Tony', $aSimple[ 4 ] )
			;
			
			$aSimple[ 1 ] = 'Nick';
			
			$this->assertStrictlyEqual( 'set', 'Nick', $aSimple[ 1 ] );
			
		} );
		
		
		$aCompare = [ 'Roland', 'Nick', 'Gary', 'Simon', 'Tony' ];
		
		
		//
		$this->assertGroup( 'iterate', function() use( $aSimple, $aCompare ) {
			
			foreach ( $aSimple as $i => $sMember ) {
				$this->assertStrictlyEqual( sprintf( 'index %d', $i ), $sMember, $aCompare[ $i ] );
			}
		
		} );
		
		
		return $this;
	}


}



