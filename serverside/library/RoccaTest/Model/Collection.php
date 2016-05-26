<?php

//
class RoccaTest_Model_Collection extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		
		$aFriends = new RoccaTest_Fixtures_Model_Friend_Collection( [
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
		$this->assertGroup( 'count', function() use( $aFriends ) {
			
			
			$this->assertArrayCount( 'init', 3, $aFriends );
			
			
			$aFriends->add( [
				'id' => 104,
				'username' => 'qux',
				'first_name' => 'Don',
				'last_name' => 'Quixote'			
			] );
			
			$this->assertArrayCount( 'add', 4, $aFriends );
			
			
			
			$aFriends->add( [
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
			
			$this->assertArrayCount( 'add more', 6, $aFriends );
		
		} );
		
		
		//
		$this->assertGroup( 'pluck', function() use( $aFriends ) {
			
			$this
			
				->assertStrictlyEqual(
					'id',
					[ 101, 102, 103, 104, 105, 106 ],
					$aFriends->pluck( 'id' )
				)
				
				->assertStrictlyEqual(
					'id 2',
					[ 101, 102, 103, 104, 105, 106 ],
					$aFriends->pluckId()
				)
				
				->assertStrictlyEqual(
					'id 3',
					[ '101', '102', '103', '104', '105', '106' ],
					$aFriends->pluck( '##id##' )
				)
				
				->assertStrictlyEqual(
					'id 4',
					[ '101', '102', '103', '104', '105', '106' ],
					$aFriends->pluck( '##Id##' )
				)
				
				->assertStrictlyEqual(
					'formatted',
					[ '101: Reg', '102: Leslie', '103: Count', '104: Don', '105: Pancho', '106: Billy' ],
					$aFriends->pluck( '##id##: ##first_name##' )
				)
				
				->assertStrictlyEqual(
					'formatted 2',
					[ '101 (Reg)', '102 (Leslie)', '103 (Count)', '104 (Don)', '105 (Pancho)', '106 (Billy)' ],
					$aFriends->pluck( '##id## (##first_name##)' )
				)
				
			;
			
		} );
		

		//
		$this->assertGroup( 'implode', function() use( $aFriends ) {
			
			$this
			
				->assertStrictlyEqual(
					'id',
					'101, 102, 103, 104, 105, 106',
					$aFriends->implode( 'id' )
				)
				
				->assertStrictlyEqual(
					'id 2',
					'101|102|103|104|105|106',
					$aFriends->implodeId( '|' )
				)
				
				->assertStrictlyEqual(
					'id 3',
					'{101} {102} {103} {104} {105} {106}',
					sprintf( '{%s}', $aFriends->implode( '##id##', '} {' ) )
				)
				
				->assertStrictlyEqual(
					'formatted',
					'101: Reg, 102: Leslie, 103: Count, 104: Don, 105: Pancho, 106: Billy',
					$aFriends->implode( '##id##: ##first_name##' )
				)
				
				->assertStrictlyEqual(
					'formatted 2',
					'101 (Reg) | 102 (Leslie) | 103 (Count) | 104 (Don) | 105 (Pancho) | 106 (Billy)',
					$aFriends->implode( '##id## (##first_name##)', ' | ' )
				)
				
			;
			
		} );
		
		
		return $this;
	}


}



