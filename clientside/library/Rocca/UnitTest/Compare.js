( function( $, _r ) {
	
	_r.UnitTest.Compare = _r.extend( _r.Base, {
		
		failMessage: '',
		value: null,
		testValue: null,
		
		setValues: function( mValue, mTestValue ) {
			
			this.value = mValue;
			this.testValue = mTestValue;
			
			return this;
		},
		
		getResult: function( mValue, mCompare ) {
			
			var _this = this;
			
			return new Promise( function( cFulfill, cReject ) {
			
				var oTestValue = _this.formatTestValue( mCompare, mValue );
				
				oTestValue.done( function( mTestValue ) {
					
					var oRet = {};
					
					_this.setValues( mValue, mTestValue );
					
					// test failed
					if ( !_this.test() ) {
						
						// return formatted values for display, should all be strings
						oRet = {
							'fail_message': _this.getFailMessage(),
							'expected_value': _this.getExpectedFormatted(),
							'result_value': _this.getResultFormatted()
						};
					}
					
					oRet[ 'complete' ] = true;
					
					cFulfill( oRet );
					
				} );
				
			} );
		},
		
		test: function() {
			return false;
		},
		
		formatTestValue: function( mCompare, mValue ) {
			
			return new Promise( function( cFulfill, cReject ) {
				
				// check mCompare
				if ( _r.isPromise( mCompare ) ) {
					
					// mCompare is a Promise!
					
					mCompare.done( function( mRes ) {
						
						cFulfill( mRes );
						
					} );
					
				} else {
					
					// immediate gratification
					
					if ( 'function' == $.type( mCompare ) ) {
						
						// cFulfill( mCompare.call( ???, mValue ) );
						cFulfill( mCompare( mValue ) );
					}
					
					cFulfill( mCompare );
				}
				
			} );
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