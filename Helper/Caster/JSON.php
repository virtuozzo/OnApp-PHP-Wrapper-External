<?php
/**
 * Serialize and Unserialize Object to/from JSON for OnApp wrapper
 *
 * @category    OBJECT CAST
 * @package     OnApp
 * @subpackage  Caster
 * @author      Lev Bartashevsky
 * @copyright   (c) 2012 OnApp
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
		parent::$super->logger->add( 'Call ' . __METHOD__ );

		if( $root != 'tmp_holder' ) {
			$data = array( $root => $data );
		}

		return @json_encode( $data );
	}

	/**
	 * Unserialize JSON data to wrapper object(s)
	 *
	 * @param string       $className className to cast into
	 * @param string|array $data      JSON or array containing nested data
	 * @param string       $root      root tag
	 *
	 * @return array|null|object
	 */
	public function unserialize( $className, $data, $root ) {
		parent::$super->logger->add( 'cast data into ' . $className . ', call ' . __METHOD__ );
		$this->className = $className;

		if( is_string( $data ) ) {
			$data = json_decode( $data );
		}

		if( empty( $data ) ) {
			parent::$super->logger->add( __METHOD__ . ': get empty data for casting' );
			return null;
		}

		// get errors
		if( $root === 'errors' ) {
			$errors = (array)$data->$root;
			return $errors;
		}

		$result = null;
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
		$obj                  = new $this->className;
		$obj->options         = parent::$super->options;
		$obj->ch              = parent::$super->ch;
		$obj->isAuthenticated = parent::$super->isAuthenticated();

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
					$tmp->className  = $obj::$nestedData[ $name ];
					$tmp->data       = $value;
					$value           = $tmp;
				}
			}

			$obj->$name = $value;
		}

		return $obj;
	}

	private function fixRootTag( $item, $root ) {
		if( isset( $item->$root ) ) {
			return $item->$root;
		}
		else {
			return $item;
		}
	}
}