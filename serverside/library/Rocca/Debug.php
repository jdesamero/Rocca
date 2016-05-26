<?php

class Rocca_Debug
{

	//
	public static function showLine( $sMessage, $sFile, $sLine, $sMethod ) {
		
		echo self::getLine( $sMessage, $sFile, $sLine, $sMethod );
		
	}
	
	//
	public static function getLine( $sMessage, $sFile, $sLine, $sMethod ) {
		
		return sprintf( "%s: Line %d: %s(): %s\n", $sFile, $sLine, $sMethod, $sMessage );
		
	}
	
	
	
}

