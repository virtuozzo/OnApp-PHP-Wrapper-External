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
class ResourceLimit_TestCase extends OnApp_TestCase {
	private $_onapp_config = array();
	private $_user_ids = array();

	public static function main() {
		$suite = new PHPUnit_Framework_TestSuite( 'ResourceLimit_TestCase' );
		$result = PHPUnit_TextUI_TestRunner::run( $suite );
	}

	protected function setUp() {
		parent::setUp();
		$this->getUserIds();
	}

	private function getUserIds() {
		$user = $this->createObj( 'ONAPP_User' );
		$user_list = $user->getList();
		foreach( $user_list as $item ) {
			$this->_user_ids[ ] = $item->_id;
		}
	}

	protected function tearDown() {
	}

	public function testCheckAttributes() {
		$obj = new OnApp_ResourceLimit();
		$obj = $this->authObj($obj);
		$obj->_user_id = $this->_user_ids[ 0 ];
		$obj->load();
		$this->CheckAttributes( $obj->_obj );
	}
}

/**
 * PHPUnit main() hack
 * "Call class::main() if this source file is executed directly."
 */
if( PHPUnit_MAIN_METHOD == 'ResourceLimit_TestCase::main' ) {
	ResourceLimits_TestCase::main();
}