( function( $, _r ) {
	
	var oDispatcher = _r.extend( _r.Dispatcher );
	
	
	// the controls
	var ControlView = _r.extend( _r.View, {
		
		tmpl: '<input type="button" class="button-primary" value="" \/>',
		
		events: {
			'click this': 'displayResults'
		},
		
		dispatcher: oDispatcher,
		
		postInit: function() {
			
			this.$el.val( this.title );
			this.$el.addClass( this.slug );
			
		},
		
		displayResults: function() {
			this.dispatcher.trigger( 'displayresults', this.collection );
		}
		
	} );
	
	
	
	_r.Inspector = _r.extend( _r.View, {
		
		tmpl: '<form>' + 
			'<p><strong>Rocca Inspector<\/strong> &nbsp; <a href="#" class="toggle">Hide<\/a><\/p>' + 
			'<div class="wrap">' + 
				'<div class="controls"><\/div>' + 
				'<div class="options">' +
					'<input type="checkbox" class="include_type" /> <label>Include Type<\/label>' +
				'<\/div>' + 
				'<hr \/>' + 
				'<div class="result"><\/div>' + 
			'<\/div>' + 
		'<\/form>',
		
		events: {
			'dispatcher:displayresults this': 'displayResults',
			'click a.toggle': 'togglePanel'
		},
		
		dispatcher: oDispatcher,
		
		postInit: function() {
			
			var _this = this;
			
			var oCollectionHash = this.collectionHash;
			
			if ( oCollectionHash ) {
				
				var bFirst = true;
				
				_r.each( oCollectionHash, function( k, v ) {
					
					var sTitle = ( v.title ) ? v.title : k ;
					var oCollection = ( v.model ) ? 
						_r.extend( _r.Collection, { members: [ v.model ] } ).init() : 
						v.collection
					;
					
					var oControl = _r.extend( ControlView, {
						collection: oCollection,
						slug: k,
						title: sTitle,
						formView: _this
					} ).init();
					
					if ( bFirst ) {
						bFirst = false;
					} else {
						_this.$append( '.controls', ' &nbsp; ' );
					}
					
					_this.$append( '.controls', oControl );
					
				} );
				
			}
			
		},
		
		displayResults: function( e, oCollection ) {
			
			// replace old results
			this.$html( '> div.wrap > div.result', this.createResultsTable( oCollection ) );
			
		},
		
		togglePanel: function() {
			
			var eWrap = this.$( '> div.wrap' );
			var eToggle = this.$( 'a.toggle' );
			
			if ( eWrap.is( ':hidden' ) ) {
				
				eWrap.show();
				eToggle.html( 'Hide' );
				
			} else {
				
				eWrap.hide();
				eToggle.html( 'Show' );
			}
			
			
			return false;
		},
		
		// helpers
		
		createResultsTable: function( oCollection ) {
			
			if ( !oCollection.length ) {
				return null;
			}
			
			var _this = this;
			
			// create a blank results table
			var eTable = $(
				'<table class="current wp-list-table widefat">' + 
					'<thead></thead>' + 
					'<tbody></tbody>' + 
				'</table>'
			);
			
			var bTitle = true;
			var bAlternate = true;
			var aKeys = [];
			var bIncludeType = this.$( '.include_type' ).is( ':checked' ) ? true : false ;
						
			oCollection.each( function( i, oModel ) {
				
				// these are row titles
				
				if ( bTitle ) {
	
					var eTitleTr = $( '<tr></tr>' );
					
					_this.createColumnTitle( '__uid', eTitleTr, aKeys );
					
					_r.each( oModel.toJsonEncodable(), function( k, v ) {
						_this.createColumnTitle( k, eTitleTr, aKeys );
					} );
					
					// TO DO: fix assertColumns
					if ( oCollection.assertColumns ) {
						
						_r.each( oCollection.assertColumns, function( i, v ) {
							_this.createColumnTitle( v, eTitleTr, aKeys );
						} );
					}
					
					eTable.find( '> thead' ).append( eTitleTr );
					
					bTitle = false;
				}
				
				
				// these are the rows
				
				var eTr = $( '<tr></tr>' );
				
				if ( bAlternate ) {
					eTr.addClass( 'alternate' );
					bAlternate = false;
				} else {
					bAlternate = true;
				}
				
				_r.each( aKeys, function( i, v ) {
					
					var eTd = $( '<td></td>' );
					
					var mModelVal = oModel.get( v );
					var sColVal = mModelVal;
					var sType = $.type( mModelVal );
					
					if ( 'object' === sType ) {
						
						eTd.append( _this.createResultsTable( mModelVal ) );
						
					} else {
						
						if ( bIncludeType ) {
							sColVal += ' &nbsp; [%s]'.printf( sType );
						}
						
						eTd.html( sColVal );
					}
					
					eTr.append( eTd );
				} );
				
				eTable.find( '> tbody' ).append( eTr );
				
			} );
			
			return eTable;
		},
		
		
		createColumnTitle: function( sKey, eTr, aKeys ) {
			
			var eTh = $( '<th></th>' );
			eTh.html( sKey );
						
			eTr.append( eTh );
			
			aKeys.push( sKey );
			
		}
		
	} );
	
} )( jQuery, Rocca );