<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Configuring Network
 *
 * With OnApp you can create complex networks between virtual machines residing on a
 * single host or across multiple installations of OnApp for production deployments or
 * development and testing purposes. Configure each virtual machine with one or more
 * virtual NICs, each with its own IP and MAC address, to make virtual machines act like
 * physical machines. We take care that each customer has their own VLAN. This provides
 * customers with their own Virtual network which provides network isolation and thus
 * security. Nobody but you will see your traffic, even if they are located on the same physical
 * server. There is a possibility to modify network configurations without changing actual
 * cabling and switch setups.
 *
 * Each virtual server has at least one network interface card, so network traffic can flow into
 * and out of your server. All servers are given static IP addresses. You don't need to worry
 * about that address changing. You can tie your domain names to these IP addresses.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_IP_ADDRESSES', 'ip_addresses' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_NETWORKS_LIST_BY_HYPERVISOR_GROUP_ID', 'networks_list_by_hypervisor_group_id' );

/**
 * Configuring Network
 *
 * This class represents the Networks added to your system.
 *
 * The OnApp_Network class uses the following basic methods:
 * {@link load} and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Network extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'network';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/networks';

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
            case '2.0':
                $this->fields = array(
                    'id'         => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_REQUIRED  => true,
                    ),
                    'created_at' => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_REQUIRED  => true,
                    ),
                    'identifier' => array(
                        ONAPP_FIELD_MAP       => '_identifier',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_REQUIRED  => true,
                    ),
                    'label'      => array(
                        ONAPP_FIELD_MAP       => '_label',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_REQUIRED  => true,
                    ),
                    'updated_at' => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_REQUIRED  => true,
                    ),
                    'vlan'       => array(
                        ONAPP_FIELD_MAP       => '_vlan',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_REQUIRED  => true,
                    ),
                );
                break;

            case '2.1':
                $this->fields                       = $this->initFields( '2.0' );
                $this->fields[ 'network_group_id' ] = array(
                    ONAPP_FIELD_MAP      => '_network_group_id',
                    ONAPP_FIELD_TYPE     => 'integer',
                    ONAPP_FIELD_REQUIRED => true,
                );
                break;

            case 2.2:
            case 2.3:
                $this->fields = $this->initFields( 2.1 );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
                $this->fields = $this->initFields( 2.3 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch( $action ) {
            case ONAPP_GETRESOURCE_NETWORKS_LIST_BY_HYPERVISOR_GROUP_ID:
                /**
                 * ROUTE :
                 *
                 * @name hypervisor_group_networks
                 * @method GET
                 * @alias  /settings/hypervisor_zones/:hypervisor_group_id/networks(.:format)
                 * @format {:controller=>"networks", :action=>"index"}
                 */
                $resource = 'settings/hypervisor_zones/' . $this->_hypervisor_group_id . '/networks';
                break;

            case ONAPP_GETRESOURCE_IP_ADDRESSES:
                /**
                 * ROUTE :
                 *
                 * @name network_ip_addresses
                 * @method GET
                 * @alias  /settings/networks/:network_id/ip_addresses(.:format)
                 * @format {:controller=>"ip_addresses", :action=>"index"}
                 */
                $resource = $this->_resource . '/' . $this->_id . '/ip_address';
                break;

            default:
                /**
                 * ROUTE :
                 *
                 * @name networks
                 * @method GET
                 * @alias  /settings/networks(.:format)
                 * @format {:controller=>"networks", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name network
                 * @method GET
                 * @alias   /settings/networks/:id(.:format)
                 * @format  {:controller=>"networks", :action=>"show"}
                 */
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    /**
     * Gets list of networks by hypervisor group id
     *
     * @param integer|null $hypervisor_group_id hypervisor group id
     *
     * @return bool|mixed
     */
    function getListByHypervisorGroupId( $hypervisor_group_id = null ) {
        if( $hypervisor_group_id ) {
            $this->_hypervisor_group_id = $hypervisor_group_id;
        }
        else {
            $this->logger->error(
                'getListByHypervisorGroupId: argument _hypervisor_group_id not set.',
                __FILE__,
                __LINE__
            );
        }

        $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_NETWORKS_LIST_BY_HYPERVISOR_GROUP_ID ) );

        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

        if( ! empty( $response[ 'errors' ] ) ) {
            $this->errors = $response[ 'errors' ];

            return false;
        }

        $result     = $this->castStringToClass( $response );
        $this->_obj = $result;

        return ( is_array( $result ) || ! $result ) ? $result : array( $result );
    }

    function activate( $action_name ) {
        switch( $action_name ) {
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}
