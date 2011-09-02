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
 * @package	ONAPP
 * @subpackage tests
 * @author	 Andrew Yatskovets <ayatsk@onapp.com>
 */
class IpAddress_TestCase extends OnApp_TestCase {
	private $_onapp_config = array();
	private $_network_ids = array();

	public static function main() {
		$suite = new PHPUnit_Framework_TestSuite( 'IpAddress_TestCase' );
		$result = PHPUnit_TextUI_TestRunner::run( $suite );
	}

	protected function setUp() {
		parent::setUp();
		$this->getNetworks();
	}

	protected function tearDown() {
	}

	public function testCheckAttributesList() {
		$obj = new OnApp_IpAddress();
		$obj->_network_id = $this->_network_ids[ 0 ];
		$this->CheckAttributes( $obj );
	}

	private function getNetworks() {
		$network = $this->createObj( 'ONAPP_Network' );
		$network_list = $network->getList();
		foreach( $network_list as $item ) {
			$this->_network_ids[ ] = $item->_id;
		}
	}
}

/**
 * PHPUnit main() hack
 * "Call class::main() if this source file is executed directly."
 */
if( PHPUnit_MAIN_METHOD == 'IpAddress_TestCase::main' ) {
	NetworkInterfaces_TestCase::main();
}