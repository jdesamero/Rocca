<?php

//
class RoccaTest_Fixtures_Model_Friend_Plugin extends Rocca_Model_Plugin
{
	
	
	protected $_aModelPropMapping = [
		'username:login',
		'id:friend_id|the_friend_id'
	];
	
	protected $_aModelDefaultValues = [
		'id' => 555,
		'username' => 'nobody',
		'first_name' => 'No',
		'last_name' => 'Body',
		'is_cool' => TRUE
	];
	
	
	//
	public function modelGetUcFullName( $sOut, $oModel, $sSuffix = NULL ) {
		
		if ( !$sOut ) {
			$sOut = $oModel->getFullName();
		}
		
		if ( $sSuffix ) {
			$sOut = trim( sprintf( '%s %s', $sOut, $sSuffix ) );
		}
		
		return strtoupper( $sOut );
	}
	
	
}


