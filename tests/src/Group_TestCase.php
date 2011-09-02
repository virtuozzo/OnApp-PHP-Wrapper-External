<?php

/**
 * Unit Tests for serializing arrays
 *
 * @package	ONAPP
 * @subpackage tests
 * @author	 Andrew Yatskovets <ayatsk@onapp.com>
 */
class Group_TestCase extends OnApp_TestCase {
	private $_onapp_config = array();

	private $obj;

	public static function main() {
		$suite = new PHPUnit_Framework_TestSuite( 'Group_TestCase' );
		$result = PHPUnit_TextUI_TestRunner::run( $suite );
	}

	protected function setUp() {
		$this->obj = new OnApp_Group();

		if( $this->obj->getAPIVersion() != '2.0' ) {
			$msg = 'unsupported API version ';
			echo PHP_EOL . __CLASS__ . ' skipped due to ' . $msg;
			$this->markTestSkipped( $msg );
		}
		else {
			parent::setUp();
		}
	}

	protected function tearDown() {
	}

	public function testCheckAttributes() {
		$this->CheckAttributes( $this->obj );
	}
}

/**
 * PHPUnit main() hack
 * "Call class::main() if this source file is executed directly."
 */
if( PHPUnit_MAIN_METHOD == 'Group_TestCase::main' ) {
	Groups_TestCase::main();
}