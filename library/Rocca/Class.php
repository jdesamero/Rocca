<?php

//
class Rocca_Class
{
	
	//
	public function resolveRelated( $sInstanceClass, $sAddSuffix, $sRemoveSuffix = '', $sDefaultClass = '' ) {
		
		// a "hard-coded" default class was provided, so skip resolution process
		if ( $sDefaultClass ) {
			
			if ( class_exists( $sDefaultClass ) ) {
				return $sDefaultClass;
			} else {
				throw new Exception( sprintf( 'Class "%s" does not exist!', $sDefaultClass ) );
			}
		}
		
		
		// remove suffix, if provided, to instance class and see if there is a match
		if ( $sRemoveSuffix ) {
			
			if ( FALSE !== ( $iPos = strrpos( $sInstanceClass, $sRemoveSuffix ) ) ) {
				
				$sResolveClass = substr( $sInstanceClass, 0, strlen( $sInstanceClass ) - strlen( $sRemoveSuffix ) );
				
				// is $sAddSuffix was provided, then don't resolve just yet
				if ( !$sAddSuffix && class_exists( $sResolveClass ) ) {
					return $sResolveClass;
				}
			}
			
		}
		
		
		// append suffix, if provided, to instance class and see if there is a match
		if ( $sAddSuffix ) {
			
			$sResolveClass = sprintf( '%s%s', $sResolveClass ?: $sInstanceClass, $sAddSuffix );
			
			if ( class_exists( $sResolveClass ) ) {
				return $sResolveClass;
			}
		}
		
		
		// no match
		return NULL;
	}
	
	
}


