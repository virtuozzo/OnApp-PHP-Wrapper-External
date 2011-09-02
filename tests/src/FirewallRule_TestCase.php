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
class FirewallRule_TestCase extends OnApp_TestCase {
	private $_onapp_config = array();

	public static function main() {
		$suite = new PHPUnit_Framework_TestSuite( 'FirewallRule_TestCase' );
		$result = PHPUnit_TextUI_TestRunner::run( $suite );
	}

	protected function setUp() {
		parent::setUp();
	}

	protected function tearDown() {
	}

	public function testCheckAttributes() {
		$obj = new ONAPP_VirtualMachine_FirewallRule();

		$fail = true;
		foreach( $this->getVMList() as $vm ) {
			$obj->_virtual_machine_id = $vm->_id;
			if( $this->CheckAttributes( $obj ) !== false ) {
				$fail = false;
				break;
			}
		}

		if( $fail ) {
			$this->echoWarning( __METHOD__ . ' receive empty data from OnApp' );
			sleep( 3 );
		}
	}
}

/**
 * PHPUnit main() hack
 * "Call class::main() if this source file is executed directly."
 */
if( PHPUnit_MAIN_METHOD == 'FirewallRule_TestCase::main' ) {
	Templates_TestCase::main();
}