<?php

//
class Rocca_Utility_Mapping
{
	
	use Rocca_Data;
	
	
	//
	public function __construct( $aMapping ) {
		
		// parse mapping array
		foreach ( $aMapping as $sMap ) {
			
			// map notation ex: 'some:some_alias|some_other'
			// some --> some, some_alias --> some, some_other --> some
			
			list( $sTarget, $sAliases ) = explode( ':', $sMap );
			$aAliases = explode( '|', $sAliases );
			
			$this->dataSet( $sTarget, $sTarget );			// target resolves to itself
			
			foreach ( $aAliases as $sAlias ) {
				$this->dataSet( $sAlias, $sTarget );		// alias resolved to target
			}
			
		}
		
	}
	
	// alias getData()
	public function get( $sKey ) {
		return $this->dataGet( $sKey );
	}
	
	
}



