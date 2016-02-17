<?php
/**
 * An IP address allocated to an accelerator is an IP address join.
 * To view, assign and delete IP address joins of your accelerators.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing Accelerators' IP addresses
 *
 * The OnApp_CDNAccelerator_NetworkInterface class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_CDNAccelerator_IpAddressJoin_IpAddress extends OnApp {
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
    //var $_resource = 'ip_addresses';

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
            case 2.0:
            case 2.1:
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
                $this->fields = array(
                    'address' => array(
                        ONAPP_FIELD_MAP => '_address',
                        ONAPP_FIELD_TYPE => 'string'
                    ),
                    'broadcast' => array(
                        ONAPP_FIELD_MAP => '_broadcast',
                        ONAPP_FIELD_TYPE => 'string'
                    ),
                    'created_at'  => array(
                        ONAPP_FIELD_MAP => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime'
                    ),
                    'customer_network_id' => array(
                        ONAPP_FIELD_MAP => '_customer_network_id',
                        ONAPP_FIELD_TYPE => 'boolean'
                    ),
                    'disallowed_primary'  => array(
                        ONAPP_FIELD_MAP => '_disallowed_primary',
                        ONAPP_FIELD_TYPE => 'boolean'
                    ),
                    'gateway' => array(
                        ONAPP_FIELD_MAP => '_gateway',
                        ONAPP_FIELD_TYPE => 'string'
                    ),
                    'hypervisor_id' => array(
                        ONAPP_FIELD_MAP => '_hypervisor_id',
                        ONAPP_FIELD_TYPE => 'boolean'
                    ),
                    'id'  => array(
                        ONAPP_FIELD_MAP => '_id',
                        ONAPP_FIELD_TYPE => 'integer'
                    ),
                    'ip_address_pool_id'  => array(
                        ONAPP_FIELD_MAP => '_ip_address_pool_id',
                        ONAPP_FIELD_TYPE => 'boolean'
                    ),
                    'network_address' => array(
                        ONAPP_FIELD_MAP => '_network_address',
                        ONAPP_FIELD_TYPE => 'string'
                    ),
                    'network_id'  => array(
                        ONAPP_FIELD_MAP => '_network_id',
                        ONAPP_FIELD_TYPE => 'integer'
                    ),
                    'pxe' => array(
                        ONAPP_FIELD_MAP => '_pxe',
                        ONAPP_FIELD_TYPE => 'boolean'
                    ),
                    'updated_at'  => array(
                        ONAPP_FIELD_MAP => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime'
                    ),
                    'user_id' => array(
                        ONAPP_FIELD_MAP => '_user_id',
                        ONAPP_FIELD_TYPE => 'boolean'
                    ),
                    'free'  => array(
                        ONAPP_FIELD_MAP => '_free',
                        ONAPP_FIELD_TYPE => 'boolean'
                    ),
                    'netmask' => array(
                        ONAPP_FIELD_MAP => '_netmask',
                        ONAPP_FIELD_TYPE => 'string'
                    ),
                );
                break;
        }
        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }
}