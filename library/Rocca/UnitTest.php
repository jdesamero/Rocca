<?php

//
class Rocca_UnitTest
{
	
	use Rocca_Singleton;
	use Rocca_HandleCall;
	
	
	protected $_aCallables = array( 'UnitTest' );
	
	protected $_aResults = NULL;		// should be instance of Rocca_UnitTest_Result_Collection
	protected $_aGrouping = array();
	
	
	
	
	
	
	//// static methods
	
	//
	public function runAll( $aParams = array() ) {
		
		// setup params
		
		$sPath = $aParams[ 'path' ] ?: dirname( dirname( __FILE__ ) ) ;
		$bShowErrorsOnly = isset( $aParams[ 'show_errors_only' ] ) ? $aParams[ 'show_errors_only' ] : TRUE ;
		$sTestClassPrefix = $aParams[ 'test_class_prefix' ] ?: 'RoccaTest' ;
		$fShowResultCb = $aParams[ 'show_results_callback' ];
		$fRunEndCb = $aParams[ 'run_end_callback' ];
		
		
		// do stuff
		
		$sTestClassPath = sprintf( '%s/%s', $sPath, $sTestClassPrefix );
		
		$bHasErrors = FALSE;
		
		
		$oDirectory = new RecursiveDirectoryIterator( $sTestClassPath );
		$oIterator = new RecursiveIteratorIterator( $oDirectory );
		$oRegex = new RegexIterator( $oIterator, '/^(.+)\.php$/i', RecursiveRegexIterator::GET_MATCH );
		
		foreach ( $oRegex as $aPath ) {
			
			$sPath = $aPath[ 1 ];
			
			$sClass = substr( $sPath, strpos( $sPath, $sTestClassPrefix ) );
			$sClass = str_replace( '/', '_', $sClass );
			
			if ( is_subclass_of( $sClass, Rocca_UnitTest ) ) {
				
				$aResults = Rocca_Singleton::getInstance( $sClass )
					->init()
					->run()
					->getResults( $bShowErrorsOnly )
				;
				
				if ( count( $aResults ) > 0 ) {
					
					if ( $fShowResultCb ) {
						call_user_func( $fShowResultCb, $sClass, $aResults );
					}
					
					
					foreach ( $aResults as $oResult ) {
						if ( $oResult->getFailed() ) $bHasErrors = TRUE;
					}
					
				}
				
			}
			
		}
		
		if ( $fRunEndCb ) {
			call_user_func( $fRunEndCb, $bHasErrors );
		}
	}
	
	
	
	
	//// initialize
	
	//
	public function doInit() {
		
		Rocca_Singleton::doInit();
		
		$this->_aResults = new Rocca_UnitTest_Result_Collection();
		
	}
	
	
	//// instance methods
	
	//
	public function getResults( $bErrorsOnly = FALSE ) {
		
		// only show errors
		if ( $bErrorsOnly ) {
			
			$aRes = array();
			
			foreach ( $this->_aResults as $oResult ) {
				
				if ( $oResult->getFailed() ) {
					$aRes[ $sKey ] = $oResult;
				}
				
			}
			
			return $aRes;
		}
		
		return $this->_aResults;
	}
	
	
	
	// run all assertions
	public function run() {
		
		return $this;
	}
	
	//
	public function assert( $sComparisonType, $sKey, $mValue, $mCompare ) {
				
		$sComparisonClass = sprintf( 'Rocca_UnitTest_Compare_%s', $sComparisonType );
		
		if ( is_subclass_of( $sComparisonClass, Rocca_UnitTest_Compare ) ) {

			$oCompare = Rocca_Singleton::getInstance( $sComparisonClass );
			
			// give compare opportunity to format test value,
			// but usually $mTestValue === $mCompare
			$mTestValue = $oCompare->formatTestValue( $mCompare, $mValue );
			
			$oCompare->setValues( $mValue, $mTestValue );
			
			$this->_aResults->add( new Rocca_UnitTest_Result(
				$sKey,
				$oCompare->getResult(),
				$this->_aGrouping
			) );
			
		} else {
			throw new Exception( sprintf( 'Invalid comparison class "%s" specified.', $sComparisonClass ) );
		}
		
		return $this;
	}
	
	
	// assert a bunch together
	public function assertGroup( $sGroupKey, $fAssertCb ) {
		
		// $fAssertCb callback should, in itself, call a bunch of "regular" asserts
		
		array_push( $this->_aGrouping, $sGroupKey );
		call_user_func( $fAssertCb );
		array_pop( $this->_aGrouping );
				
		return $this;
	}
	
	
	
	//// these are HandleCall methods (UnitTest)
	
	//
	public function handleUnitTestCall( $sMethod, $aArgs ) {
		
		$aHandler = FALSE;
		
		if ( 0 === strpos( $sMethod, 'assert' ) ) {
			$aHandler = array( 'assert', substr( $sMethod, 6 ) );
		}
		
		return $aHandler;
	}
	
	//
	public function unitTestCall( $aHandler, $aArgs ) {
		
		list( $sOp, $sProp ) = $aHandler;
		
		array_unshift( $aArgs, $sProp );
		
		if ( 'assert' == $sOp ) {
			return call_user_func_array( array( $this, 'assert' ), $aArgs );
		}
		
	}
	
	
	

}




