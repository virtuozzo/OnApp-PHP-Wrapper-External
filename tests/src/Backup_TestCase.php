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
class Backup_TestCase extends OnApp_TestCase {
	private $_onapp_config = array();
	private $fixture;

	public static function main() {
		$suite = new PHPUnit_Framework_TestSuite( 'Backup_TestCase' );
		$result = PHPUnit_TextUI_TestRunner::run( $suite );
	}

	protected function setUp() {
		parent::setUp();
	}

	protected function tearDown() {
	}

	public function testCheckAttributesList() {
		$obj = new OnApp_VirtualMachine_Backup();

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
if( PHPUnit_MAIN_METHOD == 'Backup_TestCase::main' ) {
	Backups_TestCase::main();
}