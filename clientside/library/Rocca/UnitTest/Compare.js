( function( $, Rocca ) {
	
	Rocca.UnitTest.Compare = Rocca.extend( Rocca.Base, {
		
		failMessage: '',
		value: null,
		testValue: null,
		
		setValues: function( mValue, mTestValue ) {
			
			this.value = mValue;
			this.testValue = mTestValue;
			
			return this;
		},
		
		getResult: function( mValue, mCompare ) {
			
			var mTestValue = this.formatTestValue( mCompare, mValue );
			
			this.setValues( mValue, mTestValue );
			
			if ( !this.test() ) {
				
				// return formatted values for display, should all be strings
				return {
					'fail_message': this.getFailMessage(),
					'expected_value': this.getExpectedFormatted(),
					'result_value': this.getResultFormatted()
				};
			}
			
		},
		
		test: function() {
			return false;
		},
		
		formatTestValue: function( mCompare, mValue ) {
	
			if ( 'function' == $.type( mCompare ) ) {
				
				// mCompare.call( ???, mValue );
				return mCompare( mValue );
			}
			
			return mCompare;
		},
		
		getFailMessage: function() {
			return this.failMessage;
		},
		
		getExpectedFormatted: function() {
			return '"%s"'.printf( this.value );
		},
		
		getResultFormatted: function() {
			return '"%s"'.printf( this.testValue );
		}
		
	} );
	
} )( jQuery, Rocca );