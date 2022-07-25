<?php

/**
 * NSX Edges LoadBalancer ApplicationRules
 *
 * @category        API wrapper
 * @package         OnApp
 * @author          Mykola Vuy
 * @copyright       © 2019 OnApp
 */

/**
 * NSX_Edges_LoadBalancer_ApplicationRules
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_NSX_Edges_LoadBalancer_ApplicationRules class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_NSX_Edges_LoadBalancer_ApplicationRules extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'nsx_load_balancer_application_rule';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'load_balancer/service/application_rules';
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
                    'script'                    => array(
                        ONAPP_FIELD_MAP         => '_script',
                        ONAPP_FIELD_TYPE        => 'string',
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

            case 6.6:
                $this->fields = $this->initFields( 6.5 );
                break;

            case 6.7:
                $this->fields = $this->initFields( 6.6 );
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
                 * @name Get List of Service Monitors
                 * @method GET
                 * @alias  /nsx/edges/:edge_id/load_balancer/service/application_rules(.:format)
                 * @format {:controller=>"NSX_Edges_LoadBalancer_ApplicationRules", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Get Service Monitor Details
                 * @method GET
                 * @alias  /nsx/edges/:edge_id/load_balancer/service/application_rules/:id(.:format)
                 * @format {:controller=>"NSX_Edges_LoadBalancer_ApplicationRules", :action=>"load"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Add Service Monitor
                 * @method POST
                 * @alias  /nsx/edges/:edge_id/load_balancer/service/application_rules(.:format)
                 * @format {:controller=>"NSX_Edges_LoadBalancer_ApplicationRules", :action=>"save"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Edit Service Monitor
                 * @method PUT
                 * @alias  /nsx/edges/:edge_id/load_balancer/service/application_rules/:id(.:format)
                 * @format {:controller=>"NSX_Edges_LoadBalancer_ApplicationRules", :action=>"save"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Delete Service Monitor
                 * @method DELETE
                 * @alias  /nsx/edges/:edge_id/load_balancer/service/application_rules/:id(.:format)
                 * @format {:controller=>"NSX_Edges_LoadBalancer_ApplicationRules", :action=>"delete"}
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
        $this->_tagRoot = 'nsx_application_rule';

        parent::save();
    }
}
