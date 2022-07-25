<?php

/**
 * NSX Edge Gateways NSX-T IPSec VPN
 *
 * @category        API wrapper
 * @package         OnApp
 * @copyright       © 2021 OnApp
 */

/**
 * NSX_EdgeGatewaysIpSecVpns
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_NSX_EdgeGatewaysIpSecVpns class uses the following basic methods:
 * {@link getList}, {@link load}, {@link save}, .
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */

class OnApp_NSX_EdgeGatewaysIpSecVpns extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'vcloud_nsxt_ip_sec_vpn';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'ip_sec_vpns';
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
            case 6.7:
                $this->fields = array(
                    'id'                            => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'identifier'                    => array(
                        ONAPP_FIELD_MAP         => '_identifier',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'label'                         => array(
                        ONAPP_FIELD_MAP         => '_label',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'description'                   => array(
                        ONAPP_FIELD_MAP         => '_description',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'enabled'                       => array(
                        ONAPP_FIELD_MAP         => '_enabled',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'authentication_mode'           => array(
                        ONAPP_FIELD_MAP         => '_authentication_mode',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'vcloud_nsxt_edge_gateway_id'   => array(
                        ONAPP_FIELD_MAP         => '_vcloud_nsxt_edge_gateway_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'logging'                       => array(
                        ONAPP_FIELD_MAP         => '_logging',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'version'                       => array(
                        ONAPP_FIELD_MAP         => '_version',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'security_profile'              => array(
                        ONAPP_FIELD_MAP         => '_security_profile',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'pre_shared_key'                => array(
                        ONAPP_FIELD_MAP         => '_pre_shared_key',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'local_endpoint'                => array(
                        ONAPP_FIELD_MAP         => '_local_endpoint',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'local_ip'                      => array(
                        ONAPP_FIELD_MAP         => '_local_ip',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'local_networks'                => array(
                        ONAPP_FIELD_MAP         => '_local_networks',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'remote_endpoint'               => array(
                        ONAPP_FIELD_MAP         => '_remote_endpoint',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'remote_ip'                     => array(
                        ONAPP_FIELD_MAP         => '_remote_ip',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'remote_networks'               => array(
                        ONAPP_FIELD_MAP         => '_remote_networks',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'nsxt_edge_gateway_id'                      => array(
                        ONAPP_FIELD_MAP         => '_nsxt_edge_gateway_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                );
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
                /**
                 * ROUTE :
                 *
                 * @name Get the List of IPSec VPN Tunnels
                 * @method GET
                 *
                 * @alias  /nsxt_edge_gateways/:nsxt_edge_gateway_id/ip_sec_vpns(.:format)
                 * @format {:controller=>"NSX_EdgeGatewaysIpSecVpns", :action=>"getList"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Get IPSec VPN Tunnel Details
                 * @method GET
                 *
                 * @alias  /nsxt_edge_gateways/:nsxt_edge_gateway_id/ip_sec_vpns/:id(.:format)
                 * @format {:controller=>"NSX_EdgeGatewaysIpSecVpns", :action=>"getList"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Add IPSec VPN Tunnel
                 * @method POST
                 *
                 * @alias  /nsxt_edge_gateways/:nsxt_edge_gateway_id/ip_sec_vpns(.:format)
                 * @format {:controller=>"NSX_EdgeGatewaysIpSecVpns", :action=>"save"}
                 */
                if ( is_null( $this->_nsxt_edge_gateway_id ) && is_null( $this->_obj->_nsxt_edge_gateway_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _nsxt_edge_gateway_id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_nsxt_edge_gateway_id ) ) {
                        $this->_nsxt_edge_gateway_id = $this->obj->_nsxt_edge_gateway_id;
                    }
                }

                $resource = 'nsxt_edge_gateways/' . $this->_nsxt_edge_gateway_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    public function save()
    {
        if ($this->_id) {
            return;
        }

        $data = array(
            'ip_sec_vpn' => array(
                'label' => $this->_label,
                'description' => $this->_description,
                'enabled' => $this->_enabled,
                'pre_shared_key' => $this->_pre_shared_key,
                'local_endpoint' => $this->_local_endpoint,
                'local_networks' => $this->_local_networks,
                'remote_endpoint' => $this->_remote_endpoint,
                'remote_networks' => $this->_remote_networks,
                'logging' => $this->_logging,
            ),
            '_nsxt_edge_gateway_id'  => $this->_nsxt_edge_gateway_id,
        );

        $dataJSON = json_encode($data);
        $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_DEFAULT ) );
        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_POST, $dataJSON );

        $result     = $this->_castResponseToClass( $response );
        $this->_obj = $result;
    }

    /**
     * Activates action performed with object
     *
     * @param string $action_name the name of action
     *
     * @access public
     */
    function activateCheck( $action_name ) {
        switch ( $action_name ) {
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}
