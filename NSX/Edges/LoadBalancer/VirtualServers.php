<?php

/**
 * NSX Edges LoadBalancer VirtualServers
 *
 * @category        API wrapper
 * @package         OnApp
 * @author          Mykola Vuy
 * @copyright       © 2019 OnApp
 */

/**
 * NSX_Edges_LoadBalancer_VirtualServers
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_NSX_Edges_LoadBalancer_VirtualServers class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_NSX_Edges_LoadBalancer_VirtualServers extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'nsx_load_balancer_virtual_server';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'load_balancer/service/virtual_servers';
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
                    'identifier'                => array(
                        ONAPP_FIELD_MAP         => '_identifier',
                        ONAPP_FIELD_TYPE        => 'string',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'label'                     => array(
                        ONAPP_FIELD_MAP         => '_label',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'description'               => array(
                        ONAPP_FIELD_MAP         => '_description',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'ip_address'                => array(
                        ONAPP_FIELD_MAP         => '_ip_address',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'port'                      => array(
                        ONAPP_FIELD_MAP         => '_port',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'protocol'                  => array(
                        ONAPP_FIELD_MAP         => '_protocol',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'connection_limit'          => array(
                        ONAPP_FIELD_MAP         => '_connection_limit',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'connection_rate_limit'     => array(
                        ONAPP_FIELD_MAP         => '_connection_rate_limit',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'enabled'                   => array(
                        ONAPP_FIELD_MAP         => '_enabled',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'acceleration'              => array(
                        ONAPP_FIELD_MAP         => '_acceleration',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'default_pool_id'           => array(
                        ONAPP_FIELD_MAP         => '_default_pool_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'load_balancer_service_id'  => array(
                        ONAPP_FIELD_MAP         => '_load_balancer_service_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
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
                    'application_profile_id'    => array(
                        ONAPP_FIELD_MAP         => '_application_profile_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'application_profile'       => array(
                        ONAPP_FIELD_MAP         => '_application_profile',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'default_pool'              => array(
                        ONAPP_FIELD_MAP         => '_default_pool',
                        ONAPP_FIELD_TYPE        => 'string',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'application_rules'         => array(
                        ONAPP_FIELD_MAP         => '_application_rules',
                        ONAPP_FIELD_TYPE        => '_array',
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
                 * @name Get List of Application Profiles
                 * @method GET
                 * @alias  /nsx/edges/:edge_id/load_balancer/service/virtual_servers(.:format)
                 * @format {:controller=>"NSX_Edges_LoadBalancer_VirtualServers", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Get Application Profile Details
                 * @method GET
                 * @alias  /nsx/edges/:edge_id/load_balancer/service/virtual_servers/:id(.:format)
                 * @format {:controller=>"NSX_Edges_LoadBalancer_VirtualServers", :action=>"load"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Add Application Profile
                 * @method POST
                 * @alias  /nsx/edges/:edge_id/load_balancer/service/virtual_servers(.:format)
                 * @format {:controller=>"NSX_Edges_LoadBalancer_VirtualServers", :action=>"save"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Edit Application Profile
                 * @method PUT
                 * @alias  /nsx/edges/:edge_id/load_balancer/service/virtual_servers/:id(.:format)
                 * @format {:controller=>"NSX_Edges_LoadBalancer_VirtualServers", :action=>"save"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Delete Application Profile
                 * @method DELETE
                 * @alias  /nsx/edges/:edge_id/load_balancer/service/virtual_servers/:id(.:format)
                 * @format {:controller=>"NSX_Edges_LoadBalancer_VirtualServers", :action=>"delete"}
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
        $this->_tagRoot = 'nsx_virtual_server';

        parent::save();
    }
}
