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
	define( 'PHPUnit_MAIN_METHOD', 'Payment_TestCase::main' );
}

/**
 * Unit Tests for serializing arrays
 *
 * @package	ONAPP
 * @subpackage tests
 * @author	 Andrew Yatskovets <ayatsk@onapp.com>
 */
class Payment_TestCase extends OnApp_TestCase {
	private $_onapp_config = array();
	private $_user_ids = array();

	public static function main() {
		$suite = new PHPUnit_Framework_TestSuite( 'Payment_TestCase' );
		$result = PHPUnit_TextUI_TestRunner::run( $suite );
	}

	protected function setUp() {
		parent::setUp();
		$this->getUserIds();
	}

	private function getUserIds() {
		$user = $this->createObj( 'OnApp_User' );
		$user_list = $user->getList();
		foreach( $user_list as $item ) {
			$this->_user_ids[ ] = $item->_id;
		}
	}

	protected function tearDown() {
	}

	public function testCheckAttributes() {
		$obj = new OnApp_Payment();

		$fail = true;
		foreach( $this->_user_ids as $id ) {
			$obj->_user_id = $id;
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
if( PHPUnit_MAIN_METHOD == 'Payment_TestCase::main' ) {
	Payments_TestCase::main();
}