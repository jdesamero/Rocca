<?php

// used to store auxiliary information/data
trait Rocca_Data
{
	
	protected $_aData = array();
	
	//
	public function dataSet() {
		
		$aArgs = func_get_args();
		
		if ( is_array( $aData = $aArgs[ 0 ] ) ) {
			
			foreach ( $aData as $sKey => $mValue ) {
				$this->_aData[ $sKey ] = $mValue;
			}
			
		} else {
			
			list( $sKey, $mValue ) = $aArgs;
			
			$this->_aData[ $sKey ] = $mValue;
		}
		
		return $this;
	}
	
	//
	public function dataGet( $sKey = NULL ) {
		
		if ( NULL === $sKey ) {
			return $this->_aData;
		}
		
		return $this->_aData[ $sKey ];
	}
	
	
}

