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
	protected $_sDefaultPluginClass = NULL;
	
	
	
	//
	public function __construct( $mModelData = NULL, $mPlugin = NULL ) {
		
		// resolve related classes
		
		$sInstanceClass = get_class( $this );
		
		$sCollectionClass = Rocca_Class::resolveRelated(
			$sInstanceClass, '_Collection', NULL, $sCollectionClass
		);
		
		$sDefaultPluginClass = Rocca_Class::resolveRelated(
			$sInstanceClass, '_Plugin', NULL, $sDefaultPluginClass
		);
		
		
		$this->_sInstanceClass = $sInstanceClass;
		$this->_sCollectionClass = $sCollectionClass;
		$this->_sDefaultPluginClass = $sDefaultPluginClass;
		
		
		//
		if ( $sDefaultPluginClass ) {
			$mPlugin = $this->pushPlugin( $mPlugin, $sDefaultPluginClass );
		}
		
		// add plugins
		$this->addPlugins( $mPlugin );
		
		
		
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


