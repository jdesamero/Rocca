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
	
	
	
	//
	public function __construct( $mModelData = NULL, $mPlugin = NULL ) {
		
		$this->addPlugins( $mPlugin );
		
		
		// resolve related classes
		
		$this->_sInstanceClass = get_class( $this );
		
		$this->_sCollectionClass = Rocca_Class::resolveRelated(
			$this->_sInstanceClass, '_Collection', NULL, $this->_sCollectionClass
		);
		
		
		// format model data via plugins, if applicable
		if ( $this->_bHasPlugin ) {
			$mModelData = $this->applyPluginFilter( 'formatModelData', $mModelData );
		}
		
		
		// set model properties
		
		if ( is_array( $mModelData ) ) {
			$this->modelRawSet( $mModelData );
		} else {
			$this->modelInit();			// set with $this->_aModelDefaultValues, if defined
		}
		
	}
	
	
	
}


