<?php

/**
 * Serialize and Unserialize Object to/from JSON|XML for OnApp wrapper
 *
 * @category    OBJECT CAST
 * @package     OnApp
 * @subpackage  Helper
 * @author      Lev Bartashevsky
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 */
class OnApp_Helper_Caster {
    protected static $obj;
    protected static $APIVersion;

    /**
     * @param string $version OnApp API version
     * @param object $obj     wrapper object
     */
    public function __construct( $obj ) {
        self::$obj = $obj;
        self::$APIVersion = $obj->getAPIVersion();
    }

    /**
     * Serialize wrapper data to JSON|XML
     *
     * @param string $root root tag
     * @param array  $data data to serialize
     *
     * @return string
     */
    public function serialize( $root, $data ) {
        self::$obj->logger->debug( 'Data to serialize: ' . print_r( $data, true ) );

        return self::getCaster()->serialize( $root, $data );
    }

    /**
     * Unserialize data to wrapper object(s)
     *
     * @param string       $className classname to cast into
     * @param string|array $data      XML|JSON or array containing nested data
     * @param array        $map       fields map
     * @param string       $root      root tag
     *
     * @return array|object unserialized data
     */
    public function unserialize( $className, $data, $map, $root ) {
        self::$obj->logger->debug( 'Data to unserialize into ' . $className . ':' . PHP_EOL . $data );

        return self::getCaster()->unserialize( $className, $data, $map, $root );
    }

    /**
     * Unserialize nested data
     *
     * @static
     *
     * @param DataHolder $object object storing nested data
     *
     * @return array
     */
    public static function unserializeNested( DataHolder $object ) {
        self::$obj->logger->add( 'castStringToClass: call ' . __METHOD__ );

        $className = 'OnApp_' . $object->className;
        $tmp_obj = new $className;
        $tmp_obj->initFields( $object->APIVersion );
        $tmp_obj->options = self::$obj->options;
        $tmp_obj->_ch = self::$obj->_ch;
        $tmp_obj->_is_auth = self::$obj->_is_auth;

        if( is_object( $object->data ) && get_class( $object->data ) == 'SimpleXMLElement'
            && (string)$object->data->attributes()->type != 'array' || is_object( $object->data )
            && get_class( $object->data ) == 'stdClass' && ! is_array( $object->data )
        ) {
            $tmp = self::getCaster()->unserialize( $className, $object->data, $tmp_obj->getClassFields(), $tmp_obj->_tagRoot );
        }
        else {
            $tmp = array();
            foreach( $object->data as $data ) {
                $tmp[ ] = self::getCaster()->unserialize( $className, $data, $tmp_obj->getClassFields(), $tmp_obj->_tagRoot );
            }
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
        $caster = __CLASS__ . '_' . strtoupper( self::$obj->options[ 'data_type' ] );

        return new $caster;
    }
}

/**
 * Holder class for storing nested data
 */
class DataHolder extends stdClass {
}

/**
 * Hide errors if running in CLI to pass unit tests
 */
if( IS_CLI ) {
    error_reporting( 0 );
}