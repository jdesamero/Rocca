<?php

echo "\n\n";

// echo 'Foo Bar... ';
// echo phpversion();


require_once( sprintf( '%s/library/Rocca/Autoload.php', dirname( __FILE__ ) ) );

Rocca_Autoload::getInstance()
	->registerNamespace( 'RoccaTest' )
	->init()
;


Rocca_UnitTest::runAll( [
	
	'show_errors_only' => FALSE,
	
	'run_start_callback' => function() {
		echo "================================= Starting Unit Tests =================================\n\n";
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
			
			printf( "* %s!: %s%s\n", $sStatus, $oResult->getTitle(), $sMsg );
		}
		
		echo "\n\n";
	
	},
	
	'run_end_callback' => function( $bHasErrors ) {
		
		if ( !$bHasErrors ) {
			echo "There were no errors found!\n\n";
		}
		
		echo "================================== End of Unit Tests ==================================\n\n";
	}
	
] );



echo "\n\n";



