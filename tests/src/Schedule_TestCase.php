<?php
/**
 * Unit Tests for serializing
 *
 * @package	   ONAPP
 * @subpackage tests
 * @author	   Yakubskiy Yuriy
 */

/**
 * Unit Tests for serializing arrays
 *
 * @package	   ONAPP
 * @subpackage tests
 * @author	   Andrew Yatskovets <ayatsk@onapp.com>
 */
class Schedule_TestCase extends OnApp_TestCase {
	private $_onapp_config = array();

	public static function main() {
		$suite = new PHPUnit_Framework_TestSuite( 'Schedule_TestCase' );
		$result = PHPUnit_TextUI_TestRunner::run( $suite );
	}

	protected function setUp() {
		parent::setUp();
	}

	protected function tearDown() {
	}

	public function testCheckAttributes() {
		$obj = new OnApp_Disk_Schedule();

		$this->CheckAttributes( $obj );
	}
}

/**
 * PHPUnit main() hack
 * "Call class::main() if this source file is executed directly."
 */
if( PHPUnit_MAIN_METHOD == 'Schedule_TestCase::main' ) {
	Templates_TestCase::main();
}
