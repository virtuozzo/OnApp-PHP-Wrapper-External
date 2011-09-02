<?php
/**
 * Unit Tests for serializing
 *
 * @package	ONAPP
 * @subpackage tests
 * @author	 Andrew Yatskovets <ayatsk@onapp.com>
 */

/**
 * Unit Tests for serializing arrays
 *
 * @package	ONAPP
 * @subpackage tests
 * @author	 Andrew Yatskovets <ayatsk@onapp.com>
 */
class VirtualMachine_TestCase extends OnApp_TestCase {
	private $_onapp_config = array();

	public static function main() {
		$suite = new PHPUnit_Framework_TestSuite( 'VirtualMachine_TestCase' );
		$result = PHPUnit_TextUI_TestRunner::run( $suite );
	}

	protected function setUp() {
		parent::setUp();
		$this->_onapp_config = $this->getConfig();
	}

	protected function tearDown() {
	}

	public function testCheckAttributes() {
		$obj = new OnApp_VirtualMachine();
		$obj->_id = 0;
		$this->CheckAttributes( $obj );
	}
}

/**
 * PHPUnit main() hack
 * "Call class::main() if this source file is executed directly."
 */
if( PHPUnit_MAIN_METHOD == 'VirtualMachine_TestCase::main' ) {
	VirtualMachines_TestCase::main();
}