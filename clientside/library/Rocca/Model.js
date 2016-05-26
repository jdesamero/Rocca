( function( $, Rocca ) {
	
	Rocca.Model = Rocca.extend( Rocca.Base, Rocca.Events, {
		
		init: function() {
			
			var _this = this;
			
			if ( 'object' != $.type( this.vals ) ) {
				this.vals = {};
			}
			
			Rocca.each( this.defaults, function( k, v ) {
				
				if ( !_this.vals.hasOwnProperty( k ) ) {
					_this.vals[ k ] = v;
				}
				
			} );
			
			return this;
		},
		
		set: function( sKey, mValue ) {
			
			var oOldVals = Object.create( this.vals );
			var mOldVal = this.vals[ sKey ];
			
			this.vals[ sKey ] = mValue;
			
			
			// general event
			// event parameters: new value, old value
			this.trigger( 'change', oOldVals );
			
			
			// value specific event
			var sValueEvent = 'change:%s'.printf( sKey );
			
			// event parameters: new value, old value
			this.trigger( sValueEvent, [ mValue, mOldVal ] );
			
			
			return this;
		},
		
		get: function( sKey ) {
			
			if ( '__uid' === sKey ) {
				return this.getUid();
			}
			
			return this.vals[ sKey ];
		},
		
		destroy: function() {
			
			this.trigger( 'destroy' );			
			
			this.unbind();
			
		},
		
		toJsonEncodable: function() {
			
			return this.vals;
		}
		
	} );
	
} )( jQuery, Rocca );