<?php
/**
 * Managing VirtualRouters IpNets
 * 
 * much they will be charged per unit.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Mykola Vuy
 * @copyright   © 2019 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

define('ONAPP_VIRTUAL_ROUTERS_ATTACHABLE_IP_NETS', 'attachable_ip_nets');

define('ONAPP_VIRTUAL_ROUTERS_ASSIGN_IP_NET', 'assign_ip_net');

define('ONAPP_VIRTUAL_ROUTERS_UNASSIGN_IP_NET', 'unassign_ip_net');

/**
 * Managing VirtualRouters IpNets
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_VirtualRouters_IpNets extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'ip_net';

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'ip_nets';

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
            case 6.1:
                $this->fields = array(
                    'id'                        => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'network_id'                => array(
                        ONAPP_FIELD_MAP         => '_network_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'network_mask'              => array(
                        ONAPP_FIELD_MAP         => '_network_mask',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'ipv4'                      => array(
                        ONAPP_FIELD_MAP         => '_ipv4',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'label'                     => array(
                        ONAPP_FIELD_MAP         => '_label',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'gateway_outside_ip_net'    => array(
                        ONAPP_FIELD_MAP         => '_gateway_outside_ip_net',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'network_address'           => array(
                        ONAPP_FIELD_MAP         => '_network_address',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'default_gateway'           => array(
                        ONAPP_FIELD_MAP         => '_default_gateway',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                );

                break;

            case 6.2:
                $this->fields = $this->initFields( 6.1 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        if ( is_null( $this->_virtual_router_id ) && is_null( $this->_obj->_virtual_router_id ) ) {
            $this->logger->error(
                'getResource( ' . $action . ' ): argument virtual_router_id not set.',
                __FILE__,
                __LINE__
            );
        } else {
            if ( is_null( $this->_virtual_router_id ) ) {
                $this->_virtual_router_id = $this->_obj->_virtual_router_id;
            }
        }

        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name VirtualRouters IpNets
                 * @method GET
                 * @alias  /virtual_routers/:virtual_router_id/ip_nets(.:format)
                 * @format {:controller=>"VirtualRouters_IpNets", :action=>"index"}
                 */

                $resource = 'virtual_routers/' . $this->_virtual_router_id . '/' . $this->_resource;
                break;

            case ONAPP_VIRTUAL_ROUTERS_ATTACHABLE_IP_NETS:
                /**
                 * ROUTE :
                 *
                 * @name VirtualRouters IpNets
                 * @method GET
                 * @alias  /virtual_routers/:virtual_router_id/attachable_ip_nets(.:format)
                 * @format {:controller=>"VirtualRouters_IpNets", :action=>"attachableIpNets"}
                 */

            $resource = 'virtual_routers/' . $this->_virtual_router_id . '/' . ONAPP_VIRTUAL_ROUTERS_ATTACHABLE_IP_NETS;
                break;

            case ONAPP_VIRTUAL_ROUTERS_ASSIGN_IP_NET:
                /**
                 * ROUTE :
                 *
                 * @name VirtualRouters IpNets
                 * @method POST
                 * @alias  /virtual_routers/:virtual_router_id/assign_ip_net(.:format)
                 * @format {:controller=>"VirtualRouters_IpNets", :action=>"assignIpNet"}
                 */

            $resource = 'virtual_routers/' . $this->_virtual_router_id . '/' . ONAPP_VIRTUAL_ROUTERS_ASSIGN_IP_NET;
                break;

            case ONAPP_VIRTUAL_ROUTERS_UNASSIGN_IP_NET:
                /**
                 * ROUTE :
                 *
                 * @name VirtualRouters IpNets
                 * @method DELETE
                 * @alias  /virtual_routers/:virtual_router_id/unassign_ip_net(.:format)
                 * @format {:controller=>"VirtualRouters_IpNets", :action=>"unassignIpNet"}
                 */

                $resource = 'virtual_routers/' . $this->_virtual_router_id . '/' . ONAPP_VIRTUAL_ROUTERS_UNASSIGN_IP_NET;
                break;

            default:
                $resource     = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    public function attachableIpNets()
    {
        return $this->sendGet(ONAPP_VIRTUAL_ROUTERS_ATTACHABLE_IP_NETS);
    }

    public function assignIpNet($ipNetId)
    {
        $data = array(
            'ip_net_id' => $ipNetId,
        );

        if ( ! is_null( $data ) && is_array( $data ) ) {
            $data = json_encode($data);
            $this->logger->debug( 'Additional parameters: ' . $data );
        }

        $this->setAPIResource( $this->getResource( ONAPP_VIRTUAL_ROUTERS_ASSIGN_IP_NET ) );
        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_POST, $data );

        $result     = $this->_castResponseToClass( $response );
        $this->_obj = $result;
    }

    public function unassignIpNet($ipNetId)
    {
        $data = array(
            'ip_net_id' => $ipNetId,
        );

        if ( ! is_null( $data ) && is_array( $data ) ) {
            $data = json_encode($data);
            $this->logger->debug( 'Additional parameters: ' . $data );
        }

        $this->setAPIResource( $this->getResource( ONAPP_VIRTUAL_ROUTERS_UNASSIGN_IP_NET ) );
        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_DELETE, $data );

        $result     = $this->_castResponseToClass( $response );
        $this->_obj = $result;
    }

}