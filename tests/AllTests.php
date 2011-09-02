<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Master Unit Test Suite file for ONAPP_*
 *
 * This top-level test suite file organizes
 * all class test suite files,
 * so that the full suite can be run
 * by PhpUnit or via "pear run-tests -u".
 *
 * PHP version 5
 *
 * @category   ONAPP
 * @package	ONAPP_*
 * @subpackage UnitTesting
 * @author	 Andrew Yatskovets
 * @copyright  2010 onapp.com
 * @license	onapp.com
 * @version	GIT: $Id: filename revision date time author state $
 * @since	  0.0.1
 * @see		ONAPP
 */

/**
 * Check PHP version... PhpUnit v3+ requires at least PHP v5.1.4
 */
if( version_compare( PHP_VERSION, "5.1.4" ) < 0 ) {
	// Cannnot run test suites
	echo 'Cannot run test suite via PhpUnit... requires at least PHP v5.1.4.' . PHP_EOL;
	echo 'Use "pear run-tests -p xml_util" to run the PHPT tests directly.' . PHP_EOL;
	exit( 1 );
}

/**
 * Derive the "main" method name
 * @internal PhpUnit would have to rename PHPUnit_MAIN_METHOD to PHPUNIT_MAIN_METHOD
 *		   to make this usage meet the PEAR CS... we cannot rename it here.
 */
if( !defined( 'PHPUnit_MAIN_METHOD' ) ) {
	define( 'PHPUnit_MAIN_METHOD', 'ONAPP_AllTests::main' );
}

/*
 * Files needed by PhpUnit
 */
if( !defined( 'PHPUnit_MAIN_DIR' ) ) {
	define( 'PHPUnit_MAIN_DIR', dirname( __FILE__ ) );
}

set_include_path( get_include_path( ) . PATH_SEPARATOR . PHPUnit_MAIN_DIR );

require_once 'PHPUnit/Framework.php';
require_once 'PHPUnit/TextUI/TestRunner.php';
require_once 'PHPUnit/Extensions/PhptTestSuite.php';

/*
 * You must add each additional class-level test suite file here
 */
$config_file = dirname( __FILE__ ) . '/configure.ini';
$config = parse_ini_file( $config_file );

$config[ 'debug' ] = ( $_SERVER[ 'argv' ][ 1 ] == 'true' );
$config[ 'data_type' ] = $_SERVER[ 'argv' ][ 2 ];

define( 'ONAPP_CONFIG', serialize( $config ) );

$suite_config_file = dirname( __FILE__ ) . '/' . $config[ 'suite_file' ];
$suite_config = parse_ini_file( $suite_config_file );
$test_cases = $suite_config[ 'test_cases' ];

require_once 'OnApp_TestCase.php';
require_once 'wrapper/OnAppInit.php';

foreach( $test_cases as $test_case ) {
	require_once 'src/' . $test_case . '_TestCase.php';
}
// there are no PhpUnit test files... only PHPTs.. so nothing is listed here

/**
 * directory where PHPT tests are located
 */
define( 'ONAPP_DIR_PHPT', dirname( __FILE__ ) );

/**
 * Master Unit Test Suite class for ONAPP
 *
 * This top-level test suite class organizes
 * all class test suite files,
 * so that the full suite can be run
 * by PhpUnit or via "pear run-tests -up xml_util".
 *
 * @category   WRAPPER
 * @package	ONAPP
 * @subpackage UnitTesting
 * @author	 Andrew Yatskovets <ayatsk@onapp.com>
 * @license	onapp.com
 * @version	Release: @package_version@
 * @link	   http://onapp.com
 */
class ONAPP_AllTests {
	/**
	 * Launches the TextUI test runner
	 *
	 * @return void
	 * @uses PHPUnit_TextUI_TestRunner
	 */
	public static function main( ) {
		PHPUnit_TextUI_TestRunner::run( self::suite( ) );
	}

	/**
	 * Adds all class test suites into the master suite
	 *
	 * @return PHPUnit_Framework_TestSuite a master test suite
	 *									 containing all class test suites
	 * @uses PHPUnit_Framework_TestSuite
	 */
	public static function suite( ) {
		$suite = new PHPUnit_Framework_TestSuite( 'ONAPP Full Suite of Unit Tests' );

		/*
		 * You must add each additional class-level test suite name here
		 */
		global $test_cases;
		foreach( $test_cases as $test_case ) {
			$suite->addTestSuite( $test_case . '_TestCase' );
		}
		// there are no PhpUnit test files... only PHPTs.. so nothing is listed here

		/*
		 * add PHPT tests
		 */
		$phpt = new PHPUnit_Extensions_PhptTestSuite( ONAPP_DIR_PHPT );
		$suite->addTestSuite( $phpt );

		return $suite;
	}
}

/**
 * Call the main method if this file is executed directly
 * @internal PhpUnit would have to rename PHPUnit_MAIN_METHOD to PHPUNIT_MAIN_METHOD
 *		   to make this usage meet the PEAR CS... we cannot rename it here.
 */
if( PHPUnit_MAIN_METHOD == 'ONAPP_AllTests::main' ) {
	ONAPP_AllTests::main( );
}