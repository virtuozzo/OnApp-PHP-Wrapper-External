<?php

/**
 * Serialize and Unserialize Object to/from XML for OnApp wrapper
 *
 * @category    OBJECT CAST
 * @package     OnApp
 * @subpackage  Caster
 * @author      Lev Bartashevsky
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 */
class OnApp_Helper_Caster_JSON extends OnApp_Helper_Caster {
    private $map;
    private $className;

    public function __construct() {
    }

    /**
     * Serialize wrapper data to JSON
     *
     * @param string $root root tag
     * @param array  $data data to serialize
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
     * @param string       $className className to cast into
     * @param string|array $data      JSON or array containing nested data
     * @param array        $map       fields map
     * @param string       $root      root tag
     *
     * @return array|object
     */
    public function unserialize( $className, $data, $map, $root ) {
        parent::$obj->logger->add( 'castStringToClass ' . $className . ': call ' . __METHOD__ );

        $this->runBefore( $data );

        $this->map       = $map;
        $this->className = $className;

        if( is_string( $data ) ) {
            $data = json_decode( $data );
        }

        try {
            if( empty( $data ) ) {
                if( IS_CLI ) {
                    throw new Exception( __METHOD__ . ' Data for casting could not be empty' );
                }
                else {
                    //todo add log message
                    return null;
                }
            }
        }
        catch( Exception $e ) {
            echo PHP_EOL, $e->getMessage(), PHP_EOL;

            return null;
        }

        // get API version
        if( is_null( parent::$obj->getAPIVersion() ) ) {
            return $data->$root;
        }

        // get errors
        if( $root === 'errors' ) {
            $errors = $this->objectToArray( $data->$root );

            if( is_array( $errors ) && count( $errors ) == 1 && isset( $errors[ 0 ] ) ) {
                $errors = array_shift( $errors );
            }

            return $errors;
        }

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
        if( ! ( is_array( $item ) || is_object( $item ) ) ) {
            $tmp  = new $this->className;
            $item = array(
                $tmp->_tagRoot => $item
            );
            unset( $tmp );
        }

        $obj           = new $this->className;
        $obj->options  = parent::$obj->options;
        $obj->_ch      = parent::$obj->_ch;
        $obj->_is_auth = parent::$obj->_is_auth;
        $obj->initFields( parent::$APIVersion );
        foreach( $item as $name => $value ) {

            if( isset( $this->map[ $name ][ ONAPP_FIELD_TYPE ] ) ) {
                if( $this->map[ $name ][ ONAPP_FIELD_TYPE ] == 'array' ) {
                    if( empty( $value ) ) {
                        $value = array();
                    }
                    else {
                        $tmp             = new DataHolder;
                        $tmp->APIVersion = parent::$APIVersion;
                        $tmp->className  = $this->map[ $name ][ ONAPP_FIELD_CLASS ];
                        $tmp->data       = $value;
                        $value           = $tmp;
                    }
                }

                if( $this->map[ $name ][ ONAPP_FIELD_TYPE ] == '_array' ) {
                    if( empty( $value ) ) {
                        $value = array();
                    }
                    else {
                        $tmp = array();
                        foreach( $value as $key => $obj_v ) {
                            $tmp[ $key ] = $obj_v;
                        }

                        $value = $tmp;
                    }
                }
            }

            if( array_key_exists( $name, $this->map ) ) {
                $field = $this->map[ $name ][ ONAPP_FIELD_MAP ];

                $obj->$field = $value;
            }
        }

        return $obj;
    }

    private function runBefore( &$data ) {
        if( is_string( $data ) ) {
            if( strpos( $data, '{"error"' ) !== false ) {
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

    /**
     * Convert object to array
     *
     * @param mixed $d
     *
     * @return array
     */
    private function objectToArray( $d ) {
        if( is_object( $d ) ) {
            $d = get_object_vars( $d );
        }

        if( is_array( $d ) ) {
            return array_map( __METHOD__, $d );
        }
        else {
            return $d;
        }
    }
}
