<?php

/**
 * NSX Edges VPN IPSec Sites
 *
 * @category        API wrapper
 * @package         OnApp
 * @author          Mykola Vuy
 * @copyright       © 2019 OnApp
 */

/**
 * NSX_Edges_VPN_IPSec_Sites
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_NSX_Edges_VPN_IPSec_Sites class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_NSX_Edges_VPN_IPSec_Sites extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'nsx_ipsec_site';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'vpn/ipsec/service/sites';
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
                    'label'                         => array(
                        ONAPP_FIELD_MAP         => '_label',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'identifier'                    => array(
                        ONAPP_FIELD_MAP         => '_identifier',
                        ONAPP_FIELD_TYPE        => 'string',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'ipsec_service_id'              => array(
                        ONAPP_FIELD_MAP         => '_ipsec_service_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'local_id'                      => array(
                        ONAPP_FIELD_MAP         => '_local_id',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'local_ip'                      => array(
                        ONAPP_FIELD_MAP         => '_local_ip',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'peer_id'                       => array(
                        ONAPP_FIELD_MAP         => '_peer_id',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'peer_ip'                       => array(
                        ONAPP_FIELD_MAP         => '_peer_ip',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'ipsec_session_type'            => array(
                        ONAPP_FIELD_MAP         => '_ipsec_session_type',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'encryption_algorithm'          => array(
                        ONAPP_FIELD_MAP         => '_encryption_algorithm',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'enable_pfs'                    => array(
                        ONAPP_FIELD_MAP         => '_enable_pfs',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'dh_group'                      => array(
                        ONAPP_FIELD_MAP         => '_dh_group',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'tunnel_interface_ip_address'   => array(
                        ONAPP_FIELD_MAP         => '_tunnel_interface_ip_address',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'tunnel_interface_mtu'          => array(
                        ONAPP_FIELD_MAP         => '_tunnel_interface_mtu',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'local_subnets'                 => array(
                        ONAPP_FIELD_MAP         => '_local_subnets',
                        ONAPP_FIELD_TYPE        => '_array',
                    ),
                    'peer_subnets'                  => array(
                        ONAPP_FIELD_MAP         => '_peer_subnets',
                        ONAPP_FIELD_TYPE        => '_array',
                    ),
                    'psk'                           => array(
                        ONAPP_FIELD_MAP         => '_psk',
                        ONAPP_FIELD_TYPE        => 'string',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'authentication_mode'           => array(
                        ONAPP_FIELD_MAP         => '_authentication_mode',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'extension'                     => array(
                        ONAPP_FIELD_MAP         => '_extension',
                        ONAPP_FIELD_TYPE        => 'string',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'digest_algorithm'              => array(
                        ONAPP_FIELD_MAP         => '_digest_algorithm',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'responder_only'                => array(
                        ONAPP_FIELD_MAP         => '_responder_only',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'compliance_suite'              => array(
                        ONAPP_FIELD_MAP         => '_compliance_suite',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'ike_option'                    => array(
                        ONAPP_FIELD_MAP         => '_ike_option',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'certificate_id'                => array(
                        ONAPP_FIELD_MAP         => '_certificate_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'certificate'                   => array(
                        ONAPP_FIELD_MAP         => '_certificate',
                        ONAPP_FIELD_TYPE        => 'string',
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
                 * @name Get List of IPSec VPN Sites
                 * @method GET
                 * @alias  /nsx/edges/:edge_id/vpn/ipsec/service/sites(.:format)
                 * @format {:controller=>"NSX_Edges_VPN_IPSec_Sites", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Get IPSec VPN Site Details
                 * @method GET
                 * @alias  /nsx/edges/:edge_id/vpn/ipsec/service/sites/:id(.:format)
                 * @format {:controller=>"NSX_Edges_VPN_IPSec_Sites", :action=>"load"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Add IPSec VPN Site
                 * @method POST
                 * @alias  /nsx/edges/:edge_id/vpn/ipsec/service/sites(.:format)
                 * @format {:controller=>"NSX_Edges_VPN_IPSec_Sites", :action=>"save"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Edit IPSec VPN Site
                 * @method PUT
                 * @alias  /nsx/edges/:edge_id/vpn/ipsec/service/sites/:id(.:format)
                 * @format {:controller=>"NSX_Edges_VPN_IPSec_Sites", :action=>"save"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Delete IPSec VPN Site
                 * @method DELETE
                 * @alias  /nsx/edges/:edge_id/vpn/ipsec/service/sites/:id(.:format)
                 * @format {:controller=>"NSX_Edges_VPN_IPSec_Sites", :action=>"delete"}
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
