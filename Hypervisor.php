<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Hypervisors
 *
 * In computing, a hypervisor, also called virtual machine monitor (VMM), allows
 * multiple operating systems to run concurrently on a host computer - a feature
 * called hardware virtualization. The hypervisor presents the guest operating
 * systems with a virtual platform  and monitors the execution of the guest
 * operating systems. In that way, multiple operating systems, including
 * multiple instances of the same operating system, can share hardware
 * resources.
 * In OnApp the Hypervisor servers:
 *    - Provide the system resources, such as CPU, memory, and network
 *    - Control the virtual differentiation of entities, such as machines and corresponding application data being delivered to cloud-hosted applications
 *    - Take care of secure virtualization and channeling of storage, data communications and machine processing
 *    - Can be located at different geographical zones
 *    - Can have different CPU and RAM
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
define( 'ONAPP_GETRESOURCE_HYPERVISORS_BY_HYPERVISOR_GROUP_ID', 'hypervisors' );
/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_HYPERVISOR_REBOOT', 'hypervisor_reboot' );

/**
 * Enable Maintenance Mode for Xen/KVM Compute Resource
 */
define( 'ONAPP_ENABLE_MAINTENANCE_MODE', 'maintenance_mode_enable' );

/**
 * Disable Maintenance Mode for Xen/KVM Compute Resource
 */
define( 'ONAPP_DISABLE_MAINTENANCE_MODE', 'maintenance_mode_disable' );

/**
 * Apply Hypervisor Group Custom Config
 */
define( 'ONAPP_APPLY_HYPERVISOR_GROUP_CUSTOM_CONFIG', 'apply_hypervisor_group_custom_config' );

/**
 * @var
 */
define('ONAPP_VIRTUAL_MACHINES_STARTUP', 'startup');

/**
 * @var
 */
define('ONAPP_VIRTUAL_MACHINES_STOP', 'stop');

/**
 * @var
 */
define('ONAPP_ENABLE_KERNEL_CRASH_DUMPING', 'crash_debug');

