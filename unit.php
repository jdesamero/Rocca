<?php

echo "\n\n";

// echo 'Foo Bar... ';
// echo phpversion();


require_once 'library/Rocca/Autoload.php';

Rocca_Autoload::getInstance()
	->registerNamespace( 'RoccaTest' )
	->init()
;


Rocca_UnitTest::runAll( array(
	
	'show_errors_only' => FALSE,
	
	'run_start_callback' => function() {
		echo "======== Starting Unit Tests =========================================================\n\n";
	},
	
	'show_results_callback' => function( $sClass, $aResults ) {
		
		printf( "Running Test: %s\n\n", $sClass );
		
		foreach ( $aResults as $oResult ) {
			
			if ( $oResult->getFailed() ) {

				$sStatus = 'Failed';
				$sMsg = $oResult->modelFormattedGet(
					' --> ##FailMessage## Expected: ##ExpectedValue##, result: ##ResultValue##.'
				);
				
			} else {
				
				$sStatus = 'Success';
				$sMsg = '';
			}
			
			// which test was run?
			$sTest = $oResult->getKey();
			
			if ( count( $aGrouping = $oResult->getGrouping() ) > 0 ) {
				$sTest = sprintf( '%s: %s', implode( ': ', $aGrouping ), $sTest );
			}
			
			printf( "* %s!: %s%s\n", $sStatus, $sTest, $sMsg );
		}
		
		echo "\n\n";
	
	},
	
	'run_end_callback' => function( $bHasErrors ) {
		
		if ( !$bHasErrors ) {
			echo "There were no errors found!\n\n";
		}
		
		echo "======== End of Unit Tests ===========================================================\n\n";
	}
	
) );



echo "\n\n";



