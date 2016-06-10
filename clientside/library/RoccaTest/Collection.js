( function( $, _r, _t ) {
	
	_t.Collection = _r.extend( _r.UnitTest, {
		
		run: function() {
			
			this
				.assert( 'StrictlyEqual', 'collection 1', 'one', 'wan' )
				.assert( 'StrictlyEqual', 'collection 2', 'two', 'two' )
				.assert( 'StrictlyEqual', 'collection 3', 'three', 'tree' )
			;
			
		}
		
	} );
	
} )( jQuery, Rocca, RoccaTest );