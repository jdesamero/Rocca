( function( $, _r ) {
	
	_r.UnitTest.Result = _r.extend( _r.Model, {
		
		defaults: {
			'key': '',
			'fail_message': '',
			'expected_value': '',
			'result_value': '',
			'grouping': []	
		},
		
		init: function() {
			
			_r.Model.init.apply( this, arguments );
			
			if ( this.key ) {
				this.set( 'key', this.key );
			}
			
			return this;
		},
		
		getFailed: function() {
			
			return this.get( 'fail_message' ) ? true : false ;
		},
		
		getTitle: function() {
		
			return this.get( 'key' );
		}
		
	} );
	
} )( jQuery, Rocca );