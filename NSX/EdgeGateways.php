<?php

/**
 * NSX Edge Gateways NSX-T Firewall Rule
 *
 * @category        API wrapper
 * @package         OnApp
 * @author          Mykola Vuy
 * @copyright       © 2021 OnApp
 */

define('ONAPP_CREATE_NSXT_EDGE_GATEWAY', 'wizard/summary');

/**
 * NSX_EdgeGateways
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_NSX_EdgeGateways class uses the following basic methods:
 * {@link edit}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */

class OnApp_NSX_EdgeGateways extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'vcloud_nsxt_edge_gateway';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'nsxt_edge_gateways';
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
                    'status'                        => array(
                        ONAPP_FIELD_MAP         => '_status',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'description'                   => array(
                        ONAPP_FIELD_MAP         => '_description',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'distributed_routing_enabled'   => array(
                        ONAPP_FIELD_MAP         => '_distributed_routing_enabled',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'vdc_id'                        => array(
                        ONAPP_FIELD_MAP         => '_vdc_id',
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
                    'firewalls_locked'              => array(
                        ONAPP_FIELD_MAP         => '_firewalls_locked',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'organization_id'               => array(
                        ONAPP_FIELD_MAP         => '_organization_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'external_network_id'           => array(
                        ONAPP_FIELD_MAP         => '_external_network_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'primary_ip'                    => array(
                        ONAPP_FIELD_MAP         => '_primary_ip',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'ip_ranges'                     => array(
                        ONAPP_FIELD_MAP         => '_ip_ranges',
                        ONAPP_FIELD_TYPE        => '_array',
                    ),
                );
                break;

            case 6.6:
                $this->fields = $this->initFields( 6.5 );
                $this->fields['ip_settings'] = array(
                    ONAPP_FIELD_MAP  => '_ip_settings',
                    ONAPP_FIELD_TYPE => '_array',
                );
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
                 * @name Get List of NSX-T Edge Gateways
                 * @method GET
                 * @alias  /nsxt_edge_gateways(.:format)
                 * @format {:controller=>"NSX_EdgeGateways", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Get NSX-T Edge Gateway Details
                 * @method GET
                 * @alias  /nsxt_edge_gateways/:id(.:format)
                 * @format {:controller=>"NSX_EdgeGateways", :action=>"load"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Edit NSX-T Edge Gateway
                 * @method PATCH
                 * @alias  /nsxt_edge_gateways/:id(.:format)
                 * @format {:controller=>"NSX_EdgeGateways", :action=>"save"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Delete NSX-T Edge Gateway
                 * @method DELETE
                 * @alias  /nsxt_edge_gateways/:id(.:format)
                 * @format {:controller=>"NSX_EdgeGateways", :action=>"delete"}
                 */

                $resource = $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            case ONAPP_CREATE_NSXT_EDGE_GATEWAY:
                /**
                 * ROUTE :
                 *
                 * @name Create NSX-T Edge Gateway
                 * @method PUT
                 * @alias  /nsxt_edge_gateways/wizard/summary(.:format)
                 * @format {:controller=>"NSX_EdgeGateways", :action=>"save"}
                 */

                $resource = $this->_resource . '/' . ONAPP_CREATE_NSXT_EDGE_GATEWAY;
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
        $data = $this->getSerializedDataToSend();

        if (is_null($this->_id)) {
            $this->sendPut( ONAPP_CREATE_NSXT_EDGE_GATEWAY, $data);
        } else {
            $this->sendPatch( ONAPP_GETRESOURCE_EDIT, $data);
        }
    }
}
