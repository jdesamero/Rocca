( function( $, Rocca ) {
	
	Rocca.UnitTest.Result = Rocca.extend( Rocca.Model, {
		
		init: function() {
			
			Rocca.Model.init.apply( this, arguments );
			
			if ( this.key ) {
				this.set( 'key', this.key );
			}
			
			return this;
		}
		
	} );
	
} )( jQuery, Rocca );