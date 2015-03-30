<?php

echo "\n\n";

// echo 'Foo Bar... ';
// echo phpversion();


require_once 'Rocca/Autoload.php';

Rocca_Autoload::getInstance()
	->registerNamespace( 'RoccaTest' )
	->init()
;


Rocca_UnitTest::runAll( array(
	
	'show_errors_only' => FALSE,
	
	'show_results_callback' => function( $sClass, $aResults ) {
		
		printf( "Running Test: %s\n\n", $sClass );
		
		foreach ( $aResults as $sKey => $mResult ) {
			
			if ( TRUE === $mResult ) {
				
				$sStatus = 'Success';
				$sMsg = '';
				
			} else {
				
				$sStatus = 'Failed';
				$sMsg = sprintf( ' --> %s', $mResult );
			}
			
			printf( "* %s! %s%s\n", $sStatus, $sKey, $sMsg );
		}
		
		echo "\n\n";
	
	},
	
	'run_end_callback' => function( $bHasErrors ) {
		if ( !$bHasErrors ) {
			echo 'There were no errors found!';
		}
	}
	
) );



echo "\n\n";



