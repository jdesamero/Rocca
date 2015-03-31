<?php

//
class RoccaTest_Class extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		Rocca_Autoload::getInstance()
			->registerPath( sprintf( '%s/test_files/library', dirname( dirname( __FILE__ ) ) ) )
			->registerNamespace( 'Related' )
		;
		
		
		$oThis = $this;
		
		
		$this
			
			->assertGroup( 'resolveRelated()', function() use ( $oThis ) {
				
				$oThis
					
					//// add suffix to class name
					
					->assertStrictlyEqual(
						'Related add suffix',
						'Related_Base',
						Rocca_Class::resolveRelated( 'Related', '_Base' )
					)
					
					->assertStrictlyEqual(
						'Related add suffix 2',
						'Related_Base_Sibling',
						Rocca_Class::resolveRelated( 'Related_Base', '_Sibling' )
					)
					
					->assertStrictlyEqual(
						'Related add suffix 3',
						NULL,
						Rocca_Class::resolveRelated( 'Related_Base', '_Bogus' )
					)
					
					
					//// remove suffix from class name
					
					->assertStrictlyEqual(
						'Related remove suffix',
						'Related',
						Rocca_Class::resolveRelated( 'Related_Base', '', '_Base' )
					)
					
					->assertStrictlyEqual(
						'Related remove suffix 2',
						'Related_Base',
						Rocca_Class::resolveRelated( 'Related_Base_Sibling', '', '_Sibling' )
					)
					
					
					//// remove suffix from class name, then add suffix to it
					
					->assertStrictlyEqual(
						'Related remove and add',
						'Related_Base_Cousin',
						Rocca_Class::resolveRelated( 'Related_Base_Sibling', '_Cousin', '_Sibling' )
					)
					
					->assertStrictlyEqual(
						'Related remove and add 2',
						'Related_Base_Sibling',
						Rocca_Class::resolveRelated( 'Related_Base_Cousin', '_Sibling', '_Cousin' )
					)
					
					
					//// default class
					
					->assertStrictlyEqual(
						'Default class',
						'Related_Other',
						Rocca_Class::resolveRelated( 'Related', '_Base', '', 'Related_Other' )
					)
					
					->assertStrictlyEqual(
						'Default class 2',
						'Related_Other',
						Rocca_Class::resolveRelated( 'Related', '_Bogus', '', 'Related_Other' )
					)
					
					->assertStrictlyEqual(
						'Default class 3',
						'Related_Other',
						Rocca_Class::resolveRelated( 'Related_Base_Sibling', '', '_Sibling', 'Related_Other' )
					)
					
					->assertStrictlyEqual(
						'Default class 4',
						'Related_Other',
						Rocca_Class::resolveRelated( 'Related_Base_Sibling', '_Cousin', '_Sibling', 'Related_Other' )
					)
					
					->assertThrowsException(
						'Throw exception',
						'Exception',
						function () {
							// this should throw an exception
							Rocca_Class::resolveRelated( 'Related', '_Base', '', 'Related_Bogus' );
						}
					)
				
				;
				
				
			} )			
			
			
		;
		
		
		return $this;
	}


}



