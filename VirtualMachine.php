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
 * @copyright   (c) 2012 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

define( 'ONAPP_GETRESOURCE_REBOOT', 'reboot' );

define( 'ONAPP_GETRESOURCE_SHUTDOWN', 'shutdown' );

define( 'ONAPP_GETRESOURCE_CHANGE_OWNER', 'change_owner' );

define( 'ONAPP_GETRESOURCE_REBUILD_NETWORK', 'rebuild_network' );

define( 'ONAPP_GETRESOURCE_STARTUP', 'startup' );

define( 'ONAPP_GETRESOURCE_UNLOCK', 'unlock' );

define( 'ONAPP_GETRESOURCE_BUILD', 'build' );

define( 'ONAPP_GETRESOURCE_SUSPEND_VM', 'suspend' );

define( 'ONAPP_ACTIVATE_GETLIST_USER', 'getUserVMsList' );

define( 'ONAPP_RESET_ROOT_PASSWORD', 'resetRootPassword' );

define( 'ONAPP_GETRESOURCE_MIGRATE', 'migrate' );

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
/**
 * Magic properties used for autocomplete
 *
 * @property integer  $id
 * @property boolean  $booted
 * @property boolean  $built
 * @property integer  $cpu_shares
 * @property integer  $cpus
 * @property string   $created_at
 * @property string   $hostname
 * @property integer  $hypervisor_id
 * @property string   $identifier
 * @property string   $initial_root_password
 * @property string   $label
 * @property integer  $local_remote_access_port
 * @property boolean  $locked
 * @property integer  $memory
 * @property boolean  $recovery_mode
 * @property mixed    $remote_access_password
 * @property integer  $template_id
 * @property string   $updated_at
 * @property integer  $user_id
 * @property integer  $xen_id
 * @property boolean  $allowed_swap
 * @property boolean  $allow_resize_without_reboot
 * @property integer  $min_disk_size
 * @property integer  $monthly_bandwidth_used
 * @property string   $operating_system
 * @property string   $operating_system_distro
 * @property string   $template_label
 * @property float    $total_disk_size
 * @property integer  $primary_disk_size
 * @property integer  $swap_disk_size
 * @property integer  $primary_network_id
 * @property boolean  $required_automatic_backup
 * @property integer  $rate_limit
 * @property boolean  $required_ip_address_assignment
 * @property boolean  $required_virtual_machine_build
 * @property string   $admin_note
 * @property boolean  $allowed_hot_migrate
 * @property string   $note
 * @property integer  $strict_virtual_machine_id
 * @property boolean  $suspended
 * @property boolean  $enable_autoscale
 * @property boolean  $enable_monitis
 * @property integer  $update_billing_stat
 * @property integer  $aflexi_id
 * @property integer  $aflexi_city_id
 * @property integer  $aflexi_price
 * @property integer  $custom_nginx_config_on
 * @property integer  $custom_nginx_config
 * @property integer  $add_to_marketplace
 * @property integer  $vip
 * @property integer  $volume_limit
 * @property integer  $speed_limit
 * @property integer  $required_startup
 * @property string   $state
 */
class OnApp_VirtualMachine extends OnApp {
	public static $nestedData = array(
		'ip_addresses' => 'VirtualMachine_IpAddress',
	);

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'virtual_machine';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'virtual_machines';

	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			case ONAPP_GETRESOURCE_REBOOT:
				/**
				 * ROUTE :
				 *
				 * @name reboot_virtual_machine
				 * @method POST
				 * @alias    /virtual_machines/:id/reboot(.:format)
				 * @format   {:controller=>"virtual_machines", :action=>"reboot"}
				 */
				$resource = $this->getURL( ONAPP_GETRESOURCE_LOAD ) . '/reboot';
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
				$resource = $this->getURL( ONAPP_GETRESOURCE_LOAD ) . '/shutdown';
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
				$resource = $this->getURL( ONAPP_GETRESOURCE_LOAD ) . '/change_owner';
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
				$resource = $this->getURL( ONAPP_GETRESOURCE_LOAD ) . '/rebuild_network';
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
				$resource = $this->getURL( ONAPP_GETRESOURCE_LOAD ) . '/startup';
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
				$resource = $this->getURL( ONAPP_GETRESOURCE_LOAD ) . '/unlock';
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

