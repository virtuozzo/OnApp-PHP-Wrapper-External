<?php

/**
 * NSX Edges LoadBalancer Monitors
 *
 * @category        API wrapper
 * @package         OnApp
 * @author          Mykola Vuy
 * @copyright       © 2019 OnApp
 */

/**
 * NSX_Edges_LoadBalancer_Monitors
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_NSX_Edges_LoadBalancer_Monitors class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_NSX_Edges_LoadBalancer_Monitors extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'nsx_load_balancer_monitor';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'load_balancer/service/monitors';
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
                    'url'                       => array(
                        ONAPP_FIELD_MAP         => '_url',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'expected'                  => array(
                        ONAPP_FIELD_MAP         => '_expected',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'send_data'                 => array(
                        ONAPP_FIELD_MAP         => '_send_data',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'receive_data'              => array(
                        ONAPP_FIELD_MAP         => '_receive_data',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'extension'                 => array(
                        ONAPP_FIELD_MAP         => '_extension',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'type'                      => array(
                        ONAPP_FIELD_MAP         => '_type',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'method_data'               => array(
                        ONAPP_FIELD_MAP         => '_method_data',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'interval'                  => array(
                        ONAPP_FIELD_MAP         => '_interval',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'timeout'                   => array(
                        ONAPP_FIELD_MAP         => '_timeout',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'max_retries'               => array(
                        ONAPP_FIELD_MAP         => '_max_retries',
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

            default:
                $this->fields = $this->initFields( 6.7 );
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
                 * @alias  /nsx/edges/:edge_id/load_balancer/service/monitors(.:format)
                 * @format {:controller=>"NSX_Edges_LoadBalancer_Monitors", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Get Service Monitor Details
                 * @method GET
                 * @alias  /nsx/edges/:edge_id/load_balancer/service/monitors/:id(.:format)
                 * @format {:controller=>"NSX_Edges_LoadBalancer_Monitors", :action=>"load"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Add Service Monitor
                 * @method POST
                 * @alias  /nsx/edges/:edge_id/load_balancer/service/monitors(.:format)
                 * @format {:controller=>"NSX_Edges_LoadBalancer_Monitors", :action=>"save"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Edit Service Monitor
                 * @method PUT
                 * @alias  /nsx/edges/:edge_id/load_balancer/service/monitors/:id(.:format)
                 * @format {:controller=>"NSX_Edges_LoadBalancer_Monitors", :action=>"save"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Delete Service Monitor
                 * @method DELETE
                 * @alias  /nsx/edges/:edge_id/load_balancer/service/monitors/:id(.:format)
                 * @format {:controller=>"NSX_Edges_LoadBalancer_Monitors", :action=>"delete"}
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
        $this->_tagRoot = 'nsx_monitor';

        parent::save();
    }
}
