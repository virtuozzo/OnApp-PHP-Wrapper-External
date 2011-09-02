<?php
/**
 * Unit Tests for serializing
 *
 * @package	ONAPP
 * @subpackage tests
 * @author	 Andrew Yatskovets <ayatsk@onapp.com>
 */

require_once 'PHPUnit/Framework/TestCase.php';
require_once 'PHPUnit/Framework/TestSuite.php';
require_once 'PHPUnit/TextUI/TestRunner.php';

/**
 * Unit Tests for serializing arrays
 *
 * @package	ONAPP
 * @subpackage tests
 * @author	 Andrew Yatskovets <ayatsk@onapp.com>
 */
class OnApp_TestCase extends PHPUnit_Framework_TestCase {
	private $_onapp_config = array();

	protected function setUp() {
		$this->_onapp_config = unserialize( ONAPP_CONFIG );
	}

	protected function CheckAttributes( $obj ) {
		$obj = $this->authObj( $obj );

		if( $this->_onapp_config[ 'debug' ] ) {
			$creds = '//' . $this->_onapp_config[ 'username' ] . ':' . $this->_onapp_config[ 'password' ] . '@';
			$dbg = PHP_EOL . 'class: ';
			$dbg .= str_pad( get_class( $obj ), 40, ' ' ) . ' | resource: ';
			$dbg .= str_replace( '//', $creds, $this->_onapp_config[ 'hostname' ] ) . '/'
					. $obj->getResource( ONAPP_GETRESOURCE_LIST ) . '.'
					. $obj->options[ ONAPP_OPTION_API_TYPE ] . ' ';

			echo $dbg;
		}

		$list = $obj->getList();

		if( is_null( $list ) ) {
			return false;
		}

		if( $list === false ) {
			if( !empty( $obj->errors ) ) {
				if( is_array( $obj->errors ) ) {
					$this->fail( implode( PHP_EOL, $obj->errors ) );
				}
				else {
					$this->fail( $obj->errors );
				}
			}
			return false;
		}

		if( count( $list ) == 0 ) {
			$this->fail( 'Elements Array of zero length' );
		}

		$obj->setAPIResource( $obj->getResource( ONAPP_GETRESOURCE_LIST ) );

		$sendRequest = self::getMethod( 'sendRequest', $obj );
		$response = $sendRequest->invoke( $obj, ONAPP_REQUEST_METHOD_GET );

		switch( $obj->options[ ONAPP_OPTION_API_TYPE ] ) {
			case 'xml':
				$xmlObjList = simplexml_load_string( $response[ 'response_body' ] );
				$vars = array_keys( get_object_vars( $xmlObjList ) );
				$field = isset( $vars[ 1 ] ) ? $vars[ 1 ] : $vars[ 0 ];
				$attributes = array_keys( get_object_vars( $xmlObjList->$field ) );
				$fields = array_keys( $obj->getClassFields() );
				sort( $attributes );
				sort( $fields );
				break;

			case 'json':
			default:
				$data = json_decode( $response[ 'response_body' ] );
				if( is_array( $data ) ) {
					$attributes = array_keys( get_object_vars( $data[ 0 ]->{$obj->_tagRoot} ) );
				}
				else {
					$attributes = array_keys( get_object_vars( $data->{$obj->_tagRoot} ) );
				}
				$fields = array_keys( $obj->getClassFields() );

				sort( $attributes );
				sort( $fields );
		}

		$this->assertEquals( $fields, $attributes );

		return true;
	}

	protected function CheckSave( $obj ) {
		$obj = $this->authObj( $obj );
		$obj->logger->setDebug( true );

		if( $this->_onapp_config[ 'debug' ] ) {
			$creds = '//' . $this->_onapp_config[ 'username' ] . ':' . $this->_onapp_config[ 'password' ] . '@';
			$dbg = PHP_EOL . 'class: ';
			$dbg .= str_pad( get_class( $obj ) . '::' . __FUNCTION__, 40, ' ' ) . ' | resource: ';
			$dbg .= str_replace( '//', $creds, $this->_onapp_config[ 'hostname' ] ) . '/'
					. $obj->getResource( ONAPP_GETRESOURCE_LIST ) . '.'
					. $obj->options[ ONAPP_OPTION_API_TYPE ] . ' ';

			echo $dbg;
		}

		$obj->save();

		//todo check if $obj->_obj->errors or $obj->errors are accessible
		$msg = '';
		if( !empty( $obj->_obj->errors ) ) {
			$msg = is_array( $obj->_obj->errors ) ?
					implode( PHP_EOL, $obj->_obj->errors ) :
					$obj->_obj->errors;
		}

		$this->assertNotNull( $obj->_obj->_id, $msg );

		return $obj;
	}

