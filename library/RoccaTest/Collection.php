<?php

//
class RoccaTest_Collection extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		
		$aBase = new Rocca_Collection( [
			[	'id' => 101,
				'username' => 'foo',
				'first_name' => 'Reg',
				'last_name' => 'Footman'
			],
			[	'id' => 102,
				'username' => 'bar',
				'first_name' => 'Leslie',
				'last_name' => 'Barrie'
			],
			[	'id' => 103,
				'username' => 'baz',
				'first_name' => 'Count',
				'last_name' => 'Basie'
			]
		] );
		
		
		//
		$this->assertGroup( 'count', function() use( $aBase ) {
			
			
			$this->assertArrayCount( 'init', 3, $aBase );
			
			
			$aBase->add( [
				'id' => 104,
				'username' => 'qux',
				'first_name' => 'Don',
				'last_name' => 'Quixote'			
			] );
			
			$this->assertArrayCount( 'add', 4, $aBase );
			
			
			
			$aBase->add( [
				[	'id' => 105,
					'username' => 'quux',
					'first_name' => 'Pancho',
					'last_name' => 'Sanchez'			
				],
				[	'id' => 106,
					'username' => 'corge',
					'first_name' => 'Billy',
					'last_name' => 'Corgan'			
				]
			] );
			
			$this->assertArrayCount( 'add more', 6, $aBase );
		
		} );
		
		
		//
		$this->assertGroup( 'pluck base', function() use( $aBase ) {
			
			$this
			
				->assertStrictlyEqual(
					'id',
					[ 101, 102, 103, 104, 105, 106 ],
					$aBase->pluck( 'id' )
				)
				
				->assertStrictlyEqual(
					'username',
					[ 'foo', 'bar', 'baz', 'qux', 'quux', 'corge' ],
					$aBase->pluck( 'username' )
				)
				
			;
			
		} );
		

		//
		$this->assertGroup( 'implode base', function() use( $aBase ) {
			
			$this
			
				->assertStrictlyEqual(
					'id',
					'101, 102, 103, 104, 105, 106',
					$aBase->implode( 'id' )
				)
				
				->assertStrictlyEqual(
					'username',
					'foo, bar, baz, qux, quux, corge',
					$aBase->implode( 'username' )
				)
				
			;
			
		} );
		
		
		// the class below will prefix the keys with "some-"
		$aSimple = new RoccaTest_Fixtures_Collection_Simple( [
			[	'id' => 216,
				'username' => 'spam'
			],
			[	'id' => 217,
				'username' => 'eggs'
			],
			[	'id' => 218,
				'username' => 'tomato'
			]
		] );
		
		//
		$this->assertGroup( 'pluck simple', function() use( $aSimple ) {
			
			$this
			
				->assertStrictlyEqual(
					'some-id',
					[ 216, 217, 218 ],
					$aSimple->pluck( 'some-id' )
				)
				
				->assertStrictlyEqual(
					'some-username',
					[ 'spam', 'eggs', 'tomato' ],
					$aSimple->pluck( 'some-username' )
				)
				
			;
			
		} );
		
		//
		$this->assertGroup( 'implode simple', function() use( $aSimple ) {
			
			$this
			
				->assertStrictlyEqual(
					'some-id',
					'216, 217, 218',
					$aSimple->implode( 'some-id' )
				)
				
				->assertStrictlyEqual(
					'some-username',
					'spam, eggs, tomato',
					$aSimple->implode( 'some-username' )
				)
				
			;
			
		} );
		
		
		
		return $this;
	}


}



