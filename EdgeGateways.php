<?php

/**
 * EdgeGateways
 *
 * @category        API wrapper
 * @package         OnApp
 * @subpackage      Settings
 * @author          Mykola Vuy
 * @copyright       © 2019 OnApp
 *
 */
/**
 * @var
 */
define('ONAPP_GATEWAY_INTERFACES', 'gateway_interfaces');
/**
 * @var
 */
define('ONAPP_CONVERT_TO_ADVANCED', 'convert_to_advanced');
/**
 * EdgeGateways
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_EdgeGateways class uses the
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_EdgeGateways extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'edge_gateway';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'edge_gateways';
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
                    'id'                                            => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'label'                                         => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'description'                                   => array(
                        ONAPP_FIELD_MAP  => '_description',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'identifier'                                    => array(
                        ONAPP_FIELD_MAP  => '_identifier',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'advanced_enabled'                              => array(
                        ONAPP_FIELD_MAP  => '_advanced_enabled',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'created_at'                                    => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'updated_at'                                    => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'gateway_backing_config'                        => array(
                        ONAPP_FIELD_MAP  => '_gateway_backing_config',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'ha_enabled'                                    => array(
                        ONAPP_FIELD_MAP  => '_ha_enabled',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'status'                                        => array(
                        ONAPP_FIELD_MAP  => '_status',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'use_default_route_for_dns_relay'               => array(
                        ONAPP_FIELD_MAP  => '_use_default_route_for_dns_relay',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'vdc_id'                                        => array(
                        ONAPP_FIELD_MAP  => '_vdc_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'firewall_service'                              => array(
                        ONAPP_FIELD_MAP  => '_firewall_service',
                        ONAPP_FIELD_TYPE => '_array',
                    ),
                    'gateway_ipsec_vpn_service'                     => array(
                        ONAPP_FIELD_MAP  => '_gateway_ipsec_vpn_service',
                        ONAPP_FIELD_TYPE => '_array',
                    ),
                    'nat_service'                                   => array(
                        ONAPP_FIELD_MAP  => '_nat_service',
                        ONAPP_FIELD_TYPE => '_array',
                    ),
                    'distributed_routing_enabled'                   => array(
                        ONAPP_FIELD_MAP  => '_distributed_routing_enabled',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'configure_gateway'                             => array(
                        ONAPP_FIELD_MAP  => '_configure_gateway',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'default_gateway'                               => array(
                        ONAPP_FIELD_MAP  => '_default_gateway',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'external_network_configurations_attributes'    => array(
                        ONAPP_FIELD_MAP  => '_external_network_configurations_attributes',
                        ONAPP_FIELD_TYPE => '_array',
                    ),
                    'default_firewall_rule'                         => array(
                        ONAPP_FIELD_MAP  => '_default_firewall_rule',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'network_join_id'                               => array(
                        ONAPP_FIELD_MAP  => '_network_join_id',
                        ONAPP_FIELD_TYPE => 'integer',
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

            case 6.5:
                $this->fields = $this->initFields( 6.4 );
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
        $show_log_msg = true;
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name    Get List of Edge Gateways
                 * @method  GET
                 * @alias   /edge_gateways(.:format)
                 */
                /**
                 * ROUTE :
                 *
                 * @name    Get Edge Gateway Details
                 * @method  GET
                 * @alias   /edge_gateways/:id(.:format)
                 */
                /**
                 * ROUTE :
                 *
                 * @name    Create Edge Gateway
                 * @method  POST
                 * @alias   /edge_gateways(.:format)
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method  PUT
                 * @alias   (.:format)
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method  DELETE
                 * @alias   (.:format)
                 */
                $resource = $this->_resource;
                break;

            case ONAPP_GATEWAY_INTERFACES:
                /**
                 * ROUTE :
                 *
                 * @name    Get List of Edge Gateway Interfaces
                 * @method  GET
                 * @alias   /edge_gateways/:id/gateway_interfaces(.:format)
                 */
                if( is_null( $this->_id ) && is_null( $this->_obj->_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                else {
                    if( is_null( $this->_id ) ) {
                        $this->_id = $this->_obj->_id;
                    }
                }

                $resource = $this->_resource . '/' . $this->_id . '/' . ONAPP_GATEWAY_INTERFACES;
                break;

            case ONAPP_CONVERT_TO_ADVANCED:
                /**
                 * ROUTE :
                 *
                 * @name    Convert Edge Gateways to Advanced Edge Gateways
                 * @method  PUT
                 * @alias   /edge_gateways/:id/convert_to_advanced(.:format)
                 */
                if( is_null( $this->_id ) && is_null( $this->_obj->_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if( is_null( $this->_id ) ) {
                        $this->_id = $this->_obj->_id;
                    }
                }

                $resource = $this->_resource . '/' . $this->_id . '/' . ONAPP_CONVERT_TO_ADVANCED;
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    public function getListOfEdgeGatewayInterfaces() {
        $this->_tagRoot = 'gateway_interface';

        return $this->sendGet(ONAPP_GATEWAY_INTERFACES);
    }

    public function convertToAdvanced() {
        return $this->sendPut(ONAPP_CONVERT_TO_ADVANCED);
    }
}
