( function( $, _r ) {
	
	_r.View.Item = _r.extend( _r.View, {
		
		tmpl: '<li><\/li>',
		
		events: {
			'model:change this': 'updateView',
			'model:destroy this': 'destroy'
		},
		
		init: function() {
			
			_r.View.init.call( this, function() {
				
				this.updateView();
				
			} );
			
			return this;
		},
		
		updateView: _r.emptyFunc,
		
		destroy: function( e, oModel ) {
			
			if ( this.listView ) {
				this.listView.unregisterItemView( this );
			}
			
			this.$el.unbind().remove();
		}
		
	} );
	
	
} )( jQuery, Rocca );