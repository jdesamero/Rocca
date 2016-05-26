( function( $, Rocca ) {
	
	this.RoccaTest = Rocca.extend( Rocca.UnitTest, {
		
		run: function() {
			
			var aTest = [ 1, 2, 3, 4 ];
			var aCopy = [];
			
			Rocca.each( aTest, function( i, v ) {
				aCopy.push( v );
			} );
			
			var oTest = {
				'foo': 1,
				'bar': 2,
				'baz': 'abc'
			};
			var oCopy = {};
			
			var iCount = 0;
			Rocca.each( oTest, function( k, v ) {
				oCopy[ k ] = v;
				iCount++;
			} );
			
			this
				.assert( 'StrictlyEqual', 'each 1', 1, aCopy.length )
				.assert( 'StrictlyEqual', 'each 2', 1, iCount )
				.assert( 'StrictlyEqual', 'each 3', 3, iCount )
			;
			
		}
		
	} );
	
} )( jQuery, Rocca );