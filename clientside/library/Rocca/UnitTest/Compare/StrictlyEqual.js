( function( $, Rocca ) {
	
	Rocca.UnitTest.Compare.StrictlyEqual = Rocca.extend( Rocca.UnitTest.Compare, {
		
		failMessage: 'Values are not strictly equal!',
		
		test: function() {
			return ( this.value === this.testValue );
		}
		
	} );
	
} )( jQuery, Rocca );