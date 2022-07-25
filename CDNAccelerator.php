<?php

/**
 * Managing CDN Accelerator
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * To reboot the accelerator
 */
define( 'ONAPP_ACCELERATOR_REBOOT', 'reboot' );

/**
 * To startup the accelerator
 */
define( 'ONAPP_ACCELERATOR_STARTUP', 'startup' );

/**
 * To terminate the edge server gracefully
 */
define( 'ONAPP_ACCELERATOR_SHUTDOWN', 'shutdown' );

/**
 * To terminate the edge server gracefully
 */
define( 'ONAPP_ACCELERATOR_SUSPEND', 'suspend' );

/**
 * To rebuild (or build manually) the accelerator
 */
define( 'ONAPP_ACCELERATOR_REBUILD', 'rebuild' );

/**
 * To migrate an accelerator to another compute resource
 */
define( 'ONAPP_ACCELERATOR_MIGRATE', 'migrate' );

/**
 * To unlock the accelerator
 */
define( 'ONAPP_ACCELERATOR_UNLOCK', 'unlock' );

/**
 * To segregate an accelerator (that is, instruct it never to reside on the same compute resource with another accelerator)
 */
define( 'ONAPP_ACCELERATOR_SEGREGATE', 'strict_vm' );

/**
 * To reassign an accelerator to another use
 */
define( 'ONAPP_ACCELERATOR_CHANGE_OWNER', 'change_owner' );

/**
 * It is required to rebuild network after any changes on IP address joins or network interfaces
 */
define( 'ONAPP_ACCELERATOR_REBUILD_NETWORK', 'rebuild_network' );

/**
 * To view CPU usage statistics of an accelerator
 */
define( 'ONAPP_ACCELERATOR_VM_STATS', 'vm_stats' );