	protected function CheckLoad( $obj ) {
		$obj = $this->authObj( $obj );

		if( $this->_onapp_config[ 'debug' ] ) {
			$creds = '//' . $this->_onapp_config[ 'username' ] . ':' . $this->_onapp_config[ 'password' ] . '@';
			$dbg = PHP_EOL . 'class: ';
			$dbg .= str_pad( get_class( $obj ) . '::' . __FUNCTION__, 40, ' ' ) . ' | resource: ';
			$dbg .= str_replace( '//', $creds, $this->_onapp_config[ 'hostname' ] ) . '/'
					. $obj->getResource( ONAPP_GETRESOURCE_LOAD )
					. ( ( substr( $obj->getResource( ONAPP_GETRESOURCE_LOAD ), -1 ) == '/' ) ? ( isset( $obj->_id )
							? $obj->_id : $obj->_obj->_id ) : '' )
					. '.' . $obj->options[ ONAPP_OPTION_API_TYPE ] . ' ';

			echo $dbg;
		}

		$obj->load();
		$msg = '';
		if( !empty( $obj->_obj->errors ) ) {
			$msg = implode( PHP_EOL, $obj->_obj->errors );
		}

		$this->assertNotNull( $obj->_obj->_id, $msg );

		return $obj;
	}

	protected function CheckEdit( $attr, $value, $obj ) {
		$obj = $this->authObj( $obj );

		if( $this->_onapp_config[ 'debug' ] ) {
			$creds = '//' . $this->_onapp_config[ 'username' ] . ':' . $this->_onapp_config[ 'password' ] . '@';
			$dbg = PHP_EOL . 'class: ';
			$dbg .= str_pad( get_class( $obj ) . '::' . __FUNCTION__, 40, ' ' ) . ' | resource: ';
			$dbg .= str_replace( '//', $creds, $this->_onapp_config[ 'hostname' ] ) . '/'
					. $obj->getResource( ONAPP_GETRESOURCE_LOAD )
					. '.' . $obj->options[ ONAPP_OPTION_API_TYPE ] . ' ';

			echo $dbg;
		}

		$obj->$attr = $value;
		$obj->save();

		$msg = '';
		if( !empty( $obj->_obj->errors ) ) {
			$msg = implode( PHP_EOL, $obj->_obj->errors );
		}

		$this->assertEquals( $obj->_obj->$attr, $value, $msg );

		return $obj;
	}

	protected function CheckDelete( $obj ) {
		$obj = $this->authObj( $obj );

		if( $this->_onapp_config[ 'debug' ] ) {
			$creds = '//' . $this->_onapp_config[ 'username' ] . ':' . $this->_onapp_config[ 'password' ] . '@';
			$dbg = PHP_EOL . 'class: ';
			$dbg .= str_pad( get_class( $obj ) . '::' . __FUNCTION__, 40, ' ' ) . ' | resource: ';
			$dbg .= str_replace( '//', $creds, $this->_onapp_config[ 'hostname' ] ) . '/'
					. $obj->getResource( ONAPP_GETRESOURCE_LOAD )
					. '.' . $obj->options[ ONAPP_OPTION_API_TYPE ] . ' ';

			echo $dbg;
		}

		$obj->delete();
		$msg = '';
		if( !empty( $obj->_obj->errors ) ) {
			$msg = implode( PHP_EOL, $obj->_obj->errors );
		}

		$this->assertTrue( $obj->_is_deleted, $msg );
	}

	protected function getConfig() {
		return $this->_onapp_config;
	}

	protected function createObj( $class ) {
		$obj = new $class;
		$obj = $this->authObj( $obj );

		return $obj;
	}

	protected function authObj( $obj ) {
		if( !$obj->_is_auth ) {
			$options = array(
				ONAPP_OPTION_API_TYPE => $this->_onapp_config[ 'data_type' ],
				ONAPP_OPTION_API_CONTENT => 'application/' . $this->_onapp_config[ 'data_type' ]
			);
			$obj->setOptions( $options );

			$obj->auth(
				$this->_onapp_config[ 'hostname' ],
				$this->_onapp_config[ 'username' ],
				$this->_onapp_config[ 'password' ]
			);
		}

		return $obj;
	}

	protected function getVMList() {
		$vm = new OnApp_VirtualMachine();
		$vm = $this->authObj( $vm );
		return $vm->getList();
	}

	protected function echoWarning( $msg ) {
		echo PHP_EOL . "\033[01;31m" . 'WARNING: ' . "\033[0m" . $msg;
	}

	protected static function getMethod( $name, &$obj ) {
		$class = new ReflectionObject( $obj ); // new ReflectionClass( 'OnApp' );
		$method = $class->getMethod( $name );
		$method->setAccessible( true );
		return $method;
	}
}