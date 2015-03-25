<?php

trait Rocca_HandleCall
{
	
	/* traits that are callable
	 * ex: $sCallable = 'Some'
	 * expects these methods to be implemented:
	 *		handle call method: handleSomeCall(), will we handle the call?
	 *		call method: someCall(), handle the actual call
	 */
	
	
	//
	public function __call( $sMethod, $aArgs ) {
		
		if ( is_array( $this->_aCallables ) ) {
			
			foreach ( $this->_aCallables as $sCallable ) {
				
				$sHandleCallMethod = sprintf( 'handle%sCall', $sCallable );
				$sCallMethod = sprintf( '%sCall', lcfirst( $sCallable ) );
				
				if ( method_exists( $this, $sHandleCallMethod ) && method_exists( $this, $sCallMethod ) ) {
					
					// Rocca_Debug::showLine( sprintf( '%s %s', $sHandleCallMethod, $sCallMethod ), __FILE__, __LINE__, __METHOD__ );
					
					if ( $aHandler = $this->$sHandleCallMethod( $sMethod, $aArgs ) ) {
						return $this->$sCallMethod( $aHandler, $aArgs );
					}
				}
				
			}
			
		}
		
		throw new Exception( sprintf( 'Invalid method %s::%s() called.', __CLASS__, $sMethod ) );
	}
	
	
}


