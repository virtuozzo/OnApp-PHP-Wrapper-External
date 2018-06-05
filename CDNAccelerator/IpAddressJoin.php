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
 * Managing Accelerators' Ip Address Join
 *
 * The OnApp_CDNAccelerator_IpAddressJoin class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_CDNAccelerator_IpAddressJoin extends OnApp {
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
                    'created_at'           => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'id'                   => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'ip_address_id'        => array(
                        ONAPP_FIELD_MAP  => '_ip_address_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'network_interface_id' => array(
                        ONAPP_FIELD_MAP  => '_network_interface_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'updated_at'           => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'data_store_id'        => array(
                        ONAPP_FIELD_MAP  => '_data_store_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'hypervisor_id'        => array(
                        ONAPP_FIELD_MAP  => '_hypervisor_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'target_join_id'       => array(
                        ONAPP_FIELD_MAP  => '_target_join_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'target_join_type'     => array(
                        ONAPP_FIELD_MAP  => '_target_join_type',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'ip_address'           => array(
                        ONAPP_FIELD_MAP   => '_ip_address',
                        ONAPP_FIELD_TYPE  => 'array',
                        ONAPP_FIELD_CLASS => 'CDNAccelerator_IpAddressJoin_IpAddress',
                    ),
                    'accelerator_id'       => array(
                        ONAPP_FIELD_MAP  => '_accelerator_if',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),

                );
                break;
            case 4.3:
                $this->fields = $this->initFields( 4.2 );
                break;
            case 5.0:
                $this->fields = $this->initFields( 4.3 );
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
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name ip_addresses
                 * @method GET
                 * @alias   /accelerators/:accelerator_id/ip_addresses(.:format)
                 * @format  {:controller=>"ip_addresses", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name ip_addresses
                 * @method POST
                 * @alias   /accelerators/:accelerator_id/ip_addresses(.:format)
                 * @format  {:controller=>"ip_addresses", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name  ip_addresses
                 * @method DELETE
                 * @alias   /accelerators/:accelerator_id/ip_addresses/:id(.:format)
                 * @format  {:controller=>"ip_addresses", :action=>"destroy"}
                 */
                if ( is_null( $this->_accelerator_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _accelerator_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = 'accelerators/' . $this->_accelerator_id . '/' . $this->_resource;
                break;

            default:
                /**
                 * ROUTE :
                 *
                 * @name ip_addresses
                 * @method GET
                 * @alias  accelerators/:accelerator_id/ip_addresses(.:format)
                 * @format {:controller=>"ip_addresses", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name network_interfaces
                 * @method GET
                 * @alias  accelerators/:accelerator_id/ip_addresses/:id(.:format)
                 * @format {:controller=>"ip_addresses", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name ip_addresses
                 * @method POST
                 * @alias  accelerators/:accelerator_id/ip_addresses(.:format)
                 * @format {:controller=>"ip_addresses", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name ip_addresses
                 * @method PUT
                 * @alias  accelerators/:accelerator_id/ip_addresses/:id(.:format)
                 * @format {:controller=>"ip_addresses", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name ip_addresses
                 * @method DELETE
                 * @alias  accelerators/:accelerator_id/ip_addresses/:id(.:format)
                 * @format {:controller=>"ip_addresses", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }

    function getList( $accelerator_id = null, $url_args = null ) {
        if ( is_null( $accelerator_id ) && ! is_null( $this->_accelerator_id ) ) {
            $accelerator_id = $this->_accelerator_id;
        }

        if ( ! is_null( $accelerator_id ) ) {
            $this->_accelerator_id = $accelerator_id;

            return parent::getList();
        } else {
            $this->logger->error(
                'getList: argument _accelerator_id not set.',
                __FILE__,
                __LINE__
            );
        }
    }

}