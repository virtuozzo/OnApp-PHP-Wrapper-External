<?php
/**
 * Serialize|Unserialize Object to/from JSON|XML for OnApp wrapper
 *
 * @category    OBJECT CAST
 * @package     OnApp
 * @subpackage  Helper
 * @author      Lev Bartashevsky
 * @copyright   (c) 2012 OnApp
 * @link        http://www.onapp.com/
 */
class OnApp_Helper_Caster extends OnApp {
	/**
	 * @var OnApp
	 */
	protected static $super;

	/**
	 * @param object $obj wrapper object
	 */
	public function __construct( $obj ) {
		self::$super = $obj;
	}

	/**
	 * Serialize wrapper data to JSON|XML
	 *
	 * @param string $root  root tag
	 * @param array  $data  data to serialize
	 *
	 * @return string
	 */
	public function serialize( $root, $data ) {
		self::$super->logger->debug( 'Data to serialize: ' . print_r( $data, true ) );

		return self::getCaster()->serialize( $root, $data );
	}

	/**
	 * Unserialize data to wrapper object(s)
	 *
	 * @param string        $className  classname to cast into
	 * @param string|array  $data       XML|JSON or array containing nested data
	 * @param string        $root       root tag
	 *
	 * @return array|object unserialized data
	 */
	public function unserialize( $className, $data, $root ) {
		self::$super->logger->debug( 'Data to unserialize into ' . $className . ':' . PHP_EOL . $data );
		return self::getCaster()->unserialize( $className, $data, $root );
	}

	/**
	 * Unserialize nested data
	 *
	 * @static
	 *
	 * @param OnAppNestedDataHolder $object object storing nested data
	 *
	 * @return array
	 */
	public static function unserializeNested( OnAppNestedDataHolder $object ) {
		self::$super->logger->add( 'lazy casting, call ' . __METHOD__ );

		$className                = 'OnApp_' . $object->className;
		$tmp_obj                  = new $className;
		$tmp_obj->options         = self::$super->options;
		$tmp_obj->ch              = self::$super->ch;
		$tmp_obj->isAuthenticated = self::$super->isAuthenticated();

		$tmp = array();
		foreach( $object->data as $data ) {
			$tmp[ ] = self::getCaster()->unserialize( $className, $data, $tmp_obj->rootElement );
		}

		return $tmp;
	}

	public function parseVersion( $data, $tag ) {
		return self::getCaster()->parseVersion( $data, $tag );
	}

	/**
	 * Get caster depending on data type
	 *
	 * @static
	 * @return object
	 */
	private static function getCaster() {
		$caster = __CLASS__ . '_' . strtoupper( self::$super->options[ 'data_type' ] );
		return new $caster;
	}
}

/**
 * Holder class for storing nested data
 */
class OnAppNestedDataHolder extends stdClass {
}