<?php

class Rocca_Model
{

	use Rocca_Model_GetSet;
	use Rocca_Echoable;
	use Rocca_Data;
	use Rocca_Plugin_Assign;
	use Rocca_HandleCall;
	
	
	protected $_aCallables = [ 'Echo', 'Model' ];
	
	protected $_sInstanceClass = NULL;
	protected $_sCollectionClass = NULL;
	
	protected $_aModelPropMapping = [];						// aliasing system
	protected $_bUseModelPropMapping = TRUE;
	
	
	
	//
	public function __construct( $aModel = NULL ) {
		
		
		// resolve related classes
		
		$this->_sInstanceClass = get_class( $this );
		
		$this->_sCollectionClass = Rocca_Class::resolveRelated(
			$this->_sInstanceClass, '_Collection', NULL, $this->_sCollectionClass
		);
		
		
		/* TO DO: Model property mapping might work better as part of class handler as these values
		 * are shared among the model instances for the particular class
		 *
		 * $this->_aModelPropMapping in theory may work as an instance override (rarely used)
		 */
		
		
		// class handler init, this can only happen once
		Rocca_Class_Handler::factory(
			$this->_sInstanceClass, sprintf( '%s_ClassHandler', __CLASS__ ), $this->_aModelPropMapping
		);
		
		
		
		// set model properties
		
		if ( is_array( $aModel ) ) {
			$this->modelRawSet( $aModel );
		} else {
			$this->modelInit();			// set with $this->_aModelDefaultValues, if defined
		}
		
	}
	
	
	
}


