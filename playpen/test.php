<?php

echo "\n\n";

// echo 'Foo Bar... ';
// echo phpversion();


require_once '../library/Rocca/Autoload.php';

Rocca_Autoload::getInstance()
	->registerPath( sprintf( '%s/library', dirname( __FILE__ ) ) )
	->registerNamespace( 'Furdi', 'Some' )
	->init()
;

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

class Hoi_Poloi extends Rocca_Plugin
{


}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

$oSingle = Some_Single::getInstance();
$oSame = Some_Single::getInstance();

$oSame
	->addPlugin( 'Hoi_Poloi' )
	->dataSet( 'mouse', 'Furdi' )
	->dataSet( array(
		'friend' => 'Ratzo',
		'sidekick' => 'Timmy'
	) )
	->setId( 10101 )
	->setTimmyTime( 'I am Timmew!' )
;

// print_r( $oSame->_getData() );
// print_r( $oSame->getId() );

// var_dump( Rocca_Inflector::camelize( 'timmy_time' ) );

$oSame->echoTimmyTime();

echo "\n\n";

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

$oSomeFriend = new Furdi_Friend( array(
	'id' => 101,
	'username' => 'timmy_j',
	'first_name' => 'Timothy',
	'last_name' => 'Lamb'
) );

$oSomeFriend->setFirstName( 'Timothy (Timmy)' );

echo $oSomeFriend->getFullName();
// $oSomeFriend->echoFullName();

// print_r( strip_tags( $oSomeFriend->getHtml() ) );
print_r( $oSomeFriend->getHtml() );

echo "\n\n";

$aFriends = array(
	array(
		'id' => 201,
		'username' => 'boo_bear',
		'first_name' => 'Bartholemew',
		'last_name' => 'Bear'
	),
	array(
		'id' => 512,
		'username' => 'oh_hey',
		'first_name' => 'Orson',
		'last_name' => 'Hogg'
	),
	array(
		'id' => 123,
		'username' => 'ratzo',
		'first_name' => 'Razto',
		'last_name' => 'Pink Rat'
	),
	array(
		'id' => 501,
		'username' => 'pudgy.m',
		'first_name' => 'Isabella',
		'last_name' => 'Mouse'
	)
);

$oFriends = new Furdi_Friend_Collection( $aFriends );
$oFriends->add( $oSomeFriend );

$oEmptyFriend = new Furdi_Friend();
$oFriends->add( $oEmptyFriend );


foreach ( $oFriends as $oFriend ) {
	
	printf(
		"%d - %s (%s, %s)\n",
		$oFriend->getId(),
		$oFriend->getFullName(),
		$oFriend->getUsername(),
		$oFriend->getLogin()
	);
	
}

print_r( $oFriends->pluckId() );
print_r( $oFriends->pluck( 'login' ) );
// print_r( $oFriends->pluck( 'first_name' ) );

print_r( $oFriends->pluck( '##FirstName## [##__idx##:##LastName##]' ) );

print_r( $oFriends->pluck( '<option value="##Id##">##LastName##, ##FirstName##</option>' ) );


print_r( $oFriends->implode( 'login' ) );
echo "\n\n";

print_r( $oFriends->implode( '##Id##:##Login##', ' | ' ) );
echo "\n\n";

print_r( $oFriends->implodeId() );
echo "\n\n";

print_r( $oFriends->implodeId( ':' ) );
echo "\n\n";


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


$oHomepage = Some_Layout_Homepage::getInstance();

print_r( $oHomepage->getMain() );

echo "\n\n";

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


echo 'Okay...';

echo "\n\n";


