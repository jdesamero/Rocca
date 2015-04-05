<?php

//
class RoccaTest_Class extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		
		// IMPORTANT!!! Depends of RoccaTest_Autoload
		
		
		$this
			
			->assertGroup( 'resolveRelated()', function() {
				
				$this
					
					//// add suffix to class name
					
					->assertStrictlyEqual(
						'Related add suffix',
						'Other_Related_Base',
						Rocca_Class::resolveRelated( 'Other_Related', '_Base' )
					)
					
					->assertStrictlyEqual(
						'Related add suffix 2',
						'Other_Related_Base_Sibling',
						Rocca_Class::resolveRelated( 'Other_Related_Base', '_Sibling' )
					)
					
					->assertStrictlyEqual(
						'Related add suffix 3',
						NULL,
						Rocca_Class::resolveRelated( 'Other_Related_Base', '_Bogus' )
					)
					
					
					//// remove suffix from class name
					
					->assertStrictlyEqual(
						'Related remove suffix',
						'Other_Related',
						Rocca_Class::resolveRelated( 'Other_Related_Base', '', '_Base' )
					)
					
					->assertStrictlyEqual(
						'Related remove suffix 2',
						'Other_Related_Base',
						Rocca_Class::resolveRelated( 'Other_Related_Base_Sibling', '', '_Sibling' )
					)
					
					
					//// remove suffix from class name, then add suffix to it
					
					->assertStrictlyEqual(
						'Related remove and add',
						'Other_Related_Base_Cousin',
						Rocca_Class::resolveRelated( 'Other_Related_Base_Sibling', '_Cousin', '_Sibling' )
					)
					
					->assertStrictlyEqual(
						'Related remove and add 2',
						'Other_Related_Base_Sibling',
						Rocca_Class::resolveRelated( 'Other_Related_Base_Cousin', '_Sibling', '_Cousin' )
					)
					
					
					//// default class
					
					->assertStrictlyEqual(
						'Default class',
						'Other_Related_Other',
						Rocca_Class::resolveRelated( 'Other_Related', '_Base', '', 'Other_Related_Other' )
					)
					
					->assertStrictlyEqual(
						'Default class 2',
						'Other_Related_Other',
						Rocca_Class::resolveRelated( 'Other_Related', '_Bogus', '', 'Other_Related_Other' )
					)
					
					->assertStrictlyEqual(
						'Default class 3',
						'Other_Related_Other',
						Rocca_Class::resolveRelated( 'Other_Related_Base_Sibling', '', '_Sibling', 'Other_Related_Other' )
					)
					
					->assertStrictlyEqual(
						'Default class 4',
						'Other_Related_Other',
						Rocca_Class::resolveRelated( 'Other_Related_Base_Sibling', '_Cousin', '_Sibling', 'Other_Related_Other' )
					)
					
					->assertThrowsException(
						'Throw exception',
						'Exception',
						function () {
							// this should throw an exception
							Rocca_Class::resolveRelated( 'Other_Related', '_Base', '', 'Other_Related_Bogus' );
						}
					)
				
				;
				
				
			} )			
			
			
		;
		
		
		return $this;
	}


}



