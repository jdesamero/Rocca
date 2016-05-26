<?php

//
class RoccaTest_Debug extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		// below is line 13
		$sOut = Rocca_Debug::getLine( 'Unit testing...', __FILE__, __LINE__, __METHOD__ );
		
		$bRes = strpos( $sOut, "Rocca/library/RoccaTest/Debug.php: Line 13: RoccaTest_Debug::run(): Unit testing...\n" );
		
		$this->assertStrictlyEqual( 'get line', TRUE, ( $bRes !== FALSE ) );
		
		
		// below is line 21		
		$sOut2 = Rocca_String::fromOb( [ 'Rocca_Debug', 'showLine' ], 'More unit testing...', __FILE__, __LINE__, __METHOD__ );
		
		$bRes2 = strpos( $sOut2, "Rocca/library/RoccaTest/Debug.php: Line 21: RoccaTest_Debug::run(): More unit testing...\n" );
		
		$this->assertStrictlyEqual( 'show line', TRUE, ( $bRes !== FALSE ) );
		
		
		
		return $this;
	}


}



