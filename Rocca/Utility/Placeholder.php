<?php

// placeholder replacement class
class Rocca_Utility_Placeholder
{
	
	protected $_bHasPlaceholders = FALSE;
	
	protected $_sFormat = '';
	protected $_aPlaceholderKeys = array();
	
	
	
	
	//// static methods
	
	// factory method
	public static function create( $mFormat ) {
		
		$sClass = __CLASS__;
		
		if ( $mFormat instanceof $sClass ) {
			return $mFormat;
		}
		
		return new $sClass( $mFormat );
	}
	
	
	//// instance methods
	
	//
	public function __construct( $sFormat ) {
		
		// determine what $sFormat is
		if ( FALSE !== strpos( $sFormat, '##' ) ) {
						
			$aRegs = array();
			preg_match_all( '/##([^#]+)##/', $sFormat, $aRegs );
			
			$this->_aPlaceholderKeys = $aRegs[ 1 ];
			$this->_bHasPlaceholders = TRUE;
		}
		
		$this->_sFormat = $sFormat;
	}
	
	
	//
	public function getPopulated( $aValues = array(), $fPlaceholdersCb = NULL, $fNoPlaceholdersCb = NULL ) {
		
		$sFormat = $this->_sFormat;				// make a copy
		
		if ( $this->_bHasPlaceholders ) {
			
			//
			foreach ( $this->_aPlaceholderKeys as $sKey ) {
				
				$sReplace = '';
				
				if ( isset( $aValues[ $sKey ] ) ) {
					
					$sReplace = $aValues[ $sKey ];
				
				} elseif ( $fPlaceholdersCb ) {
					
					$sReplace = call_user_func( $fPlaceholdersCb, $sKey );
				}
				
				$sFormat = str_replace( sprintf( '##%s##', $sKey ), $sReplace, $sFormat );
			}

			return $sFormat;
			
		}
		
		if ( $fNoPlaceholdersCb ) {
			return call_user_func( $fNoPlaceholdersCb, $sFormat );
		}
		
		return $sFormat;
	}
	
	
}



