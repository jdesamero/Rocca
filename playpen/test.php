<?php

echo "\n\n";

// echo 'Foo Bar... ';
// echo phpversion();

define( 'PLAYPEN_CURDIR', dirname( __FILE__ ) );

require_once( sprintf( '%s/library/Rocca/Autoload.php', dirname( PLAYPEN_CURDIR ) ) );

Rocca_Autoload::getInstance()
	->registerPath( sprintf( '%s/library', PLAYPEN_CURDIR ) )
	->registerNamespace( 'Furdi', 'Some' )
	->init()
;

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

class Hoi_Poloi extends Rocca_Plugin
{


}

class Furdi_Plugin extends Rocca_Model_Plugin
{
	
	protected $_aModelPropMapping = array(
		'username:login',
		'id:friend_id|the_friend_id'
	);
	
	protected $_aModelDefaultValues = array(
		'id' => 999,
		'username' => 'nina_nine',
		'first_name' => 'Nina',
		'last_name' => 'Nine'		
	);
	
	
	
	//// static model
	
	
	//
	public function formatModelData( $mModelData ) {
		
		if ( is_string( $mModelData ) ) {
			
			$aValues = explode( ':', $mModelData );
			
			return [
				'id' => trim( $aValues[ 0 ] ),
				'username' => trim( $aValues[ 1 ] ),
				'first_name' => trim( $aValues[ 2 ] ),
				'last_name' => trim( $aValues[ 3 ] )
			];
		}
		
		return $mModelData;
	}
	
	
	//// magic calls modelGet*()
	
	//
	public function modelGetBigName( $sOut, $oModel, $sLala = NULL ) {
		
		if ( !$sOut ) {
			$sOut = $oModel->getFirstName();
		}
		
		return sprintf( '[ %s :: %s ]', strtoupper( $sOut ), $sLala );
	}
	
}

$oFurdiPlugin = Furdi_Plugin::getInstance();

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

$oSingle = Some_Single::getInstance();
$oSame = Some_Single::getInstance();

$oSame
	->addPlugin( 'Hoi_Poloi' )
	->dataSet( 'mouse', 'Furdi' )
	->dataSet( [
		'friend' => 'Ratzo',
		'sidekick' => 'Timmy'
	] )
	->setId( 10101 )
	->setTimmyTime( 'I am Timmew!' )
;

// print_r( $oSame->_getData() );
// print_r( $oSame->getId() );

// var_dump( Rocca_Inflector::camelize( 'timmy_time' ) );

$oSame->echoTimmyTime();

echo "\n\n";

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Furdi_Plugin, $oFurdiPlugin

$oSomeFriend = new Furdi_Friend( [
	'id' => 101,
	'username' => 'timmy_j',
	'first_name' => 'Timothy',
	'last_name' => 'Lamb'
], $oFurdiPlugin );

$oSomeFriend->setFirstName( 'Timothy (Timmy)' );


echo $oSomeFriend->getFullName();
// $oSomeFriend->echoFullName();

// print_r( strip_tags( $oSomeFriend->getHtml() ) );
print_r( $oSomeFriend->getHtml() );

echo "\n\n";

$aFriendRaw = [
	[
		'id' => 201,
		'username' => 'boo_bear',
		'first_name' => 'Bartholemew',
		'last_name' => 'Bear'
	], [
		'id' => 512,
		'username' => 'oh_hey',
		'first_name' => 'Orson',
		'last_name' => 'Hogg'
	], [
		'id' => 123,
		'username' => 'ratzo',
		'first_name' => 'Razto',
		'last_name' => 'Pink Rat'
	], [
		'id' => 501,
		'username' => 'pudgy.m',
		'first_name' => 'Isabella',
		'last_name' => 'Mouse'
	],
	'503:spider.ball:Spider:Ball'
];




$aFriends = new Furdi_Friend_Collection( $aFriendRaw, $oFurdiPlugin );
$aFriends->add( $oSomeFriend );

$oEmptyFriend = new Furdi_Friend( NULL, $oFurdiPlugin );
$aFriends->add( $oEmptyFriend );


$aFuji = [
	'id' => 502,
	'username' => 'fuji.c',
	'first_name' => 'Fuji',
	'last_name' => 'Cheburashka'
];

// $aFriends->add( $aFuji );
$aFriends[] = $aFuji;


foreach ( $aFriends as $oFriend ) {
	
	printf(
		"%d - %s (%s, %s) %s\n",
		$oFriend->getId(),
		$oFriend->getFullName(),
		$oFriend->getUsername(),
		$oFriend->getLogin(),
		$oFriend->getBigName( 'lala' )
	);
	
}

print_r( $aFriends->pluckId() );
print_r( $aFriends->pluck( 'login' ) );
// print_r( $aFriends->pluck( 'first_name' ) );

print_r( $aFriends->pluck( '##FirstName## [##__idx##:##LastName##]' ) );

print_r( $aFriends->pluck( '<option value="##Id##">##LastName##, ##FirstName##</option>' ) );


print_r( $aFriends->pluck( 'big_name', 'lolo' ) );


print_r( $aFriends->implode( 'login' ) );
echo "\n\n";

print_r( $aFriends->implode( '##Id##:##Login##', ' | ' ) );
echo "\n\n";

print_r( $aFriends->implodeId() );
echo "\n\n";

print_r( $aFriends->implodeId( ':' ) );
echo "\n\n";

print_r( $aFriends->implode( 'big_name', ', ', 'tata' ) );
echo "\n\n";

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


$oHomepage = Some_Layout_Homepage::getInstance();

print_r( $oHomepage->getMain() );

echo "\n\n";

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


echo 'Okay...';

echo "\n\n";



