<?php
/**
 * OnApp CP Settings
 *
 *
 * @category       API WRAPPER
 * @package        OnApp
 * @author         Yuriy Yakubskiy
 * @copyright      © 2012 OnApp
 * @link           http://www.onapp.com/
 * @see            OnApp
 */

/**
 *
 * Managing OnApp CP Settings
 *
 * The ONAPP_Settings class uses the following basic methods:
 * {@link save}, and {@link getList}.
 *
 * The ONAPP_Settings class represents Settings.
 * The ONAPP class is a parent of ONAPP_Settings class.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Settings extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'settings';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings';

    /**
     * Returns the URL Alias of the API Class that inherits the Class ONAPP
     *
     * @param string $action action name
     *
     * @return string API resource
     * @access public
     */
    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch( $action ) {

            case ONAPP_GETRESOURCE_EDIT:
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method PUT
                 * @alias  /settings/edit(.:format)
                 * @format settings#update
                 */

                $resource = $this->_resource;
                break;

            case ONAPP_GETRESOURCE_LIST:
                /**
                 * ROUTE :
                 *
                 * @name configuration_settings
                 * @method GET
                 * @alias     /settings/configuration(.:format)
                 * @format    settings#configuration
                 */

                $resource = $this->_resource . '/configuration';
                break;
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

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
            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
                $this->fields = array(
                    'use_ssh_file_transfer'                  => array(
                        ONAPP_FIELD_MAP  => '_use_ssh_file_transfer',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'ssh_file_transfer_server'               => array(
                        ONAPP_FIELD_MAP  => '_ssh_file_transfer_server',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'ssh_file_transfer_user'                 => array(
                        ONAPP_FIELD_MAP  => '_ssh_file_transfer_user',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'ssh_file_transfer_options'              => array(
                        ONAPP_FIELD_MAP  => '_ssh_file_transfer_options',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'ssh_port'                               => array(
                        ONAPP_FIELD_MAP  => '_ssh_port',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'template_path'                          => array(
                        ONAPP_FIELD_MAP  => '_template_path',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'backups_path'                           => array(
                        ONAPP_FIELD_MAP  => '_backups_path',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'data_path'                              => array(
                        ONAPP_FIELD_MAP  => '_data_path',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'update_server_url'                      => array(
                        ONAPP_FIELD_MAP  => '_update_server_url',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'generate_comment'                       => array(
                        ONAPP_FIELD_MAP  => '_generate_comment',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'simultaneous_backups'                   => array(
                        ONAPP_FIELD_MAP  => '_simultaneous_backups',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'simultaneous_backups_per_datastore'     => array(
                        ONAPP_FIELD_MAP  => '_simultaneous_backups_per_datastore',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'simultaneous_backups_per_hypervisor'    => array(
                        ONAPP_FIELD_MAP  => '_simultaneous_backups_per_hypervisor',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'simultaneous_transactions'              => array(
                        ONAPP_FIELD_MAP  => '_simultaneous_transactions',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'guest_wait_time_before_destroy'         => array(
                        ONAPP_FIELD_MAP  => '_guest_wait_time_before_destroy',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'remote_access_session_start_port'       => array(
                        ONAPP_FIELD_MAP  => '_remote_access_session_start_port',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'remote_access_session_last_port'        => array(
                        ONAPP_FIELD_MAP  => '_remote_access_session_last_port',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'system_email'                           => array(
                        ONAPP_FIELD_MAP  => '_system_email',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'ajax_power_update_time'                 => array(
                        ONAPP_FIELD_MAP  => '_ajax_power_update_time',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'ajax_pagination_update_time'            => array(
                        ONAPP_FIELD_MAP  => '_ajax_pagination_update_time',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'hypervisor_live_times'                  => array(
                        ONAPP_FIELD_MAP  => '_hypervisor_live_times',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'cpu_guarantee'                          => array(
                        ONAPP_FIELD_MAP  => '_cpu_guarantee',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'system_host'                            => array(
                        ONAPP_FIELD_MAP  => '_system_host',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'system_notification'                    => array(
                        ONAPP_FIELD_MAP  => '_system_notification',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'system_support_email'                   => array(
                        ONAPP_FIELD_MAP  => '_system_support_email',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'recovery_templates_path'                => array(
                        ONAPP_FIELD_MAP  => '_recovery_templates_path',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'remove_backups_on_destroy_vm'           => array(
                        ONAPP_FIELD_MAP  => '_remove_backups_on_destroy_vm',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'disable_hypervisor_failover'            => array(
                        ONAPP_FIELD_MAP  => '_disable_hypervisor_failover',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'ips_allowed_for_login'                  => array(
                        ONAPP_FIELD_MAP  => '_ips_allowed_for_login',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'monitis_path'                           => array(
                        ONAPP_FIELD_MAP  => '_monitis_path',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'monitis_account'                        => array(
                        ONAPP_FIELD_MAP  => '_monitis_account',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'monitis_apikey'                         => array(
                        ONAPP_FIELD_MAP  => '_monitis_apikey',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'locales'                                => array(
                        ONAPP_FIELD_MAP  => '_locales',
                        ONAPP_FIELD_TYPE => '_array',
                    ),
                    'max_memory_ratio'                       => array(
                        ONAPP_FIELD_MAP  => '_max_memory_ratio',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'license_key'                            => array(
                        ONAPP_FIELD_MAP  => '_license_key',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'remove_old_root_passwords'              => array(
                        ONAPP_FIELD_MAP  => '_remove_old_root_passwords',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'pagination_max_items_limit'             => array(
                        ONAPP_FIELD_MAP  => '_pagination_max_items_limit',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'default_image_template'                 => array(
                        ONAPP_FIELD_MAP  => '_default_image_template',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'default_firewall_policy'                => array(
                        ONAPP_FIELD_MAP  => '_default_firewall_policy',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'app_name'                               => array(
                        ONAPP_FIELD_MAP  => '_app_name',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'show_ip_address_selection_for_new_vm'   => array(
                        ONAPP_FIELD_MAP  => '_show_ip_address_selection_for_new_vm',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'backup_taker_delay'                     => array(
                        ONAPP_FIELD_MAP  => '_backup_taker_delay',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'billing_stat_updater_delay'             => array(
                        ONAPP_FIELD_MAP  => '_billing_stat_updater_delay',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'cluster_monitor_delay'                  => array(
                        ONAPP_FIELD_MAP  => '_cluster_monitor_delay',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'hypervisor_monitor_delay'               => array(
                        ONAPP_FIELD_MAP  => '_hypervisor_monitor_delay',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'cdn_sync_delay'                         => array(
                        ONAPP_FIELD_MAP  => '_cdn_sync_delay',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'schedule_runner_delay'                  => array(
                        ONAPP_FIELD_MAP  => '_schedule_runner_delay',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'transaction_runner_delay'               => array(
                        ONAPP_FIELD_MAP  => '_transaction_runner_delay',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'zombie_transaction_time'                => array(
                        ONAPP_FIELD_MAP  => '_zombie_transaction_time',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'zombie_disk_space_updater_delay'        => array(
                        ONAPP_FIELD_MAP  => '_zombie_disk_space_updater_delay',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'dns_enabled'                            => array(
                        ONAPP_FIELD_MAP  => '_dns_enabled',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'enabled_libvirt_anti_spoofing'          => array(
                        ONAPP_FIELD_MAP  => '_enabled_libvirt_anti_spoofing',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'ip_range_limit'                         => array(
                        ONAPP_FIELD_MAP  => '_ip_range_limit',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'allow_initial_root_password_encryption' => array(
                        ONAPP_FIELD_MAP  => '_allow_initial_root_password_encryption',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'wipe_out_disk_on_destroy'               => array(
                        ONAPP_FIELD_MAP  => '_wipe_out_disk_on_destroy',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'password_enforce_complexity'            => array(
                        ONAPP_FIELD_MAP  => '_password_enforce_complexity',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'password_minimum_length'                => array(
                        ONAPP_FIELD_MAP  => '_password_minimum_length',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'password_upper_lowercase'               => array(
                        ONAPP_FIELD_MAP  => '_password_upper_lowercase',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'password_letters_numbers'               => array(
                        ONAPP_FIELD_MAP  => '_password_letters_numbers',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'password_symbols'                       => array(
                        ONAPP_FIELD_MAP  => '_password_symbols',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'password_force_unique'                  => array(
                        ONAPP_FIELD_MAP  => '_password_force_unique',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'password_lockout_attempts'              => array(
                        ONAPP_FIELD_MAP  => '_password_lockout_attempts',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'password_expiry'                        => array(
                        ONAPP_FIELD_MAP  => '_password_expiry',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'password_history_length'                => array(
                        ONAPP_FIELD_MAP  => '_password_history_length',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'force_windows_backups'                  => array(
                        ONAPP_FIELD_MAP  => '_force_windows_backups',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'cloud_boot_enabled'                     => array(
                        ONAPP_FIELD_MAP  => '_cloud_boot_enabled',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'nfs_root_ip'                            => array(
                        ONAPP_FIELD_MAP  => '_nfs_root_ip',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'cloud_boot_target'                      => array(
                        ONAPP_FIELD_MAP  => '_cloud_boot_target',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'storage_enabled'                        => array(
                        ONAPP_FIELD_MAP  => '_storage_enabled',
                        ONAPP_FIELD_TYPE => 'boolean',
                    )
                );
                break;
            case 4.2:
                $this->fields            = $this->initFields( 4.1 );
                $this->fields[ 'use_yubikey_login' ]    = array(
                    ONAPP_FIELD_MAP       => '_use_yubikey_login',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'yubikey_api_id' ]    = array(
                    ONAPP_FIELD_MAP       => '_yubikey_api_id',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'yubikey_api_key' ]    = array(
                    ONAPP_FIELD_MAP       => '_yubikey_api_key',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'allow_to_collect_errors' ]    = array(
                    ONAPP_FIELD_MAP       => '_allow_to_collect_errors',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'ajax_log_update_interval' ]    = array(
                    ONAPP_FIELD_MAP       => '_ajax_log_update_interval',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'allow_connect_aws' ]    = array(
                    ONAPP_FIELD_MAP       => '_allow_connect_aws',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'allow_hypervisor_password_encryption' ]    = array(
                    ONAPP_FIELD_MAP       => '_allow_hypervisor_password_encryption',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'allow_incremental_backups' ]    = array(
                    ONAPP_FIELD_MAP       => '_allow_incremental_backups',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'allow_start_vms_with_one_ip' ]    = array(
                    ONAPP_FIELD_MAP       => '_allow_start_vms_with_one_ip',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'amount_of_service_instances' ]    = array(
                    ONAPP_FIELD_MAP       => '_amount_of_service_instances',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'application_server_email' ]    = array(
                    ONAPP_FIELD_MAP       => '_application_server_email',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'archive_stats_period' ]    = array(
                    ONAPP_FIELD_MAP       => '_archive_stats_period',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'backup_convert_coefficient' ]    = array(
                    ONAPP_FIELD_MAP       => '_backup_convert_coefficient',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'cdn_max_results_per_get_page' ]    = array(
                    ONAPP_FIELD_MAP       => '_cdn_max_results_per_get_page',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'dashboard_api_access_token' ]    = array(
                    ONAPP_FIELD_MAP       => '_dashboard_api_access_token',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'delete_template_source_after_install' ]    = array(
                    ONAPP_FIELD_MAP       => '_delete_template_source_after_install',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'disable_all_as_notifications' ]    = array(
                    ONAPP_FIELD_MAP       => '_disable_all_as_notifications',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'draas_enabled' ]    = array(
                    ONAPP_FIELD_MAP       => '_draas_enabled',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'email_delivery_method' ]    = array(
                    ONAPP_FIELD_MAP       => '_email_delivery_method',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'enable_daily_storage_report' ]    = array(
                    ONAPP_FIELD_MAP       => '_enable_daily_storage_report',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'enable_hourly_storage_report' ]    = array(
                    ONAPP_FIELD_MAP       => '_enable_hourly_storage_report',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'enable_huge_pages' ]    = array(
                    ONAPP_FIELD_MAP       => '_enable_huge_pages',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'federation_trusts_only_private' ]    = array(
                    ONAPP_FIELD_MAP       => '_federation_trusts_only_private',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'force_saml_login_only' ]    = array(
                    ONAPP_FIELD_MAP       => '_force_saml_login_only',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'ha_enabled' ]    = array(
                    ONAPP_FIELD_MAP       => '_ha_enabled',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'infiniband_cloud_boot_enabled' ]    = array(
                    ONAPP_FIELD_MAP       => '_infiniband_cloud_boot_enabled',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'instance_types_threshold_num' ]    = array(
                    ONAPP_FIELD_MAP       => '_instance_types_threshold_num',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'instant_stats_period' ]    = array(
                    ONAPP_FIELD_MAP       => '_instant_stats_period',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'is_archive_stats_enabled' ]    = array(
                    ONAPP_FIELD_MAP       => '_is_archive_stats_enabled',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'iso_path_on_cp' ]    = array(
                    ONAPP_FIELD_MAP       => '_iso_path_on_cp',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'iso_path_on_hv' ]    = array(
                    ONAPP_FIELD_MAP       => '_iso_path_on_hv',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'licence_key' ]    = array(
                    ONAPP_FIELD_MAP       => '_licence_key',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'log_cleanup_enabled' ]    = array(
                    ONAPP_FIELD_MAP       => '_log_cleanup_enabled',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'log_cleanup_period' ]    = array(
                    ONAPP_FIELD_MAP       => '_log_cleanup_period',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'max_network_interface_port_speed' ]    = array(
                    ONAPP_FIELD_MAP       => '_max_network_interface_port_speed',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'max_upload_size' ]    = array(
                    ONAPP_FIELD_MAP       => '_max_upload_size',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'maximum_pending_tasks' ]    = array(
                    ONAPP_FIELD_MAP       => '_maximum_pending_tasks',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'partition_align_offset' ]    = array(
                    ONAPP_FIELD_MAP       => '_partition_align_offset',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'password_protection_for_deleting' ]    = array(
                    ONAPP_FIELD_MAP       => '_password_protection_for_deleting',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'prefer_local_reads' ]    = array(
                    ONAPP_FIELD_MAP       => '_prefer_local_reads',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'qemu_attach_device_delay' ]    = array(
                    ONAPP_FIELD_MAP       => '_qemu_attach_device_delay',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'qemu_detach_device_delay' ]    = array(
                    ONAPP_FIELD_MAP       => '_qemu_detach_device_delay',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'rabbitmq_host' ]    = array(
                    ONAPP_FIELD_MAP       => '_rabbitmq_host',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'rabbitmq_login' ]    = array(
                    ONAPP_FIELD_MAP       => '_rabbitmq_login',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'rabbitmq_password' ]    = array(
                    ONAPP_FIELD_MAP       => '_rabbitmq_password',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'rabbitmq_vhost' ]    = array(
                    ONAPP_FIELD_MAP       => '_rabbitmq_vhost',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'rsync_option_acls' ]    = array(
                    ONAPP_FIELD_MAP       => '_rsync_option_acls',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'rsync_option_xattrs' ]    = array(
                    ONAPP_FIELD_MAP       => '_rsync_option_xattrs',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'run_recipe_on_vs_sleep_seconds' ]    = array(
                    ONAPP_FIELD_MAP       => '_run_recipe_on_vs_sleep_seconds',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'service_account_name' ]    = array(
                    ONAPP_FIELD_MAP       => '_service_account_name',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'simultaneous_backups_per_backup_server' ]    = array(
                    ONAPP_FIELD_MAP       => '_simultaneous_backups_per_backup_server',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'smtp_address' ]    = array(
                    ONAPP_FIELD_MAP       => '_smtp_address',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'smtp_authentication' ]    = array(
                    ONAPP_FIELD_MAP       => '_smtp_authentication',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'smtp_domain' ]    = array(
                    ONAPP_FIELD_MAP       => '_smtp_domain',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'smtp_enable_starttls_auto' ]    = array(
                    ONAPP_FIELD_MAP       => '_smtp_enable_starttls_auto',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'smtp_password' ]    = array(
                    ONAPP_FIELD_MAP       => '_smtp_password',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'smtp_port' ]    = array(
                    ONAPP_FIELD_MAP       => '_smtp_port',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'smtp_username' ]    = array(
                    ONAPP_FIELD_MAP       => '_smtp_username',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'snmptrap_addresses' ]    = array(
                    ONAPP_FIELD_MAP       => '_snmptrap_addresses',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'snmptrap_port' ]    = array(
                    ONAPP_FIELD_MAP       => '_snmptrap_port',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'ssl_pem_path' ]    = array(
                    ONAPP_FIELD_MAP       => '_ssl_pem_path',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'storage_endpoint_override' ]    = array(
                    ONAPP_FIELD_MAP       => '_storage_endpoint_override',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'storage_unicast' ]    = array(
                    ONAPP_FIELD_MAP       => '_storage_unicast',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'system_alert_reminder_period' ]    = array(
                    ONAPP_FIELD_MAP       => '_system_alert_reminder_period',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'system_theme' ]    = array(
                    ONAPP_FIELD_MAP       => '_system_theme',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'tc_burst' ]    = array(
                    ONAPP_FIELD_MAP       => '_tc_burst',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'tc_latency' ]    = array(
                    ONAPP_FIELD_MAP       => '_tc_latency',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'tc_mtu' ]    = array(
                    ONAPP_FIELD_MAP       => '_tc_mtu',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'transaction_standby_period' ]    = array(
                    ONAPP_FIELD_MAP       => '_transaction_standby_period',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'url_for_custom_tools' ]    = array(
                    ONAPP_FIELD_MAP       => '_url_for_custom_tools',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'use_html5_vnc_console' ]    = array(
                    ONAPP_FIELD_MAP       => '_use_html5_vnc_console',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'wrong_activated_logical_volume_alerts' ]    = array(
                    ONAPP_FIELD_MAP       => '_wrong_activated_logical_volume_alerts',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'wrong_activated_logical_volume_minutes' ]    = array(
                    ONAPP_FIELD_MAP       => '_wrong_activated_logical_volume_minutes',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'zabbix_host' ]    = array(
                    ONAPP_FIELD_MAP       => '_zabbix_host',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'zabbix_onapp_user_password' ]    = array(
                    ONAPP_FIELD_MAP       => '_zabbix_onapp_user_password',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'zabbix_password' ]    = array(
                    ONAPP_FIELD_MAP       => '_zabbix_password',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'zabbix_url' ]    = array(
                    ONAPP_FIELD_MAP       => '_zabbix_url',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'zabbix_user' ]    = array(
                    ONAPP_FIELD_MAP       => '_zabbix_user',
                    ONAPP_FIELD_TYPE      => 'string',
                );

                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    public function changeCustomParameters($params) {
        $allowedParams = array('use_yubikey_login', 'yubikey_api_key', 'yubikey_api_id', 'allow_to_collect_errors');

        if(!is_array($params)){
            return false;
        }

        $settings = $this->getList();
        if(isset($settings[0]) && $settings[0]->_license_key == ''){
            return false;
        }

        $dataArray = array();
        $dataArray['license_key'] = $settings[0]->_license_key;
        foreach ($params as $key => $val) {
            if(in_array($key, $allowedParams)) {
                $dataArray[$key] = $val;
            }
        }

        if(count($dataArray) == 0){
            return false;
        }

        $data = array(
            'root' => 'configuration',
            'data' => $dataArray,
        );
        $this->sendPut( ONAPP_GETRESOURCE_EDIT, $data, array('restart'=>'1'));
    }


}