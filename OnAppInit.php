<?php
/**
 * OnApp API wrapper bootstrap
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Lev Bartashevsky
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 */
if( ! defined( 'ONAPP_WRAPPER_ROOT_DIR' ) ) {
	/**
	 * Specify the wrapper root dir
	 */
	define( 'ONAPP_WRAPPER_ROOT_DIR', dirname( __FILE__ ) . DIRECTORY_SEPARATOR );

	/**
	 * Automatically load requested class
	 *
	 * @param string $className requested class' name
	 *
	 * @return bool
	 */
	function OnAppAutoLoad( $className ) {
		// compatibility with legacy code
		$className = str_replace( 'ONAPP', 'OnApp', $className );

		$path = str_replace( 'OnApp_', '', $className );
		$path = explode( '_', $path );
		$path = ONAPP_WRAPPER_ROOT_DIR . implode( DIRECTORY_SEPARATOR, $path ) . '.php';

		if(file_exists( $path ) ) {
			require $path;
	
			if( class_exists( $className ) ) {
				return true;
			}
			//todo add loging instead of printing
		}
		return false;
	}

	/**
	 * Register autoload handler
	 */
	spl_autoload_register( 'OnAppAutoLoad' );

	/**
	 * Detect if the code run in CLI for testing purposes
	 */
	if( defined( 'STDIN' ) ) {
		define( 'IS_CLI', true );
	}
	else {
		define( 'IS_CLI', false );
	}
}
