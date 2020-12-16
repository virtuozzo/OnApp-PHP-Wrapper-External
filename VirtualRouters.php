<?php
/**
 * Managing VirtualRouters
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Mykola Vuy
 * @copyright   © 2019 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing VirtualRouters
 *
 * The OnApp_VirtualRouters class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_VirtualRouters extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'virtual_router';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'virtual_routers';

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
                    'id'                                => array(
                        ONAPP_FIELD_MAP           => '_id',
                        ONAPP_FIELD_TYPE          => 'integer',
                        ONAPP_FIELD_READ_ONLY     => true,
                    ),
                    'hypervisor_id'                     => array(
                        ONAPP_FIELD_MAP           => '_hypervisor_id',
                        ONAPP_FIELD_TYPE          => 'integer',
                    ),
                    'template_id'                       => array(
                        ONAPP_FIELD_MAP           => '_template_id',
                        ONAPP_FIELD_TYPE          => 'integer',
                    ),
                    'identifier'                        => array(
                        ONAPP_FIELD_MAP           => '_identifier',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'hostname'                          => array(
                        ONAPP_FIELD_MAP           => '_hostname',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'memory'                            => array(
                        ONAPP_FIELD_MAP           => '_memory',
                        ONAPP_FIELD_TYPE          => 'integer',
                    ),
                    'cpus'                              => array(
                        ONAPP_FIELD_MAP           => '_cpus',
                        ONAPP_FIELD_TYPE          => 'integer',
                    ),
                    'cpu_shares'                        => array(
                        ONAPP_FIELD_MAP           => '_cpu_shares',
                        ONAPP_FIELD_TYPE          => 'integer',
                    ),
                    'created_at'                        => array(
                        ONAPP_FIELD_MAP           => '_created_at',
                        ONAPP_FIELD_TYPE          => 'datetime',
                        ONAPP_FIELD_READ_ONLY     => true
                    ),
                    'updated_at'                        => array(
                        ONAPP_FIELD_MAP           => '_updated_at',
                        ONAPP_FIELD_TYPE          => 'datetime',
                        ONAPP_FIELD_READ_ONLY     => true
                    ),
                    'built'                             => array(
                        ONAPP_FIELD_MAP           => '_built',
                        ONAPP_FIELD_TYPE          => 'boolean',
                    ),
                    'locked'                            => array(
                        ONAPP_FIELD_MAP           => '_locked',
                        ONAPP_FIELD_TYPE          => 'boolean',
                    ),
                    'booted'                            => array(
                        ONAPP_FIELD_MAP           => '_booted',
                        ONAPP_FIELD_TYPE          => 'boolean',
                    ),
                    'xen_id'                            => array(
                        ONAPP_FIELD_MAP           => '_xen_id',
                        ONAPP_FIELD_TYPE          => 'integer',
                    ),
                    'remote_access_password'            => array(
                        ONAPP_FIELD_MAP           => '_remote_access_password',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'local_remote_access_port'          => array(
                        ONAPP_FIELD_MAP           => '_local_remote_access_port',
                        ONAPP_FIELD_TYPE          => 'integer',
                    ),
                    'label'                             => array(
                        ONAPP_FIELD_MAP           => '_label',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'recovery_mode'                     => array(
                        ONAPP_FIELD_MAP           => '_recovery_mode',
                        ONAPP_FIELD_TYPE          => 'boolean',
                    ),
                    'user_id'                           => array(
                        ONAPP_FIELD_MAP           => '_user_id',
                        ONAPP_FIELD_TYPE          => 'integer',
                    ),
                    'operating_system'                  => array(
                        ONAPP_FIELD_MAP           => '_operating_system',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'operating_system_distro'           => array(
                        ONAPP_FIELD_MAP           => '_operating_system_distro',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'allowed_swap'                      => array(
                        ONAPP_FIELD_MAP           => '_allowed_swap',
                        ONAPP_FIELD_TYPE          => 'boolean',
                    ),
                    'template_label'                    => array(
                        ONAPP_FIELD_MAP           => '_template_label',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'min_disk_size'                     => array(
                        ONAPP_FIELD_MAP           => '_min_disk_size',
                        ONAPP_FIELD_TYPE          => 'integer',
                    ),
                    'allowed_hot_migrate'               => array(
                        ONAPP_FIELD_MAP           => '_allowed_hot_migrate',
                        ONAPP_FIELD_TYPE          => 'boolean',
                    ),
                    'note'                              => array(
                        ONAPP_FIELD_MAP           => '_note',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'admin_note'                        => array(
                        ONAPP_FIELD_MAP           => '_admin_note',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'suspended'                         => array(
                        ONAPP_FIELD_MAP           => '_suspended',
                        ONAPP_FIELD_TYPE          => 'boolean',
                    ),
                    'strict_virtual_machine_id'         => array(
                        ONAPP_FIELD_MAP           => '_strict_virtual_machine_id',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'enable_autoscale'                  => array(
                        ONAPP_FIELD_MAP           => '_enable_autoscale',
                        ONAPP_FIELD_TYPE          => 'boolean',
                    ),
                    'add_to_marketplace'                => array(
                        ONAPP_FIELD_MAP           => '_add_to_marketplace',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'state'                             => array(
                        ONAPP_FIELD_MAP           => '_state',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'initial_root_password_encrypted'   => array(
                        ONAPP_FIELD_MAP           => '_initial_root_password_encrypted',
                        ONAPP_FIELD_TYPE          => 'boolean',
                    ),
                    'edge_server_type'                  => array(
                        ONAPP_FIELD_MAP           => '_edge_server_type',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'storage_server_type'               => array(
                        ONAPP_FIELD_MAP           => '_storage_server_type',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'firewall_notrack'                  => array(
                        ONAPP_FIELD_MAP           => '_firewall_notrack',
                        ONAPP_FIELD_TYPE          => 'boolean',
                    ),
                    'service_password'                  => array(
                        ONAPP_FIELD_MAP           => '_service_password',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'preferred_hvs'                     => array(
                        ONAPP_FIELD_MAP           => '_preferred_hvs',
                        ONAPP_FIELD_TYPE          => '_array',
                    ),
                    'local_remote_access_ip_address'    => array(
                        ONAPP_FIELD_MAP           => '_local_remote_access_ip_address',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'cpu_units'                         => array(
                        ONAPP_FIELD_MAP           => '_cpu_units',
                        ONAPP_FIELD_TYPE          => 'integer',
                    ),
                    'cpu_sockets'                       => array(
                        ONAPP_FIELD_MAP           => '_cpu_sockets',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'draas_keys'                        => array(
                        ONAPP_FIELD_MAP           => '_draas_keys',
                        ONAPP_FIELD_TYPE          => '_array',
                    ),
                    'iso_id'                            => array(
                        ONAPP_FIELD_MAP           => '_iso_id',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'cores_per_socket'                  => array(
                        ONAPP_FIELD_MAP           => '_cores_per_socket',
                        ONAPP_FIELD_TYPE          => 'integer',
                    ),
                    'instance_package_id'               => array(
                        ONAPP_FIELD_MAP           => '_instance_package_id',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'hot_add_cpu'                       => array(
                        ONAPP_FIELD_MAP           => '_hot_add_cpu',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'hot_add_memory'                    => array(
                        ONAPP_FIELD_MAP           => '_hot_add_memory',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'time_zone'                         => array(
                        ONAPP_FIELD_MAP           => '_time_zone',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'autoscale_service'                 => array(
                        ONAPP_FIELD_MAP           => '_autoscale_service',
                        ONAPP_FIELD_TYPE          => 'integer',
                    ),
                    'cdboot'                            => array(
                        ONAPP_FIELD_MAP           => '_cdboot',
                        ONAPP_FIELD_TYPE          => 'boolean',
                    ),
                    'draas_mode'                        => array(
                        ONAPP_FIELD_MAP           => '_draas_mode',
                        ONAPP_FIELD_TYPE          => 'integer',
                    ),
                    'vapp_id'                           => array(
                        ONAPP_FIELD_MAP           => '_vapp_id',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'vmware_tools'                      => array(
                        ONAPP_FIELD_MAP           => '_vmware_tools',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'vcenter_moref'                     => array(
                        ONAPP_FIELD_MAP           => '_vcenter_moref',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'template_version'                  => array(
                        ONAPP_FIELD_MAP           => '_template_version',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'openstack_id'                      => array(
                        ONAPP_FIELD_MAP           => '_openstack_id',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'domain'                            => array(
                        ONAPP_FIELD_MAP           => '_domain',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'vcenter_reserved_memory'           => array(
                        ONAPP_FIELD_MAP           => '_vcenter_reserved_memory',
                        ONAPP_FIELD_TYPE          => 'integer',
                    ),
                    'deleted_at'                        => array(
                        ONAPP_FIELD_MAP           => '_deleted_at',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'properties'                        => array(
                        ONAPP_FIELD_MAP           => '_properties',
                        ONAPP_FIELD_TYPE          => '_array',
                    ),
                    'acceleration_allowed'              => array(
                        ONAPP_FIELD_MAP           => '_acceleration_allowed',
                        ONAPP_FIELD_TYPE          => 'boolean',
                    ),
                    'vcenter_cluster_id'                => array(
                        ONAPP_FIELD_MAP           => '_vcenter_cluster_id',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'ip_addresses'                      => array(
                        ONAPP_FIELD_MAP           => '_ip_addresses',
                        ONAPP_FIELD_CLASS         => 'OnApp_VirtualRouters_IpAddresses',
                    ),
                    'monthly_bandwidth_used'            => array(
                        ONAPP_FIELD_MAP           => '_monthly_bandwidth_used',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'total_disk_size'                   => array(
                        ONAPP_FIELD_MAP           => '_total_disk_size',
                        ONAPP_FIELD_TYPE          => 'integer',
                    ),
                    'support_incremental_backups'       => array(
                        ONAPP_FIELD_MAP           => '_support_incremental_backups',
                        ONAPP_FIELD_TYPE          => 'boolean',
                    ),
                    'cpu_priority'                      => array(
                        ONAPP_FIELD_MAP           => '_cpu_priority',
                        ONAPP_FIELD_TYPE          => 'integer',
                    ),
                    'built_from_iso'                    => array(
                        ONAPP_FIELD_MAP           => '_built_from_iso',
                        ONAPP_FIELD_TYPE          => 'boolean',
                    ),
                    'built_from_ova'                    => array(
                        ONAPP_FIELD_MAP           => '_built_from_ova',
                        ONAPP_FIELD_TYPE          => 'boolean',
                    ),
                    'acceleration'                      => array(
                        ONAPP_FIELD_MAP           => '_acceleration',
                        ONAPP_FIELD_TYPE          => 'boolean',
                    ),
                    'hypervisor_type'                   => array(
                        ONAPP_FIELD_MAP           => '_hypervisor_type',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'initial_root_password'             => array(
                        ONAPP_FIELD_MAP           => '_initial_root_password',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'vip'                               => array(
                        ONAPP_FIELD_MAP           => '_vip',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'price_per_hour'                    => array(
                        ONAPP_FIELD_MAP           => '_price_per_hour',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'price_per_hour_powered_off'        => array(
                        ONAPP_FIELD_MAP           => '_price_per_hour_powered_off',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                    'virsh_console'                     => array(
                        ONAPP_FIELD_MAP           => '_virsh_console',
                        ONAPP_FIELD_TYPE          => 'string',
                    ),
                );
                break;

            case 6.2:
                $this->fields = $this->initFields( 6.1 );
                break;

            case 6.3:
                $this->fields = $this->initFields( 6.2 );
                $this->fields['draas_shadow_ip_address_join_id']    = array(
                    ONAPP_FIELD_MAP  => '_draas_shadow_ip_address_join_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['infrastructure_mode']                = array(
                    ONAPP_FIELD_MAP  => '_infrastructure_mode',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['trim_disabled']                      = array(
                    ONAPP_FIELD_MAP  => '_trim_disabled',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                break;

            case 6.4:
                $this->fields = $this->initFields( 6.3 );
                $this->fields['vcenter_resource_pool_id']    = array(
                    ONAPP_FIELD_MAP  => '_vcenter_resource_pool_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
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
            default:
                /**
                 * ROUTE :
                 *
                 * @name VirtualRouters
                 * @method GET
                 * @alias  /virtual_routers(.:format)
                 * @format {:controller=>"VirtualRouters", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name VirtualRouters
                 * @method GET
                 * @alias  /virtual_routers/:id(.:format)
                 * @format {:controller=>"VirtualRouters", :action=>"show"}
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }
}
