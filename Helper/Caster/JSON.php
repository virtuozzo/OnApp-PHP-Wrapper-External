<?php
/**
 * Serialize and Unserialize Object to/from JSON for OnApp wrapper
 *
 * @category    OBJECT CAST
 * @package     OnApp
 * @subpackage  Caster
 * @author      Lev Bartashevsky
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 */
class OnApp_Helper_Caster_JSON extends OnApp_Helper_Caster {
	public function __construct() {
	}

	/**
	 * Serialize wrapper data to JSON
	 *
	 * @param string $root  root tag
	 * @param array  $data  data to serialize
	 *
	 * @return string
	 */
	public function serialize( $root, $data ) {
		parent::$obj->logger->add( 'Call ' . __METHOD__ );

		if( $root != 'tmp_holder' ) {
			$data = array( $root => $data );
		}

		return @json_encode( $data );
	}

	/**
	 * Unserialize JSON data to wrapper object(s)
	 *
	 * @param string        $className    className to cast into
	 * @param string|array  $data         JSON or array containing nested data
	 * @param string        $root         root tag
	 *
	 * @throws Exception    $e            if data is empty
	 *
	 * @return array|null|object
	 */
	public function unserialize( $className, $data, $root ) {
		parent::$obj->logger->add( 'castStringToClass ' . $className . ': call ' . __METHOD__ );

		$this->runBefore( $data );

		$this->className = $className;

		$z = $data;
		if( is_string( $data ) ) {
			$data = json_decode( $data );
		}

		if( empty( $data ) ) {
			return NULL;
		}
		/*
		todo check this code
		try {
			if( empty( $data ) ) {
				if( IS_CLI ) {
					throw new Exception( __METHOD__ . ' Data for casting could not be empty' );
				}
				else {
					//todo add log message
					return NULL;
				}
			}
		}
		catch( Exception $e ) {
			echo PHP_EOL, $e->getMessage(), PHP_EOL;
			return NULL;
		}
		*/

		// get API version
		if( is_null( parent::$obj->getAPIVersion() ) ) {
			return $data->$root;
		}

		// get errors
		if( $root === 'errors' ) {
			$errors = (array)$data->$root;
			return $errors;
		}

		$result = NULL;
		if( count( $data ) > 1 ) {
			foreach( $data as $item ) {
				$result[ ] = $this->process( $this->fixRootTag( $item, $root ) );
			}
		}
		else {
			if( is_array( $data ) ) {
				$data = $data[ 0 ];
			}
			$result = $this->process( $this->fixRootTag( $data, $root ) );
		}

		return $result;
	}

	/**
	 * Cast data to wrapper object
	 *
	 * @param object $item data to cast
	 *
	 * @return object
	 */
	private function process( $item ) {
		$obj           = new $this->className;
		$obj->options  = parent::$obj->options;
		$obj->_ch      = parent::$obj->_ch;
		$obj->isAuthenticated = parent::$isAuthenticated;

		foreach( $item as $name => $value ) {
			if( is_array( $value ) ) {
				if( ! isset( $obj::$nestedData[ $name ] ) ) {
					// just continue
				}
				elseif( empty( $value ) ) {
					$value = array();
				}
				else {
					$tmp             = new OnAppNestedDataHolder;
					$tmp->APIVersion = parent::$APIVersion;
					$tmp->className  = $obj::$nestedData[ $name ];
					$tmp->data       = $value;
					$value           = $tmp;
				}
			}

			$obj->$name = $value;
		}

		return $obj;
	}

	private function runBefore( &$data ) {
		if( is_string( $data ) ) {
			if( strpos( $data, '{"error"' ) !== FALSE ) {
				$data = str_replace( '"error"', '"errors"', $data );
			}
		}
	}

	private function fixRootTag( $item, $root ) {
		if( isset( $item->$root ) ) {
			return $item->$root;
		}
		else {
			return $item;
		}
	}

	private function runAfter() {
	}
}