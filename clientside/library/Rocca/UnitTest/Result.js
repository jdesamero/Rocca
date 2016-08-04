( function( $, _r ) {
	
	_r.UnitTest.Result = _r.extend( _r.Model, {
		
		defaults: {
			'key': '',
			'fail_message': '',
			'expected_value': '',
			'result_value': '',
			'grouping': [],
			'complete': false
		},
		
		init: function() {
			
			var _this = this;
			
			var oPromiseVals;
			
			// check if "vals" is a Promise
			if ( this.vals && _r.isPromise( this.vals ) ) {
				
				oPromiseVals = this.vals;
				this.vals = {};		// empty vals for now
			}
			
			
			_r.Model.init.apply( this, arguments );
			
			if ( this.key ) {
				this.set( 'key', this.key );
			}
			
			if ( oPromiseVals ) {
				
				// possibly deferred set()
				oPromiseVals.done( function( oRes ) {
					
					_r.each( oRes, function( k, v ) {
						
						_this.set( k, v );
						
					} );
					
				} );
				
			}
			
			return this;
		},
		
		getFailed: function() {
			
			return this.get( 'fail_message' ) ? true : false ;
		},
		
		getTitle: function() {
		
			return this.get( 'key' );
		},
		
		getCompleted: function() {
			
			return this.get( 'complete' );
		}
		
	} );
	
} )( jQuery, Rocca );