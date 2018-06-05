<?php
/**
 * API calls for managing accelerators' network interfaces.
 * Accelerators' network interfaces have the same attributes as network interfaces of virtual servers
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing Accelerators' Network Interfaces
 *
 * The OnApp_CDNAccelerator_NetworkInterface class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_CDNAccelerator_NetworkInterface extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'network_interface';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'network_interfaces';

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
                    'connected'             => array(
                        ONAPP_FIELD_MAP  => '_connected',
                        ONAPP_FIELD_TYPE => 'boolean'
                    ),
                    'created_at'            => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime'
                    ),
                    'default_firewall_rule' => array(
                        ONAPP_FIELD_MAP  => '_default_firewall_rule',
                        ONAPP_FIELD_TYPE => 'string'
                    ),
                    'id'                    => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer'
                    ),
                    'identifier'            => array(
                        ONAPP_FIELD_MAP  => '_identifier',
                        ONAPP_FIELD_TYPE => 'string'
                    ),
                    'label'                 => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string'
                    ),
                    'mac_address'           => array(
                        ONAPP_FIELD_MAP  => '_mac_address',
                        ONAPP_FIELD_TYPE => 'string'
                    ),
                    'network_join_id'       => array(
                        ONAPP_FIELD_MAP  => '_network_join_id',
                        ONAPP_FIELD_TYPE => 'integer'
                    ),
                    'primary'               => array(
                        ONAPP_FIELD_MAP  => '_primary',
                        ONAPP_FIELD_TYPE => 'boolean'
                    ),
                    'rate_limit'            => array(
                        ONAPP_FIELD_MAP  => '_rate_limit',
                        ONAPP_FIELD_TYPE => 'integer'
                    ),
                    'updated_at'            => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime'
                    ),
                    'usage'                 => array(
                        ONAPP_FIELD_MAP  => '_usage',
                        ONAPP_FIELD_TYPE => 'boolean'
                    ),
                    'usage_last_reset_at'   => array(
                        ONAPP_FIELD_MAP  => '_usage_last_reset_at',
                        ONAPP_FIELD_TYPE => 'boolean'
                    ),
                    'usage_month_rolled_at' => array(
                        ONAPP_FIELD_MAP  => '_usage_month_rolled_at',
                        ONAPP_FIELD_TYPE => 'boolean'
                    ),
                    'virtual_machine_id'    => array(
                        ONAPP_FIELD_MAP  => '_virtual_machine_id',
                        ONAPP_FIELD_TYPE => 'integer'
                    ),
                    'edge_gateway_id'       => array(
                        ONAPP_FIELD_MAP  => '_edge_gateway_id',
                        ONAPP_FIELD_TYPE => 'string'
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
                $this->fields['use_as_gateway'] = array(
                    ONAPP_FIELD_MAP  => '_use_as_gateway',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
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
                 * @name network_interfaces
                 * @method GET
                 * @alias   /accelerators/:virtual_machine_id/network_interfaces(.:format)
                 * @format  {:controller=>"network_interfaces", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name network_interfaces
                 * @method POST
                 * @alias   /accelerators/:virtual_machine_id/network_interfaces(.:format)
                 * @format  {:controller=>"network_interfaces", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name  network_interfaces
                 * @method DELETE
                 * @alias   /accelerators/:virtual_machine_id/network_interfaces/:id(.:format)
                 * @format  {:controller=>"network_interfaces", :action=>"destroy"}
                 */
                if ( is_null( $this->_virtual_machine_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _virtual_machine_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = 'accelerators/' . $this->_virtual_machine_id . '/' . $this->_resource;
                break;

            default:
                /**
                 * ROUTE :
                 *
                 * @name network_interfaces
                 * @method GET
                 * @alias  accelerators/:virtual_machine_id/network_interfaces(.:format)
                 * @format {:controller=>"network_interfaces", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name network_interfaces
                 * @method GET
                 * @alias  accelerators/:virtual_machine_id/network_interfaces/:id(.:format)
                 * @format {:controller=>"network_interfaces", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name network_interfaces
                 * @method POST
                 * @alias  accelerators/:virtual_machine_id/network_interfaces(.:format)
                 * @format {:controller=>"network_interfaces", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name network_interfaces
                 * @method PUT
                 * @alias  accelerators/:virtual_machine_id/network_interfaces/:id(.:format)
                 * @format {:controller=>"network_interfaces", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name network_interfaces
                 * @method DELETE
                 * @alias  accelerators/:virtual_machine_id/network_interfaces/:id(.:format)
                 * @format {:controller=>"network_interfaces", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }

    function getList( $virtual_machine_id = null, $url_args = null ) {
        if ( is_null( $virtual_machine_id ) && ! is_null( $this->_virtual_machine_id ) ) {
            $virtual_machine_id = $this->_virtual_machine_id;
        }

        if ( ! is_null( $virtual_machine_id ) ) {
            $this->_virtual_machine_id = $virtual_machine_id;

            return parent::getList();
        } else {
            $this->logger->error(
                'getList: argument _virtual_machine_id not set.',
                __FILE__,
                __LINE__
            );
        }
    }

}