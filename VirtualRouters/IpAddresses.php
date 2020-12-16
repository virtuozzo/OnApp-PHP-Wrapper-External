<?php
/**
 * Managing VirtualRouters IpAddresses
 * 
 * much they will be charged per unit.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Mykola Vuy
 * @copyright   © 2019 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

class OnApp_VirtualRouters_IpAddresses extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'ip_address';

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
            case 6.1:
                $this->fields = array(
                    'id'                    => array(
                        ONAPP_FIELD_MAP             => '_id',
                        ONAPP_FIELD_TYPE            => 'integer',
                    ),
                    'address'               => array(
                        ONAPP_FIELD_MAP             => '_address',
                        ONAPP_FIELD_TYPE            => 'string',
                    ),
                    'broadcast'             => array(
                        ONAPP_FIELD_MAP             => '_broadcast',
                        ONAPP_FIELD_TYPE            => 'string',
                    ),
                    'network_address'       => array(
                        ONAPP_FIELD_MAP             => '_network_address',
                        ONAPP_FIELD_TYPE            => 'string',
                    ),
                    'gateway'               => array(
                        ONAPP_FIELD_MAP             => '_gateway',
                        ONAPP_FIELD_TYPE            => 'string',
                    ),
                    'created_at'            => array(
                        ONAPP_FIELD_MAP             => '_created_at',
                        ONAPP_FIELD_TYPE            => 'datetime',
                        ONAPP_FIELD_READ_ONLY       => true
                    ),
                    'updated_at'            => array(
                        ONAPP_FIELD_MAP             => '_updated_at',
                        ONAPP_FIELD_TYPE            => 'datetime',
                        ONAPP_FIELD_READ_ONLY       => true
                    ),
                    'user_id'               => array(
                        ONAPP_FIELD_MAP             => '_user_id',
                        ONAPP_FIELD_TYPE            => 'string',
                    ),
                    'pxe'                   => array(
                        ONAPP_FIELD_MAP             => '_pxe',
                        ONAPP_FIELD_TYPE            => 'boolean',
                    ),
                    'hypervisor_id'         => array(
                        ONAPP_FIELD_MAP             => '_hypervisor_id',
                        ONAPP_FIELD_TYPE            => 'string',
                    ),
                    'ip_range_id'           => array(
                        ONAPP_FIELD_MAP             => '_ip_range_id',
                        ONAPP_FIELD_TYPE            => 'integer',
                    ),
                    'external_address'      => array(
                        ONAPP_FIELD_MAP             => '_external_address',
                        ONAPP_FIELD_TYPE            => 'string',
                    ),
                    'free'                  => array(
                        ONAPP_FIELD_MAP             => '_free',
                        ONAPP_FIELD_TYPE            => 'string',
                    ),
                    'netmask'               => array(
                        ONAPP_FIELD_MAP             => '_netmask',
                        ONAPP_FIELD_TYPE            => 'string',
                    ),
                );

                break;

            case 6.2:
                $this->fields = $this->initFields( 6.1 );
                break;

            case 6.3:
                $this->fields = $this->initFields( 6.2 );
                break;

            case 6.4:
                $this->fields = $this->initFields( 6.3 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

}