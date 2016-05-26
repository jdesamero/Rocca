<?php

//
class Furdi_Friend extends Rocca_Model
{
	
	//
	public function getFullName() {
		return sprintf( '%s %s', $this->getFirstName(), $this->getLastName() );
	}
	
	//
	public function echoHtml() {
		?><b><?php $this->echoFirstName(); ?></b><?php
	}
	
}


