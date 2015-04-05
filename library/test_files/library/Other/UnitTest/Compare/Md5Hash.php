<?php

//
class Other_UnitTest_Compare_Md5Hash extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		
		$aChunks = array();
		
		$this
			->assertMd5Hash( 'Empty value', 'd41d8cd98f00b204e9800998ecf8427e', '' )
			->assertMd5Hash( 'Plain vanilla string', '54070a3d5d8af15a0c32a7aea2277cfe', 'I love ice cream!' )
			->assertMd5Hash( 'Bad value type given', '0045506f9ff3ee456878221746aa9a9c', $aChunks )
		;
				
		
		
		return $this;
	}


}



