<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Groups
 *
 * Groups are created to set prices for the resources so that users know how
 * much they will be charged per unit. The prices can be set for the memory,
 * CPU, CPU Share, and Disk size. Each user is assigned a billing group during
 * the creation process.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing Groups
 *
 * The Group class represents the billing groups.
 * The OnApp class is the parent of the Group class.
 *
 * The OnApp_Group uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Group extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'group';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'groups';

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
                $this->fields = array(
                    'id'                         => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'created_at'                 => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'identifier'                 => array(
                        ONAPP_FIELD_MAP       => '_identifier',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'label'                      => array(
                        ONAPP_FIELD_MAP           => '_label',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                    'price_cpu'                  => array(
                        ONAPP_FIELD_MAP           => '_price_cpu',
                        ONAPP_FIELD_TYPE          => 'decimal',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => '0.0',
                    ),
                    'price_cpu_share'            => array(
                        ONAPP_FIELD_MAP           => '_price_cpu_share',
                        ONAPP_FIELD_TYPE          => 'decimal',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => '0.0',
                    ),
                    'price_disk_size'            => array(
                        ONAPP_FIELD_MAP           => '_price_disk_size',
                        ONAPP_FIELD_TYPE          => 'decimal',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => '0.0',
                    ),
                    'price_memory'               => array(
                        ONAPP_FIELD_MAP           => '_price_memory',
                        ONAPP_FIELD_TYPE          => 'decimal',
                        ONAPP_FIELD_REQUIRED      => 'true',
                        ONAPP_FIELD_DEFAULT_VALUE => '0.0',
                    ),
                    'updated_at'                 => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'price_ip_address'           => array(
                        ONAPP_FIELD_MAP      => '_price_ip_address',
                        ONAPP_FIELD_REQUIRED => 'true',
                    ),
                    'price_storage_disk_size'    => array(
                        ONAPP_FIELD_MAP           => '_price_storage_disk_size',
                        ONAPP_FIELD_TYPE          => 'decimal',
                        ONAPP_FIELD_REQUIRED      => 'true',
                        ONAPP_FIELD_DEFAULT_VALUE => '0.0',
                    ),
                    'price_cpu_power_off'        => array(
                        ONAPP_FIELD_MAP           => '_price_cpu_power_off',
                        ONAPP_FIELD_TYPE          => 'decimal',
                        ONAPP_FIELD_REQUIRED      => 'true',
                        ONAPP_FIELD_DEFAULT_VALUE => '0.0',
                    ),
                    'price_memory_power_off'     => array(
                        ONAPP_FIELD_MAP           => '_price_memory_power_off',
                        ONAPP_FIELD_TYPE          => 'decimal',
                        ONAPP_FIELD_REQUIRED      => 'true',
                        ONAPP_FIELD_DEFAULT_VALUE => '0.0',
                    ),
                    'price_disk_size_power_off'  => array(
                        ONAPP_FIELD_MAP           => '_price_disk_size_power_off',
                        ONAPP_FIELD_TYPE          => 'decimal',
                        ONAPP_FIELD_REQUIRED      => 'true',
                        ONAPP_FIELD_DEFAULT_VALUE => '0.0',
                    ),
                    'price_cpu_share_power_off'  => array(
                        ONAPP_FIELD_MAP           => '_price_cpu_share_power_off',
                        ONAPP_FIELD_TYPE          => 'decimal',
                        ONAPP_FIELD_REQUIRED      => 'true',
                        ONAPP_FIELD_DEFAULT_VALUE => '0.0',
                    ),
                    'price_ip_address_power_off' => array(
                        ONAPP_FIELD_MAP           => '_price_ip_address_power_off',
                        ONAPP_FIELD_TYPE          => 'decimal',
                        ONAPP_FIELD_REQUIRED      => 'true',
                        ONAPP_FIELD_DEFAULT_VALUE => '0.0',
                    ),
                );
                break;

            case '2.1':
                $this->fields = array();
                break;

            case 2.2:
            case 2.3:
            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
                $this->fields = $this->initFields( 2.1 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }
}