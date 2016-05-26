<?php

//
class Rocca_Array
{
	
	//
	public static function hasNumericIndex( $mSubject ) {
		
		if (
			( is_array( $mSubject ) ) || 
			( $mSubject instanceof Iterator )
		) {
			
			// TO DO: find better algorithm
			foreach ( $mSubject as $i => $j ) {
				if ( !is_int( $i ) ) {
					return FALSE;
				}
			}
			
			return TRUE;
		}
		
		return NULL;
	}


}



