<?php
/**
 * Serialize|Unserialize Object to|from XML for OnApp wrapper
 *
 * @category    OBJECT CAST
 * @package     OnApp
 * @subpackage  Caster
 * @author      Lev Bartashevsky
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 */
class OnApp_Helper_Caster_XML extends OnApp_Helper_Caster {
	private $types = array(
		'datetime' => 's',
		'float'    => 'f',
		'decimal'  => 'f',
		'integer'  => 'd',
		'boolean'  => 's',
		''         => 's'
	);

	private static $unknown_tag = 'item';

	public function __construct() {
	}

	/**
	 * Serialize wrapper data to XML
	 *
	 * @param string $root  root tag
	 * @param array  $data  data to serialize
	 *
	 * @return string
	 */
	public function serialize( $root, $data ) {
		parent::$obj->logger->add( 'Call ' . __METHOD__ );
		return $this->getXML( $data, $root );
	}

	/**
	 * Unserialize XML data to wrapper object(s)
	 *
	 * @param string        $className   class name to cast into
	 * @param string|array  $data        XML or array containing nested data
	 * @param string        $root        root tag
	 *
	 * @return array|object
	 */
	public function unserialize( $className, $data, $root ) {
		parent::$obj->logger->add( 'castStringToClass: call ' . __METHOD__ );

		$this->className = $className;

		if( is_string( $data ) ) {
			$data = simplexml_load_string( $data );
		}

		try {
			if( ! $data->count() ) {
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

		// get API version
		if( is_null( parent::$obj->getAPIVersion() ) ) {
			return $data->$root;
		}

		// get errors
		if( $root === 'errors' ) {
			foreach( $data->children() as $error ) {
				$errors[ ] = (string)$error;
			}

			if( count( $errors ) == 1 ) {
				$errors = $errors[ 0 ];
			}
			return $errors;
		}

		if( isset( $data->$root ) ) {
			//parse list
			foreach( $data->$root as $item ) {
				$result[ ] = $this->process( $item );
			}
		}
		else {
			//parse single item
			$result = $this->process( $data );
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
		$obj->isAuthenticated = parent::$obj->isAuthenticated;

		foreach( $item as $name => $value ) {
			$boolean = $type = FALSE;

			if( isset( $value->attributes()->type ) ) {
				if( $value->attributes()->type == 'array' ) {
					if( ! $value->count() ) {
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
				else {
					$type    = $this->types[ (string)$value->attributes()->type ];
					$boolean = ( (string)$value->attributes()->type == 'boolean' );
				}
			}
			else {
				$type = $this->types[ '' ];
			}

			if( $type ) {
				$value = sprintf( '%' . $type, $value );
			}

			if( $boolean ) {
				switch( strtolower( $value ) ) {
					case 'false':
						$value = FALSE;
						break;

					case 'true':
					default:
						$value = TRUE;
				}
			}

			$obj->$name = $value;
		}

		return $obj;
	}

	/**
	 * The main function for converting to an XML document.
	 * Pass in a multidimensional array and this recrusively loops through and builds up an XML document.
	 *
	 * @param mixed                $data    data for converting
	 * @param string               $root    what you want the root node to be
	 * @param SimpleXMLElement     $xml     should only be used recursively
	 *
	 * @return string XML
	 */
	private function getXML( $data, $root, $xml = NULL ) {
		if( is_array( $data ) ) {
			if( is_null( $xml ) ) {
				$xml = simplexml_load_string( '<?xml version="1.0" encoding="UTF-8"?><' . $root . ' />' );
			}

			foreach( $data as $name => $value ) {
				if( is_object( $value ) ) {
					continue;
				}
				elseif( is_array( $value ) ) {
					$node = $xml->addChild( $name );
					$node->addAttribute( 'type', 'array' );
					$this->getXML( $value, $root, $node );
				}
				else {
					if( is_integer( $name ) ) {
						$name = self::$unknown_tag;
					}
					$xml->addChild( $name, htmlentities( $value ) );
				}
			}
		}
		else {
			if( is_null( $xml ) ) {
				$xml = simplexml_load_string( '<?xml version="1.0" encoding="UTF-8"?><tmp_holder />' );
			}
			$xml->addChild( $root, $data );
		}

		return $this->runAfter( $xml->asXML() );
	}

	private function runBefore( &$data ) {
	}

	private function runAfter( $xml ) {
		$xml = str_replace( '<tmp_holder>', '', $xml );
		$xml = str_replace( '</tmp_holder>', '', $xml );

		return $xml;
	}
}