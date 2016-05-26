( function( $, Rocca ) {
	
	Rocca.UnitTest = Rocca.extend( Rocca.Base, {
		
		results: null,
		
		run: Rocca.emptyFunc,
		
		init: function() {
			
			this.results = Rocca.extend( Rocca.UnitTest.Result.Collection ).init();
			
			return this;
		},
		
		assert: function( sType, sKey, mValue, mCompare ) {
			
			var oCompare = Rocca.UnitTest.Compare[ sType ];
			
			// sKey
			
			this.results.add( Rocca.extend( Rocca.UnitTest.Result, {
				key: sKey,
				vals: oCompare.getResult( mValue, mCompare )
			} ).init() );
			
			return this;
		}
		
	} );
	
} )( jQuery, Rocca );