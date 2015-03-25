<?php

//
class Furdi_Friend extends Rocca_Model
{
	
	protected $_aMapping = array(
		'username:login',
		'id:friend_id|the_friend_id'
	);
	
	
	
	//
	public function getFullName() {
		return sprintf( '%s %s', $this->getFirstName(), $this->getLastName() );
	}
	
	//
	public function echoHtml() {
		?><b><?php $this->echoFirstName(); ?></b><?php
	}
	
}


