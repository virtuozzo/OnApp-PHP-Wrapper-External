<?php
/**
 * OnApp CP Settings
 *
 * @category       API WRAPPER
 * @package        OnApp
 * @author         Yuriy Yakubskiy
 * @copyright      (c) 2012 OnApp
 * @link           http://www.onapp.com/
 * @see            OnApp
 */
/**
 *
 * Managing OnApp CP Settings
 *
 * The OnApp_Settings class uses the following basic methods:
 * {@link save}, and {@link getList}.
 *
 * The OnApp_Settings class represents Settings.
 * The OnApp class is a parent of OnApp_Settings class.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property boolean use_ssh_file_transfer
 * @property string  ssh_file_transfer_server
 * @property string  ssh_file_transfer_user
 * @property string  ssh_file_transfer_options
 * @property integer ssh_port
 * @property string  template_path
 * @property string  backups_path
 * @property string  data_path
 * @property string  update_server_url
 * @property string  license_key
 * @property string  generate_comment
 * @property integer simultaneous_backups
 * @property integer simultaneous_backups_per_datastore
 * @property integer simultaneous_backups_per_hypervisor
 * @property integer simultaneous_transactions
 * @property integer guest_wait_time_before_destroy
 * @property integer remote_access_session_start_port
 * @property integer remote_access_session_last_port
 * @property string  system_email
 * @property integer ajax_power_update_time
 * @property integer ajax_pagination_update_time
 * @property integer hypervisor_live_times
 * @property boolean cpu_guarantee
 * @property string  system_host
 * @property boolean system_notification
 * @property string  system_support_email
 * @property string  recovery_templates_path
 * @property boolean remove_backups_on_destroy_vm
 * @property boolean disable_hypervisor_failover
 * @property string  ips_allowed_for_login
 * @property string  monitis_path
 * @property string  monitis_account
 * @property string  monitis_apikey
 * @property array   locales
 * @property integer max_memory_ratio
 * @property boolean remove_old_root_passwords
 * @property boolean pagination_max_items_limit
 * @property string  default_image_template
 * @property string  default_firewall_policy
 * @property string  app_name
 * @property boolean show_ip_address_selection_for_new_vm
 * @property integer backup_taker_delay
 * @property integer billing_stat_updater_delay
 * @property integer cluster_monitor_delay
 * @property integer hypervisor_monitor_delay
 * @property integer cdn_sync_delay
 * @property integer schedule_runner_delay
 * @property integer transaction_runner_delay
 * @property string  zombie_transaction_time
 * @property integer zombie_disk_space_updater_delay
 * @property boolean dns_enabled
 * @property boolean enabled_libvirt_anti_spoofing
 * @property integer ip_range_limit
 * @property boolean allow_initial_root_password_encryption
 * @property boolean wipe_out_disk_on_destroy
 * @property boolean password_enforce_complexity
 * @property integer password_minimum_length
 * @property boolean password_upper_lowercase
 * @property boolean password_letters_numbers
 * @property boolean password_symbols
 * @property boolean password_force_unique
 * @property string  password_lockout_attempts
 * @property integer password_expiry
 * @property integer password_history_length
 * @property boolean force_windows_backups
 * @property boolean cloud_boot_enabled
 * @property string  nfs_root_ip
 * @property string  cloud_boot_target
 * @property boolean storage_enabled
 * @property string  licence_key
 */
class OnApp_Settings extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'settings';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'settings';

	/**
	 * Returns the URL Alias of the API Class that inherits the Class OnApp
	 *
	 * @param string $action action name
	 *
	 * @return string API resource
	 */
	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
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
				$resource = $this->URLPath;
				break;

			case ONAPP_GETRESOURCE_LIST:
				/**
				 * ROUTE :
				 *
				 * @name configuration_settings
				 * @method GET
				 * @alias  /settings/configuration(.:format)
				 * @format    settings#configuration
				 */

				$resource = $this->URLPath . '/configuration';
				break;
			default:
				$resource = parent::getURL( $action );
				break;
		}

		return $resource;
	}
}