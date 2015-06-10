<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * VM IP Address Joins
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  VirtualMachine
 * @author      Vitaliy Kondratyuk
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * VM IP Address Joins
 *
 * The OnApp_VirtualMachine_IpAddressJoin uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_VirtualMachine_IpAddressJoin extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'ip_address_join';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'ip_addresses';

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
            case '2.0':
            case '2.1':
                $this->fields = array(
                    'id'                   => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'created_at'           => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'updated_at'           => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'network_interface_id' => array(
                        ONAPP_FIELD_MAP      => '_network_interface_id',
                        ONAPP_FIELD_TYPE     => 'integer',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'ip_address_id'        => array(
                        ONAPP_FIELD_MAP      => '_ip_address_id',
                        ONAPP_FIELD_TYPE     => 'integer',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'ip_address'           => array(
                        ONAPP_FIELD_MAP       => '_ip_address',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_CLASS     => 'VirtualMachine_IpAddress',
                    ),
                );
                break;

            case 2.2:
                $this->fields                         = $this->initFields( 2.1 );
                $this->fields[ 'virtual_machine_id' ] = array(
                    ONAPP_FIELD_MAP  => 'virtual_machine_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                break;

            case 2.3:
                $this->fields = $this->initFields( 2.2 );
                $fields       = array(
                    'virtual_machine_id',
                );
                $this->unsetFields( $fields );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
                $this->fields = $this->initFields( 2.3 );
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
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name virtual_machine_ip_address_joins
                 * @method GET
                 * @alias   /virtual_machines/:virtual_machine_id/ip_addresses(.:format)
                 * @format  {:controller=>"ip_address_joins", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name virtual_machine_ip_address_join
                 * @method GET
                 * @alias    /virtual_machines/:virtual_machine_id/ip_addresses/:id(.:format)
                 * @format   {:controller=>"ip_address_joins", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias    /virtual_machines/:virtual_machine_id/ip_addresses(.:format)
                 * @format   {:controller=>"ip_address_joins", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method DELETE
                 * @alias   /virtual_machines/:virtual_machine_id/ip_addresses/:id(.:format)
                 * @format  {:controller=>"ip_address_joins", :action=>"destroy"}
                 */
                if( is_null( $this->_virtual_machine_id ) && is_null( $this->_obj->_virtual_machine_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _virtual_machine_id not set.",
                        __FILE__,
                        __LINE__
                    );
                }
                else {
                    if( is_null( $this->_virtual_machine_id ) ) {
                        $this->_virtual_machine_id = $this->_obj->_virtual_machine_id;
                    }
                }

                $resource = 'virtual_machines/' . $this->_virtual_machine_id . '/' . $this->_resource;
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
     * @param integer $virtual_machine_id Virtual Machine id
     *
     * @return mixed an array of Object instances on success. Otherwise false
     * @access public
     */
    function getList( $virtual_machine_id = null, $url_args = null ) {
        if( is_null( $virtual_machine_id ) && ! is_null( $this->_virtual_machine_id ) ) {
            $virtual_machine_id = $this->_virtual_machine_id;
        }

        if( ! is_null( $virtual_machine_id ) ) {
            $this->_virtual_machine_id = $virtual_machine_id;

            return parent::getList();
        }
        else {
            $this->logger->error(
                'getList: argument _virtual_machine_id not set.',
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
     * @param integer $id                 IP Address Join id
     * @param integer $virtual_machine_id Virtual Machine id
     *
     * @return mixed serialized Object instance from API
     * @access public
     */
    function load( $id = null, $virtual_machine_id = null ) {
        if( is_null( $virtual_machine_id ) && ! is_null( $this->_virtual_machine_id ) ) {
            $virtual_machine_id = $this->_virtual_machine_id;
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

        $this->logger->add( "load: Load class ( id => '$id')." );

        if( ! is_null( $id ) && ! is_null( $virtual_machine_id ) ) {
            $this->_id                 = $id;
            $this->_virtual_machine_id = $virtual_machine_id;

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
                    'load: argument _virtual_machine_id not set.',
                    __FILE__,
                    __LINE__
                );
            }
        }
    }
}
