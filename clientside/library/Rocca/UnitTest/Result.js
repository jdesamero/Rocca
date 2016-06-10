( function( $, _r ) {
	
	_r.UnitTest.Result = _r.extend( _r.Model, {
		
		init: function() {
			
			_r.Model.init.apply( this, arguments );
			
			if ( this.key ) {
				this.set( 'key', this.key );
			}
			
			return this;
		}
		
	} );
	
} )( jQuery, Rocca );