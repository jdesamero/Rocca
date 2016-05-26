<?php

trait Rocca_Echoable
{
	
	
	//
	public function echoValue( $sProp = NULL, $aArgs = [] ) {
		
		$sMethod = sprintf( 'get%s', Rocca_Inflector::camelize( $sProp ) );
		
		if ( method_exists( $this, $sMethod ) ) {
			echo call_user_func_array( [ $this, $sMethod ], $aArgs );
		}
		
		if ( method_exists( $this, 'modelRawGet' ) ) {
			echo $this->modelRawGet( $sProp );
		}
		
		return $this;
	}
	
	
	//
	public function echoGetValue( $sProp = NULL, $aArgs = [] ) {
		
		$sMethod = sprintf( 'echo%s', Rocca_Inflector::camelize( $sProp ) );
		
		if ( method_exists( $this, $sMethod ) ) {
			return Rocca_String::fromObArray( [ $this, $sMethod ], $aArgs );
		}
		
		return $this->modelRawGet( $sProp );
	}
	
	
	//
	public function handleEchoCall( $sMethod, $aArgs ) {
		
		$aHandler = FALSE;
		
		if ( 0 === strpos( $sMethod, 'echo' ) ) {

			$sProp = Rocca_Inflector::underscore( substr( $sMethod, 4 ) );
			$aHandler = [ 'echo', $sProp ];
			
		} elseif ( 0 === strpos( $sMethod, 'get' ) ) {
			
			$sSuffix = substr( $sMethod, 3 );
			$sMethod = sprintf( 'echo%s', $sSuffix );
			
			// only kicks in if echo() method exists
			
			if ( method_exists( $this, $sMethod ) ) {
				$sProp = Rocca_Inflector::underscore( $sSuffix );
				$aHandler = [ 'get', $sProp ];
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


