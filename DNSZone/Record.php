<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * VM IP Adresses
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  DNSZone
 * @author      Andrew Yatskovets
 * @copyright   © 2013 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 *
 */
class OnApp_DNSZone_Record extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'dns_record';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'records';

    /**
     * API Fields description
     *
     * @param string|float $version   OnApp API version
     * @param string       $className current class' name
     *
     * @return array
     */
    public function initFields( $version = null, $className = '' ) {
        switch( $version ) {
            case 2.3:
            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
                $this->fields = array(
                    'id'          => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'dns_zone_id' => array(
                        ONAPP_FIELD_MAP       => '_dns_zone_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'type'        => array(
                        ONAPP_FIELD_MAP      => '_type',
                        ONAPP_FIELD_TYPE     => 'string',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'name'        => array(
                        ONAPP_FIELD_MAP      => '_name',
                        ONAPP_FIELD_TYPE     => 'string',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'ttl'         => array(
                        ONAPP_FIELD_MAP      => '_ttl',
                        ONAPP_FIELD_TYPE     => 'integer',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'priority'    => array(
                        ONAPP_FIELD_MAP      => '_priority',
                        ONAPP_FIELD_TYPE     => 'integer',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'hostname'    => array(
                        ONAPP_FIELD_MAP      => '_hostname',
                        ONAPP_FIELD_TYPE     => 'string',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'port'        => array(
                        ONAPP_FIELD_MAP      => '_port',
                        ONAPP_FIELD_TYPE     => 'integer',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'weight'      => array(
                        ONAPP_FIELD_MAP      => '_weight',
                        ONAPP_FIELD_TYPE     => 'integer',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'ip'          => array(
                        ONAPP_FIELD_MAP      => '_ip',
                        ONAPP_FIELD_TYPE     => 'string',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'txt'         => array(
                        ONAPP_FIELD_MAP      => '_txt',
                        ONAPP_FIELD_TYPE     => 'string',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'serial'      => array(
                        ONAPP_FIELD_MAP      => '_serial',
                        ONAPP_FIELD_TYPE     => 'string',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'primaryNs'   => array(
                        ONAPP_FIELD_MAP      => '_primaryNs',
                        ONAPP_FIELD_TYPE     => 'string',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'retry'       => array(
                        ONAPP_FIELD_MAP      => '_retry',
                        ONAPP_FIELD_TYPE     => 'integer',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'refresh'     => array(
                        ONAPP_FIELD_MAP      => '_refresh',
                        ONAPP_FIELD_TYPE     => 'integer',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'minimum'     => array(
                        ONAPP_FIELD_MAP      => '_minimum',
                        ONAPP_FIELD_TYPE     => 'integer',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'expire'      => array(
                        ONAPP_FIELD_MAP      => '_expire',
                        ONAPP_FIELD_TYPE     => 'integer',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'hostmaster'  => array(
                        ONAPP_FIELD_MAP      => '_hostmaster',
                        ONAPP_FIELD_TYPE     => 'string',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                );
                break;
            default:
                $resource = parent::getResource( $action );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    /**
     * Returns the URL Alias of the API Class that inherits the OnApp class
     *
     * @param string $action action name
     *
     * @return string API resource
     * @access public
     */
    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch( $action ) {
            case ONAPP_GETRESOURCE_LOAD:
                $resource = 'dns_zones/' . $this->_dns_zone_id . '/' . $this->_resource . '/' . $this->_id;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
            case ONAPP_GETRESOURCE_ADD:
            case ONAPP_GETRESOURCE_EDIT:
                $resource = 'dns_zones/' . $this->_dns_zone_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
            case ONAPP_GETRESOURCE_LIST:
                $resource = 'dns_zones/' . $this->_dns_zone_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    /**
     * Sends an API request to get the Objects. After requesting,
     * unserializes the received response into the array of Objects
     *
     * @param integer $dns_zone_id Virtual Machine id
     *
     * @return mixed an array of Object instances on success. Otherwise false
     * @access public
     */
    function getList( $dns_zone_id = null, $url_args = null ) {
        if( is_null( $dns_zone_id ) && ! is_null( $this->_dns_zone_id ) ) {
            $dns_zone_id = $this->_dns_zone_id;
        }

        if( is_null( $dns_zone_id ) &&
            isset( $this->_obj ) &&
            ! is_null( $this->_obj->_dns_zone_id )
        ) {
            $dns_zone_id = $this->_obj->_dns_zone_id;
        }

        if( ! is_null( $dns_zone_id ) ) {
            $this->_dns_zone_id = $dns_zone_id;

            return parent::getList();
        }
        else {
            $this->logger->error(
                'getList: argument _dns_zone_id not set.',
                __FILE__,
                __LINE__
            );
        }
    }

    /**
     * Sends an API request to get the Object after sending,
     * unserializes the response into an object
     *
     * The key field Parameter ID is used to load the Object. You can re-set
     * this parameter in the class inheriting OnApp class.
     *
     * @access public
     */
    function load( $id = null, $dns_zone_id = null ) {
        if( is_null( $dns_zone_id ) && ! is_null( $this->_dns_zone_id ) ) {
            $dns_zone_id = $this->_dns_zone_id;
        }

        if( is_null( $dns_zone_id ) &&
            isset( $this->_obj ) &&
            ! is_null( $this->_obj->_dns_zone_id )
        ) {
            $dns_zone_id = $this->_obj->_dns_zone_id;
        }

        if( is_null( $id ) && ! is_null( $this->_id ) ) {
            $id = $this->_id;
        }

        if( is_null( $id ) &&
            isset( $this->_obj ) &&
            ! is_null( $this->_obj->_id )
        ) {
            $id = $this->_obj->_id;
        }
        $this->logger->add( 'load: Load class ( id => ' . $id . ' ).' );

        if( ! is_null( $id ) && ! is_null( $dns_zone_id ) ) {
            $this->_id          = $id;
            $this->_dns_zone_id = $dns_zone_id;

            $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_LOAD ) );

            $response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

            $result = $this->_castResponseToClass( $response );

            $this->_obj = $result;

            return $result;
        }
        else {
            if( is_null( $id ) ) {
                $this->logger->error(
                    'load: argument _id not set.',
                    __FILE__,
                    __LINE__
                );
            }
            else {
                $this->logger->error(
                    'load: argument _dns_zone_id not set.',
                    __FILE__,
                    __LINE__
                );
            }
        }
    }

    /**
     * The method saves an Object to your account
     *
     * After sending an API request to create an object or change the data in
     * the existing object, the method checks the response and loads the
     * exisitng object with the new data.
     *
     * @return void
     * @access public
     */
    function save() {
        $fields = $this->fields;

        $_unset = array(
            'priority',
            'hostname',
            'port',
            'weight',
            'ip',
            'txt',
            'serial',
            'primaryNs',
            'retry',
            'refresh',
            'minimum',
            'expire',
            'hostmaster'
        );

        foreach( $_unset as $field ) {
            $this->fields[ $field ][ ONAPP_FIELD_REQUIRED ] = false;
        }

        switch( $this->_type ) {
            case 'MX':
                $this->fields[ 'priority' ][ ONAPP_FIELD_REQUIRED ] =
                $this->fields[ 'hostname' ][ ONAPP_FIELD_REQUIRED ] =
                    true;
                break;
            case 'SRV':
                $this->fields[ 'port' ][ ONAPP_FIELD_REQUIRED ] =
                $this->fields[ 'weight' ][ ONAPP_FIELD_REQUIRED ] =
                $this->fields[ 'priority' ][ ONAPP_FIELD_REQUIRED ] =
                $this->fields[ 'hostname' ][ ONAPP_FIELD_REQUIRED ] =
                    true;
                break;
            case 'A':
            case 'AAAA':
                $this->fields[ 'ip' ][ ONAPP_FIELD_REQUIRED ] = true;
                break;
            case 'CNAME':
            case 'NS':
                $this->fields[ 'hostname' ][ ONAPP_FIELD_REQUIRED ] = true;
                break;
            case 'TXT':
                $this->fields[ 'txt' ][ ONAPP_FIELD_REQUIRED ] = true;
                break;
            case 'SOA':
                trigger_error( 'Cannot save SOA record', E_USER_ERROR );
                break;
            default:
                trigger_error( sprintf( "Cannot save '%s' record", $this->_type ), E_USER_ERROR );
                break;
        }

        if( isset( $this->_id ) ) {
            $obj = $this->_edit();
            $this->load();
        }
        else {
            return parent::save();
        }

        $this->fields = $fields;
    }

    protected function sendRequest( $method, $data = null ) {
        $result = parent::sendRequest( $method, $data );

        $response_body = $result[ 'response_body' ];

        $data = json_decode( $response_body, true );

        if( isset( $data[ 'dns_zone' ] ) ) {
            $records = $data[ 'dns_zone' ][ 'records' ];

            $dns_records = array();

            foreach( array( 'MX', 'SRV', 'A', 'CNAME', 'AAAA', 'TXT', 'NS', 'SOA' ) as $type ) {
                if( array_key_exists( $type, $records ) ) {
                    $dns_records = array_merge( $dns_records, $records[ $type ] );
                }
            }

            $result[ 'response_body' ] = json_encode( $dns_records );
        };

        return $result;
    }
}
