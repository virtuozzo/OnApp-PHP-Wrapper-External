<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * VM IP Adresses
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
 * VM IP Adresses
 *
 * The OnApp_VirtualMachine_IpAddress class doesn't support any basic method.
 *
 */

/**
 *
 */
define( 'ONAPP_GETRESOURCE_JOIN', 'ip_address_join' );

class OnApp_VirtualMachine_IpAddress extends OnApp_IpAddress {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'ip_address';
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
            case 2.2:
            case 2.3:
                $this->fields = array(
                    'id'              => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'created_at'      => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'updated_at'      => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'address'         => array(
                        ONAPP_FIELD_MAP       => '_address',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'netmask'         => array(
                        ONAPP_FIELD_MAP       => '_netmask',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'broadcast'       => array(
                        ONAPP_FIELD_MAP       => '_broadcast',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'network_address' => array(
                        ONAPP_FIELD_MAP       => '_network_address',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'gateway'         => array(
                        ONAPP_FIELD_MAP       => '_gateway',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'network_id'      => array(
                        ONAPP_FIELD_MAP       => '_network_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'free'            => array(
                        ONAPP_FIELD_MAP       => '_free',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
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
            case ONAPP_GETRESOURCE_JOIN:
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
     * Joins another Ip Address to particular virtual machine
     *
     * @param integer $ip_address_id        ip address id
     * @param integer $virtual_machine_id   virtual machine id
     * @param integer $network_interface_id network interface id
     */
    function join( $ip_address_id = null, $virtual_machine_id = null, $network_interface_id = null ) {
        if( $virtual_machine_id ) {
            $this->_virtual_machine_id = $virtual_machine_id;
        }
        if( $network_interface_id ) {
            $this->_network_interface_id = $network_interface_id;
        }
        if( $ip_address_id ) {
            $this->_id = $ip_address_id;
        }

        $data = array(
            'root' => 'ip_address_join',
            'data' => array(
                'network_interface_id' => $this->_network_interface_id,
                'ip_address_id'        => $this->_id
            )
        );

        $this->sendPost( ONAPP_GETRESOURCE_JOIN, $data );
    }

    /**
     * Activates action performed with object
     *
     * @param string $action_name the name of action
     *
     * @access public
     */
    function activate( $action_name ) {
        switch( $action_name ) {
            case ONAPP_ACTIVATE_GETLIST:
            case ONAPP_ACTIVATE_LOAD:
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}
