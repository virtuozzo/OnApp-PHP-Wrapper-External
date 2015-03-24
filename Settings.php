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
                 * @alias  /settings(.:format)
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
                    'license_key'                            => array(
                        ONAPP_FIELD_MAP  => '_license_key',
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
                    ),
                    'licence_key'                            => array(
                        ONAPP_FIELD_MAP  => '_license_key',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }
}