<?php
/**
 * Managing CloudBootIpAddresses
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @docs        https://docs.onapp.com/display/42API/Get+List+of+CloudBoot+IP+Addresses
 * @see         OnApp
 */

/**
 * Managing CloudBootIpAddresses
 *
 *
 * The Availability class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: (https://docs.onapp.com/display/42API/Get+List+of+CloudBoot+IP+Addresses )
 */
class OnApp_CloudBootIpAddress extends OnApp {
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
    var $_resource = 'cloud_boot_ip_addresses';

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
                    'created_at'          => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'updated_at'          => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'address'             => array(
                        ONAPP_FIELD_MAP  => '_address',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'broadcast'           => array(
                        ONAPP_FIELD_MAP  => '_broadcast',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'customer_network_id' => array(
                        ONAPP_FIELD_MAP  => '_customer_network_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'disallowed_primary'  => array(
                        ONAPP_FIELD_MAP  => '_disallowed_primary',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'gateway'             => array(
                        ONAPP_FIELD_MAP  => '_gateway',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'hypervisor_id'       => array(
                        ONAPP_FIELD_MAP  => '_hypervisor_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'ip_address_pool_id'  => array(
                        ONAPP_FIELD_MAP  => '_ip_address_pool_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'network_address'     => array(
                        ONAPP_FIELD_MAP  => '_network_address',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'network_id'          => array(
                        ONAPP_FIELD_MAP  => '_network_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'user_id'             => array(
                        ONAPP_FIELD_MAP  => '_user_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'netmask'             => array(
                        ONAPP_FIELD_MAP  => '_netmask',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'id'                  => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'pxe'                 => array(
                        ONAPP_FIELD_MAP  => '_pxe',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'free'                => array(
                        ONAPP_FIELD_MAP  => '_free',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                );
                break;

            case 4.3:
            case 5.0:
                $this->fields = $this->initFields( 4.2 );
                break;
            case 5.1:
                $this->fields = $this->initFields( 5.0 );
                break;
            case 5.2:
                $this->fields = $this->initFields( 5.1 );
                break;
            case 5.3:
                $this->fields = $this->initFields( 5.2 );
                break;
            case 5.4:
                $this->fields = $this->initFields( 5.3 );
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

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            default:
                /**
                 * @alias  /settings/currencies/:id.json
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }

    function allocateIP( $ip_address = null) {
        $data = array(
            'root' => 'ip_address',
            'data' => array(
                'address' => $ip_address,
            )
        );

        $this->sendPost( ONAPP_GETRESOURCE_DEFAULT, $data );
    }



}