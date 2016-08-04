( function( $ ) {
	
	var cEmptyFunc = function() {};
	
	var cEach = function( mSubject, cIterate ) {
		
		if ( 'array' === $.type( mSubject ) ) {
			
			for ( var i = 0; i < mSubject.length; i++ ) {
				
				var bRes = cIterate( i, mSubject[ i ] );
				
				if ( false === bRes ) {
					break;
				}
			}
			
		} else if ( 'object' === $.type( mSubject ) ) {
			
			// note, this will only iterate the object's own properties
			// and not include items down the prototype chain
			
			for ( var k in mSubject ) {
				
				if ( !mSubject.hasOwnProperty( k ) ) continue;
				
				var bRes = cIterate( k, mSubject[ k ] );
				
				if ( false === bRes ) {
					break;
				}				
			}
			
		}
		
		return this;
	};
	
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	
	this.Rocca = {
		
		uidCounter: 0,
		
		each: cEach,
		
		emptyFunc: cEmptyFunc,
		
		extend: function() {
			
			var aArgs = Array.prototype.slice.call( arguments );
			
			var oSubject = aArgs.shift();
			
			var oCopy = Object.create( oSubject );
			
			cEach( aArgs, function( i, v ) {
				
				// v are other objects to merge with oCopy
				cEach( v, function( k1, v1 ) {
					
					// check if oCopy has existing property
					var mExisting = oCopy[ k1 ];
					
					// attempt to merge objects together
					if (
						( 'object' === $.type( mExisting ) ) && 
						( 'object' === $.type( v1 ) )
					) {
						
						// merge v1 into mExisting
						cEach( v1, function( k2, v2 ) {
							
							// this will overwrite existing
							mExisting[ k2 ] = v2;
						} );
						
						// retain as v1, so we don't lose this below
						v1 = mExisting;
					}
					
					
					// this will overwrite mExisting, if alredy exists
					oCopy[ k1 ] = v1;
					
				} );
				
			} );
			
			
			this.uidCounter++;
			
			oCopy.setUid( this.uidCounter );
			
			return oCopy;
		},
		
		tmpl: function( sSelector ) {
			
			// do this for lazy template instantiation
			return {
				
				selector: sSelector,
				
				getContent: function( eTarget ) {
					
					var sTmplContent, eTmpl;
					
					if ( eTarget ) {
						
						eTmpl = eTarget.find( this.selector );
					
					} else {
						
						// global
						eTmpl = $( this.selector );
					}
					
					
					if (
						( 'SCRIPT' === eTmpl.prop( 'tagName' ) ) &&
						( 'text/x-jquery-tmpl' === eTmpl.attr( 'type' ) )
					) {
						
						sTmplContent = eTmpl.text();
						
					} else {
						
						sTmplContent = eTmpl.html();
					}
					
					return sTmplContent;
				}
				
			};
			
		},
		
		//// utility methods
		
		isPromise: function( mCheck ) {
			
			if (
				( mCheck.then ) && 
				( 'function' === $.type( mCheck.then ) ) && 
				( mCheck.done ) && 
				( 'function' === $.type( mCheck.done ) )
			) {
				
				return true;
			}
			
			return false;
		},
		
		
		//// base mix-in
		
		Base: {
			
			'__uid': 0,
			
			setUid: function( iUid ) {
				
				this.__uid = iUid;
				
				return this;
			},
			
			// return negative number
			getUid: function() {
				
				return - this.__uid;
			},
			
			init: cEmptyFunc,
			
			toJsonEncodable: cEmptyFunc
			
		},
		
		
		//// events mix-in
		
		Events: {
			
			/* create an empty object where events are bound and triggered
			 *
			 * wrapping the main object (this) can cause problems, especially if there is
			 * conflict with property names (e.g. "length") or if property matches an event
			 * (will cause infinite loop)
			 */
			
			getEventDelegate: function() {
				
				if ( !this.__eventDelegate ) {
					
					// lazy creation
					this.__eventDelegate = $( {} );
				}
				
				return this.__eventDelegate;
			},
			
			trigger: function() {
				
				var oEventDelegate = this.getEventDelegate();
				
				oEventDelegate.trigger.apply( oEventDelegate, arguments );
				
				return this;
			},
			
			on: function( e ) {
				
				var oEventDelegate = this.getEventDelegate();
				
				oEventDelegate.on.apply( oEventDelegate, arguments );
				
				return this;
			},
			
			unbind: function() {
				
				var oEventDelegate = this.getEventDelegate();
				
				oEventDelegate.unbind.apply( oEventDelegate, arguments );
				
				return this;
			}
			
		}
		
	};
	
} )( jQuery );