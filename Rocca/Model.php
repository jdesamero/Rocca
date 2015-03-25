<?php

class Rocca_Model
{

	use Rocca_Model_GetSet;
	use Rocca_Echoable;
	use Rocca_Data;
	use Rocca_Plugin_Assign;
	use Rocca_HandleCall;
	
	
	protected $_aCallables = array( 'Echo', 'Model' );
	
	protected $_sInstanceClass = NULL;
	protected $_sCollectionClass = NULL;
	
	protected $_aMapping = array();					// aliasing system
	
	
	
	//
	public function __construct( $aModel = NULL ) {
		
		
		// resolve related classes
		
		$this->_sInstanceClass = get_class( $this );
		
		$this->_sCollectionClass = Rocca_Class::resolveRelated(
			$this->_sInstanceClass, '_Collection', NULL, $this->_sCollectionClass
		);
		
		
		// set model properties
		
		if ( is_array( $aModel ) ) {
			$this->modelRawSet( $aModel );
		}
		
	}
	
	
	
}


