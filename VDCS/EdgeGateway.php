<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Edge Gateways
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */


/**
 * Edge Gateways
 *
 */
class OnApp_VDCS_EdgeGateway extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'edge_gateway';

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'edge_gateways';

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
            case 4.0:
                $this->fields = array(
                    'id'          => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'created_at'  => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'description' => array(
                        ONAPP_FIELD_MAP => '_description',
                    ),
                    'identifier'  => array(
                        ONAPP_FIELD_MAP       => '_identifier',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'label'       => array(
                        ONAPP_FIELD_MAP => '_label',
                    ),
                    'updated_at'  => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'vdc_id'      => array(
                        ONAPP_FIELD_MAP       => '_vdc_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                );
                break;
            case 4.1:
            case 4.2:
                $this->fields = $this->initFields( 4.0 );

                //gateway_backing_config can be: compact, full, full-4
                $this->fields['gateway_backing_config']          = array(
                    ONAPP_FIELD_MAP  => '_gateway_backing_config',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['ha_enabled']                      = array(
                    ONAPP_FIELD_MAP  => '_ha_enabled',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['status']                          = array(
                    ONAPP_FIELD_MAP  => '_status',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['use_default_route_for_dns_relay'] = array(
                    ONAPP_FIELD_MAP  => '_use_default_route_for_dns_relay',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['external_network_ids']            = array(
                    ONAPP_FIELD_MAP  => '_external_network_ids',
                    ONAPP_FIELD_TYPE => 'array',
                );
                break;
            case 4.3:
            case 5.0:
                $this->fields = $this->initFields( 4.2 );
                $this->fields['firewall_service']            = array(
                    ONAPP_FIELD_MAP  => '_firewall_service',
                    ONAPP_FIELD_TYPE => 'array',
                );
                $this->fields['gateway_ipsec_vpn_service']            = array(
                    ONAPP_FIELD_MAP  => '_gateway_ipsec_vpn_service',
                    ONAPP_FIELD_TYPE => 'array',
                );
                $this->fields['nat_service']            = array(
                    ONAPP_FIELD_MAP  => '_nat_service',
                    ONAPP_FIELD_TYPE => 'array',
                );
                break;
            case 5.1:
                $this->fields = $this->initFields( 5.0 );
                break;
            case 5.2:
                $this->fields = $this->initFields( 5.1 );
                break;
            case 5.3:
                $this->fields = $this->initFields( 5.2 );
                break;
            case 5.4:
                $this->fields = $this->initFields( 5.3 );
                $this->fields['advanced_enabled'] = array(
                    ONAPP_FIELD_MAP  => '_advanced_enabled',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                break;

            case 6.1:
                $this->fields = $this->initFields( 6.0 );
                $this->fields['configure_gateway']      = array(
                    ONAPP_FIELD_MAP  => '_configure_gateway',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['default_gateway']        = array(
                    ONAPP_FIELD_MAP  => '_default_gateway',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['enable_rate_limits']     = array(
                    ONAPP_FIELD_MAP  => '_enable_rate_limits',
                    ONAPP_FIELD_TYPE => 'boolean',
                );

                $this->fields['incoming_rate_limit']    = array(
                    ONAPP_FIELD_MAP  => '_incoming_rate_limit',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['outgoing_rate_limit']    = array(
                    ONAPP_FIELD_MAP  => '_outgoing_rate_limit',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['participate']            = array(
                    ONAPP_FIELD_MAP  => '_participate',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['auto_ip_assignment']     = array(
                    ONAPP_FIELD_MAP  => '_auto_ip_assignment',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['ip_address']             = array(
                    ONAPP_FIELD_MAP  => '_ip_address',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $fields       = array(
                    'external_network_ids',
                );
                $this->unsetFields( $fields );
                break;

            case 6.2:
                $this->fields = $this->initFields( 6.1 );
                break;

            case 6.3:
                $this->fields = $this->initFields( 6.2 );
                break;

            case 6.4:
                $this->fields = $this->initFields( 6.3 );
                $this->fields['nsx_edge'] = array(
                    ONAPP_FIELD_MAP  => '_nsx_edge',
                    ONAPP_FIELD_TYPE => '_array',
                );
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

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

}