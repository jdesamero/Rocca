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
		
		$oEmptyFriend = new RoccaTest_Fixtures_Model_Friend();
		
		
		$oFruit = new Rocca_Model( [
			'id' => 201,
			'name' => 'Banana',
			'colour' => 'Yellow',
			'shape' => 'long',
			'is_fresh' => FALSE
		] );
		
		
		//
		$this
			
			->assertGroup( 'get*()', function() use ( $oFriend, $oEmptyFriend, $oFruit ) {
				
				$this
					
					// friend
					
					->assertStrictlyEqual( 'a. int value', 101, $oFriend->getId() )
					->assertStrictlyEqual( 'a. string value', 'John', $oFriend->getFirstName() )
					->assertStrictlyEqual( 'a. bool value', TRUE, $oFriend->getIsFriend() )
					->assertStrictlyEqual( 'a. method value', 'John Doe', $oFriend->getFullName() )
					
					->assertStrictlyEqual( 'a. formatted value', 'John (Doe)', $oFriend->modelFormattedGet( '##FirstName## (##LastName##)' ) )
					->assertStrictlyEqual( 'a. formatted value 2', 'Doe, John', $oFriend->modelFormattedGet( '##last_name##, ##first_name##' ) )
					->assertStrictlyEqual( 'a. formatted value 3', 'johnny', $oFriend->modelFormattedGet( 'username' ) )
					
					->assertStrictlyEqual( 'a. has prop', TRUE, $oFriend->modelHasProp( 'username' ) )
					->assertStrictlyEqual( 'a. has prop 2', FALSE, $oFriend->modelHasProp( 'some_bogus' ) )
					
					->assertStrictlyEqual( 'a. mapped prop', 101, $oFriend->getFriendId() )
					->assertStrictlyEqual( 'a. plugin prop', 'JOHN DOE', $oFriend->getUcFullName() )
					->assertStrictlyEqual( 'a. plugin prop arg', 'JOHN DOE XXX', $oFriend->getUcFullName( 'xxx' ) )
					
					
					
					// empty friend

					->assertStrictlyEqual( 'b. int value', 555, $oEmptyFriend->getId() )
					->assertStrictlyEqual( 'b. string value', 'nobody', $oEmptyFriend->getUsername() )
					->assertStrictlyEqual( 'b. bool value', TRUE, $oEmptyFriend->getIsCool() )
					->assertStrictlyEqual( 'b. method value', 'No Body', $oEmptyFriend->getFullName() )
					
					
					
					// fruit
					
					->assertStrictlyEqual( 'c. int value', 201, $oFruit->getId() )
					->assertStrictlyEqual( 'c. string value', 'Banana', $oFruit->getName() )
					->assertStrictlyEqual( 'c. bool value', FALSE, $oFruit->getIsFresh() )
					
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
		
		//
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



