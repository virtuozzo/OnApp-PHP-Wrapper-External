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
 */
define( 'ONAPP_GETRESOURCE_IP_ADDRESSES', 'ip_addresses' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_NETWORKS_LIST_BY_HYPERVISOR_GROUP_ID', 'networks_list_by_hypervisor_group_id' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_IP_ASSIGN', 'ip_assign' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_IP_UNASSIGN', 'ip_unassign' );

/**
 *
 */
define( 'ONAPP_MANAGE_FAILOVER', 'manage_failover' );

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
     * @param string|float $version OnApp API version
     * @param string $className current class' name
     *
     * @return array
     */
    public function initFields( $version = null, $className = '' ) {
        switch ( $version ) {
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
                $this->fields                     = $this->initFields( '2.0' );
                $this->fields['network_group_id'] = array(
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
            case 4.0:
            case 4.1:
            case 4.2:
                $this->fields                                  = $this->initFields( 2.3 );
                $this->fields['default_nat_rule_number']       = array(
                    ONAPP_FIELD_MAP  => '_default_nat_rule_number',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['default_outside_ip_address_id'] = array(
                    ONAPP_FIELD_MAP  => '_default_outside_ip_address_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['dns_suffix']                    = array(
                    ONAPP_FIELD_MAP  => '_dns_suffix',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['dvportgroup']                   = array(
                    ONAPP_FIELD_MAP  => '_dvportgroup',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['enabled']                       = array(
                    ONAPP_FIELD_MAP  => '_enabled',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['fence_mode']                    = array(
                    ONAPP_FIELD_MAP  => '_fence_mode',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['gateway']                       = array(
                    ONAPP_FIELD_MAP  => '_gateway',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['ip_address_pool_id']            = array(
                    ONAPP_FIELD_MAP  => '_ip_address_pool_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['is_nated']                      = array(
                    ONAPP_FIELD_MAP  => '_is_nated',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['netmask']                       = array(
                    ONAPP_FIELD_MAP  => '_netmask',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['prefix_size']                   = array(
                    ONAPP_FIELD_MAP  => '_prefix_size',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['primary_dns']                   = array(
                    ONAPP_FIELD_MAP  => '_primary_dns',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['secondary_dns']                 = array(
                    ONAPP_FIELD_MAP  => '_secondary_dns',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['shared']                        = array(
                    ONAPP_FIELD_MAP  => '_shared',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['user_id']                       = array(
                    ONAPP_FIELD_MAP  => '_user_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['vapp_id']                       = array(
                    ONAPP_FIELD_MAP  => '_vapp_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['vdc_id']                        = array(
                    ONAPP_FIELD_MAP  => '_vdc_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );

                break;
            case 4.3:
                $this->fields                      = $this->initFields( 4.2 );
                $this->fields['parent_network_id'] = array(
                    ONAPP_FIELD_MAP  => '_parent_network_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                break;

            case 5.0:
                $this->fields = $this->initFields( 4.3 );
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
                $this->fields['id'][ONAPP_FIELD_REQUIRED] = false;
                $this->fields['created_at'][ONAPP_FIELD_REQUIRED] = false;
                $this->fields['updated_at'][ONAPP_FIELD_REQUIRED] = false;
                $this->fields['identifier'][ONAPP_FIELD_REQUIRED] = false;

                $this->fields['type'] = array(
                    ONAPP_FIELD_MAP  => '_type',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
                $this->fields['openstack_id'] = array(
                    ONAPP_FIELD_MAP  => '_openstack_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['vcenter_identifier'] = array(
                    ONAPP_FIELD_MAP  => '_vcenter_identifier',
                    ONAPP_FIELD_TYPE => 'string',
                );
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

            case ONAPP_GETRESOURCE_IP_ASSIGN:
                /*
                 * @method POST
                 * @alias  /settings/networks/:network_id/ip_addresses/assign(.:format)
                 */
                $resource = $this->_resource . '/' . $this->_id . '/ip_addresses/assign';
                break;

            case ONAPP_GETRESOURCE_IP_UNASSIGN:
                /*
                 * @method POST
                 * @alias  /settings/networks/:network_id/ip_addresses/assign(.:format)
                 */
                $resource = $this->_resource . '/' . $this->_id . '/ip_addresses/unassign';
                break;

            case ONAPP_MANAGE_FAILOVER:
                /*
                 * @method PATCH
                 * @alias  /settings/hypervisor_zones/:id/manage_failover(.:format)
                 */
                $resource = 'settings/hypervisor_zones/' . $this->_hypervisor_group_id . '/' . ONAPP_MANAGE_FAILOVER;
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
        if ( $hypervisor_group_id ) {
            $this->_hypervisor_group_id = $hypervisor_group_id;
        } else {
            $this->logger->error(
                'getListByHypervisorGroupId: argument _hypervisor_group_id not set.',
                __FILE__,
                __LINE__
            );
        }

        $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_NETWORKS_LIST_BY_HYPERVISOR_GROUP_ID ) );

        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

        if ( ! empty( $response['errors'] ) ) {
            $this->errors = $response['errors'];

            return false;
        }

        $result     = $this->castStringToClass( $response );
        $this->_obj = $result;

        return ( is_array( $result ) || ! $result ) ? $result : array( $result );
    }

    function assignIPAddressToUser( $ipAddresses, $userID ) {
        if ( is_null( $this->_id ) ) {
            $this->logger->error(
                'cloudConfig: argument _id not set.',
                __FILE__,
                __LINE__
            );
        }
        $ipAddressesRes = [];
        if ( is_array( $ipAddresses ) ) {
            foreach ( $ipAddresses as $ip ) {
                $ipAddressesRes[] = $ip;
            }
        } else {
            $ipAddressesRes[] = $ipAddresses;
        }

        $data = array(
            'root' => (parent::getAPIVersion() <= 5.5) ? 'tmp_holder' : 'assign',
            'data' => array(
                'ip_address' => $ipAddressesRes,
                'user_id'      => $userID,
            ),
        );

        $res = $this->sendPost( ONAPP_GETRESOURCE_IP_ASSIGN, $data );

        return $res;
    }

    function unassignIPAddress( $ipAddressIDs ) {
        if ( is_null( $this->_id ) ) {
            $this->logger->error(
                'cloudConfig: argument _id not set.',
                __FILE__,
                __LINE__
            );
        }
        $ipAddresses = [];
        if ( is_array( $ipAddressIDs ) ) {
            foreach ( $ipAddressIDs as $ip ) {
                $ipAddresses[] = $ip;
            }
        } else {
            $ipAddresses[] = $ipAddressIDs;
        }

        $data = array(
            'root' => (parent::getAPIVersion() <= 5.5) ? 'tmp_holder' : 'unassign',
            'data' => array(
                'ip_address' => $ipAddresses,
            ),
        );

        $res = $this->sendPost( ONAPP_GETRESOURCE_IP_UNASSIGN, $data );

        return $res;
    }

    function activateCheck( $action_name ) {
        if($this->version < 5.3){
            switch ( $action_name ) {
                case ONAPP_ACTIVATE_SAVE:
                case ONAPP_ACTIVATE_DELETE:
                    exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                    break;
            }
        }
    }

    public function manageFailover ( $hypervisor_group_id, $failover_status ) {
        if ( is_null( $hypervisor_group_id ) ) {
            $this->logger->error(
                'cloudConfig: argument hypervisor_group_id not set.',
                __FILE__,
                __LINE__
            );
        }
        if ( is_null( $failover_status ) ) {
            $this->logger->error(
                'cloudConfig: argument failover_status not set.',
                __FILE__,
                __LINE__
            );
        }

        $this->_hypervisor_group_id = $hypervisor_group_id;

        $data = array(
            'root' => 'hypervisor_group',
            'data' => array(
                'failover_status' => $failover_status,
            ),
        );
        $res = $this->sendPatch( ONAPP_MANAGE_FAILOVER, $data );

        return $res;
    }
}
