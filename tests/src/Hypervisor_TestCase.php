<?php
/**
 * Unit Tests for serializing
 *
 * @package	ONAPP
 * @subpackage tests
 * @author	 Andrew Yatskovets <ayatsk@onapp.com>
 */

/**
 * PHPUnit main() hack
 *
 * "Call class::main() if this source file is executed directly."
 */
if( !defined( 'PHPUnit_MAIN_METHOD' ) ) {
	define( 'PHPUnit_MAIN_METHOD', 'Hypervisor_TestCase::main' );
}

/**
 * Unit Tests for serializing arrays
 *
 * @package	ONAPP
 * @subpackage tests
 * @author	 Andrew Yatskovets <ayatsk@onapp.com>
 */
class Hypervisor_TestCase extends OnApp_TestCase {
	private $_onapp_config = array();

	public static function main() {
		$suite = new PHPUnit_Framework_TestSuite( 'Hypervisor_TestCase' );
		$result = PHPUnit_TextUI_TestRunner::run( $suite );
	}

	protected function setUp() {
		parent::setUp();
	}

	protected function tearDown() {
	}

	public function testCheckAttributes() {
		$obj = new OnApp_Hypervisor();
		$this->CheckAttributes( $obj );
	}
}

/**
 * PHPUnit main() hack
 * "Call class::main() if this source file is executed directly."
 */
if( PHPUnit_MAIN_METHOD == 'Hypervisor_TestCase::main' ) {
	Hypervisor_TestCase::main();
}