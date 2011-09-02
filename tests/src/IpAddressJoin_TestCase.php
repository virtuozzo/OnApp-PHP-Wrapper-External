<?php
/**
 * Unit Tests for serializing
 *
 * @package	ONAPP
 * @subpackage tests
 * @author	 Vitaliy Kondratyuk <vitaliy.kondratyuk@onapp.com>
 */

/**
 * Unit Tests for serializing arrays
 *
 */
class IpAddressJoin_TestCase extends OnApp_TestCase {
	private $_onapp_config = array();
	private $fixture;

	public static function main() {
		$suite = new PHPUnit_Framework_TestSuite( 'IpAddressJoin_TestCase' );
		$result = PHPUnit_TextUI_TestRunner::run( $suite );
	}

	protected function setUp() {
		parent::setUp();
		$this->_onapp_config = $this->getConfig();

		$obj = new OnApp_VirtualMachine();
		$obj->auth(
			$this->_onapp_config[ 'hostname' ],
			$this->_onapp_config[ 'username' ],
			$this->_onapp_config[ 'password' ]
		);

		$list = $obj->getList();
		$this->fixture = $list[ 0 ]->_id;
	}

	protected function tearDown() {
	}

	public function testCheckAttributesList() {
		$obj = new OnApp_VirtualMachine_IpAddressJoin();
		$obj->_virtual_machine_id = $this->fixture;
		$this->CheckAttributes( $obj );
	}
}

/**
 * PHPUnit main() hack
 * "Call class::main() if this source file is executed directly."
 */
if( PHPUnit_MAIN_METHOD == 'IpAddressJoin_TestCase::main' ) {
	IpAddressJoins_TestCase::main();
}