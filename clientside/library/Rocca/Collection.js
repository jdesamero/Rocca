( function( $, Rocca ) {
	
	Rocca.Collection = Rocca.extend( Rocca.Base, Rocca.Events, {
		
		length: 0,
		
		init: function() {
			
			var _this = this;
			
			var aMembersTmp = [];
			
			if ( 'array' == $.type( this.members ) ) {
				
				aMembersTmp = this.members;
				
			}
			
			this.members = [];
			
			Rocca.each( aMembersTmp, function( i, v ) {
				
				_this.add( v );
				
			} );
			
			return this;
		},
		
		add: function( mData ) {
			
			var _this = this;
			
			var mCheck = mData.init;
			var oPush;
			
			if ( mCheck && ( 'function' == $.type( mCheck ) ) ) {
				
				oPush = mData;
			
			} else {
				
				oPush = Rocca.extend( this.model, {
					vals: mData
				} ).init();
				
			}
			
			
			// add destroy handler
			oPush.on( 'destroy', function() {
				
				var iIdx = _this.members.indexOf( oPush );
				
				if ( iIdx > -1 ) {
					
					_this.members.splice( iIdx, 1 );
					
					_this.trigger( 'removemember', [ oPush ] );
										
					_this.updateLength();
				}
				
			} );
			
			this.members.push( oPush );
			
			this.trigger( 'addmember', [ oPush ] );
			
			
			// update the collection's length property
			this.updateLength();
			
			return this;
		},
		
		updateLength: function() {
			
			var iPrevLen = this.length;
			var iCurLen = this.members.length;
			
			this.trigger( 'lengthchanged', [ iCurLen, iPrevLen ] );
			
			this.length = iCurLen;
		},
		
		get: function( iIdx ) {
			
			return this.members[ iIdx ];
		},
		
		
		each: function( cEach ) {
			
			return Rocca.each.call( this, this.members, cEach );
		},
		
		
		toJsonEncodable: function() {
			
			var aRet = [];
			
			this.each( function( i, v ) {
				aRet.push( v.toJsonEncodable() );
			} );
			
			return aRet;
		}
		
		
	} );
	
} )( jQuery, Rocca );