( function( $, Rocca ) {
	
	Rocca.UnitTest = Rocca.extend( Rocca.Base, {
		
		results: null,
		
		run: Rocca.emptyFunc,
		
		init: function() {
			
			this.results = {};
			
			return this;
		},
		
		assert: function( sType, sKey, mValue, mCompare ) {
			
			var oCompare = Rocca.UnitTest.Compare[ sType ];
			
			this.results[ sKey ] = oCompare.getResult( mValue, mCompare );
			
			return this;
		}
		
	} );
	
} )( jQuery, Rocca );