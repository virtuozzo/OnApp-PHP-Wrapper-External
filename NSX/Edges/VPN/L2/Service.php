<?php

/**
 * NSX Edges VPN L2 Service
 *
 * @category        API wrapper
 * @package         OnApp
 * @author          Mykola Vuy
 * @copyright       © 2019 OnApp
 */

/**
 * NSX_Edges_VPN_L2_Service
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_NSX_Edges_VPN_L2_Service class uses the following basic methods:
 * {@link getList} and {@link save}
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_NSX_Edges_VPN_L2_Service extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'nsx_l2_vpn_service';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'vpn/l2_vpn/service';
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
            case 6.2:
                $this->fields = array(
                    'id'                            => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'enabled'                       => array(
                        ONAPP_FIELD_MAP         => '_enabled',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'logging'                       => array(
                        ONAPP_FIELD_MAP         => '_logging',
                        ONAPP_FIELD_TYPE        => 'boolean',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'log_level'                     => array(
                        ONAPP_FIELD_MAP         => '_log_level',
                        ONAPP_FIELD_TYPE        => 'string',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'edge_id'                       => array(
                        ONAPP_FIELD_MAP         => '_edge_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'routed_remote_subnets_enabled'  => array(
                        ONAPP_FIELD_MAP         => '_routed_remote_subnets_enabled',
                        ONAPP_FIELD_TYPE        => 'boolean',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'mode'                          => array(
                        ONAPP_FIELD_MAP         => '_mode',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'listener_ip'                   => array(
                        ONAPP_FIELD_MAP         => '_listener_ip',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'listener_port'                 => array(
                        ONAPP_FIELD_MAP         => '_listener_port',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'server_address'                => array(
                        ONAPP_FIELD_MAP         => '_server_address',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'server_port'                   => array(
                        ONAPP_FIELD_MAP         => '_server_port',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'service_certificate_id'        => array(
                        ONAPP_FIELD_MAP         => '_service_certificate_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'service_certificate'        => array(
                        ONAPP_FIELD_MAP         => '_service_certificate',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'ca_certificate_id'             => array(
                        ONAPP_FIELD_MAP         => '_ca_certificate_id',
                        ONAPP_FIELD_TYPE        => 'string',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'encryption_algorithm'          => array(
                        ONAPP_FIELD_MAP         => '_encryption_algorithm',
                        ONAPP_FIELD_TYPE        => '_array',
                    ),
                    'egress_optimization'           => array(
                        ONAPP_FIELD_MAP         => '_egress_optimization',
                        ONAPP_FIELD_TYPE        => '_array',
                    ),
                    'user_id'                       => array(
                        ONAPP_FIELD_MAP         => '_user_id',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'user_password'                 => array(
                        ONAPP_FIELD_MAP         => '_user_password',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'proxy_type'       => array(
                        ONAPP_FIELD_MAP             => '_proxy_type',
                        ONAPP_FIELD_TYPE        => 'string',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'proxy_address'                 => array(
                        ONAPP_FIELD_MAP         => '_proxy_address',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'proxy_port'                    => array(
                        ONAPP_FIELD_MAP         => '_proxy_port',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'proxy_user_name'               => array(
                        ONAPP_FIELD_MAP         => '_proxy_user_name',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'proxy_user_password'           => array(
                        ONAPP_FIELD_MAP         => '_proxy_user_password',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'created_at'                    => array(
                        ONAPP_FIELD_MAP         => '_created_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'updated_at'                    => array(
                        ONAPP_FIELD_MAP         => '_updated_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'locked'                        => array(
                        ONAPP_FIELD_MAP         => '_locked',
                        ONAPP_FIELD_TYPE        => 'boolean',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'ca_certificate'                => array(
                        ONAPP_FIELD_MAP         => '_ca_certificate',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'sub_interfaces'                => array(
                        ONAPP_FIELD_MAP         => '_sub_interfaces',
                        ONAPP_FIELD_TYPE        => '_array',
                    ),
                    'certificate_auth_enabled'      => array(
                        ONAPP_FIELD_MAP         => '_certificate_auth_enabled',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'secure_proxy_enabled'          => array(
                        ONAPP_FIELD_MAP         => '_secure_proxy_enabled',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'l2_vpn_peer_sites'             => array(
                        ONAPP_FIELD_MAP         => '_l2_vpn_peer_sites',
                        ONAPP_FIELD_TYPE        => 'array',
                        ONAPP_FIELD_CLASS       => 'OnApp_NSX_Edges_VPN_L2_PeerSites',
                    ),
                );
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
                 * @name Get NSX L2 VPN Client Details
                 * @method GET
                 * @alias  /nsx/edges/:edge_id/vpn/l2_vpn/service(.:format)
                 * @format {:controller=>"NSX_Edges_VPN_L2_Service", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Edit L2 VPN Client
                 * @method PUT
                 * @alias  /nsx/edges/:edge_id/vpn/l2_vpn/service(.:format)
                 * @format {:controller=>"NSX_Edges_VPN_L2_Service", :action=>"save"}
                 */
                if ( is_null( $this->_edge_id ) && is_null( $this->_obj->_edge_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _edge_id not set.",
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_edge_id ) ) {
                        $this->_edge_id = $this->_obj->_edge_id;
                    }
                }

                $resource = 'nsx/edges/' . $this->_edge_id . '/' . $this->_resource;
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
        if ($this->_mode === 'server') {
            $dataFields = array(
                'enabled' => $this->_enabled,
                'mode' => $this->_mode,
                'listener_ip' => $this->_listener_ip,
                'listener_port' => $this->_listener_port,
                'encryption_algorithm' => $this->_encryption_algorithm,
                'service_certificate' => $this->_service_certificate,
                'certificate_auth_enabled' => $this->_certificate_auth_enabled,
                'l2_vpn_peer_sites' => $this->_l2_vpn_peer_sites,
            );
        } else {
            $dataFields = array(
                'enabled' => $this->_enabled,
                'mode' => $this->_mode,
                'server_address' => $this->_server_address,
                'server_port' => $this->_server_port,
                'encryption_algorithm' => $this->_encryption_algorithm,
                'egress_optimization' => $this->_egress_optimization,
                'user_id' => $this->_user_id,
                'user_password' => $this->_user_password,
                'proxy_address' => $this->_proxy_address,
                'proxy_port' => $this->_proxy_port,
                'proxy_user_name' => $this->_proxy_user_name,
                'proxy_user_password' => $this->_proxy_user_password,
                'ca_certificate' => $this->_ca_certificate,
                'sub_interfaces' => $this->_sub_interfaces,
                'certificate_auth_enabled' => $this->_certificate_auth_enabled,
                'secure_proxy_enabled' => $this->_secure_proxy_enabled,
            );
        }

        $data = array(
            'root' => $this->_tagRoot,
            'data' => $dataFields,
        );

        $this->sendPut( ONAPP_GETRESOURCE_DEFAULT, $data );
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
            case ONAPP_ACTIVATE_LOAD:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }

}