/**
 * Hypervisors
 *
 * This class represents the Hypervisors of your OnApp installation. The OnApp class is the parent of the Hypervisors class.
 *
 * The OnApp_Hypervisor class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Hypervisor extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'hypervisor';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/hypervisors';

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
                    'id'              => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'called_in_at'    => array(
                        ONAPP_FIELD_MAP       => '_called_in_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'created_at'      => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'failure_count'   => array(
                        ONAPP_FIELD_MAP       => '_failure_count',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'health'          => array(
                        ONAPP_FIELD_MAP       => '_health',
                        ONAPP_FIELD_TYPE      => 'yaml',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'ip_address'      => array(
                        ONAPP_FIELD_MAP       => '_ip_address',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_REQUIRED  => true,
                    ),
                    'label'           => array(
                        ONAPP_FIELD_MAP           => '_label',
                        ONAPP_FIELD_READ_ONLY     => true,
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                    'locked'          => array(
                        ONAPP_FIELD_MAP       => '_locked',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'memory_overhead' => array(
                        ONAPP_FIELD_MAP       => '_memory_overhead',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'online'          => array(
                        ONAPP_FIELD_MAP       => '_online',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'spare'           => array(
                        ONAPP_FIELD_MAP       => '_spare',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'updated_at'      => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'xen_info'        => array(
                        ONAPP_FIELD_MAP       => '_xen_info',
                        ONAPP_FIELD_TYPE      => 'yaml',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                break;

            case '2.1':
                $this->fields = $this->initFields( '2.0' );

                $this->fields['enabled'] = array(
                    ONAPP_FIELD_MAP       => '_enabled',
                    ONAPP_FIELD_TYPE      => 'boolean',
                    ONAPP_FIELD_READ_ONLY => true,
                );

                $this->fields['hypervisor_group_id'] = array(
                    ONAPP_FIELD_MAP      => '_hypervisor_group_id',
                    ONAPP_FIELD_TYPE     => 'integer',
                    ONAPP_FIELD_REQUIRED => true,
                );

                $this->fields['hypervisor_type'] = array(
                    ONAPP_FIELD_MAP      => '_hypervisor_type',
                    ONAPP_FIELD_TYPE     => 'string',
                    ONAPP_FIELD_REQUIRED => true,
                );
                break;

            case 2.2:
                $this->fields = $this->initFields( 2.1 );
                break;

            case 2.3:
                $this->fields = $this->initFields( 2.2 );
                $fields       = array(
                    'raw_stats',
                );
                $this->unsetFields( $fields );
                $this->fields['cpu_cores']                       = array(
                    ONAPP_FIELD_MAP       => 'cpu_cores',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields['free_memory']                     = array(
                    ONAPP_FIELD_MAP       => 'free_memory',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields['total_cpus']                      = array(
                    ONAPP_FIELD_MAP       => 'total_cpus',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields['total_memory']                    = array(
                    ONAPP_FIELD_MAP       => 'total_memory',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields['used_cpu_resources']              = array(
                    ONAPP_FIELD_MAP       => 'used_cpu_resources',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields['memory_allocated_by_running_vms'] = array(
                    ONAPP_FIELD_MAP  => '_memory_allocated_by_running_vms',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['total_memory_allocated_by_vms']   = array(
                    ONAPP_FIELD_MAP  => '_total_memory_allocated_by_vms',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['disable_failover']                = array(
                    ONAPP_FIELD_MAP  => '_disable_failover',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['redis_password']                  = array(
                    ONAPP_FIELD_MAP  => '_redis_password',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['free_disk_space']                 = array(
                    ONAPP_FIELD_MAP  => '_free_disk_space',
                    ONAPP_FIELD_TYPE => '_array',
                );

                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
                $this->fields                     = $this->initFields( 2.3 );
                $this->fields['maintenance_mode'] = array(
                    ONAPP_FIELD_MAP  => '_maintenance_mode',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                break;

            case 4.2:
                $this->fields              = $this->initFields( 4.1 );
                $this->fields['cpu_flags'] = array(
                    ONAPP_FIELD_MAP  => '_cpu_flags',
                    ONAPP_FIELD_TYPE => '_array',
                );

                $this->fields['allow_unsafe_assigned_interrupts'] = array(
                    ONAPP_FIELD_MAP  => '_allow_unsafe_assigned_interrupts',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['amqp_exchange_name']               = array(
                    ONAPP_FIELD_MAP  => '_amqp_exchange_name',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['backup']                           = array(
                    ONAPP_FIELD_MAP  => '_backup',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['backup_ip_address']                = array(
                    ONAPP_FIELD_MAP  => '_backup_ip_address',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['blocked']                          = array(
                    ONAPP_FIELD_MAP  => '_blocked',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['built']                            = array(
                    ONAPP_FIELD_MAP  => '_built',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['cloud_boot_os']                    = array(
                    ONAPP_FIELD_MAP  => '_cloud_boot_os',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['connection_options']               = array(
                    ONAPP_FIELD_MAP  => '_connection_options',
                    ONAPP_FIELD_TYPE => 'Hypervisor_ConnectionOptions',
                );
                $this->fields['cpu_idle']                         = array(
                    ONAPP_FIELD_MAP  => '_cpu_idle',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['cpu_mhz']                          = array(
                    ONAPP_FIELD_MAP  => '_cpu_mhz',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['cpu_units']                        = array(
                    ONAPP_FIELD_MAP  => '_cpu_units',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['cpus']                             = array(
                    ONAPP_FIELD_MAP  => '_cpus',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['custom_config']                    = array(
                    ONAPP_FIELD_MAP  => '_custom_config',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['disks_per_storage_controller']     = array(
                    ONAPP_FIELD_MAP  => '_disks_per_storage_controller',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['distro']                           = array(
                    ONAPP_FIELD_MAP  => '_distro',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['dom0_memory_size']                 = array(
                    ONAPP_FIELD_MAP  => '_dom0_memory_size',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['format_disks']                     = array(
                    ONAPP_FIELD_MAP  => '_format_disks',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['free_mem']                         = array(
                    ONAPP_FIELD_MAP  => '_free_mem',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['host']                             = array(
                    ONAPP_FIELD_MAP  => '_host',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['host_id']                          = array(
                    ONAPP_FIELD_MAP  => '_host_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['infiniband_identifier']            = array(
                    ONAPP_FIELD_MAP  => '_infiniband_identifier',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['list_of_logical_volumes']          = array(
                    ONAPP_FIELD_MAP  => '_list_of_logical_volumes',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['list_of_volume_groups']            = array(
                    ONAPP_FIELD_MAP  => '_list_of_volume_groups',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['list_of_zombie_domains']           = array(
                    ONAPP_FIELD_MAP  => '_list_of_zombie_domains',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['mac']                              = array(
                    ONAPP_FIELD_MAP  => '_mac',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['machine']                          = array(
                    ONAPP_FIELD_MAP  => '_machine',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['mem_info']                         = array(
                    ONAPP_FIELD_MAP  => '_mem_info',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['mtu']                              = array(
                    ONAPP_FIELD_MAP  => '_mtu',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['ovs']                              = array(
                    ONAPP_FIELD_MAP  => '_ovs',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['passthrough_disks']                = array(
                    ONAPP_FIELD_MAP  => '_passthrough_disks',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['power_cycle_command']              = array(
                    ONAPP_FIELD_MAP  => '_power_cycle_command',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['rebooting']                        = array(
                    ONAPP_FIELD_MAP  => '_rebooting',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['release']                          = array(
                    ONAPP_FIELD_MAP  => '_release',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['server_type']                      = array(
                    ONAPP_FIELD_MAP  => '_server_type',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['storage']                          = array(
                    ONAPP_FIELD_MAP  => '_storage',
                    ONAPP_FIELD_TYPE => 'Hypervisor_Storage',
                );
                $this->fields['storage_controller_memory_size']   = array(
                    ONAPP_FIELD_MAP  => '_storage_controller_memory_size',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['threads_per_core']                 = array(
                    ONAPP_FIELD_MAP  => '_threads_per_core',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['total_mem']                        = array(
                    ONAPP_FIELD_MAP  => '_total_mem',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['total_zombie_mem']                 = array(
                    ONAPP_FIELD_MAP  => '_total_zombie_mem',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['uptime']                           = array(
                    ONAPP_FIELD_MAP  => '_uptime',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;

            case 4.3:
                $this->fields                  = $this->initFields( 4.2 );
                $this->fields['cache_mirrors'] = array(
                    ONAPP_FIELD_MAP  => '_cache_mirrors',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['cache_stripes'] = array(
                    ONAPP_FIELD_MAP  => '_cache_stripes',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;

            case 5.0:
                $this->fields = $this->initFields( 4.3 );
                break;
            case 5.1:
                $this->fields = $this->initFields( 5.0 );
                $this->fields['storage_bonding_mode'] = array(
                    ONAPP_FIELD_MAP  => '_storage_bonding_mode',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['storage_controller_db_size'] = array(
                    ONAPP_FIELD_MAP  => '_storage_controller_db_size',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                break;
            case 5.2:
                $this->fields = $this->initFields( 5.1 );
                $this->fields['os_version'] = array(
                    ONAPP_FIELD_MAP  => '_os_version',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
            case 5.3:
                $this->fields = $this->initFields( 5.2 );
                break;
            case 5.4:
                $this->fields = $this->initFields( 5.3 );
                $this->fields['integrated_storage_disabled'] = array(
                    ONAPP_FIELD_MAP  => '_integrated_storage_disabled',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['os_version_minor'] = array(
                    ONAPP_FIELD_MAP  => '_os_version_minor',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                $this->fields['apply_hypervisor_group_custom_config'] = array(
                    ONAPP_FIELD_MAP  => '_apply_hypervisor_group_custom_config',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['storage_vlan']                         = array(
                    ONAPP_FIELD_MAP  => '_storage_vlan',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['cpu_model']                            = array(
                    ONAPP_FIELD_MAP  => '_cpu_model',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['crash_debug']                          = array(
                    ONAPP_FIELD_MAP  => '_crash_debug',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['segregation_os_type']                  = array(
                    ONAPP_FIELD_MAP  => '_segregation_os_type',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['failover_recipe_id']                   = array(
                    ONAPP_FIELD_MAP  => '_failover_recipe_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_HYPERVISORS_BY_HYPERVISOR_GROUP_ID:
                /**
                 * ROUTE :
                 *
                 * @name hypervisor_group_hypervisors
                 * @method GET
                 * @alias  /settings/hypervisor_zones/:hypervisor_group_id/hypervisors(.:format)
                 * @format {:controller=>"hypervisors", :action=>"index"}
                 */

                $resource = 'settings/hypervisor_zones/' . $this->_hypervisor_group_id . '/hypervisors';
                break;
            case ONAPP_ENABLE_MAINTENANCE_MODE:
                /**
                 * ROUTE :
                 *
                 * @name hypervisor
                 * @method PUT
                 * @alias  /settings/hypervisors/:hypervisor_id/maintenance_mode/enable(.:format)
                 * @format {:controller=>"hypervisors", :action=>"index"}
                 */

                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/maintenance_mode/enable';
                break;
            case ONAPP_DISABLE_MAINTENANCE_MODE:
                /**
                 * ROUTE :
                 *
                 * @name hypervisor
                 * @method PUT
                 * @alias  /settings/hypervisors/:hypervisor_id/maintenance_mode/disable(.:format)
                 * @format {:controller=>"hypervisors", :action=>"index"}
                 */

                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/maintenance_mode/disable';
                break;
            case ONAPP_GETRESOURCE_HYPERVISOR_REBOOT:
                /**
                 * ROUTE :
                 *
                 * @name reboot_hypervisor
                 * @method POST
                 * @alias   /settings/hypervisors/:id/reboot(.:format)
                 * @format  {:action=>"reboot", :controller=>"settings_hypervisors"}
                 */

                /**
                 * ROUTE :
                 *
                 * @name reboot_hypervisor
                 * @method PUT
                 * @alias   /settings/hypervisors/:id/reboot(.:format)
                 * @format  {:action=>"reboot", :controller=>"settings_hypervisors"}
                 */

                $resource = $this->_resource . '/' . $this->_id . '/reboot';
                break;
            
            case ONAPP_APPLY_HYPERVISOR_GROUP_CUSTOM_CONFIG:
                
                $resource = $this->_resource . '/' . $this->_id;
                break;

            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name hypervisors
                 * @method GET
                 * @alias  /settings/hypervisors(.:format)
                 * @format {:controller=>"settings_hypervisors", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name hypervisor
                 * @method GET
                 * @alias   /settings/hypervisors/:id(.:format)
                 * @format  {:controller=>"settings_hypervisors", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias   /settings/hypervisors(.:format)
                 * @format  {:controller=>"settings_hypervisors", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method PUT
                 * @alias  /settings/hypervisors/:id(.:format)
                 * @format {:controller=>"settings_hypervisors", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method DELETE
                 * @alias   /settings/hypervisors/:id(.:format)
                 * @format  {:controller=>"settings_hypervisors", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
                break;
            
            case ONAPP_VIRTUAL_MACHINES_STARTUP:
                /**
                 * ROUTE :
                 * 
                 * @method POST
                 * 
                 * @alias   /hypervisors/:hypervisor_id/virtual_machines/startup(.:format)
                 * @format  {:controller=>"Hypervisor", :action=>"startup"}
                 */
                
                if ( is_null( $this->_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _id not set.",
                        __FILE__,
                        __LINE__
                    );
                }

                $resource = 'hypervisors/' . $this->_id . '/virtual_machines/startup';
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
                
            case ONAPP_VIRTUAL_MACHINES_STOP:
                /**
                 * ROUTE :
                 * 
                 * @method POST
                 * 
                 * @alias   /hypervisors/:hypervisor_id/virtual_machines/stop(.:format)
                 * @format  {:controller=>"Hypervisor", :action=>"startup"}
                 */
                
                if ( is_null( $this->_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _id not set.",
                        __FILE__,
                        __LINE__
                    );
                }

                $resource = 'hypervisors/' . $this->_id . '/virtual_machines/stop';
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
                
            case ONAPP_ENABLE_KERNEL_CRASH_DUMPING:
                /**
                 * ROUTE :
                 *
                 * @name HYPERVISOR
                 * 
                 * @method PUT
                 *
                 * @alias   /settings/hypervisors/:id/crash_debug(.:format)
                 * @format  {:controller=>"HYPERVISOR", :action=>"enableKernelCrashDumping"}
                 */
                if ( is_null( $this->_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _id not set.",
                        __FILE__,
                        __LINE__
                    );
                }

                $resource = 'settings/hypervisors/' . $this->_id . '/' . ONAPP_ENABLE_KERNEL_CRASH_DUMPING;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
                
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    /**
     * Gets Hypervisors List by hypervisor group id
     *
     * @param integer|null $group_id hypervisor group id
     *
     * @return bool|mixed
     */
    function GetListByGroupId( $group_id = null ) {
        if ( $group_id ) {
            $this->_hypervisor_group_id = $group_id;
        } else {
            $this->logger->error(
                'GetListByGroupId: argument _group_id not set.',
                __FILE__,
                __LINE__
            );
        }

        $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_HYPERVISORS_BY_HYPERVISOR_GROUP_ID ) );

        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

        if ( ! empty( $response['errors'] ) ) {
            $this->errors = $response['errors'];

            return false;
        }

        $result     = $this->castStringToClass( $response );
        $this->_obj = $result;

        return ( is_array( $result ) || ! $result ) ? $result : array( $result );
    }

    /**
     * Reboots hypervisor
     *
     * @param integer $hypervisor_id hypervisor id
     *
     * @return void
     *
     */
    function reboot( $hypervisor_id ) {
        if ( $hypervisor_id ) {
            $this->_id = $hypervisor_id;
        } else {
            $this->logger->error(
                'reboot: argument _hypervisor_id not set.',
                __FILE__,
                __LINE__
            );
        }

        $version = parent::getAPIVersion();
        if ( $version <= 5.0 ) {
            $data = array(
                'root' => 'force',
                'data' => '1',
            );

            $this->sendPost( ONAPP_GETRESOURCE_HYPERVISOR_REBOOT, $data );

        } else {
            $data = array(
                'schedule_failover'                 => '1',
                'force'                             => '1',
                'confirm'                           => '1',
            );

            if ($version >= 6.0) {
                $data['skip_powered_off_vms_migration'] = '1';
            }

            if ( ! is_null( $data ) && is_array( $data ) ) {
                $data = json_encode($data);
                $this->logger->debug( 'Additional parameters: ' . $data );
            }

            $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_HYPERVISOR_REBOOT ) );
            $response = $this->sendRequest( ONAPP_REQUEST_METHOD_PUT, $data );

            $result     = $this->_castResponseToClass( $response );
            $this->_obj = $result;

        }
    }

    function save() {
        if (parent::getAPIVersion() >= 6.0) {
            $this->unsetFields( array('ip_address', 'backup_ip_address') );
            $this->fields['api_url'] = array(
                ONAPP_FIELD_MAP  => '_api_url',
                ONAPP_FIELD_TYPE => 'string',
            );
        }

        if ( $this->_id ) {
            $this->fields['hypervisor_group_id'][ ONAPP_FIELD_REQUIRED ] = false;
        } else {
            $this->unsetFields( array('hypervisor_group_id') );
        }
        
        return parent::save();
    }
    
    /**
     * Enable Hypervisor Group Custom Config
     *
     * @return void
     *
     */
    function enableHypervisorGroupCustomConfig() {
        $data = array(
            'root' => $this->_tagRoot,
            'data' => array(
                'apply_hypervisor_group_custom_config' => 1,
            ),
        );
        
        $this->sendPatch( ONAPP_APPLY_HYPERVISOR_GROUP_CUSTOM_CONFIG, $data );
    }
    
    /**
     * Disable Hypervisor Group Custom Config
     *
     * @return void
     *
     */
    function disableHypervisorGroupCustomConfig() {
        $data = array(
            'root' => $this->_tagRoot,
            'data' => array(
                'apply_hypervisor_group_custom_config' => 0,
            ),
        );
        
        $this->sendPatch( ONAPP_APPLY_HYPERVISOR_GROUP_CUSTOM_CONFIG, $data );
    }
    
    function enableMaintanceMode( $id = null ) {
        if ( $id ) {
            $this->_id = $id;
        }
        $data = array(
            'root' => 'force',
            'data' => '1'
        );

        return $this->sendPut( ONAPP_ENABLE_MAINTENANCE_MODE, $data );
    }

    function disableMaintanceMode( $id = null ) {
        if ( $id ) {
            $this->_id = $id;
        }

        return $this->sendPut( ONAPP_DISABLE_MAINTENANCE_MODE );
    }
    
    public function virtualMachinesStartup( $hypervisor_id, $virtual_machines ) {

        if ( $hypervisor_id ) {
            $this->_id = $hypervisor_id;
        } else {
            $this->logger->error(
                'virtualMachinesStartup: argument _hypervisor_id not set.',
                __FILE__,
                __LINE__
            );
        }
        if ( !is_countable($virtual_machines) || !count($virtual_machines) ) {
            $this->logger->error(
                'virtualMachinesStartup: argument _virtual_machines not set.',
                __FILE__,
                __LINE__
            );
        }
        
        $data = array(
            'virtual_machines' => $virtual_machines,
        );
        
        if ( ! is_null( $data ) && is_array( $data ) ) {
            $data = json_encode($data);
            $this->logger->debug( 'Additional parameters: ' . $data );
        }

        $this->setAPIResource( $this->getResource( ONAPP_VIRTUAL_MACHINES_STARTUP ) );
        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_POST, $data );

        $result     = $this->_castResponseToClass( $response );
        $this->_obj = $result;
    }
    
    public function virtualMachinesStop( $hypervisor_id, $virtual_machines, $shutdown_type ) {

        if ( $hypervisor_id ) {
            $this->_id = $hypervisor_id;
        } else {
            $this->logger->error(
                'virtualMachinesStop: argument _hypervisor_id not set.',
                __FILE__,
                __LINE__
            );
        }
        if ( !is_countable($virtual_machines) || !count($virtual_machines) ) {
            $this->logger->error(
                'virtualMachinesStop: argument _virtual_machines not set.',
                __FILE__,
                __LINE__
            );
        }
        
        if ( !$shutdown_type ) {
            $this->logger->error(
                'virtualMachinesStop: argument _shutdown_type not set.',
                __FILE__,
                __LINE__
            );
        }
        
        $data = array(
            'virtual_machines'  => $virtual_machines,
            'shutdown_type'     => $shutdown_type,
        );
        
        if ( ! is_null( $data ) && is_array( $data ) ) {
            $data = json_encode($data);
            $this->logger->debug( 'Additional parameters: ' . $data );
        }

        $this->setAPIResource( $this->getResource( ONAPP_VIRTUAL_MACHINES_STOP ) );
        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_POST, $data );

        $result     = $this->_castResponseToClass( $response );
        $this->_obj = $result;
    }
    
    public function enableKernelCrashDumping(){
        $data = array(
            'root' => $this->_tagRoot,
            'data' => array(
                'crash_debug' => true,
            ),
        );
        
        return $this->sendPut(ONAPP_ENABLE_KERNEL_CRASH_DUMPING, $data);
    }
}
