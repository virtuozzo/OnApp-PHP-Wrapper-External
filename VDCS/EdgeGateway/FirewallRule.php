<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Edge Gateways Firewall Rules
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
 * Firewall Rule
 *
 */
class OnApp_VDCS_EdgeGateway_FirewallRule extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = ''; //todo find out when CP is available

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'firewall_service/firewall_rules';

    /**
     * API Fields description
     *
     * @param string|float $version   OnApp API version
     * @param string       $className current class' name
     *
     * @return array
     */
    public function initFields( $version = null, $className = '' ) {
        switch( $version ) {
            case '4.0':
                $this->fields = array(
                    'id'                          => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'vdc_id'                          => array(
                        ONAPP_FIELD_MAP       => '_vdc_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'edge_gateway_id'                          => array(
                        ONAPP_FIELD_MAP       => '_edge_gateway_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),

                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method DELETE
                 * @alias    /vdcs/:vdc_id/edge_gateways/:edge_gateways_id/firewall_service/firewall_rules/:firewall_rule_id(.:format)
                 * @format    {:controller=>"edge_gateways", :action=>"destroy"}
                 */
                if( is_null( $this->_vdcs_id ) && is_null( $this->_obj->_vdcs_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _vdcs_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                else {
                    if( is_null( $this->_vdcs_id ) ) {
                        $this->_vdcs_id = $this->_obj->_vdcs_id;
                    }
                }

                if( is_null( $this->_edge_gateway_id ) && is_null( $this->_obj->_edge_gateway_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _edge_gateway_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                else {
                    if( is_null( $this->_edge_gateway_id ) ) {
                        $this->_edge_gateway_id = $this->_obj->_edge_gateway_id;
                    }
                }

                $resource = 'vdcs/' . $this->_vdcs_id . '/edge_gateways' . $this->_edge_gateway_id . '/' .  $this->_resource;
                break;
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

}