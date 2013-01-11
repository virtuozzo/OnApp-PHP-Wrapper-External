<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Disks
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Vitaliy Kondratyuk
 * @copyright   (c) 2012 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

define( 'ONAPP_GETRESOURCE_AUTOBACKUP_ENABLE', 'autobackup_enable' );

define( 'ONAPP_GETRESOURCE_AUTOBACKUP_DISABLE', 'autobackup_disable' );

define( 'ONAPP_GETRESOURCE_TAKE_BACKUP', 'backups' );

/**
 * Managing Disks
 *
 * The OnApp_Disk class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property integer  $id
 * @property string   $created_at
 * @property string   $updated_at
 * @property boolean  $add_to_linux_fstab
 * @property integer  $disk_size
 * @property boolean  $primary
 * @property integer  $data_store_id
 * @property integer  $disk_vm_number
 * @property boolean  $is_swap
 * @property string   $mount_point
 * @property string   $identifier
 * @property integer  $virtual_machine_id
 * @property boolean  $built
 * @property boolean  $locked
 * @property boolean  $has_autobackups
 */
class OnApp_Disk extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'disk';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'settings/disks';

	/**
	 * Returns the URL Alias of the API Class that inherits the OnApp class
	 *
	 * @param string $action action name
	 *
	 * @return string API resource
	 */
	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			case ONAPP_GETRESOURCE_LIST:
				/**
				 * ROUTE :
				 *
				 * @name virtual_machine_disks
				 * @method GET
				 * @alias  /virtual_machines/:virtual_machine_id/disks(.:format)
				 * @format {:controller=>"disks", :action=>"index"}
				 */
				$resource = $this->virtual_machine_id ?
					'virtual_machines/' . $this->virtual_machine_id . '/disks' :
					$this->getURL();
				break;

			case ONAPP_GETRESOURCE_ADD:
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method POST
				 * @alias     /virtual_machines/:virtual_machine_id/disks(.:format)
				 * @format    {:controller=>"disks", :action=>"create"}
				 */
				if( is_null( $this->virtual_machine_id ) ) {
					$this->logger->logError(
						'getURL( ' . $action . ' ): property virtual_machine_id not set.',
						__FILE__,
						__LINE__
					);
				}
				else {
					$resource = 'virtual_machines/' . $this->virtual_machine_id . '/disks';
				}
				break;

			case ONAPP_GETRESOURCE_AUTOBACKUP_ENABLE:
				/**
				 * ROUTE :
				 *
				 * @name autobackup_enable_disk
				 * @method POST
				 * @alias     /settings/disks/:id/autobackup_enable(.:format)
				 * @format    {:controller=>"disks", :action=>"autobackup_enable"}
				 */
				$resource = $this->getURL( ONAPP_GETRESOURCE_LOAD ) . '/autobackup_enable';
				break;

			case ONAPP_GETRESOURCE_AUTOBACKUP_DISABLE:
				/**
				 * ROUTE :
				 *
				 * @name autobackup_disable_disk
				 * @method POST
				 * @alias  /settings/disks/:id/autobackup_disable(.:format)
				 * @format {:controller=>"disks", :action=>"autobackup_disable"}
				 */
				$resource = $this->getURL( ONAPP_GETRESOURCE_LOAD ) . '/autobackup_disable';
				break;

			case ONAPP_GETRESOURCE_TAKE_BACKUP:
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method POST
				 * @alias  /settings/disks/:disk_id/backups(.:format)
				 * @format {:controller=>"backups", :action=>"create"}
				 */
				$resource = $this->getURL( ONAPP_GETRESOURCE_LOAD ) . '/backups';
				break;

			default:
				/**
				 * ROUTE :
				 *
				 * @name disks
				 * @method GET
				 * @alias     /settings/disks(.:format)
				 * @format    {:controller=>"disks", :action=>"index"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name disk
				 * @method GET
				 * @alias     /settings/disks/:id(.:format)
				 * @format    {:controller=>"disks", :action=>"show"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method POST
				 * @alias     /settings/disks(.:format)
				 * @format    {:controller=>"disks", :action=>"create"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method PUT
				 * @alias  /settings/disks/:id(.:format)
				 * @format {:controller=>"disks", :action=>"update"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method DELETE
				 * @alias  /settings/disks/:id(.:format)
				 * @format {:controller=>"disks", :action=>"destroy"}
				 */
				$resource = parent::getURL( $action );
		}

		$actions = array(
			ONAPP_GETRESOURCE_LIST,
			ONAPP_GETRESOURCE_ADD,
			ONAPP_GETRESOURCE_AUTOBACKUP_ENABLE,
			ONAPP_GETRESOURCE_AUTOBACKUP_DISABLE,
		);

		if( in_array( $action, $actions ) ) {
			$this->logger->logDebug( 'getURL( ' . $action . ' ): return ' . $resource );
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
	public function enableAutobackup( $id = null ) {
		if( $id ) {
			$this->id = $id;
		}
		$this->sendPost( ONAPP_GETRESOURCE_AUTOBACKUP_ENABLE, '' );
	}

	/**
	 * Disable autobackup
	 *
	 * @param null $id
	 *
	 * @return void
	 */
	public function disableAutobackup( $id = null ) {
		if( $id ) {
			$this->id = $id;
		}

		$this->sendPost( ONAPP_GETRESOURCE_AUTOBACKUP_DISABLE, '' );
	}

	/**
	 * Sends an API request to get the Objects. After requesting,
	 * unserializes the received response into the array of Objects
	 *
	 * @param integer $vm_id VM ID
	 * @param mixed   $url_args
	 *
	 * @return mixed an array of Object instances on success. Otherwise false
	 */
	public function getList( $vm_id = null, $url_args = null ) {
		if( $vm_id ) {
			$this->virtual_machine_id = $vm_id;
		}
		return parent::getList( $vm_id, $url_args );
	}

	/**
	 * The method saves an Object to your account
	 *
	 * @return mixed Serialized API Response
	 */
	public function save() {
		//todo check this code
		if( $this->virtual_machine_id ) {
			$this->fields[ 'require_format_disk' ] = array(
				ONAPP_FIELD_MAP           => '_require_format_disk',
				ONAPP_FIELD_TYPE          => 'integer',
				ONAPP_FIELD_REQUIRED      => true,
				ONAPP_FIELD_DEFAULT_VALUE => false,
			);
		}

		if( $this->id ) {
			$this->fields[ 'add_to_linux_fstab' ][ ONAPP_FIELD_REQUIRED ] = false;
			$this->fields[ 'data_store_id' ][ ONAPP_FIELD_REQUIRED ]      = false;
			$this->fields[ 'is_swap' ][ ONAPP_FIELD_REQUIRED ]            = false;
			$this->fields[ 'mount_point' ][ ONAPP_FIELD_REQUIRED ]        = false;
		}

		parent::save();
	}

	/**
	 * Takes Disk Backup
	 *
	 * @param integer $disk_id Disk Id
	 *
	 * @return void
	 */
	public function takeBackup( $disk_id ) {
		if( $disk_id ) {
			$this->id = $disk_id;
		}
		// workaround because we get backup data in response
		$this->rootElement = 'backup';
		$this->className   = 'OnApp_VirtualMachine_Backup';
		$backup            = new OnApp_VirtualMachine_Backup();
		$this->fields      = $backup->getClassFields();
		$this->sendPost( ONAPP_GETRESOURCE_TAKE_BACKUP );
	}
}