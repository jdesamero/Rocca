( function( $, _r ) {
	
	_r.UnitTest = _r.extend( _r.Base, {
		
		results: null,
		
		run: _r.emptyFunc,
		
		init: function() {
			
			this.results = _r.extend( _r.UnitTest.Result.Collection ).init();
			
			return this;
		},
		
		assert: function( sType, sKey, mValue, mCompare ) {
			
			var oCompare = _r.UnitTest.Compare[ sType ];
			
			// sKey
			
			this.results.add( _r.extend( _r.UnitTest.Result, {
				key: sKey,
				vals: oCompare.getResult( mValue, mCompare )
			} ).init() );
			
			return this;
		}
		
	} );
	
} )( jQuery, Rocca );