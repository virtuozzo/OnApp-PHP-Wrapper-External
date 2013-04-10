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
class OnApp_Helper_Caster extends OnApp_Helper_Stub {
	/**
	 * @param OnApp $obj wrapper object
	 */
	public function __construct( $obj ) {
		$this->super = $obj;
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
		$this->super->logger->debug( 'Data to serialize: ' . print_r( $data, true ) );

		return $this->getCaster()->serialize( $root, $data );
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
		$this->super->logger->debug( 'Data to unserialize into ' . $className . ':' . PHP_EOL . $data );
		return $this->getCaster()->unserialize( $className, $data, $root );
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
	public function unserializeNested( OnAppNestedDataHolder $object ) {
		$this->super->logger->add( 'lazy casting, call ' . __METHOD__ );

		$className        = 'OnApp_' . $object->className;
		$tmp_obj          = new $className;
		$tmp_obj->options = $this->super->options;

		$tmp = array();
		foreach( $object->data as $data ) {
			$tmp[ ] = $this->getCaster()->unserialize( $className, $data, $tmp_obj->rootElement );
		}

		return $tmp;
	}

	/**
	 * Get caster depending on data type
	 *
	 * @static
	 *
	 * @return OnApp_Helper_Caster_JSON|OnApp_Helper_Caster_XML
	 */
	private function getCaster() {
		$caster = __CLASS__ . '_' . strtoupper( $this->super->options[ ONAPP_OPTION_API_TYPE ] );
		return new $caster( $this->super );
	}

	protected function get() {
		return $this->super;
	}
}

/**
 * Holder class for storing nested data
 */
class OnAppNestedDataHolder extends stdClass {
}