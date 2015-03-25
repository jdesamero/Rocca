<?php

trait Rocca_Echoable
{
	
	
	//
	public function echoValue( $sProp = NULL, $aArgs = array() ) {
		
		$sMethod = sprintf( 'get%s', Rocca_Inflector::camelize( $sProp ) );
		
		if ( method_exists( $this, $sMethod ) ) {
			echo call_user_func_array( array( $this, $sMethod ), $aArgs );
		}
		
		if ( method_exists( $this, 'modelRawGet' ) ) {
			echo $this->modelRawGet( $sProp );
		}
		
		return $this;
	}
	
	
	//
	public function echoGetValue( $sProp = NULL, $aArgs = array() ) {
		
		$sMethod = sprintf( 'echo%s', Rocca_Inflector::camelize( $sProp ) );
		
		if ( method_exists( $this, $sMethod ) ) {
			
			ob_start();
			call_user_func_array( array( $this, $sMethod ), $aArgs );
			$sOut = ob_get_contents();
			ob_end_clean();
			
			return $sOut;
		}
		
		return $this->modelRawGet( $sProp );
	}
	
	
	//
	public function handleEchoCall( $sMethod, $aArgs ) {
		
		$aHandler = FALSE;
		
		if ( 0 === strpos( $sMethod, 'echo' ) ) {

			$sProp = Rocca_Inflector::underscore( substr( $sMethod, 4 ) );
			$aHandler = array( 'echo', $sProp );
			
		} elseif ( 0 === strpos( $sMethod, 'get' ) ) {
			
			$sSuffix = substr( $sMethod, 3 );
			$sMethod = sprintf( 'echo%s', $sSuffix );
			
			// only kicks in if echo() method exists
			
			if ( method_exists( $this, $sMethod ) ) {
				$sProp = Rocca_Inflector::underscore( $sSuffix );
				$aHandler = array( 'get', $sProp );
			}
			
		}
		
		
		return $aHandler;
	}
	
	
	//
	public function echoCall( $aHandler, $aArgs ) {
				
		list( $sOp, $sProp ) = $aHandler;
		
		if ( 'echo' == $sOp ) {
		
			return $this->echoValue( $sProp, $aArgs );
			
		} elseif ( 'get' == $sOp ) {
			
			return $this->echoGetValue( $sProp, $aArgs );
			
		}
		
	}


}


