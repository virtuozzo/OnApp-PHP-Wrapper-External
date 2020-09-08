<?php

/**
 * NSX Edges VPN IPSec Service
 *
 * @category        API wrapper
 * @package         OnApp
 * @author          Mykola Vuy
 * @copyright       © 2019 OnApp
 */

/**
 * NSX_Edges_VPN_IPSec_Service
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_NSX_Edges_VPN_IPSec_Service class uses the following basic methods:
 * {@link getList} and {@link save}
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_NSX_Edges_VPN_IPSec_Service extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'nsx_ipsec_service';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'vpn/ipsec/service';
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
                    'id'                        => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'enabled'                   => array(
                        ONAPP_FIELD_MAP         => '_enabled',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'logging'                   => array(
                        ONAPP_FIELD_MAP         => '_logging',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'edge_id'                   => array(
                        ONAPP_FIELD_MAP         => '_edge_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'service_certificate_id'    => array(
                        ONAPP_FIELD_MAP         => '_service_certificate_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'psk'                       => array(
                        ONAPP_FIELD_MAP         => '_psk',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'log_level'                 => array(
                        ONAPP_FIELD_MAP         => '_log_level',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'created_at'                => array(
                        ONAPP_FIELD_MAP         => '_created_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'updated_at'                => array(
                        ONAPP_FIELD_MAP         => '_updated_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'locked'                    => array(
                        ONAPP_FIELD_MAP         => '_locked',
                        ONAPP_FIELD_TYPE        => 'boolean',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'service_certificate'       => array(
                        ONAPP_FIELD_MAP         => '_service_certificate',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'certificate_auth_enabled'  => array(
                        ONAPP_FIELD_MAP         => '_certificate_auth_enabled',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'ipsec_sites'               => array(
                        ONAPP_FIELD_MAP         => '_ipsec_sites',
                        ONAPP_FIELD_TYPE        => 'array',
                        ONAPP_FIELD_CLASS       => 'OnApp_NSX_Edges_VPN_IPSec_Sites',
                    ),
                );
                break;

            case 6.3:
                $this->fields = $this->initFields( 6.2 );
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
                 * @name Get IPSec VPN Service Details
                 * @method GET
                 * @alias  /nsx/edges/:edge_id/vpn/ipsec/service(.:format)
                 * @format {:controller=>"NSX_Edges_VPN_IPSec_Service", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Edit IPSec VPN Service
                 * @method PUT
                 * @alias  /nsx/edges/:edge_id/vpn/ipsec/service(.:format)
                 * @format {:controller=>"NSX_Edges_VPN_IPSec_Service", :action=>"save"}
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
        $data = array(
            'root' => $this->_tagRoot,
            'data' => array(
                'enabled' => $this->_enabled,
                'logging' => $this->_logging,
                'log_level' => $this->_log_level,
                'psk' => $this->_psk,
                'service_certificate' => $this->_service_certificate,
                'certificate_auth_enabled' => $this->_certificate_auth_enabled,
                'ipsec_sites' => $this->_ipsec_sites,
            )
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
