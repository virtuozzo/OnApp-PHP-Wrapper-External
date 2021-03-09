<?php

/**
 * NSX Edges VPN L2 PeerSites
 *
 * @category        API wrapper
 * @package         OnApp
 * @author          Mykola Vuy
 * @copyright       © 2019 OnApp
 */

/**
 * NSX_Edges_VPN_L2_PeerSites
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_NSX_Edges_VPN_L2_PeerSites class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_NSX_Edges_VPN_L2_PeerSites extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'nsx_l2_vpn_peer_site';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'vpn/l2_vpn/service/peer_sites';
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
                    'label'                         => array(
                        ONAPP_FIELD_MAP         => '_label',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'identifier'                    => array(
                        ONAPP_FIELD_MAP         => '_identifier',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'description'                   => array(
                        ONAPP_FIELD_MAP         => '_description',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'egress_optimization'           => array(
                        ONAPP_FIELD_MAP         => '_egress_optimization',
                        ONAPP_FIELD_TYPE        => '_array',
                    ),
                    'enabled'                       => array(
                        ONAPP_FIELD_MAP         => '_enabled',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'user_id'                       => array(
                        ONAPP_FIELD_MAP         => '_user_id',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'user_password'                 => array(
                        ONAPP_FIELD_MAP         => '_user_password',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'routed_remote_subnets_enabled' => array(
                        ONAPP_FIELD_MAP         => '_routed_remote_subnets_enabled',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'l2_vpn_service_id'             => array(
                        ONAPP_FIELD_MAP         => '_l2_vpn_service_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'ca_certificate_id'             => array(
                        ONAPP_FIELD_MAP         => '_ca_certificate_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
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
                    'sub_interfaces'                => array(
                        ONAPP_FIELD_MAP         => '_sub_interfaces',
                        ONAPP_FIELD_TYPE        => '_array',
                    ),
                );
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
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name Get List of L2 VPN Peer Sites
                 * @method GET
                 * @alias  /nsx/edges/:edge_id/vpn/l2_vpn/service/peer_sites(.:format)
                 * @format {:controller=>"NSX_Edges_VPN_L2_PeerSites", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Get NSX L2 VPN Peer Site Details
                 * @method GET
                 * @alias  /nsx/edges/:edge_id/vpn/l2_vpn/service/peer_sites/:id(.:format)
                 * @format {:controller=>"NSX_Edges_VPN_L2_PeerSites", :action=>"load"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Add NSX L2 VPN Peer Site
                 * @method POST
                 * @alias  /nsx/edges/:edge_id/vpn/l2_vpn/service/peer_sites(.:format)
                 * @format {:controller=>"NSX_Edges_VPN_L2_PeerSites", :action=>"save"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Edit NSX L2 VPN Peer Site
                 * @method PUT
                 * @alias  /nsx/edges/:edge_id/vpn/l2_vpn/service/peer_sites/:id(.:format)
                 * @format {:controller=>"NSX_Edges_VPN_L2_PeerSites", :action=>"save"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Delete NSX L2 VPN Peer Site
                 * @method DELETE
                 * @alias  /nsx/edges/:edge_id/vpn/l2_vpn/service/peer_sites/:peer_site_id(.:format)
                 * @format {:controller=>"NSX_Edges_VPN_L2_PeerSites", :action=>"delete"}
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
}
