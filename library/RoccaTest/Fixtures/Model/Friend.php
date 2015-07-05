<?php

//
class RoccaTest_Fixtures_Model_Friend extends Rocca_Model
{
	
	protected $_aModelPropMapping = [
		'username:login',
		'id:friend_id|the_friend_id'
	];
	
	protected $_aModelDefaultValues = [
		'id' => NULL,
		'username' => NULL,
		'first_name' => NULL,
		'last_name' => NULL
	];
	
	
	//
	public function getFullName() {
		return sprintf( '%s %s', $this->getFirstName(), $this->getLastName() );
	}
	
	//
	public function echoHtml() {
		?><b><?php $this->echoFirstName(); ?></b><?php
	}
	
}

