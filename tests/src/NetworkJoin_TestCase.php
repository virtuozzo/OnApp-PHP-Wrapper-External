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
class NetworkJoin_TestCase extends OnApp_TestCase {
	private $_onapp_config = array();
	private $hv_ids = array();

	public static function main() {
		$suite = new PHPUnit_Framework_TestSuite( 'NetworkJoin_TestCase' );
		$result = PHPUnit_TextUI_TestRunner::run( $suite );
	}

	protected function setUp() {
		parent::setUp();
		$this->_onapp_config = $this->getConfig();

		$obj = new OnApp_Hypervisor();
		$obj->auth(
			$this->_onapp_config[ 'hostname' ],
			$this->_onapp_config[ 'username' ],
			$this->_onapp_config[ 'password' ]
		);

		$hvs = $obj->getList();
		foreach( $hvs as $hv ) {
			$this->hv_ids[ ] = $hv->_id;
		}
	}

	protected function tearDown() {
	}

	public function testCheckAttributesList() {
		$obj = new OnApp_Hypervisor_NetworkJoin();

		$fail = true;
		foreach( $this->hv_ids as $id ) {
			$obj->_hypervisor_id = $id;
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
if( PHPUnit_MAIN_METHOD == 'NetworkJoin_TestCase::main' ) {
	NetworkJoins_TestCase::main();
}