<?php
/**
 * Unit Tests for serializing
 *
 * @package	ONAPP
 * @subpackage tests
 * @author	 Andrew Yatskovets <ayatsk@onapp.com>
 */

if( !defined( 'ONAPP_USERSTEST_GROUPID' ) ) {
	/**
	 * Default User Group ID
	 */
	define( 'ONAPP_USERSTEST_GROUPID', 1 );

	/**
	 * Default User Role ID
	 */
	define( 'ONAPP_USERSTEST_ROLEID', 2 );
}

/**
 * Unit Tests for serializing arrays
 *
 * @package	ONAPP
 * @subpackage tests
 * @author	 Andrew Yatskovets <ayatsk@onapp.com>
 */
class UserFull_TestCase extends OnApp_TestCase {
	private $_onapp_config = array();

	public static function main() {
		$suite = new PHPUnit_Framework_TestSuite( 'UserFull_TestCase' );
		$result = PHPUnit_TextUI_TestRunner::run( $suite );
	}

	protected function setUp() {
		parent::setUp();
	}

	protected function tearDown() {
	}

	public function testCheckCreate() {
		$obj = new OnApp_User();
		$obj->_login = 'testuser' . time();
		$obj->_first_name = 'testFirstName';
		$obj->_last_name = 'testLastName';
		$obj->_email = $obj->_login . '@test.com';
		$obj->_password = $obj->_login . 'pwd';

		$result = $this->CheckSave( $obj );

		return $result;
	}

	/**
	 * @depends testCheckCreate
	 */
	public function testCheckLoad( $obj ) {
		$result = $this->CheckLoad( $obj );
		return $result;
	}

	/**
	 * @dataProvider editDataProvider
	 * @depends testCheckLoad
	 */
	public function testCheckEdit( $attr, $value, $obj ) {
		$result = $this->CheckEdit( $attr, $value, $obj );
		return $result;
	}

	/**
	 * @depends testCheckLoad
	 */
	public function testCheckDelete( $obj ) {
		$this->CheckDelete( $obj );
		$obj->delete();
	}

	public function editDataProvider() {
		$login = 'testuseredited' . time();
		return array(
			array( '_first_name', 'testFirstNameEdited' ),
			array( '_last_name', 'testLastNameEdited' ),
			array( '_email', $login . 'edited@test.com' ),
		);
	}
}

/**
 * PHPUnit main() hack
 * "Call class::main() if this source file is executed directly."
 */
if( PHPUnit_MAIN_METHOD == 'UserFull_TestCase::main' ) {
	UserFull_TestCase::main();
}