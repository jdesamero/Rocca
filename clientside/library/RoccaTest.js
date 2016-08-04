( function( $, _r ) {
	
	this.RoccaTest = _r.extend( _r.UnitTest, {
		
		run: function() {
			
			var aTest = [ 1, 2, 3, 4 ];
			var aCopy = [];
			
			_r.each( aTest, function( i, v ) {
				aCopy.push( v );
			} );
			
			var oTest = {
				'foo': 1,
				'bar': 2,
				'baz': 'abc'
			};
			var oCopy = {};
			
			var iCount = 0;
			_r.each( oTest, function( k, v ) {
				oCopy[ k ] = v;
				iCount++;
			} );
			
			
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			
			
			var cSomeAsyncOp = function ( mVal, iDelay ) {
				
				return new Promise( function( cFulfill, cReject ) {
					
					setTimeout( function() {
						
						cFulfill( mVal );
						
					}, iDelay );
					
				} );
			};
			
			
			// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
			
			this
				
				// synchronous
				.assert( 'StrictlyEqual', 'each 1', 1, aCopy.length )
				.assert( 'StrictlyEqual', 'each 2', 1, iCount )
				.assert( 'StrictlyEqual', 'each 3', 3, iCount )
				
				// asynchronous (must be provided Promise)
				.assert( 'StrictlyEqual', 'async 1', 'foo', cSomeAsyncOp( 'foo', 2000 ) )
				.assert( 'StrictlyEqual', 'async 2', 'bar', cSomeAsyncOp( 'barbara', 3000 ) )
				
			;
			
		}
		
	} );
	
} )( jQuery, Rocca );