<?php

//
class RoccaTest_Model extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		
		$oFriend = new RoccaTest_Fixtures_Model_Friend( [
			'id' => 101,
			'username' => 'johnny',
			'first_name' => 'John',
			'last_name' => 'Doe',
			'is_friend' => TRUE
		] );
		
		
		$this
			
			->assertGroup( 'get*()', function() use ( $oFriend ) {
				
				$this
					
					->assertStrictlyEqual( 'int value', 101, $oFriend->getId() )
					->assertStrictlyEqual( 'string value', 'John', $oFriend->getFirstName() )
					->assertStrictlyEqual( 'bool value', TRUE, $oFriend->getIsFriend() )
					->assertStrictlyEqual( 'method value', 'John Doe', $oFriend->getFullName() )
					->assertStrictlyEqual( 'formatted value', 'John (Doe)', $oFriend->modelFormattedGet( '##FirstName## (##LastName##)' ) )
					->assertStrictlyEqual( 'formatted value 2', 'Doe, John', $oFriend->modelFormattedGet( '##last_name##, ##first_name##' ) )
					->assertStrictlyEqual( 'formatted value 3', 'johnny', $oFriend->modelFormattedGet( 'username' ) )
					
					->assertThrowsException(
						'Get non-existent entity',
						'Exception',
						function() use ( $oFriend ) {
							// this should throw an exception
							$oFriend->getSomeBogus();
						}
					)
					
				;
			
			} )
			
			->assertGroup( 'echo*()', function() use ( $oFriend ) {
				
				$this
					
					->assertStrictlyEqual( 'int value', '101', Rocca_String::fromOb( [ $oFriend, 'echoId' ] ) )
					->assertStrictlyEqual( 'string value', 'John', Rocca_String::fromOb( [ $oFriend, 'echoFirstName' ] ) )
					->assertStrictlyEqual( 'method value', 'John Doe', Rocca_String::fromOb( [ $oFriend, 'echoFullName' ] ) )
					
				;
				
			} )
			
			
		;
		
		
		$oFriend
			->setId( 5151 )
			->setLastName( 'Matthews' )
			->setColor( 'Red' )
		;

		$this
			
			->assertGroup( 'set*()', function() use ( $oFriend ) {
				
				$this
					->assertStrictlyEqual( 'int value', 5151, $oFriend->getId() )
					->assertStrictlyEqual( 'string value', 'Matthews', $oFriend->getLastName() )
					->assertStrictlyEqual( 'new value', 'Red', $oFriend->getColor() )
				;
				
			} )
		;
		
		return $this;
	}
	
	
	
}



