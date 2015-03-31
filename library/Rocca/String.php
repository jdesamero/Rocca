<?php

//
class Rocca_String
{
	
	
	// returns string
	public function fromOb() {
		
		$aArgs = func_get_args();
		
		$fOutputCb = array_shift( $aArgs );
		
		ob_start();
		call_user_func_array( $fOutputCb, $aArgs );
		$sOut = ob_get_contents();
		ob_end_clean();
		
		return $sOut;
	}
	
	
	// returns string
	public function fromObArray( $fOutputCb, $aArgs = array() ) {
		
		ob_start();
		call_user_func_array( $fOutputCb, $aArgs );
		$sOut = ob_get_contents();
		ob_end_clean();
		
		return $sOut;
	}
	
	
	
	
}



