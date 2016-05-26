( function( $, Rocca ) {
	
	Rocca.View.Item = Rocca.extend( Rocca.View, {
		
		tmpl: '<li><\/li>',
		
		events: {
			'model:change this': 'updateView',
			'model:destroy this': 'destroy'
		},
		
		init: function() {
			
			Rocca.View.init.call( this, function() {
				
				this.updateView();
				
			} );
			
			return this;
		},
		
		updateView: Rocca.emptyFunc,
		
		destroy: function( e, oModel ) {
			
			if ( this.listView ) {
				this.listView.unregisterItemView( this );
			}
			
			this.$el.unbind().remove();
		}
		
	} );
	
	
} )( jQuery, Rocca );