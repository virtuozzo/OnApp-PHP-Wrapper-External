<?php
/**
 * Managing Edge Gateway Interfaces
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
 * Gateway Interfaces
 *
 */
class OnApp_VDCS_EdgeGateway_GatewayInterface extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'gateway_interface';

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'gateway_interfaces';

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
            case 5.0:
                $this->fields = array(
                    'created_at'  => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                    ),
                    'updated_at'  => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                    ),
                    'id' => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                    ),
                    'network_join_id' => array(
                        ONAPP_FIELD_MAP       => '_network_join_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                    ),
                    'default_firewall_rule' => array(
                        ONAPP_FIELD_MAP       => '_default_firewall_rule',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'identifier' => array(
                        ONAPP_FIELD_MAP       => '_identifier',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'label' => array(
                        ONAPP_FIELD_MAP       => '_label',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'edge_gateway_id' => array(
                        ONAPP_FIELD_MAP       => '_edge_gateway_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                    ),

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
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_LIST:
            case ONAPP_GETRESOURCE_DEFAULT:
                if ( is_null( $this->_edge_gateway_id ) && is_null( $this->_obj->_edge_gateway_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _edge_gateway_id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_edge_gateway_id ) ) {
                        $this->_edge_gateway_id = $this->_obj->_edge_gateway_id;
                    }
                }

                $resource = '/edge_gateways/' . $this->_edge_gateway_id . '/' . $this->_resource;
                break;
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    function getList( $edge_gateway_id = null, $url_args = null ) {
        if ( $edge_gateway_id ) {
            $this->_edge_gateway_id = $edge_gateway_id;
        }
        return parent::getList(null, $url_args);
    }


}