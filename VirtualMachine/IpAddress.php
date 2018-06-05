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

class OnApp_VirtualMachine_IpAddress extends OnApp {
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
     * @param string|float $version OnApp API version
     * @param string $className current class' name
     *
     * @return array
     */
    public function initFields( $version = null, $className = '' ) {

        switch ( $version ) {
            case '2.0':
            case '2.1':
            case 2.2:
            case 2.3:
            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
            case 4.2:
            case 4.3:
            case 5.0:
            case 5.1:
            case 5.2:
            case 5.3:
            case 5.4:
                $this->fields                         = array();
                $this->fields['id']                   = array(
                    ONAPP_FIELD_MAP  => '_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['created_at']           = array(
                    ONAPP_FIELD_MAP  => '_created_at',
                    ONAPP_FIELD_TYPE => 'datetime',
                );
                $this->fields['updated_at']           = array(
                    ONAPP_FIELD_MAP  => '_updated_at',
                    ONAPP_FIELD_TYPE => 'datetime',
                );
                $this->fields['ip_address_id']        = array(
                    ONAPP_FIELD_MAP  => '_ip_address_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['network_interface_id'] = array(
                    ONAPP_FIELD_MAP  => '_network_interface_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['ip_address']           = array(
                    ONAPP_FIELD_MAP  => '_ip_address',
                    ONAPP_FIELD_CLASS => 'IpAddress',
                );

                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
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
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
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
     * @param integer $ip_address_id ip address id
     * @param integer $virtual_machine_id virtual machine id
     * @param integer $network_interface_id network interface id
     */
    function join( $ip_address_id = null, $virtual_machine_id = null, $network_interface_id = null, $used_ip = false ) {
        if ( $virtual_machine_id ) {
            $this->_virtual_machine_id = $virtual_machine_id;
        }
        if ( $network_interface_id ) {
            $this->_network_interface_id = $network_interface_id;
        }
        if ( $ip_address_id ) {
            $this->_id = $ip_address_id;
        }

        $data = array(
            'root' => 'ip_address_join',
            'data' => array(
                'network_interface_id' => $this->_network_interface_id,
                'ip_address_id'        => $this->_id
            )
        );
        if ( $used_ip ) {
            $data['data']['used_ip'] = '1';
        }

        $this->sendPost( ONAPP_GETRESOURCE_JOIN, $data );
    }

    /**
     * Sends an API request to get the Objects. After requesting,
     * unserializes the received response into the array of Objects
     *
     * @param integer $network_id Network ID
     *
     * @return mixed an array of Object instances on success. Otherwise false
     * @access public
     */
    function getList( $virtual_machine_id = null, $url_args = null ) {
        if ( $virtual_machine_id ) {
            $this->_virtual_machine_id = $virtual_machine_id;
        }

        if ( ! $this->_virtual_machine_id ) {
            $this->logger->error(
                'getList: argument _virtual_machine_id not set.',
                __FILE__,
                __LINE__
            );

            return false;
        }

        return parent::getList();
    }

}
