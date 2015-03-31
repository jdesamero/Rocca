<?php

//
class RoccaTest_Model extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		
		$oFriend = new RoccaTest_Fixtures_Friend( array(
			'id' => 101,
			'username' => 'johnny',
			'first_name' => 'John',
			'last_name' => 'Doe',
			'is_friend' => TRUE
		) );
		
		
		$this
			
			->assertStrictlyEqual( 'Get int value', 101, $oFriend->getId() )
			->assertStrictlyEqual( 'Get string value', 'John', $oFriend->getFirstName() )
			->assertStrictlyEqual( 'Get bool value', TRUE, $oFriend->getIsFriend() )
			->assertStrictlyEqual( 'Get method value', 'John Doe', $oFriend->getFullName() )
			->assertStrictlyEqual( 'Get formatted value', 'John (Doe)', $oFriend->modelFormattedGet( '##FirstName## (##LastName##)' ) )
			->assertStrictlyEqual( 'Get formatted value 2', 'Doe, John', $oFriend->modelFormattedGet( '##last_name##, ##first_name##' ) )
			->assertStrictlyEqual( 'Get formatted value 3', 'johnny', $oFriend->modelFormattedGet( 'username' ) )
			
			->assertStrictlyEqual( 'Echo int value', '101', Rocca_String::fromOb( array( $oFriend, 'echoId' ) ) )
			->assertStrictlyEqual( 'Echo string value', 'John', Rocca_String::fromOb( array( $oFriend, 'echoFirstName' ) ) )
			->assertStrictlyEqual( 'Echo method value', 'John Doe', Rocca_String::fromOb( array( $oFriend, 'echoFullName' ) ) )
			
		;
		
		
		$oFriend
			->setId( 5151 )
			->setLastName( 'Matthews' )
			->setColor( 'Red' )
		;

		$this
			->assertStrictlyEqual( 'Set int value', 5151, $oFriend->getId() )		
			->assertStrictlyEqual( 'Set string value', 'Matthews', $oFriend->getLastName() )		
			->assertStrictlyEqual( 'Set new value', 'Red', $oFriend->getColor() )		
		;
		
		return $this;
	}
	
	
	
}



