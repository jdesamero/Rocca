( function( $, _r ) {
	
	_r.UnitTest.Compare.StrictlyEqual = _r.extend( _r.UnitTest.Compare, {
		
		failMessage: 'Values are not strictly equal!',
		
		test: function() {
			return ( this.value === this.testValue );
		}
		
	} );
	
} )( jQuery, Rocca );