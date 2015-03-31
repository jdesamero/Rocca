<?php

//
class Rocca_Inflector
{
	
	//
	public static function camelize( $sLcAndUnscrWord ) {
		
		$sReplace = str_replace(
			' ', '', ucwords( str_replace( '_', ' ', $sLcAndUnscrWord ) )
		);		
		
		return $sReplace;
	}
	
	// basically, convert something like: some_class/sub_item
	// to: SomeClass_SubItem
	public static function camelizeSlash( $sValue ) {
		
		$sValue = self::camelize( $sValue );
		
		return preg_replace_callback( '/\/([a-z])/', function( $aMatches ) {
			return sprintf( '_%s', strtoupper( $aMatches[ 1 ] ) );
		}, $sValue );
	}
	
	//
	public static function underscore( $sCamelCasedWord ) {
		
		$sReplace = strtolower( preg_replace( '/(?<=\\w)([A-Z])/', '_\\1', $sCamelCasedWord ) );
		$sReplace = preg_replace( '/[\s]+/', '_', $sReplace );
		
		return $sReplace;
	}
	
	//
	public static function humanize( $sLcAndUnscrWord ) {
		
		$sReplace = ucwords( str_replace( '_', ' ', $sLcAndUnscrWord ) );
		
		return $sReplace;
	}
	
	
	// ala Wordpress slug
	public static function sanitize( $sString ) {
		
		$sRet = strtolower( $sString );
		$sRet = preg_replace( '/[^a-z0-9-]/', '-', $sRet );
		
		return $sRet;
	}
	

}


