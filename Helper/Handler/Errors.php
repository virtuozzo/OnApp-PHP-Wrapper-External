<?php
/**
 * Errors handler
 *
 * @package     OnApp
 * @subpackage  Helper
 * @author      Lev Bartashevsky
 * @copyright   (c) 2012 OnApp
 * @link        http://www.onapp.com/
 */
class OnApp_Helper_Handler_Errors {
	private static $log;
	private static $displayErrors;
	private static $errorsDescriptions = array();

	public static function init() {
		self::setErrorsDescriptions();
		self::$displayErrors = ini_get( 'display_errors' );

		// set error reporting level
		error_reporting( E_ALL | E_STRICT );
		// switch off displaying errors
		ini_set( 'display_errors', 0 );
		// set errors handlers
		set_error_handler( array( __CLASS__, 'errorHandler' ), E_ALL );
		set_exception_handler( array( __CLASS__, 'exceptionHandler' ) );
		register_shutdown_function( array( __CLASS__, 'fatalHandler' ) );
		ob_start( array( __CLASS__, 'obHandler' ) );
	}

	public static function errorHandler( $errorCode, $errorText, $errorFile, $errorLine ) {
		$msg = self::$errorsDescriptions[ $errorCode ] . ': ' . $errorText;
		$msg .= ' in ' . $errorFile . ' on line ' . $errorLine;

		switch( $errorCode ) {
			case E_ERROR:
			case E_CORE_ERROR:
			case E_COMPILE_ERROR:
			case E_PARSE:
			case E_USER_ERROR:
			case E_RECOVERABLE_ERROR:
				self::addToLog( $msg );
				self::halt( $msg );
				break;

			case E_WARNING:
			case E_CORE_WARNING:
			case E_COMPILE_WARNING:
			case E_USER_WARNING:
			case E_NOTICE:
			case E_USER_NOTICE:
			case E_STRICT:
			case E_DEPRECATED:
			case E_USER_DEPRECATED:
				self::addToLog( $msg );
				break;

			default:
				$msg .= PHP_EOL . "\t Unknown error type: " . $errorCode;
				self::addToLog( $msg );
		}
	}

	public static function exceptionHandler( Exception $e ) {
		$msg  = 'Uncaught ' . get_class( $e );
		$emsg = $e->getMessage();
		if( ! empty( $emsg ) ) {
			$msg .= ' (' . $emsg . ')';
		}
		$msg .= ' in ' . $e->getFile() . ' on line ' . $e->getLine();

		self::addToLog( $msg );
		exit( $msg . PHP_EOL );
	}

	public static function obHandler( $ob ) {
		$e = error_get_last();
		if( ! is_null( $e ) && self::$displayErrors ) {
			$msg = self::$errorsDescriptions[ $e[ 'type' ] ] . ': ' . $e[ 'message' ];
			$msg .= ' in ' . $e[ 'file' ] . ' on line ' . $e[ 'line' ] . PHP_EOL;
			return $msg;
		}
		else {
			return $ob;
		}
	}

	public static function fatalHandler() {
		$e = error_get_last();
		if( ! is_null( $e ) ) {
			$msg = self::$errorsDescriptions[ $e[ 'type' ] ] . ' (fatal): ' . $e[ 'message' ];
			$msg .= ' in ' . $e[ 'file' ] . ' on line ' . $e[ 'line' ];
			self::halt( $msg );
		}
	}

	public static function setLog( OnApp_Helper_Handler_Log $log ) {
		self::$log = $log;
	}

	public static function setErrorsDescriptions() {
		$errorLevels = array(
			'E_ALL',
			'E_USER_DEPRECATED',
			'E_DEPRECATED',
			'E_RECOVERABLE_ERROR',
			'E_STRICT',
			'E_USER_NOTICE',
			'E_USER_WARNING',
			'E_USER_ERROR',
			'E_COMPILE_WARNING',
			'E_COMPILE_ERROR',
			'E_CORE_WARNING',
			'E_CORE_ERROR',
			'E_NOTICE',
			'E_PARSE',
			'E_WARNING',
			'E_ERROR'
		);

		foreach( $errorLevels as $level ) {
			if( defined( $level ) ) {
				self::$errorsDescriptions[ constant( $level ) ] = $level;
			}
		}
	}

	private static function addToLog( $msg ) {
		self::$log->logPHPMessage( $msg );
	}

	private static function halt( $msg ) {
		if( self::$displayErrors ) {
			exit( $msg . PHP_EOL );
		}
		else {
			exit;
		}
	}
}