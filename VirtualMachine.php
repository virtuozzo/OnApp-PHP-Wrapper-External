<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Virtual Machines
 *
 * When creating a virtual machine, users can select a Hypervisor server with
 * Data Store attached if they wish. If not, the system will find a list of
 * hypervisors with sufficient RAM and available storage and choose the one with
 * the least available RAM.
 *
 * OnApp provides complete management for your virtual machines. You can start,
 * stop, reboot, and delete virtual machines. You can also move VM's between the
 * hypervisors with no downtime. Automatic and manual backups will help you
 * restore the VM’s in case of failure.
 * With OnApp you have an integrated console and complete root access to your
 * virtual machines that provides full control over all files and processes
 * running on the machines.
 *
 * With OnApp you can monitor the CPU usage for each virtual machine and Network
 * Utilization for each network interface. This lets you know when to consider
 * increasing resources available to the system. Also the cloud engine provides
 * the detailed log records of all the tasks which are currently running,
 * pending, failed or completed.
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
define( 'ONAPP_GETRESOURCE_VIRTUALMACHINE_AUTOBACKUP_ENABLE', 'virtualmachine_autobackup_enable' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_VIRTUALMACHINE_AUTOBACKUP_DISABLE', 'virtualmachine_autobackup_disable' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_REBOOT', 'reboot' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_SHUTDOWN', 'shutdown' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_STOP', 'stop' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_CHANGE_OWNER', 'change_owner' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_REBUILD_NETWORK', 'rebuild_network' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_STARTUP', 'startup' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_UNLOCK', 'unlock' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_BUILD', 'build' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_SUSPEND_VM', 'suspend' );

/**
 *
 *
 */
define( 'ONAPP_ACTIVATE_GETLIST_USER', 'getUserVMsList' );

/**
 *
 *
 */
define( 'ONAPP_RESET_ROOT_PASSWORD', 'resetRootPassword' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_MIGRATE', 'migrate' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_MIGRATION', 'migration' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_VIRTUALMACHINES_STATUSES', 'statusAll' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_VIRTUALMACHINE_STATUS', 'status' );

/**
 * Enable Booting from CD for ISO Virtual Server
 */
define( 'ONAPP_ENABLE_BOOT_FROM_CD', 'cd_boot_enable' );

/**
 * Disable Booting from CD for ISO Virtual Server
 */
define( 'ONAPP_DISABLE_BOOT_FROM_CD', 'cd_boot_disable' );

/**
 * Search
 */
define( 'ONAPP_SEARCH', 'search' );

/**
 * Segregate Virtual Server
 */
define( 'ONAPP_GETRESOURCE_SEGREGATION', 'segregation' );

/**
 * Purge All Content
 */
define( 'ONAPP_GETRESOURCE_PURGE_ALL', 'purge_all' );

/**
 * Purge File(s)
 */
define( 'ONAPP_GETRESOURCE_PURGE', 'purge' );

/**
 * Purge File(s)
 */
define( 'ONAPP_GETRESOURCE_WITH_DECRYPTED_PASSWORD', 'with_decrypted_password' );

/**
 * Edit FQDN
 */
define( 'ONAPP_EDIT_FQDN', 'fqdn' );

/**
 * Enable Acceleration for Virtual Server
 */
define( 'ONAPP_ENABLE_ACCELERATION', 'acceleration.enable' );

/**
 * Disable Acceleration for Virtual Server
 */
define( 'ONAPP_DISABLE_ACCELERATION', 'acceleration.disable' );

