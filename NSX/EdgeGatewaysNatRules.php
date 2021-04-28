<?php

/**
 * NSX Edge Gateways NSX-T Nat Rule
 *
 * @category        API wrapper
 * @package         OnApp
 * @author          Mykola Vuy
 * @copyright       © 2021 OnApp
 */

/**
 * NSX_EdgeGatewaystNatRules
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_NSX_EdgeGatewaystNatRules class uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */

class OnApp_NSX_EdgeGatewaysNatRules extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'vcloud_nsxt_nat_rule';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'nat_rules';
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
            case 6.5:
                $this->fields = array(
                    'id'  => array(
                        ONAPP_FIELD_MAP             => '_id',
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
                    'rule_type'                     => array(
                        ONAPP_FIELD_MAP         => '_rule_type',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'vcloud_nsxt_edge_gateway_id'   => array(
                        ONAPP_FIELD_MAP         => '_vcloud_nsxt_edge_gateway_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'port'                          => array(
                        ONAPP_FIELD_MAP         => '_port',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'logging'                       => array(
                        ONAPP_FIELD_MAP         => '_logging',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'system'                        => array(
                        ONAPP_FIELD_MAP         => '_system',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'version'                       => array(
                        ONAPP_FIELD_MAP         => '_version',
                        ONAPP_FIELD_TYPE        => 'integer',
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
                    'nsxt_edge_gateway_id'          => array(
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
                 * @name Get List of NSX-T NAT Rules
                 * @method GET
                 *
                 * @alias  /nsxt_edge_gateways/:nsxt_edge_gateway_id/nat_rules(.:format)
                 * @format {:controller=>"NSX_EdgeGatewaystNatRules", :action=>"getList"}
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
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}
