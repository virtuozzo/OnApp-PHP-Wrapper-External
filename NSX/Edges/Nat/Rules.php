<?php

/**
 * NSX Edges Nat Rules
 *
 * @category        API wrapper
 * @package         OnApp
 * @author          Mykola Vuy
 * @copyright       © 2019 OnApp
 */

/**
 * NSX_Edges_Nat_Rules
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_NSX_Edges_Nat_Rules class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_NSX_Edges_Nat_Rules extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'nsx_nat_rule';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'nat/service/rules';
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
                    'action'                => array(
                        ONAPP_FIELD_MAP         => '_action',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'enabled'               => array(
                        ONAPP_FIELD_MAP         => '_enabled',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'interface'             => array(
                        ONAPP_FIELD_MAP         => '_interface',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'interface_id'          => array(
                        ONAPP_FIELD_MAP         => '_interface_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'identifier'            => array(
                        ONAPP_FIELD_MAP         => '_identifier',
                        ONAPP_FIELD_TYPE        => 'string',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'logging'               => array(
                        ONAPP_FIELD_MAP         => '_logging',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'nat_service_id'        => array(
                        ONAPP_FIELD_MAP         => '_nat_service_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'original_ip'           => array(
                        ONAPP_FIELD_MAP         => '_original_ip',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'rule_type'             => array(
                        ONAPP_FIELD_MAP         => '_rule_type',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'translated_ip'         => array(
                        ONAPP_FIELD_MAP         => '_translated_ip',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'original_port'         => array(
                        ONAPP_FIELD_MAP         => '_original_port',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'protocol'              => array(
                        ONAPP_FIELD_MAP         => '_protocol',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'translated_port'       => array(
                        ONAPP_FIELD_MAP         => '_translated_port',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'icmp_type'             => array(
                        ONAPP_FIELD_MAP         => '_icmp_type',
                        ONAPP_FIELD_TYPE        => 'string',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'description'           => array(
                        ONAPP_FIELD_MAP         => '_description',
                        ONAPP_FIELD_TYPE        => 'string',
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
                    'interface_type'        => array(
                        ONAPP_FIELD_MAP         => '_interface_type',
                        ONAPP_FIELD_TYPE        => 'string',
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
                 * @name Get List of NAT Rules
                 * @method GET
                 * @alias  /nsx/edges/:edge_id/nat/service/rules(.:format)
                 * @format {:controller=>"NSX_Edges_Nat_Rules", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Get NAT Rule Details
                 * @method GET
                 * @alias  /nsx/edges/:edge_id/nat/service/rules/:id(.:format)
                 * @format {:controller=>"NSX_Edges_Nat_Rules", :action=>"load"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Add NAT Rule
                 * @method POST
                 * @alias  /nsx/edges/:edge_id/nat/service/rules(.:format)
                 * @format {:controller=>"NSX_Edges_Nat_Rules", :action=>"save"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Edit NAT Rule
                 * @method PUT
                 * @alias  /nsx/edges/:edge_id/nat/service/rules/:id(.:format)
                 * @format {:controller=>"NSX_Edges_Nat_Rules", :action=>"save"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Delete NAT Rule
                 * @method DELETE
                 * @alias  /nsx/edges/:edge_id/nat/service/rules/:id(.:format)
                 * @format {:controller=>"NSX_Edges_Nat_Rules", :action=>"delete"}
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