/**
 * Managing CDN Accelerator
 *
 * The CDN Accelerator class represents the CDN Accelerator.
 * The OnApp_CDNAccelerator class is the parent of the OnApp class.
 *
 * The CDNAccelerator uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_CDNAccelerator extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'accelerator';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'accelerators';

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
            case '2.3':
            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
            case 4.2:
                $this->fields = array(
                    'admin_note'                      => array(
                        ONAPP_FIELD_MAP  => '_admin_note',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'allowed_hot_migrate'             => array(
                        ONAPP_FIELD_MAP  => '_allowed_hot_migrate',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'allowed_swap'                    => array(
                        ONAPP_FIELD_MAP  => '_allowed_swap',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'booted'                          => array(
                        ONAPP_FIELD_MAP  => '_booted',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'built'                           => array(
                        ONAPP_FIELD_MAP  => '_built',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'cores_per_socket'                => array(
                        ONAPP_FIELD_MAP  => '_cores_per_socket',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'cpu_shares'                      => array(
                        ONAPP_FIELD_MAP  => '_cpu_shares',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'cpu_sockets'                     => array(
                        ONAPP_FIELD_MAP  => '_cpu_sockets',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'cpu_threads'                     => array(
                        ONAPP_FIELD_MAP  => '_cpu_threads',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'cpu_units'                       => array(
                        ONAPP_FIELD_MAP  => '_cpu_units',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'cpus'                            => array(
                        ONAPP_FIELD_MAP  => '_cpus',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'created_at'                      => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'customer_network_id'             => array(
                        ONAPP_FIELD_MAP  => '_customer_network_id',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'deleted_at'                      => array(
                        ONAPP_FIELD_MAP  => '_deleted_at',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'enable_autoscale'                => array(
                        ONAPP_FIELD_MAP  => '_enable_autoscale',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'enable_monitis'                  => array(
                        ONAPP_FIELD_MAP  => '_enable_monitis',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'firewall_notrack'                => array(
                        ONAPP_FIELD_MAP  => '_firewall_notrack',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'hot_add_cpu'                     => array(
                        ONAPP_FIELD_MAP  => '_hot_add_cpu',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'hot_add_memory'                  => array(
                        ONAPP_FIELD_MAP  => '_hot_add_memory',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'hypervisor_id'                   => array(
                        ONAPP_FIELD_MAP  => '_hypervisor_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'id'                              => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'identifier'                      => array(
                        ONAPP_FIELD_MAP  => '_identifier',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'initial_root_password'           => array(
                        ONAPP_FIELD_MAP  => '_initial_root_password',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'initial_root_password_encrypted' => array(
                        ONAPP_FIELD_MAP  => '_initial_root_password_encrypted',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'instance_type_id'                => array(
                        ONAPP_FIELD_MAP  => '_instance_type_id',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'iso_id'                          => array(
                        ONAPP_FIELD_MAP  => '_iso_id',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'label'                           => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'local_remote_access_ip_address'  => array(
                        ONAPP_FIELD_MAP  => '_local_remote_access_ip_address',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'local_remote_access_port'        => array(
                        ONAPP_FIELD_MAP  => '_local_remote_access_port',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'locked'                          => array(
                        ONAPP_FIELD_MAP  => '_locked',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'memory'                          => array(
                        ONAPP_FIELD_MAP  => '_memory',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'min_disk_size'                   => array(
                        ONAPP_FIELD_MAP  => '_min_disk_size',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'note'                            => array(
                        ONAPP_FIELD_MAP  => '_note',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'operating_system'                => array(
                        ONAPP_FIELD_MAP  => '_operating_system',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'operating_system_distro'         => array(
                        ONAPP_FIELD_MAP  => '_operating_system_distro',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'recovery_mode'                   => array(
                        ONAPP_FIELD_MAP  => '_recovery_mode',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'remote_access_password'          => array(
                        ONAPP_FIELD_MAP  => '_remote_access_password',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'service_password'                => array(
                        ONAPP_FIELD_MAP  => '_service_password',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'state'                           => array(
                        ONAPP_FIELD_MAP  => '_state',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'strict_virtual_machine_id'       => array(
                        ONAPP_FIELD_MAP  => '_strict_virtual_machine_id',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'suspended'                       => array(
                        ONAPP_FIELD_MAP  => '_suspended',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'template_id'                     => array(
                        ONAPP_FIELD_MAP  => '_template_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'template_label'                  => array(
                        ONAPP_FIELD_MAP  => '_template_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'time_zone'                       => array(
                        ONAPP_FIELD_MAP  => '_time_zone',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'updated_at'                      => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'user_id'                         => array(
                        ONAPP_FIELD_MAP  => '_user_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'vip'                             => array(
                        ONAPP_FIELD_MAP  => '_vip',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'xen_id'                          => array(
                        ONAPP_FIELD_MAP  => '_xen_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'monthly_bandwidth_used'          => array(
                        ONAPP_FIELD_MAP  => '_monthly_bandwidth_used',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'total_disk_size'                 => array(
                        ONAPP_FIELD_MAP  => '_total_disk_size',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'price_per_hour'                  => array(
                        ONAPP_FIELD_MAP  => '_price_per_hour',
                        ONAPP_FIELD_TYPE => 'float',
                    ),
                    'price_per_hour_powered_off'      => array(
                        ONAPP_FIELD_MAP  => '_price_per_hour_powered_off',
                        ONAPP_FIELD_TYPE => 'float',
                    ),
                    'support_incremental_backups'     => array(
                        ONAPP_FIELD_MAP  => '_support_incremental_backups',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'cpu_priority'                    => array(
                        ONAPP_FIELD_MAP  => '_cpu_priority',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'edge_status'                     => array(
                        ONAPP_FIELD_MAP  => '_edge_status',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'ip_addresses'                    => array(
                        ONAPP_FIELD_MAP       => '_ip_addresses',
                        ONAPP_FIELD_TYPE      => 'array',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_CLASS     => 'CDNAccelerator_IpAddress',
                    ),
                    'acceleration'                    => array(
                        ONAPP_FIELD_MAP  => '_acceleration',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'acceleration_status'             => array(
                        ONAPP_FIELD_MAP  => '_acceleration_status',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'autoscale_service'               => array(
                        ONAPP_FIELD_MAP  => '_autoscale_service',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'built_from_iso'                  => array(
                        ONAPP_FIELD_MAP  => '_built_from_iso',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'cdboot'                          => array(
                        ONAPP_FIELD_MAP  => '_cdboot',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'cdn_reference'                   => array(
                        ONAPP_FIELD_MAP  => '_cdn_reference',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'draas_keys'                      => array(
                        ONAPP_FIELD_MAP  => '_draas_keys',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    'draas_mode'                      => array(
                        ONAPP_FIELD_MAP  => '_draas_mode',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'preferred_hvs'                   => array(
                        ONAPP_FIELD_MAP  => '_preferred_hvs',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    'vapp_id'                         => array(
                        ONAPP_FIELD_MAP  => '_vapp_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'destination'                     => array(
                        ONAPP_FIELD_MAP  => '_destination',
                        ONAPP_FIELD_TYPE => 'string',
                    ),

                );
                break;

            case 4.3:
                $this->fields                        = $this->initFields( 4.2 );
                $this->fields['hypervisor_type']     = array(
                    ONAPP_FIELD_MAP  => '_hypervisor_type',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['instance_package_id'] = array(
                    ONAPP_FIELD_MAP  => '_instance_package_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['vmware_tools']        = array(
                    ONAPP_FIELD_MAP  => '_vmware_tools',
                    ONAPP_FIELD_TYPE => 'string',
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
                $this->fields['built_from_ova'] = array(
                    ONAPP_FIELD_MAP  => '_built_from_ova',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['template_version'] = array(
                    ONAPP_FIELD_MAP  => '_template_version',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['vcenter_moref'] = array(
                    ONAPP_FIELD_MAP  => '_vcenter_moref',
                    ONAPP_FIELD_TYPE => 'string',
                );
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

            case 6.1:
                $this->fields = $this->initFields( 6.0 );
                $this->fields['acceleration_allowed']   = array(
                    ONAPP_FIELD_MAP  => '_acceleration_allowed',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['domain']                 = array(
                    ONAPP_FIELD_MAP  => '_domain',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['openstack_id']           = array(
                    ONAPP_FIELD_MAP  => '_openstack_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['properties']             = array(
                    ONAPP_FIELD_MAP  => '_properties',
                    ONAPP_FIELD_TYPE => '_array',
                );
                $this->fields['vcenter_cluster_id']     = array(
                    ONAPP_FIELD_MAP  => '_vcenter_cluster_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['vcenter_reserved_memory'] = array(
                    ONAPP_FIELD_MAP  => '_vcenter_reserved_memory',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['virsh_console']          = array(
                    ONAPP_FIELD_MAP  => '_virsh_console',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                break;

            case 6.2:
                $this->fields = $this->initFields( 6.1 );
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

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_ACCELERATOR_REBOOT:
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias  /accelerators/:accelerator_id/reboot(.:format)
                 * @format {:controller=>"accelerators", :action=>"reboot"}
                 */

                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/reboot';
                break;

            case ONAPP_ACCELERATOR_STARTUP:
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias  /accelerators/:accelerator_id/startup(.:format)
                 * @format {:controller=>"accelerators", :action=>"startup"}
                 */

                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/startup';
                break;

            case ONAPP_ACCELERATOR_SHUTDOWN:
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias  /accelerators/:accelerator_id/shutdown(.:format)
                 * @format {:controller=>"accelerators", :action=>"shutdown"}
                 */

                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/shutdown';
                break;
            case ONAPP_ACCELERATOR_SUSPEND:
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias  /accelerators/:accelerator_id/suspend(.:format)
                 * @format {:controller=>"accelerators", :action=>"suspend"}
                 */

                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/suspend';
                break;
            case ONAPP_ACCELERATOR_REBUILD:
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias  /accelerators/:accelerator_id/build(.:format)
                 * @format {:controller=>"accelerators", :action=>"build"}
                 */

                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/build';
                break;
            case ONAPP_ACCELERATOR_MIGRATE:
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias  /accelerators/:accelerator_id/migrate(.:format)
                 * @format {:controller=>"accelerators", :action=>"migrate"}
                 */

                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/migrate';
                break;
            case ONAPP_ACCELERATOR_UNLOCK:
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias  /accelerators/:accelerator_id/unlock(.:format)
                 * @format {:controller=>"accelerators", :action=>"unlock"}
                 */

                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/unlock';
                break;
            case ONAPP_ACCELERATOR_SEGREGATE:
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias  /accelerators/:accelerator_id/strict_vm(.:format)
                 * @format {:controller=>"accelerators", :action=>"strict_vm"}
                 */

                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/strict_vm';
                break;
            case ONAPP_ACCELERATOR_CHANGE_OWNER:
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias  /accelerators/:accelerator_id/change_owner(.:format)
                 * @format {:controller=>"accelerators", :action=>"change_owner"}
                 */

                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/change_owner';
                break;
            case ONAPP_ACCELERATOR_REBUILD_NETWORK:
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias  /accelerators/:accelerator_id/rebuild_network(.:format)
                 * @format {:controller=>"accelerators", :action=>"rebuild_network"}
                 */

                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/rebuild_network';
                break;
            case ONAPP_ACCELERATOR_VM_STATS:
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method GET
                 * @alias  /accelerators/:accelerator_id/vm_stats(.:format)
                 * @format {:controller=>"accelerators", :action=>"vm_stats"}
                 */

                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/vm_stats';
                break;

            default:
                /**
                 * ROUTE :
                 *
                 * @name accelerators
                 * @method GET
                 * @alias  accelerators(.:format)
                 * @format {:controller=>"accelerators", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name accelerators
                 * @method GET
                 * @alias  accelerators/:id(.:format)
                 * @format {:controller=>"accelerators", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name accelerators
                 * @method POST
                 * @alias  accelerators(.:format)
                 * @format {:controller=>"accelerators", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name accelerators
                 * @method PUT
                 * @alias  accelerators/:id(.:format)
                 * @format {:controller=>"accelerators", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name accelerators
                 * @method DELETE
                 * @alias  accelerators/:id(.:format)
                 * @format {:controller=>"accelerators", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    public function reboot() {
        $this->sendPost( ONAPP_ACCELERATOR_REBOOT );
    }

    public function startup() {
        $this->sendPost( ONAPP_ACCELERATOR_STARTUP );
    }

    public function shutdown() {
        $this->sendPost( ONAPP_ACCELERATOR_SHUTDOWN );
    }

    public function suspend() {
        $this->sendPost( ONAPP_ACCELERATOR_SUSPEND );
    }

    public function rebuild() {
        $this->sendPost( ONAPP_ACCELERATOR_REBUILD );
    }

    public function migrate( $id = null ) {
        if ( is_null( $id ) && ! is_null( $this->_id ) ) {
            $id = $this->_id;
        }
        if ( ! is_null( $id ) ) {
            $this->_id = $id;
            $data      = array();

            if ( $this->_destination ) {
                $data['destination'] = $this->_destination;
            }
            if ( $this->_cold_migrate_on_rollback ) {
                $data['cold_migrate_on_rollback'] = $this->_cold_migrate_on_rollback;
            }
            $data = array(
                'root' => 'accelerator',
                'data' => $data
            );

            return $this->sendPost( ONAPP_ACCELERATOR_MIGRATE, $data );
        } else {
            $this->logger->error(
                'getList: argument _id not set.',
                __FILE__,
                __LINE__
            );
        }
    }

    public function unlock() {
        $this->sendPost( ONAPP_ACCELERATOR_UNLOCK );
    }

    public function segregate( $id = null ) {
        if ( is_null( $id ) && ! is_null( $this->_id ) ) {
            $id = $this->_id;
        }
        if ( ! is_null( $id ) ) {
            $this->_id = $id;
            $data      = array();

            if ( $this->_strict_virtual_machine_id ) {
                $data['strict_virtual_machine_id'] = $this->_strict_virtual_machine_id;
            }
            $data = array(
                'root' => 'accelerator',
                'data' => $data
            );

            return $this->sendPost( ONAPP_ACCELERATOR_SEGREGATE, $data );
        } else {
            $this->logger->error(
                'getList: argument _id not set.',
                __FILE__,
                __LINE__
            );
        }
    }

    public function change_owner( $id = null ) {
        if ( is_null( $id ) && ! is_null( $this->_id ) ) {
            $id = $this->_id;
        }
        if ( ! is_null( $id ) ) {
            $this->_id = $id;
            $data      = array();

            if ( $this->_user_id ) {
                $data['user_id'] = $this->_user_id;
            }
            $data = array(
                'root' => 'accelerator',
                'data' => $data
            );

            return $this->sendPost( ONAPP_ACCELERATOR_CHANGE_OWNER, $data );
        } else {
            $this->logger->error(
                'getList: argument _id not set.',
                __FILE__,
                __LINE__
            );
        }
    }

    public function rebuild_network( $accelerator_id, $shutdown_type, $required_startup ) {
        if ( isset( $accelerator_id ) && isset( $shutdown_type ) && isset( $required_startup ) ) {
            //rebuild_network.xml?force=1&shutdown_type=hard&required_startup=1'
            return $this->sendGet( ONAPP_ACCELERATOR_REBUILD_NETWORK, null,
                array(
                    'force'            => $accelerator_id,
                    'shutdown_type'    => $shutdown_type,
                    'required_startup' => $required_startup
                )
            );
        } else {
            $this->logger->error(
                'getList: please check arguments (accelerator_id, shutdown_type, required_startup) in rebuild_network() function.',
                __FILE__,
                __LINE__
            );
        }
    }

}