				$resource = $this->getURL( ONAPP_GETRESOURCE_LOAD ) . '/migrate';
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
				$resource = $this->getURL( ONAPP_GETRESOURCE_LOAD ) . '/suspend';
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
				$resource = $this->getURL( ONAPP_GETRESOURCE_LOAD ) . '/build';
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
				$resource = $this->getURL( ONAPP_GETRESOURCE_LOAD ) . '/reset_password';
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
				$resource = '/users/' . $this->user_id . '/virtual_machines';
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
				$resource = parent::getURL( $action );
		}

		$actions = array(
			ONAPP_GETRESOURCE_REBOOT,
			ONAPP_GETRESOURCE_SHUTDOWN,
			ONAPP_GETRESOURCE_STARTUP,
			ONAPP_GETRESOURCE_UNLOCK,
			ONAPP_GETRESOURCE_BUILD,
			ONAPP_ACTIVATE_GETLIST_USER,
			ONAPP_GETRESOURCE_SUSPEND_VM,
			ONAPP_RESET_ROOT_PASSWORD
		);

		if( in_array( $action, $actions ) ) {
			$this->logger->logDebug( 'getURL( ' . $action . ' ): return ' . $resource );
		}

		return $resource;
	}

	/**
	 * Reboot Virtual machine
	 *
	 * @param mixed $recovery reboot mode
	 */
	public function reboot( $recovery = false ) {
		if( ! $recovery ) {
			$this->sendPost( ONAPP_GETRESOURCE_REBOOT, '' );
		}
		else {
			$data = array(
				'root' => 'mode',
				'data' => 'recovery',
			);

			$this->sendPost( ONAPP_GETRESOURCE_REBOOT, $data );
		}
	}

	/**
	 * Set|Reset Virtual Machine Root Password
	 *
	 * @param string|null $newPassword new password
	 *
	 * @return object
	 */
	public function reset_password( $newPassword = null ) {
		if( $newPassword ) {
			$this->initial_root_password = $newPassword;
			//$this->initial_root_password_confirmation = $newPassword;
			$newPassword = array(
				'root' => $this->rootElement,
				'data' => array( 'initial_root_password' => $newPassword ),
			);
		}
		return $this->sendPost( ONAPP_RESET_ROOT_PASSWORD, $newPassword );
	}

	/**
	 * Suspends Virtual Machine
	 */
	public function suspend() {
		$this->sendPost( ONAPP_GETRESOURCE_SUSPEND_VM, '' );
	}

	/**
	 * Stop Virtual Machine
	 */
	public function shutdown() {
		$this->sendPost( ONAPP_GETRESOURCE_SHUTDOWN, '' );
	}

	/**
	 * Migrates Virtual Machine to the other hypervisor
	 *
	 * @param int $id            virtual machine id
	 * @param int $hypervisor_id destination hypervisor id
	 */
	public function migrate( $id, $hypervisor_id ) {
		if( $id ) {
			$this->id = $id;
		}

		//todo add check for cold migrate
		$data = array(
			'root' => 'tmp_holder',
			'data' => array(
				'destination' => $hypervisor_id,
			),
		);

		$this->sendPost( ONAPP_GETRESOURCE_MIGRATE, $data );
	}

	/**
	 * Change Virtual Machine Owner
	 *
	 * @param int|bool $user_id
	 *
	 * @return response object
	 */
	public function change_owner( $user_id = false ) {
		if( ! $user_id ) {
			$this->sendPost( ONAPP_GETRESOURCE_STARTUP );
		}
		else {
			$data = array(
				'root' => 'tmp_holder',
				'data' => array(
					'user_id' => $user_id
				)
			);

			$this->sendPost( ONAPP_GETRESOURCE_CHANGE_OWNER, $data );
		}
		return $this->loadedObject;
	}

	/**
	 * Rebuilds network for virtual machine
	 */
	public function rebuild_network() {
		$this->sendPost( ONAPP_GETRESOURCE_REBUILD_NETWORK );
	}

	/**
	 * Start Virtual machine
	 *
	 * @param int|bool $recovery
	 *
	 * @return object response object
	 */
	public function startup( $recovery = false ) {
		if( ! $recovery ) {
			$this->sendPost( ONAPP_GETRESOURCE_STARTUP, '' );
		}
		else {
			$data = array(
				'root' => 'tmp_holder',
				'data' => array(
					'mode' => 'recovery'
				)
			);

			$this->sendPost( ONAPP_GETRESOURCE_STARTUP, $data );
		}
		return $this->loadedObject;
	}

	/**
	 * Unlock Virtual machine
	 */
	public function unlock() {
		$this->sendPost( ONAPP_GETRESOURCE_UNLOCK );
	}

	/**
	 * Build or rebuild Virtual machine
	 */
	public function build() {
		if( $this->getOnAppVersion() < 2.3 ) {
			if( isset( $this->template_id ) && ( $this->template_id != $this->loadedObject->template_id ) ) {
				$data = array(
					'root' => 'virtual_machine',
					'data' => array(
						'template_id'      => $this->template_id,
						'required_startup' => $this->required_startup
					)
				);
			}
			else {
				$data = array(
					'root' => 'virtual_machine',
					'data' => array(
						'required_startup' => $this->required_startup
					)
				);
			}
		}
		else {
			$data = array(
				'root' => 'virtual_machine',
				'data' => array(
					'template_id'      => $this->template_id ? $this->template_id : $this->loadedObject->template_id,
					'required_startup' => $this->required_startup
				)
			);
		}

		$this->sendPost( ONAPP_GETRESOURCE_BUILD, $data );
	}

	/**
	 * Sends an API request to get the Objects. After requesting,
	 * unserializes the received response into the array of Objects
	 *
	 * @param null|int $user_id
	 * @param null     $url_args
	 *
	 * @return array|bool|null
	 */
	public function getList( $user_id = null, $url_args = null ) {
		//todo rewrite to use parent method
		if( is_null( $user_id ) ) {
			return parent::getList( $user_id, $url_args );
		}
		else {
			$this->activate( ONAPP_ACTIVATE_GETLIST );

			$this->logger->logMessage( 'getList: Get Transaction list.' );

			$this->user_id = $user_id;

			$this->setAPIResource( $this->getURL( ONAPP_ACTIVATE_GETLIST_USER ) );

			$response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

			$result = $this->doCastResponseToClass( $response );

			if( ! empty( $response[ 'errors' ] ) ) {
				//todo test this stuff
				//$this->errors = $result->errors;
				return false;
			}
			if( ! is_array( $result ) && ! is_null( $result ) ) {
				$result = array( $result );
			}
			return $result;
		}
	}

	/**
	 * Save Object in to your account.
	 */
	public function save() {
		if( ! is_null( $this->id ) ) {
			parent::save();
			return;
		}

		parent::save();
	}

	/**
	 * Edit Administrator's Note
	 *
	 * @param int    $id         virtual machine id
	 * @param string $admin_note Administrator's Note
	 *
	 * @return void
	 */
	public function editAdminNote( $id, $admin_note ) {
		if( $admin_note ) {
			$this->admin_note = $admin_note;
		}

		if( $id ) {
			$this->id = $id;
		}
		parent::save();
	}
}