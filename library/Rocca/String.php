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
	public function fromObArray( $fOutputCb, $aArgs = [] ) {
		
		ob_start();
		call_user_func_array( $fOutputCb, $aArgs );
		$sOut = ob_get_contents();
		ob_end_clean();
		
		return $sOut;
	}
	
	
	
	/* break a large blob of text into chunks
	 * $sBreakPoints are allowed characters where breaks can take place
	 */
	public function chunk( $sText, $iChunkLen = 255, $sBreakPoints = " .,!?:;\n\r\t" ) {
		
		if ( strlen( $sText ) <= $iChunkLen ) {
			return $sText;
		}
		
		
		//// break it down
		
		$aBroken = [];
		
		while ( strlen( $sText ) > $iChunkLen ) {
			
			$sPart = substr( $sText, 0, $iChunkLen );
			
			$iLen = strlen( $sPart );
			
			while ( TRUE ) {
				$sLastChar = $sPart[ $iLen - 1 ];
				if ( FALSE === strpos( $sBreakPoints, $sLastChar ) ) {
					$iLen--;
				} else {
					break;
				}
			}
			
			$sPart = substr( $sText, 0, $iLen );
			
			$aBroken[] = $sPart;
			$sText = substr( $sText, $iLen );
			
		}
		
		// add last part
		$aBroken[] = $sText;
		
		return $aBroken;
	}
	
	
	
}



