<?php

/**
 * OnApp API wrapper bootstrap
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Lev Bartashevsky
 * @copyright   (c) 2012 OnApp
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
	 * @throws Exception
	 */
	public function OnAppAutoLoad( $className ) {
		// check if called class belongs to OnApp wrapper
		if( strpos( strtolower( $className ), 'onapp' ) !== 0 ) {
			return false;
		}

		$path = str_replace( 'OnApp_', '', $className );
		$path = explode( '_', $path );
		$path = ONAPP_WRAPPER_ROOT_DIR . implode( DIRECTORY_SEPARATOR, $path ) . '.php';

		$error = false;
		if( ! file_exists( $path ) ) {
			$error = __FUNCTION__ . ': File ' . $path . ' does not exist or can not be read';
		}
		else {
			require $path;

			if( ! class_exists( $className ) ) {
				$error = __FUNCTION__ . ': Class ' . $className . ' not found in ' . $path;
			}
		}

		if( $error ) {
			throw new Exception( $error );
		}
		else {
			return true;
		}
	}

	/**
	 * Register autoload handler
	 */
	spl_autoload_register( 'OnAppAutoLoad', true, true );

	/**
	 * Detect if the code run in CLI for testing purposes
	 */
	if( defined( 'STDIN' ) || ( php_sapi_name() == 'cli' ) ) {
		define( 'ONAPP_CLI_MODE', true );
	}
	else {
		define( 'ONAPP_CLI_MODE', false );
	}

	// start errors handler
	OnApp_Helper_Handler_Errors::init();
}