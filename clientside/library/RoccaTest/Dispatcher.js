( function( $, _r, _t ) {
	
	_t.Dispatcher = _r.extend( _r.UnitTest, {
		
		run: function() {
			
			this
				.assert( 'StrictlyEqual', 'dispatcher 1', 'one', 'one' )
				.assert( 'StrictlyEqual', 'dispatcher 2', 'two', 'too' )
				.assert( 'StrictlyEqual', 'dispatcher 3', 'three', 'tri' )
			;
			
		}
		
	} );
	
} )( jQuery, Rocca, RoccaTest );