<?php

/**
 * NSX Edges Firewall Rules
 *
 * @category        API wrapper
 * @package         OnApp
 * @author          Mykola Vuy
 * @copyright       © 2019 OnApp
 */

/**
 * NSX_Edges_Firewall_Rules
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_NSX_Edges_Firewall_Rules class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_NSX_Edges_Firewall_Rules extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'nsx_firewall_rule';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'firewall/service/rules';
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
                    'id'                    => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'identifier'            => array(
                        ONAPP_FIELD_MAP         => '_identifier',
                        ONAPP_FIELD_TYPE        => 'string',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'enabled'               => array(
                        ONAPP_FIELD_MAP         => '_enabled',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'label'                 => array(
                        ONAPP_FIELD_MAP         => '_label',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'rule_type'             => array(
                        ONAPP_FIELD_MAP         => '_rule_type',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'source_excluded'       => array(
                        ONAPP_FIELD_MAP         => '_source_excluded',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'destination_excluded'  => array(
                        ONAPP_FIELD_MAP         => '_destination_excluded',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'action'                => array(
                        ONAPP_FIELD_MAP         => '_action',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'logging'               => array(
                        ONAPP_FIELD_MAP         => '_logging',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'sources'               => array(
                        ONAPP_FIELD_MAP         => '_sources',
                        ONAPP_FIELD_TYPE        => 'array',
                        ONAPP_FIELD_CLASS       => 'OnApp_NSX_Edges_Firewall_Fields_Sources',
                    ),
                    'destinations'          => array(
                        ONAPP_FIELD_MAP         => '_destinations',
                        ONAPP_FIELD_TYPE        => 'array',
                        ONAPP_FIELD_CLASS       => 'OnApp_NSX_Edges_Firewall_Fields_Destinations',
                    ),
                    'services'              => array(
                        ONAPP_FIELD_MAP         => '_services',
                        ONAPP_FIELD_TYPE        => 'array',
                        ONAPP_FIELD_CLASS       => 'OnApp_NSX_Edges_Firewall_Fields_Services',
                    ),
                    'firewall_service_id'   => array(
                        ONAPP_FIELD_MAP         => '_firewall_service_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'edge_id'               => array(
                        ONAPP_FIELD_MAP         => '_edge_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'created_at'            => array(
                        ONAPP_FIELD_MAP         => '_created_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'updated_at'            => array(
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
                 * @name Get list of NSX firewall rules
                 * @method GET
                 * @alias  /nsx/edges/:edge_id/firewall/service/rules(.:format)
                 * @format {:controller=>"NSX_Edges_Firewall_Rules", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Get NSX firewall rule details
                 * @method GET
                 * @alias  /nsx/edges/:edge_id/firewall/service/rules/:id(.:format)
                 * @format {:controller=>"NSX_Edges_Firewall_Rules", :action=>"load"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Add NSX Firewall Rule
                 * @method POST
                 * @alias  /nsx/edges/:edge_id/firewall/service/rules(.:format)
                 * @format {:controller=>"NSX_Edges_Firewall_Rules", :action=>"save"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Edit NSX Firewall Rule
                 * @method PUT
                 * @alias  /nsx/edges/:edge_id/firewall/service/rules/:id(.:format)
                 * @format {:controller=>"NSX_Edges_Firewall_Rules", :action=>"save"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Delete NSX firewall rule
                 * @method DELETE
                 * @alias  /nsx/edges/:edge_id/firewall/service/rules/:id(.:format)
                 * @format {:controller=>"NSX_Edges_Firewall_Rules", :action=>"delete"}
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
