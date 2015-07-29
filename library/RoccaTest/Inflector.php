<?php

//
class RoccaTest_Inflector extends Rocca_UnitTest
{
	
	//
	public function run() {
		
		parent::run();
		
		
		$this
			
			->assertGroup( 'camelize()', function() {
				
				$this
					->assertStrictlyEqual( 'simple 1', 'FooBarBaz', Rocca_Inflector::camelize( 'foo_bar_baz' ) )
					->assertStrictlyEqual( 'simple 2', 'FooBarBaz', Rocca_Inflector::camelize( 'foo bar baz' ) )
					->assertStrictlyEqual( 'simple 3', 'FooBarBaz', Rocca_Inflector::camelize( 'foo-bar-baz' ) )
					->assertStrictlyEqual( 'simple 4', 'FooBarBaz', Rocca_Inflector::camelize( 'foo.bar.baz' ) )
					->assertStrictlyEqual( 'simple 5', 'FooBarBaz', Rocca_Inflector::camelize( 'foo  bar__baz' ) )
					->assertStrictlyEqual( 'simple 6', 'AddressLine1', Rocca_Inflector::camelize( 'address_line_1' ) )
					->assertStrictlyEqual( 'simple 7', 'AddressLine1', Rocca_Inflector::camelize( 'address_line1' ) )
				;
				
			} )
			
			->assertGroup( 'camelizeSlash()', function() {

				$this
					->assertStrictlyEqual( 'simple 1', 'SomeClass_SubItem', Rocca_Inflector::camelizeSlash( 'some_class/sub_item' ) )
					->assertStrictlyEqual( 'simple 2', 'SomeClass_SubItem', Rocca_Inflector::camelizeSlash( 'some class/sub item' ) )
					->assertStrictlyEqual( 'simple 3', 'SomeClass_SubItem', Rocca_Inflector::camelizeSlash( 'some.class/sub.item' ) )
				;
			
			} )
			
			->assertGroup( 'underscore()', function() {

				$this
					->assertStrictlyEqual( 'simple 1', 'do_some_stuff', Rocca_Inflector::underscore( 'doSomeStuff' ) )
					->assertStrictlyEqual( 'simple 2', 'do_some_stuff', Rocca_Inflector::underscore( 'DoSomeStuff' ) )
					->assertStrictlyEqual( 'simple 3', 'do_some_stuff', Rocca_Inflector::underscore( 'Do some stuff' ) )
					->assertStrictlyEqual( 'simple 4', 'address_line1', Rocca_Inflector::underscore( 'addressLine1' ) )
					->assertStrictlyEqual( 'simple 5', 'address_line_1', Rocca_Inflector::underscore( 'addressLine 1' ) )
				;
			
			} )
			
			->assertGroup( 'humanize()', function() {
				
				$this
					->assertStrictlyEqual( 'simple 1', 'Big And Small', Rocca_Inflector::humanize( 'big_and_small' ) )
					->assertStrictlyEqual( 'simple 2', 'Big And Small', Rocca_Inflector::humanize( 'big and small' ) )
				;
				
			} )
			
			->assertGroup( 'sanitize()', function() {
				
				$this
					->assertStrictlyEqual( 'simple 1', 'the-quick-brown-fox', Rocca_Inflector::sanitize( 'The quick brown fox' ) )
					->assertStrictlyEqual( 'simple 2', 'to-be-or-not-to-be', Rocca_Inflector::sanitize( 'To be, or not to be?' ) )
				;
				
			} )
			
		;
		
		
		return $this;
	}
	
	
}



