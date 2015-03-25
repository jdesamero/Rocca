<?php

class Rocca_Debug
{

	//
	public static function showLine( $sMessage, $sFile, $sLine, $sMethod ) {
		
		printf( "%s: Line %d: %s(): %s\n", $sFile, $sLine, $sMethod, $sMessage );
		
	}
	

}