/**
 * Virtual Machines
 *
 * The Virtual Machine class represents the Virtual Machines of the OnAPP installation.
 *
 * The OnApp_VirtualMachine class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_VirtualMachine extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'virtual_machine';

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'virtual_machines';

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
                    'id'                          => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'booted'                      => array(
                        ONAPP_FIELD_MAP       => '_booted',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'built'                       => array(
                        ONAPP_FIELD_MAP       => '_built',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'cpu_shares'                  => array(
                        ONAPP_FIELD_MAP           => '_cpu_shares',
                        ONAPP_FIELD_TYPE          => 'integer',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => 1
                    ),
                    'cpus'                        => array(
                        ONAPP_FIELD_MAP           => '_cpus',
                        ONAPP_FIELD_TYPE          => 'integer',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => 1
                    ),
                    'created_at'                  => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'hostname'                    => array(
                        ONAPP_FIELD_MAP           => '_hostname',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_TYPE          => 'string',
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                    'hypervisor_id'               => array(
                        ONAPP_FIELD_MAP           => '_hypervisor_id',
                        ONAPP_FIELD_TYPE          => 'integer',
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                    'identifier'                  => array(
                        ONAPP_FIELD_MAP       => '_identifier',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'initial_root_password'       => array(
                        ONAPP_FIELD_MAP           => '_initial_root_password',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                    'label'                       => array(
                        ONAPP_FIELD_MAP      => '_label',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'local_remote_access_port'    => array(
                        ONAPP_FIELD_MAP       => '_local_remote_access_port',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'locked'                      => array(
                        ONAPP_FIELD_MAP       => '_locked',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'memory'                      => array(
                        ONAPP_FIELD_MAP           => '_memory',
                        ONAPP_FIELD_TYPE          => 'integer',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => 256
                    ),
                    'recovery_mode'               => array(
                        ONAPP_FIELD_MAP       => '_recovery_mode',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'remote_access_password'      => array(
                        ONAPP_FIELD_MAP       => '_remote_access_password',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'template_id'                 => array(
                        ONAPP_FIELD_MAP           => '_template_id',
                        ONAPP_FIELD_TYPE          => 'integer',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                    'updated_at'                  => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'user_id'                     => array(
                        ONAPP_FIELD_MAP       => '_user_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'xen_id'                      => array(
                        ONAPP_FIELD_MAP       => '_xen_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'allowed_swap'                => array(
                        ONAPP_FIELD_MAP       => '_allowed_swap',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'allow_resize_without_reboot' => array(
                        ONAPP_FIELD_MAP       => '_allow_resize_without_reboot',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'ip_addresses'                => array(
                        ONAPP_FIELD_MAP       => '_ip_addresses',
                        ONAPP_FIELD_TYPE      => 'array',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_CLASS     => 'VirtualMachine_IpAddress',
                    ),
                    'min_disk_size'               => array(
                        ONAPP_FIELD_MAP       => '_min_disk_size',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'monthly_bandwidth_used'      => array(
                        ONAPP_FIELD_MAP       => '_monthly_bandwidth_used',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'operating_system'            => array(
                        ONAPP_FIELD_MAP       => '_operating_system',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'operating_system_distro'     => array(
                        ONAPP_FIELD_MAP       => '_operating_system_distro',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'template_label'              => array(
                        ONAPP_FIELD_MAP       => '_template_label',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'total_disk_size'             => array(
                        ONAPP_FIELD_MAP       => '_total_disk_size',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                break;

            case '2.1':
                $this->fields = $this->initFields( '2.0' );

                $this->fields['admin_note']                = array(
                    ONAPP_FIELD_MAP  => '_admin_note',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['allowed_hot_migrate']       = array(
                    ONAPP_FIELD_MAP           => '_allowed_hot_migrate',
                    ONAPP_FIELD_TYPE          => 'boolean',
                    ONAPP_FIELD_REQUIRED      => true,
                    ONAPP_FIELD_DEFAULT_VALUE => '0'
                );
                $this->fields['note']                      = array(
                    ONAPP_FIELD_MAP  => '_note',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['strict_virtual_machine_id'] = array(
                    ONAPP_FIELD_MAP  => '_strict_virtual_machine_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['suspended']                 = array(
                    ONAPP_FIELD_MAP  => '_suspended',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['enable_autoscale']          = array(
                    ONAPP_FIELD_MAP       => '_enable_autoscale',
                    ONAPP_FIELD_TYPE      => 'boolean',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields['enable_monitis']            = array(
                    ONAPP_FIELD_MAP       => '_enable_monitis',
                    ONAPP_FIELD_TYPE      => 'boolean',
                    ONAPP_FIELD_READ_ONLY => true,
                );

                if ( $this->_release == '0' ) {
                    unset( $this->fields['enable_autoscale'] );
                }
                break;

            case 2.2:
                $this->fields = $this->initFields( 2.1 );

                $this->fields['update_billing_stat'] = array(
                    ONAPP_FIELD_MAP       => 'update_billing_stat',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                break;

            case 2.3:
                $this->fields                           = $this->initFields( 2.2 );
                $this->fields['aflexi_id']              = array(
                    ONAPP_FIELD_MAP       => 'aflexi_id',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields['aflexi_city_id']         = array(
                    ONAPP_FIELD_MAP       => 'aflexi_city_id',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields['aflexi_price']           = array(
                    ONAPP_FIELD_MAP       => 'aflexi_price',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields['custom_nginx_config_on'] = array(
                    ONAPP_FIELD_MAP       => 'custom_nginx_config_on',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields['custom_nginx_config']    = array(
                    ONAPP_FIELD_MAP       => 'custom_nginx_config',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields['add_to_marketplace']     = array(
                    ONAPP_FIELD_MAP       => 'add_to_marketplace',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields['vip']                    = array(
                    ONAPP_FIELD_MAP       => 'vip',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields['volume_limit']           = array(
                    ONAPP_FIELD_MAP       => 'volume_limit',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields['speed_limit']            = array(
                    ONAPP_FIELD_MAP       => 'speed_limit',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields['state']                  = array(
                    ONAPP_FIELD_MAP       => 'state',
                    ONAPP_FIELD_TYPE      => 'string',
                    ONAPP_FIELD_READ_ONLY => true,
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
                $this->fields                        = $this->initFields( 2.3 );
                $this->fields['type_of_format']      = array(
                    ONAPP_FIELD_MAP  => 'type_of_format',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['licensing_type']      = array(
                    ONAPP_FIELD_MAP  => 'licensing_type',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['licensing_key']       = array(
                    ONAPP_FIELD_MAP  => 'licensing_key',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['licensing_server_id'] = array(
                    ONAPP_FIELD_MAP  => 'licensing_server_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );

                $this->fields['cores_per_socket']                = array(
                    ONAPP_FIELD_MAP  => '_cores_per_socket',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['cpu_sockets']                     = array(
                    ONAPP_FIELD_MAP  => '_cpu_sockets',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['cpu_threads']                     = array(
                    ONAPP_FIELD_MAP  => '_cpu_threads',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['cpu_units']                       = array(
                    ONAPP_FIELD_MAP  => '_cpu_units',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['customer_network_id']             = array(
                    ONAPP_FIELD_MAP  => '_customer_network_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['deleted_at']                      = array(
                    ONAPP_FIELD_MAP  => '_deleted_at',
                    ONAPP_FIELD_TYPE => 'datetime',
                );
                $this->fields['edge_server_type']                = array(
                    ONAPP_FIELD_MAP  => '_edge_server_type',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['firewall_notrack']                = array(
                    ONAPP_FIELD_MAP  => '_firewall_notrack',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['initial_root_password_encrypted'] = array(
                    ONAPP_FIELD_MAP  => '_initial_root_password_encrypted',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['local_remote_access_ip_address']  = array(
                    ONAPP_FIELD_MAP  => '_local_remote_access_ip_address',
                    ONAPP_FIELD_TYPE => 'string',
                );
                //todo: check response for preferred_hvs
                /*
                $this->fields[ 'preferred_hvs' ] = array(
                    ONAPP_FIELD_MAP  => '_preferred_hvs',
                    ONAPP_FIELD_TYPE => 'array',
                );
                */
                $this->fields['service_password']    = array(
                    ONAPP_FIELD_MAP  => '_service_password',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['iso_id']              = array(
                    ONAPP_FIELD_MAP  => '_iso_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['storage_server_type'] = array(
                    ONAPP_FIELD_MAP  => '_storage_server_type',
                    ONAPP_FIELD_TYPE => 'boolean',
                );

                break;
            case 4.2:
                $this->fields                                = $this->initFields( 4.1 );
                $this->fields['built_from_iso']              = array(
                    ONAPP_FIELD_MAP  => '_built_from_iso',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['acceleration']                = array(
                    ONAPP_FIELD_MAP  => '_acceleration',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['acceleration_status']         = array(
                    ONAPP_FIELD_MAP  => '_acceleration_status',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['allowed_swap']                = array(
                    ONAPP_FIELD_MAP  => '_allowed_swap',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['autoscale_service']           = array(
                    ONAPP_FIELD_MAP  => '_autoscale_service',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['cdboot']                      = array(
                    ONAPP_FIELD_MAP  => '_cdboot',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['draas_mode']                  = array(
                    ONAPP_FIELD_MAP  => '_draas_mode',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['hostname']                    = array(
                    ONAPP_FIELD_MAP  => '_hostname',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['hot_add_cpu']                 = array(
                    ONAPP_FIELD_MAP  => '_hot_add_cpu',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['hot_add_memory']              = array(
                    ONAPP_FIELD_MAP  => '_hot_add_memory',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['instance_type_id']            = array(
                    ONAPP_FIELD_MAP  => '_instance_type_id',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['local_remote_access_port']    = array(
                    ONAPP_FIELD_MAP  => '_local_remote_access_port',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['time_zone']                   = array(
                    ONAPP_FIELD_MAP  => '_time_zone',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['xen_id']                      = array(
                    ONAPP_FIELD_MAP  => '_xen_id',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['support_incremental_backups'] = array(
                    ONAPP_FIELD_MAP  => '_support_incremental_backups',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['cpu_priority']                = array(
                    ONAPP_FIELD_MAP  => '_cpu_priority',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['price_per_hour']              = array(
                    ONAPP_FIELD_MAP  => '_price_per_hour',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['price_per_hour_powered_off']  = array(
                    ONAPP_FIELD_MAP  => '_price_per_hour_powered_off',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['primary_network_group_id']    = array(
                    ONAPP_FIELD_MAP  => '_primary_network_group_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['draas_keys']                  = array(
                    ONAPP_FIELD_MAP  => '_draas_keys',
                    ONAPP_FIELD_TYPE => 'array',
                );
                $this->fields['preferred_hvs']               = array(
                    ONAPP_FIELD_MAP  => '_preferred_hvs',
                    ONAPP_FIELD_TYPE => 'array',
                );
                $this->fields['vapp_id']                     = array(
                    ONAPP_FIELD_MAP  => '_vapp_id',
                    ONAPP_FIELD_TYPE => 'string',
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
                $this->fields['purge_paths']     = array(
                    ONAPP_FIELD_MAP  => '_purge_paths',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
            case 5.1:
                $this->fields = $this->initFields( 5.0 );
                break;
            case 5.2:
                $this->fields = $this->initFields( 5.1 );
                $this->fields['built_from_ova']     = array(
                    ONAPP_FIELD_MAP  => '_built_from_ova',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['vcenter_moref']     = array(
                    ONAPP_FIELD_MAP  => '_vcenter_moref',
                    ONAPP_FIELD_TYPE => 'string',
                );

                break;
            case 5.3:
                $this->fields = $this->initFields( 5.2 );
                $this->fields['template_version'] = array(
                    ONAPP_FIELD_MAP  => '_template_version',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['recipe_joins_attributes'] = array(
                    ONAPP_FIELD_MAP  => '_recipe_joins_attributes',
                    ONAPP_FIELD_TYPE => 'array',
                );
                $this->fields['custom_variables_attributes'] = array(
                    ONAPP_FIELD_MAP   => '_custom_variables_attributes',
                    ONAPP_FIELD_TYPE  => 'array',
                    ONAPP_FIELD_CLASS => 'VirtualMachine_CustomVariablesAttribute',
                );
                break;
            case 5.4:
                $this->fields = $this->initFields( 5.3 );
                $this->fields['domain'] = array(
                    ONAPP_FIELD_MAP           => '_domain',
                    ONAPP_FIELD_TYPE          => 'string',
                    ONAPP_FIELD_DEFAULT_VALUE => 'localdomain',
                );
                $this->fields['user_group_id'] = array(
                    ONAPP_FIELD_MAP  => '_user_group_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['vdc_id'] = array(
                    ONAPP_FIELD_MAP  => '_vdc_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['data_store_id'] = array(
                    ONAPP_FIELD_MAP  => '_data_store_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['network_id'] = array(
                    ONAPP_FIELD_MAP  => '_network_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['openstack_id'] = array(
                    ONAPP_FIELD_MAP  => '_openstack_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['vcenter_reserved_memory'] = array(
                    ONAPP_FIELD_MAP  => '_vcenter_reserved_memory',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
                $this->fields['service_addon_ids'] = array(
                    ONAPP_FIELD_MAP  => '_service_addon_ids',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                $this->fields['properties']             = array(
                    ONAPP_FIELD_MAP  => '_properties',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['cpu_topology']           = array(
                    ONAPP_FIELD_MAP  => '_cpu_topology',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['acceleration_allowed']   = array(
                    ONAPP_FIELD_MAP  => '_acceleration_allowed',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                break;
        }

        if ( is_null( $this->_id ) ) {
            $this->fields['primary_disk_size']              = array(
                ONAPP_FIELD_MAP           => '_primary_disk_size',
                ONAPP_FIELD_TYPE          => 'integer',
                ONAPP_FIELD_REQUIRED      => true,
                ONAPP_FIELD_DEFAULT_VALUE => 5
            );
            $this->fields['swap_disk_size']                 = array(
                ONAPP_FIELD_MAP           => '_swap_disk_size',
                ONAPP_FIELD_TYPE          => 'integer',
                ONAPP_FIELD_DEFAULT_VALUE => 0
            );
            $this->fields['primary_network_id']             = array(
                ONAPP_FIELD_MAP           => '_primary_network_id',
                ONAPP_FIELD_TYPE          => 'integer',
                ONAPP_FIELD_REQUIRED      => true,
                ONAPP_FIELD_DEFAULT_VALUE => ''
            );
            $this->fields['required_automatic_backup']      = array(
                ONAPP_FIELD_MAP           => '_required_automatic_backup',
                ONAPP_FIELD_TYPE          => 'boolean',
                ONAPP_FIELD_REQUIRED      => true,
                ONAPP_FIELD_DEFAULT_VALUE => ''
            );
            $this->fields['rate_limit']                     = array(
                ONAPP_FIELD_MAP  => '_rate_limit',
                ONAPP_FIELD_TYPE => 'integer',
            );
            $this->fields['required_ip_address_assignment'] = array(
                ONAPP_FIELD_MAP           => '_required_ip_address_assignment',
                ONAPP_FIELD_TYPE          => 'boolean',
                ONAPP_FIELD_REQUIRED      => true,
                ONAPP_FIELD_DEFAULT_VALUE => '1'
            );
            $this->fields['required_virtual_machine_build'] = array(
                ONAPP_FIELD_MAP           => '_required_virtual_machine_build',
                ONAPP_FIELD_TYPE          => 'boolean',
                ONAPP_FIELD_REQUIRED      => true,
                ONAPP_FIELD_DEFAULT_VALUE => false
            );
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_SEGREGATION:
                /**
                 * ROUTE :
                 *
                 * @name segregate_virtual_server
                 * @method PUT
                 * @alias     /virtual_machines/:id/segregation.json
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/segregation';
                break;
            case ONAPP_GETRESOURCE_VIRTUALMACHINE_AUTOBACKUP_ENABLE:
                /**
                 * ROUTE :
                 *
                 * @name autobackup_enable_virtualmachine
                 * @method POST
                 * @alias     /virtual_machines/:id/autobackup_enable.json
                 * @format    {:controller=>"virtual_machines", :action=>"autobackup_enable"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/autobackup_enable';
                break;
            case ONAPP_GETRESOURCE_VIRTUALMACHINE_AUTOBACKUP_DISABLE:
                /**
                 * ROUTE :
                 *
                 * @name autobackup_disable_virtualmachine
                 * @method POST
                 * @alias     /virtual_machines/:id/autobackup_disable.json
                 * @format    {:controller=>"virtual_machines", :action=>"autobackup_disable"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/autobackup_disable';
                break;
            case ONAPP_GETRESOURCE_REBOOT:
                /**
                 * ROUTE :
                 *
                 * @name reboot_virtual_machine
                 * @method POST
                 * @alias    /virtual_machines/:id/reboot(.:format)
                 * @format   {:controller=>"virtual_machines", :action=>"reboot"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/reboot';
                break;

            case ONAPP_GETRESOURCE_SHUTDOWN:
                /**
                 * ROUTE :
                 *
                 * @name shutdown_virtual_machine
                 * @method POST
                 * @alias    /virtual_machines/:id/shutdown(.:format)
                 * @format   {:controller=>"virtual_machines", :action=>"shutdown"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/shutdown';
                break;

            case ONAPP_GETRESOURCE_STOP:
                /**
                 * ROUTE :
                 *
                 * @name stop_virtual_machine
                 * @method POST
                 * @alias    /virtual_machines/:id/stop(.:format)
                 * @format   {:controller=>"virtual_machines", :action=>"stop"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/stop';
                break;

            case ONAPP_GETRESOURCE_CHANGE_OWNER:
                /**
                 * ROUTE :
                 *
                 * @name change_owner_virtual_machine
                 * @method POST
                 * @alias   /virtual_machines/:id/change_owner(.:format)
                 * @format  {:controller=>"virtual_machines", :action=>"change_owner"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/change_owner';
                break;

            case ONAPP_GETRESOURCE_REBUILD_NETWORK:
                /**
                 * ROUTE :
                 *
                 * @name rebuild_network_virtual_machine
                 * @method POST
                 * @alias   /virtual_machines/:id/rebuild_network(.:format)
                 * @format  {:controller=>"virtual_machines", :action=>"rebuild_network"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/rebuild_network';
                break;

            case ONAPP_GETRESOURCE_STARTUP:
                /**
                 * ROUTE :
                 *
                 * @name shutdown_virtual_machine
                 * @method POST
                 * @alias    /virtual_machines/:id/startup(.:format)
                 * @format   {:controller=>"virtual_machines", :action=>"startup"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/startup';
                break;

            case ONAPP_GETRESOURCE_UNLOCK:
                /**
                 * ROUTE :
                 *
                 * @name shutdown_virtual_machine
                 * @method POST
                 * @alias   /virtual_machines/:id/unlock(.:format)
                 * @format  {:controller=>"virtual_machines", :action=>"unlock"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/unlock';
                break;

            case ONAPP_GETRESOURCE_MIGRATE:

                /**
                 * ROUTE :
                 *
                 * @name migrate_virtual_machine
                 * @method POST
                 * @alias   /virtual_machines/:id/migrate(.:format)
                 * @format  {:controller=>"virtual_machines", :action=>"migrate"}
                 */

                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/migrate';
                break;

            case ONAPP_GETRESOURCE_MIGRATION:

                /**
                 * ROUTE :
                 *
                 * @name migrate_virtual_machine
                 * @method POST
                 * @alias   /virtual_machines/:id/migration(.:format)
                 * @format  {:controller=>"virtual_machines", :action=>"migration"}
                 */

                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/migration';
                break;

            case ONAPP_GETRESOURCE_SUSPEND_VM:
                /**
                 * ROUTE :
                 *
                 * @name suspend_virtual_machine
                 * @method POST
                 * @alias   /virtual_machines/:id/suspend(.:format)
                 * @format  {:controller=>"virtual_machines", :action=>"suspend"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/suspend';
                break;

            case ONAPP_GETRESOURCE_BUILD:
                /**
                 * ROUTE :
                 *
                 * @name build_virtual_machine
                 * @method POST
                 * @alias    /virtual_machines/:id/build(.:format)
                 * @format   {:controller=>"virtual_machines", :action=>"build"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/build';
                break;

            case ONAPP_RESET_ROOT_PASSWORD:
                /**
                 * ROUTE :
                 *
                 * @name reset_password_virtual_machine
                 * @method POST
                 * @alias  /virtual_machines/:id/reset_password(.:format)
                 * @format {:controller=>"virtual_machines", :action=>"reset_password"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/reset_password';
                break;

            case ONAPP_ACTIVATE_GETLIST_USER:
                /**
                 * ROUTE :
                 *
                 * @name user_virtual_machines
                 * @method POST
                 * @alias  /users/:user_id/virtual_machines(.:format)
                 * @format {:controller=>"virtual_machines", :action=>"index"}
                 */
                $resource = '/users/' . $this->_user_id . '/virtual_machines';
                break;
            case ONAPP_GETRESOURCE_VIRTUALMACHINES_STATUSES:
                /**
                 * ROUTE :
                 *
                 * @name virtual_machines_statuses
                 * @method GET
                 * @alias  /virtual_machines/status(.:format)
                 * @format {:controller=>"virtual_machines", :action=>"statusAll"}
                 */
                $resource = '/virtual_machines/status';
                break;
            case ONAPP_GETRESOURCE_VIRTUALMACHINE_STATUS:
                /**
                 * ROUTE :
                 *
                 * @name virtual_machine_status
                 * @method GET
                 * @alias  /virtual_machines/:id/status(.:format)
                 * @format {:controller=>"virtual_machines", :action=>"status"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/status';
                break;
            case ONAPP_ENABLE_BOOT_FROM_CD:
                /**
                 * ROUTE :
                 *
                 * @name virtual_machine_status
                 * @method POST
                 * @alias  /virtual_machines/:id/cd_boot/enable(.:format)
                 * @format {:controller=>"virtual_machines", :action=>"status"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/cd_boot/enable';
                break;
            case ONAPP_DISABLE_BOOT_FROM_CD:
                /**
                 * ROUTE :
                 *
                 * @name virtual_machine_status
                 * @method POST
                 * @alias  /virtual_machines/:id/cd_boot/disable(.:format)
                 * @format {:controller=>"virtual_machines", :action=>"status"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/cd_boot/disable';
                break;
            case ONAPP_SEARCH:
                /**
                 * ROUTE :
                 *
                 * @name virtual_machine_search
                 * @method GET
                 * @alias  /virtual_machines(.:format)?q=label
                 * @format {:controller=>"virtual_machines", :action=>"status"}
                 */
                $resource = $this->_resource;
                break;

            case ONAPP_GETRESOURCE_PURGE:
                /**
                 * ROUTE :
                 *
                 * @name purge_files
                 * @method POST
                 * @alias    /virtual_machines/:id/purge(.:format)
                 * @format   {:controller=>"virtual_machines", :action=>"purge"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/purge';
                break;

            case ONAPP_GETRESOURCE_PURGE_ALL:
                /**
                 * ROUTE :
                 *
                 * @name purge_all_content
                 * @method POST
                 * @alias    /virtual_machines/:id/purge_all(.:format)
                 * @format   {:controller=>"virtual_machines", :action=>"purge_all"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/purge_all';
                break;

            case ONAPP_GETRESOURCE_WITH_DECRYPTED_PASSWORD:
                /**
                 * ROUTE :
                 *
                 * @name with_decrypted_password
                 * @method GET
                 * @alias    /virtual_machines/:id/with_decrypted_password(.:format)
                 * @format   {:controller=>"virtual_machines", :action=>"with_decrypted_password"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/with_decrypted_password';
                break;
            case ONAPP_EDIT_FQDN:
                /**
                 * ROUTE :
                 *
                 * @name edit_fqdn
                 * @method PATCH
                 * @alias    /virtual_machines/:id/fqdn(.:format)
                 * @format   {:controller=>"virtual_machines", :action=>"edit_fqdn"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/fqdn';
                break;
            case ONAPP_ENABLE_ACCELERATION:
                /**
                 * ROUTE :
                 *
                 * @name Enable Acceleration for Virtual Server
                 * @method PUT
                 * @alias    /virtual_machines/:id/acceleration.enable(.:format)
                 * @format   {:controller=>"virtual_machines", :action=>"acceleration.enable"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/' . ONAPP_ENABLE_ACCELERATION;
                break;
            case ONAPP_DISABLE_ACCELERATION:
                /**
                 * ROUTE :
                 *
                 * @name Enable Acceleration for Virtual Server
                 * @method PUT
                 * @alias    /virtual_machines/:id/acceleration.disable(.:format)
                 * @format   {:controller=>"virtual_machines", :action=>"acceleration.disable"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/' . ONAPP_DISABLE_ACCELERATION;
                break;

            default:
                /**
                 * ROUTE :
                 *
                 * @name virtual_machines
                 * @method GET
                 * @alias   /virtual_machines(.:format)
                 * @format  {:controller=>"virtual_machines", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name virtual_machine
                 * @method GET
                 * @alias    /virtual_machines/:id(.:format)
                 * @format   {:controller=>"virtual_machines", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias    /virtual_machines(.:format)
                 * @format   {:controller=>"virtual_machines", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method PUT
                 * @alias  /virtual_machines/:id(.:format)
                 * @format {:controller=>"virtual_machines", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method DELETE
                 * @alias   /virtual_machines/:id(.:format)
                 * @format  {:controller=>"virtual_machines", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
                break;
        }

        $actions = array(
            ONAPP_GETRESOURCE_VIRTUALMACHINE_AUTOBACKUP_ENABLE,
            ONAPP_GETRESOURCE_VIRTUALMACHINE_AUTOBACKUP_DISABLE,
            ONAPP_GETRESOURCE_REBOOT,
            ONAPP_GETRESOURCE_SHUTDOWN,
            ONAPP_GETRESOURCE_STARTUP,
            ONAPP_GETRESOURCE_UNLOCK,
            ONAPP_GETRESOURCE_BUILD,
            ONAPP_ACTIVATE_GETLIST_USER,
            ONAPP_GETRESOURCE_SUSPEND_VM,
            ONAPP_RESET_ROOT_PASSWORD,
            ONAPP_GETRESOURCE_PURGE_ALL,
            ONAPP_GETRESOURCE_PURGE,
            ONAPP_GETRESOURCE_WITH_DECRYPTED_PASSWORD,
            ONAPP_EDIT_FQDN,
            ONAPP_ENABLE_ACCELERATION,
            ONAPP_DISABLE_ACCELERATION,
        );

        if ( in_array( $action, $actions ) ) {
            $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
        }

        return $resource;
    }

    /**
     * Enable autobackup
     *
     * @param null $id
     *
     * @return void
     */
    function enableAutobackup( $id = null ) {
        if ( $id ) {
            $this->_id = $id;
        }
        $this->sendPost( ONAPP_GETRESOURCE_VIRTUALMACHINE_AUTOBACKUP_ENABLE, '' );
    }

    /**
     * Disable autobackup
     *
     * @param null $id
     *
     * @return void
     */
    function disableAutobackup( $id = null ) {
        if ( $id ) {
            $this->_id = $id;
        }
        $this->sendPost( ONAPP_GETRESOURCE_VIRTUALMACHINE_AUTOBACKUP_DISABLE, '' );
    }

    /**
     * Reboot Virtual machine
     *
     * @param mixed $recovery reboot mode
     */
    function reboot( $recovery = false ) {
        if ( ! $recovery ) {
            $this->sendPost( ONAPP_GETRESOURCE_REBOOT, '' );
        } else {
            $data = array(
                'root' => 'mode',
                'data' => 'recovery',
            );

            $this->sendPost( ONAPP_GETRESOURCE_REBOOT, $data );
        }
    }

    /**
     * Resets Virtual Machine Root Password
     *
     * @access public
     */
    function reset_password( $password = null, $encryption_key = null ) {
        if ( is_null( $password ) && is_null( $encryption_key ) ) {
            return $this->sendPost( ONAPP_RESET_ROOT_PASSWORD );
        }

        $data = array(
            'root' => 'virtual_machine',
            'data' => array(
                'initial_root_password'                => $password,
                'initial_root_password_encryption_key' => $encryption_key
            )
        );

        $this->sendPost( ONAPP_RESET_ROOT_PASSWORD, $data );
    }

    /**
     * Suspends Virtual Machine
     *
     * @access public
     */
    function suspend() {
        $this->sendPost( ONAPP_GETRESOURCE_SUSPEND_VM, '' );
    }

    /**
     * Shutdown Virtual Machine
     *
     * @access public
     */
    function shutdown() {
        $this->sendPost( ONAPP_GETRESOURCE_SHUTDOWN, '' );
    }

    /**
     * Stop Virtual Machine
     *
     * @access public
     */
    function stop() {
        $this->sendPost( ONAPP_GETRESOURCE_STOP, '' );
    }

    /**
     * Migrates Virtual Machine to the other hypervisor
     *
     * @param int $id virtual machine id
     * @param int $hypervisor_id destination hypervisor id
     */
    function migrate( $id, $hypervisor_id ) {
        if ( $id ) {
            $this->_id = $id;
        }

        //todo add check for cold migrate
        $data = array(
            'root' => 'tmp_holder',
            'data' => array(
                'destination' => $hypervisor_id,
                //'cold_migrate_on_rollback' => true
            ),
        );

        $this->sendPost( ONAPP_GETRESOURCE_MIGRATE, $data );
    }

    /**
     * Migrates Virtual Machine to the other hypervisor
     *
     * @param int $id virtual machine id
     * @param int $hypervisor_id destination hypervisor id
     */
    function migration( $id, $hypervisor_id, $cold_migrate_on_rollback = false, $migration_type=null, $data_store_id=null, $virtual_machine_identifier=null ) {
        if ( $id ) {
            $this->_id = $id;
        }
        $data = array(
            'root' => 'tmp_holder',
            'data' => array(
                'destination' => $hypervisor_id,
            ),
        );
        if (  $migration_type ) {
            $data['data']['migration_type'] = $migration_type;
        }
        if (  $data_store_id ) {
            $data['data']['data_store_id'] = $data_store_id;
        }
        if (  $virtual_machine_identifier ) {
            $data['data']['virtual_machine_identifier'] = $virtual_machine_identifier;
        }
        if ( $cold_migrate_on_rollback ) {
            $data['data']['cold_migrate_on_rollback'] = "1";
        }

        $this->sendPost( ONAPP_GETRESOURCE_MIGRATION, $data );
    }

    /**
     * Change Virtual Machine Owner
     *
     * @param int|bool $user_id
     *
     * @return response object
     */
    function change_owner( $user_id = false ) {
        if ( ! $user_id ) {
            $this->sendPost( ONAPP_GETRESOURCE_STARTUP );
        } else {
            $data = array(
                'root' => 'tmp_holder',
                'data' => array(
                    'user_id' => $user_id
                )
            );

            $this->sendPost( ONAPP_GETRESOURCE_CHANGE_OWNER, $data );
        }

        return $this->_obj;
    }

    /**
     * Rebuilds network for virtual machine
     *
     * @access public
     */
    function rebuild_network( $shutdown_type = null, $required_startup = null ) {
        $data = array();

        if ( ! is_null( $shutdown_type ) && $shutdown_type != "" ) {
            $data['shutdown_type'] = $shutdown_type;
            $data['force']         = '1';
        }

        if ( ! is_null( $required_startup ) && $required_startup != "" ) {
            $data['required_startup'] = $required_startup;
        }

        $data = array(
            'root' => 'tmp_holder',
            'data' => $data
        );

        $this->sendPost( ONAPP_GETRESOURCE_REBUILD_NETWORK, $data );
    }

    /**
     * Start Virtual machine
     *
     * @param int|bool $recovery
     *
     * @return object response object
     */
    function startup( $recovery = false ) {
        if ( ! $recovery ) {
            $this->sendPost( ONAPP_GETRESOURCE_STARTUP, '' );
        } else {
            $data = array(
                'root' => 'tmp_holder',
                'data' => array(
                    'mode' => 'recovery'
                )
            );

            $this->sendPost( ONAPP_GETRESOURCE_STARTUP, $data );
        }

        return $this->_obj;
    }

    /**
     * Unlock Virtual machine
     *
     * @access public
     */
    function unlock() {
        $this->sendPost( ONAPP_GETRESOURCE_UNLOCK );
    }

    /**
     * Build or rebuild Virtual machine
     *
     * @access public
     */
    function build() {
        if ( $this->getAPIVersion() < 2.3 ) {
            if ( isset( $this->_template_id ) && ( $this->_template_id != $this->_obj->_template_id ) ) {
                $data = array(
                    'root' => 'virtual_machine',
                    'data' => array(
                        'template_id'      => $this->_template_id,
                        'required_startup' => $this->_required_startup
                    )
                );
            } else {
                $data = array(
                    'root' => 'virtual_machine',
                    'data' => array(
                        'required_startup' => $this->_required_startup
                    )
                );
            }
        } else {
            $tmpData = array(
                'template_id'      => $this->_template_id ? $this->_template_id : $this->_obj->_template_id,
                'required_startup' => $this->_required_startup
            );
            if ( isset( $this->licensing_type ) ) {
                $tmpData['licensing_type'] = $this->licensing_type;
                if ( ( $this->licensing_type == 'own' ) && isset( $this->licensing_key ) ) {
                    $tmpData['licensing_key'] = $this->licensing_key;
                } elseif ( ( $this->licensing_type == 'kms' ) && isset( $this->licensing_server_id ) ) {
                    $tmpData['licensing_server_id'] = $this->licensing_server_id;
                }
            }
            $data = array(
                'root' => 'virtual_machine',
                'data' => $tmpData
            );
        }

        $this->sendPost( ONAPP_GETRESOURCE_BUILD, $data );
    }

    /**
     * Sends an API request to get the Objects. After requesting,
     * unserializes the received response into the array of Objects
     *
     * @param int|null $user_id
     *
     * @return array|bool
     */
    function getList( $user_id = null, $url_args = null ) {
        //todo rewrite to use parent method
        if ( is_null( $user_id ) ) {
            return parent::getList( null, $url_args );
        } else {
            $this->activateCheck( ONAPP_ACTIVATE_GETLIST );

            $this->logger->add( 'getList: Get Transaction list.' );

            $this->_user_id = $user_id;

            $this->setAPIResource( $this->getResource( ONAPP_ACTIVATE_GETLIST_USER ) );

            $response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

            $result = $this->castStringToClass( $response );

            if ( ! empty( $response['errors'] ) ) {
                //todo test this stuff
                //$this->errors = $result->errors;
                return false;
            }
            if ( ! is_array( $result ) && ! is_null( $result ) ) {
                $result = array( $result );
            }

            return $result;
        }
    }

    /**
     * Save Object in to your account.
     */
    function save() {
        if ( ! is_null( $this->_id ) ) {
            foreach ( $this->fields as $field => $value ) {
                unset( $this->fields[ $field ][ ONAPP_FIELD_DEFAULT_VALUE ] );
                unset( $this->fields[ $field ][ ONAPP_FIELD_REQUIRED ] );
            }

            parent::save();

            return;
        }

        $fields = $this->fields;
        
        $this->unsetFields( array( 'cpu_threads' ) );

        $this->fields['primary_disk_size']              = array(
            ONAPP_FIELD_MAP           => '_primary_disk_size',
            ONAPP_FIELD_TYPE          => 'integer',
            ONAPP_FIELD_REQUIRED      => true,
            ONAPP_FIELD_DEFAULT_VALUE => 5
        );
        $this->fields['swap_disk_size']                 = array(
            ONAPP_FIELD_MAP           => '_swap_disk_size',
            ONAPP_FIELD_TYPE          => 'integer',
            ONAPP_FIELD_REQUIRED      => true,
            ONAPP_FIELD_DEFAULT_VALUE => 0
        );
        $this->fields['primary_network_id']             = array(
            ONAPP_FIELD_MAP           => '_primary_network_id',
            ONAPP_FIELD_TYPE          => 'integer',
            ONAPP_FIELD_REQUIRED      => true,
            ONAPP_FIELD_DEFAULT_VALUE => ''
        );
        $this->fields['required_automatic_backup']      = array(
            ONAPP_FIELD_MAP           => '_required_automatic_backup',
            ONAPP_FIELD_TYPE          => 'boolean',
            ONAPP_FIELD_REQUIRED      => true,
            ONAPP_FIELD_DEFAULT_VALUE => ''
        );
        $this->fields['rate_limit']                     = array(
            ONAPP_FIELD_MAP           => '_rate_limit',
            ONAPP_FIELD_TYPE          => 'integer',
            ONAPP_FIELD_DEFAULT_VALUE => ''
        );
        $this->fields['required_ip_address_assignment'] = array(
            ONAPP_FIELD_MAP           => '_required_ip_address_assignment',
            ONAPP_FIELD_TYPE          => 'boolean',
            ONAPP_FIELD_REQUIRED      => true,
            ONAPP_FIELD_DEFAULT_VALUE => '1'
        );
        $this->fields['required_virtual_machine_build'] = array(
            ONAPP_FIELD_MAP           => '_required_virtual_machine_build',
            ONAPP_FIELD_TYPE          => 'boolean',
            ONAPP_FIELD_REQUIRED      => true,
            ONAPP_FIELD_DEFAULT_VALUE => ''
        );
        $this->fields['hypervisor_group_id']            = array(
            ONAPP_FIELD_MAP  => '_hypervisor_group_id',
            ONAPP_FIELD_TYPE => 'integer',
        );
        $this->fields['data_store_group_primary_id']    = array(
            ONAPP_FIELD_MAP  => '_data_store_group_primary_id',
            ONAPP_FIELD_TYPE => 'integer',
        );
        $this->fields['data_store_group_swap_id']       = array(
            ONAPP_FIELD_MAP  => '_data_store_group_swap_id',
            ONAPP_FIELD_TYPE => 'integer',
        );
        $this->fields['required_automatic_backup']      = array(
            ONAPP_FIELD_MAP  => '_required_automatic_backup',
            ONAPP_FIELD_TYPE => 'boolean',
        );
        $this->fields['required_public_ip_address']     = array(
            ONAPP_FIELD_MAP  => '_required_public_ip_address',
            ONAPP_FIELD_TYPE => 'boolean',
        );
        $this->fields['datacenter_id']                  = array(
            ONAPP_FIELD_MAP  => '_datacenter_id',
            ONAPP_FIELD_TYPE => 'integer',
        );
        $this->fields['cluster_id']                     = array(
            ONAPP_FIELD_MAP  => '_cluster_id',
            ONAPP_FIELD_TYPE => 'integer',
        );
        $this->fields['primary_data_store_id']          = array(
            ONAPP_FIELD_MAP  => '_primary_data_store_id',
            ONAPP_FIELD_TYPE => 'integer',
        );
        $this->fields['swap_data_store_id']             = array(
            ONAPP_FIELD_MAP  => '_swap_data_store_id',
            ONAPP_FIELD_TYPE => 'integer',
        );
        
        parent::save();

        $this->fields = $fields;
    }

    /**
     * Edit Administrator's Note
     *
     * @param int $id virtual machine id
     * @param string $admin_note Administrator's Note
     *
     * @return void
     */
    function editAdminNote( $id, $admin_note ) {
        if ( $admin_note ) {
            $this->_admin_note = $admin_note;
        }

        if ( $id ) {
            $this->_id = $id;
        }
        parent::save();
    }

    /**
     * Get Virtual machines statuses
     * or Virtual machine status if _id set
     *
     * @param int|null $id virtual machine id
     *
     * @access public
     *
     * @return response object|array
     */
    function status( $id = null ) {
        if ( ! is_null( $id ) ) {
            $this->_id = $id;
        }

        if ( ! is_null( $this->_id ) ) {
            return $this->sendGet( ONAPP_GETRESOURCE_VIRTUALMACHINE_STATUS );

        } else {
            return $this->sendGet( ONAPP_GETRESOURCE_VIRTUALMACHINES_STATUSES );
        }
    }

    function enableCdBoot() {
        return $this->sendPost( ONAPP_ENABLE_BOOT_FROM_CD );
    }

    function disableCdBoot() {
        return $this->sendPost( ONAPP_DISABLE_BOOT_FROM_CD );
    }

    public function search( $question ) {
        return $this->sendGet( ONAPP_SEARCH, null, array( 'q' => $question ) );
    }

    /**
     * Segregate Virtual Server
     *
     * @param $strict_virtual_machine_id
     *
     */
    function segregation( $strict_virtual_machine_id = null ) {
        if ( ! is_null( $strict_virtual_machine_id ) ) {
            $this->_strict_virtual_machine_id = $strict_virtual_machine_id;
        }

        if ( ! $this->_strict_virtual_machine_id ) {
            $this->logger->error(
                'segregation: argument _strict_virtual_machine_id not set.',
                __FILE__,
                __LINE__
            );
        }

        $data = array(
            'root' => $this->_tagRoot,
            'data' => array(
                'strict_virtual_machine_id' => $strict_virtual_machine_id
            ),
        );

        $this->sendPut( ONAPP_GETRESOURCE_SEGREGATION, $data );
    }

    /**
     * Desegregate Virtual Server
     *
     * @param $strict_virtual_machine_id
     *
     */
    function desegregation( $strict_virtual_machine_id = null ) {
        if ( ! is_null( $strict_virtual_machine_id ) ) {
            $this->_strict_virtual_machine_id = $strict_virtual_machine_id;
        }

        if ( ! $this->_strict_virtual_machine_id ) {
            $this->logger->error(
                'desegregation: argument _strict_virtual_machine_id not set.',
                __FILE__,
                __LINE__
            );
        }

        $data = array(
            'root' => $this->_tagRoot,
            'data' => array(
                'strict_virtual_machine_id' => $strict_virtual_machine_id
            ),
        );

        $this->sendDelete( ONAPP_GETRESOURCE_SEGREGATION, $data );
    }

    function purgeAll() {
        return $this->sendPost( ONAPP_GETRESOURCE_PURGE_ALL );
    }

    function purge($purge_paths) {
        if(!is_array($purge_paths)){
            $path = $purge_paths;
            $purge_paths = array();
            $purge_paths[] = $path;
        }
        $data = array(
            'root' => 'tmp_holder',
            'data' => array(
                'purge_paths' => $purge_paths
            )
        );

        return $this->sendPost( ONAPP_GETRESOURCE_PURGE, $data );
    }

    function viewDecryptedPassword($encryptionKey) {
        //initial_root_password_encryption_key=encryptionkey
        return $this->sendGet( ONAPP_GETRESOURCE_WITH_DECRYPTED_PASSWORD, null, array(initial_root_password_encryption_key => $encryptionKey) );
    }
    
    function edit_fqdn($hostname, $domain) {
        $data = array(
            'root' => $this->_tagRoot,
            'data' => array(
                'hostname'  => $hostname,
                'domain'    => $domain,
            )
        );
        
        return $this->sendPatch( ONAPP_EDIT_FQDN, $data );
    }
    
    public function addVsFromOvaTemplate($template_id, $label, $hostname, $domain='localdomain', $initial_root_password=null, $initial_root_password_confirmation=null, $hypervisor_group_id=null, $hypervisor_id=null, $memory, $cpus, $cpu_shares, $cpu_units, $cpu_topology, array $disks_attributes, array $network_interfaces_attributes, $required_automatic_backup=0, $required_virtual_machine_build=1, $required_virtual_machine_startup=0, $acceleration=false){
        
        $data = array(
            'root' => $this->_tagRoot,
            'data' => array(
                'template_id'                      => $template_id,
                'label'                            => $label,
                'hostname'                         => $hostname,
                'domain'                           => $domain,
                'hypervisor_group_id'              => $hypervisor_group_id,
                'hypervisor_id'                    => $hypervisor_id,
                'memory'                           => $memory,
                'cpus'                             => $cpus,
                'cpu_shares'                       => $cpu_shares,
                'cpu_units'                        => $cpu_units,
                'cpu_topology'                     => $cpu_topology,
                'disks_attributes'                 => $disks_attributes,
                'network_interfaces_attributes'    => $network_interfaces_attributes,
                'required_automatic_backup'        => $required_automatic_backup,
                '$required_virtual_machine_build'  => $required_virtual_machine_build,
                'required_virtual_machine_startup' => $required_virtual_machine_startup,
                'acceleration' => $acceleration,
            )
        );
        if ( ! is_null( $initial_root_password ) && $initial_root_password != "" ) {
            $pattern = "/^\S*(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\,\.\;\:\_\-\@\~\!\*\+\{\}\[\]\`\?\#\$\=\/\\\])[a-zA-Z0-9\,\.\;\:\_\-\@\~\!\*\+\{\}\[\]\`\?\#\$\=\/\\\]{6,32}$/";

            if ( preg_match( $pattern, $initial_root_password ) ) {
                $data['data']['initial_root_password'] = $initial_root_password;
            } else {
                $this->logger->error(
                    'The root password can consist of 6-32 characters, letters [A-Za-z], digits [0-9], dash [ - ] and lower dash [ _ ], and the following special characters: ~ ! @ # $ * _ - + = ` \\ { } [ ] : ; \' , . ? /. You can use both lower- and uppercase letters.',
                    __FILE__,
                    __LINE__
                );
            }
        }
        if ( $initial_root_password_confirmation === $initial_root_password ) {
            if ( !is_null($initial_root_password_confirmation) ) {
                $data['data']['initial_root_password_confirmation'] = $initial_root_password_confirmation;
            }
        } else {
            $this->logger->error(
                'segregation: argument initial_root_password_confirmation does not coincide with initial_root_password',
                __FILE__,
                __LINE__
            );
        }
        
        return $this->sendPost( ONAPP_GETRESOURCE_DEFAULT, $data );
    }

    public function enableAcceleration($id){
        if ( is_null($id) ) {
            $this->logger->error(
                'enableAcceleration: argument _id not set.',
                __FILE__,
                __LINE__
            );
        }
        $this->_id = $id;

        return $this->sendPut( ONAPP_ENABLE_ACCELERATION );
    }

    public function disableAcceleration($id){
        if ( is_null($id) ) {
            $this->logger->error(
                'disableAcceleration: argument _id not set.',
                __FILE__,
                __LINE__
            );
        }
        $this->_id = $id;

        return $this->sendPut( ONAPP_DISABLE_ACCELERATION );
    }

}
