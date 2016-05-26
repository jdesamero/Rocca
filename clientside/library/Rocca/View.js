( function( $, Rocca ) {
	
	Rocca.View = Rocca.extend( Rocca.Base, {
		
		$el: null,
		
		events: [],
		tmpl: '<div></div>',
		
		// init hooks
		preInit: Rocca.emptyFunc,
		postInit: Rocca.emptyFunc,
		
		init: function( cInit ) {
			
			var _this = this;
			
			this.preInit();
			
			///// instantiate $el, if not specified
			
			if ( null === this.$el ) {
				
				var mTmpl = this.tmpl, sTmplContent;
				
				if (
					( 'object' === $.type( mTmpl ) ) && 
					( mTmpl.selector || mTmpl.getContent )
				) {
					
					sTmplContent = mTmpl.getContent();
					
				} else {
					
					sTmplContent = mTmpl;
				}
				
				
				this.$el = $( sTmplContent );
			
			}
			
			
			//// prep events
			
			Rocca.each( this.events, function( k, v ) {
				
				// find the first space char
				var iSpacePos = k.indexOf( ' ' );
				
				var sEvent = k.substr( 0, iSpacePos );
				var sSelector = k.substr( iSpacePos + 1 );
				var sDelegateKey = '';
				
				
				// see if we have a "delegated" event, check for ":"
				var iColonPos = sEvent.indexOf( ':' );
				if ( iColonPos > -1 ) {
					sDelegateKey = sEvent.substr( 0, iColonPos );
					sEvent = sEvent.substr( iColonPos + 1 );
				}
				
				var cBindFunc = _this[ v ];
				
				if ( 'function' == $.type( cBindFunc ) ) {
	
					var oBindTo;
					
					if ( sDelegateKey ) {
						
						oBindTo = _this[ sDelegateKey ];
					
					} else {
						
						if ( 'this' === sSelector ) {
							oBindTo = _this.$el;
						} else {
							oBindTo = _this.$el.find( sSelector );
						}
					}
					
					oBindTo.on( sEvent, function() {
						// do this so "this" context is correct
						return cBindFunc.apply( _this, arguments );
					} );
				}
				
			} );
			
			
			if ( cInit ) {
				cInit.call( this );
			}
			
			
			this.postInit();
			
			return this;
		},
		
		
		//// jQuery convenience methods
		
		$: function( sSelector ) {
			
			return this.$el.find( sSelector );
		},
		
		
		// this.$append( mElem ) or this.$append( sSelector, mElem )
		
		$append: function() {
			
			var sSel, mElem, oTarget;
			
			if ( 2 === arguments.length ) {
				
				sSel = arguments[ 0 ];
				mElem = arguments[ 1 ];
				oTarget = this.$( sSel );
				
			} else {
				
				mElem = arguments[ 0 ];
				oTarget = this.$el;
				
			}
			
			if ( mElem.$el ) {
				
				// assumed view was provided, append the $el property automatically
				oTarget.append( mElem.$el );
				
			} else {
				
				oTarget.append( mElem );
			}
			
			return this;
		},


		// this.$html( sContent ) or this.$append( sSelector, sContent )
		
		$html: function() {
		
			var sSel, sContent, oTarget;
			
			if ( 2 === arguments.length ) {
				
				sSel = arguments[ 0 ];
				sContent = arguments[ 1 ];
				oTarget = this.$( sSel );
				
			} else {
				
				sContent = arguments[ 0 ];
				oTarget = this.$el;
				
			}
			
			oTarget.html( sContent );
			
			return this;
		},
		
		
		$val: function( sSel, sVal ) {
			
			if (
				( undefined !== sVal ) && 
				( null !== sVal )
			) {
				
				this.$( sSel ).val( sVal );
				
				return this;
			}
			
			return this.$( sSel ).val();
		},
		
		
		$hide: function( sSel ) {
			
			if ( sSel ) {
				this.$( sSel ).hide();
			} else {
				this.$el.hide();			
			}
			
			return this;
		},
		
		$show: function( sSel ) {
			
			if ( sSel ) {
				this.$( sSel ).show();
			} else {
				this.$el.show();
			}
			
			return this;
		}
		
	} );
	
} )( jQuery, Rocca );