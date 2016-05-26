( function( $, Rocca ) {
	
	Rocca.View.List = Rocca.extend( Rocca.View, {
		
		itemViews: null,
		
		tmpl: '<ul></ul>',
		
		events: {
			'collection:lengthchanged this': 'lengthChanged',
			'collection:addmember this': 'addMember'
		},
		
		init: function() {
			
			Rocca.View.init.call( this, function() {
				
				var _this = this;
				
				this.itemViews = {};		// initialize itemView registry
				
				this.collection.each( function( i, v ) {
					
					_this.addMember( null, v );
					
				} );
				
				this.lengthChanged( null, this.collection.length );
				
			} );
			
			return this;
		},
		
		lengthChanged: Rocca.emptyFunc,
		
		addMember: function( e, oModel ) {
	
			var oView = Rocca.extend( this.itemView, {
				model: oModel,
				listView: this
			} ).init();
			
			this.registerItemView( oView );
			
			if ( this.appendTarget ) {
				this.$append( this.appendTarget, oView );			
			} else {
				this.$append( oView );
			}
			
			return this;
		},
		
		registerItemView: function( oView ) {
			
			this.itemViews[ oView.getUid() ] = oView;
			
			return this;
		},
		
		unregisterItemView: function( oView ) {
			
			var iViewUid = oView.getUid();
			
			if ( this.itemViews[ iViewUid ] ) {
				delete this.itemViews[ iViewUid ];
			}
			
			return this;
		}
		
	} );
	
	
} )( jQuery, Rocca );