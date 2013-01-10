<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * VM Backups
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  VirtualMachine
 * @author      Vitaliy Kondratyuk
 * @copyright   (c) 2012 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * @todo: Add description
 */
define( 'ONAPP_GETRESOURCE_BACKUP_CONVERT', 'convert' );

/**
 * @todo: Add description
 */
define( 'ONAPP_GETRESOURCE_BACKUP_RESTORE', 'restore' );

/**
 * @todo: Add description
 */
define( 'ONAPP_GETRESOURCE_DISK_BACKUPS', 'disk_backups' );

/**
 * VM Backups
 *
 * This class represents the Backups which have been taken or are waiting to be taken for Virtual Machine.
 *
 * The OnApp_VirtualMachine_Backup class uses the following basic methods:
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
 * @property string   $built_at
 * @property integer  $disk_id
 * @property string   $operating_system
 * @property string   $operating_system_distro
 * @property integer  $template_id
 * @property string   $backup_type
 * @property boolean  $allow_resize_without_reboot
 * @property integer  $backup_size
 * @property string   $identifier
 * @property integer  $min_disk_size
 * @property boolean  $built
 * @property boolean  $locked
 * @property boolean  $allowed_hot_migrate
 * @property boolean  $allowed_swap
 * @property integer  $backup_server_id
 */
class OnApp_VirtualMachine_Backup extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'backup';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'backups';

	/**
	 * Returns the URL Alias of the API Class that inherits the OnApp class
	 *
	 * @param string $action action name
	 *
	 * @return string API resource
	 */
	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		$show_log_msg = true;
		switch( $action ) {
			case ONAPP_GETRESOURCE_DEFAULT:
				/**
				 * ROUTE :
				 *
				 * @name virtual_machine_backups
				 * @method GET
				 * @alias   /virtual_machines/:virtual_machine_id/backups(.:format)
				 * @format  {:controller=>"backups", :action=>"index"}
				 */
				if( is_null( $this->virtual_machine_id ) && is_null( $this->loadedObject->virtual_machine_id ) ) {
					$this->logger->logError(
						'getURL( ' . $action . ' ): property virtual_machine_id not set.',
						__FILE__,
						__LINE__
					);
				}
				else {
					if( is_null( $this->virtual_machine_id ) ) {
						$this->virtual_machine_id = $this->loadedObject->virtual_machine_id;
					}
				}

				$resource = 'virtual_machines/' . $this->virtual_machine_id . '/' . $this->URLPath;
				break;

			case ONAPP_GETRESOURCE_ADD:
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method POST
				 * @alias   /virtual_machines/:virtual_machine_id/backups(.:format)
				 * @format  {:controller=>"backups", :action=>"create"}
				 */
				if( is_null( $this->disk_id ) && is_null( $this->loadedObject->disk_id ) ) {
					$this->logger->logError(
						'getURL( ' . $action . ' ): property disk_id not set.',
						__FILE__,
						__LINE__
					);
				}
				else {
					if( is_null( $this->disk_id ) ) {
						$this->disk_id = $this->loadedObject->disk_id;
					}
				}

				$resource = 'settings/disks/' . $this->disk_id . '/' . $this->URLPath;
				break;

			case ONAPP_GETRESOURCE_DISK_BACKUPS:
				/**
				 * ROUTE :
				 *
				 * @name disk_backups
				 * @method GET
				 * @alias  /settings/disks/:disk_id/backups(.:format)
				 * @format {:controller=>"backups", :action=>"index"}
				 */
				$resource = 'settings/disks/' . $this->disk_id . '/' . $this->URLPath;
				break;

			case ONAPP_GETRESOURCE_LOAD:
			case ONAPP_GETRESOURCE_DELETE:
				/**
				 * ROUTE :
				 *
				 * @name backup
				 * @method GET
				 * @alias   /backups/:id(.:format)
				 * @format  {:controller=>"backups", :action=>"show"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method DELETE
				 * @alias    /backups/:id(.:format)
				 * @format   {:controller=>"backups", :action=>"destroy"}
				 */
				if( is_null( $this->id ) && is_null( $this->loadedObject->id ) ) {
					$this->logger->logError(
						'getURL( ' . $action . ' ): property id not set.',
						__FILE__,
						__LINE__
					);
				}
				else {
					if( is_null( $this->id ) ) {
						$this->id = $this->loadedObject->id;
					}
				}

				return $this->URLPath . '/' . $this->id;

			case ONAPP_GETRESOURCE_BACKUP_CONVERT:
				/**
				 * ROUTE :
				 *
				 * @name convert_backup
				 * @method GET
				 * @alias    /backups/:id/convert(.:format)
				 * @format   {:controller=>"backups", :action=>"convert"}
				 */
				$resource = $this->getURL( ONAPP_GETRESOURCE_LOAD ) . '/convert';
				break;

			case ONAPP_GETRESOURCE_BACKUP_RESTORE:
				/**
				 * ROUTE :
				 *
				 * @name restore_backup
				 * @method POST
				 * @alias     /backups/:id/restore(.:format)
				 * @format    {:controller=>"backups", :action=>"restore"}
				 */
				$resource = $this->getURL( ONAPP_GETRESOURCE_LOAD ) . '/restore';
				break;

			default:
				$resource     = parent::getURL( $action );
				$show_log_msg = false;
		}

		if( $show_log_msg ) {
			$this->logger->logDebug( 'getURL( ' . $action . ' ): return ' . $resource );
		}

		return $resource;
	}

	/**
	 * Sends an API request to get the Objects. After requesting,
	 * unserializes the received response into the array of Objects
	 *
	 * @param integer $virtual_machine_id Virtual Machine id
	 * @param mixed   $url_args           additional parameters
	 *
	 * @return mixed an array of Object instances on success. Otherwise false
	 */
	function getList( $virtual_machine_id = null, $url_args = null ) {
		if( is_null( $virtual_machine_id ) && ! is_null( $this->virtual_machine_id ) ) {
			$virtual_machine_id = $this->virtual_machine_id;
		}

		if( ! is_null( $virtual_machine_id ) ) {
			$this->virtual_machine_id = $virtual_machine_id;
			return parent::getList( $virtual_machine_id, $url_args );
		}
		else {
			$this->logger->logError(
				'getList: property virtual_machine_id not set.',
				__FILE__,
				__LINE__
			);
		}
	}

	/**
	 * Gets Backups List by Disk Id
	 *
	 * @param mixed $disk_id Disk Id
	 *
	 * @return response object
	 */
	function diskBackups( $disk_id = null ) {
		if( $disk_id ) {
			$this->disk_id = $disk_id;
		}

		$this->setAPIResource( $this->getURL( ONAPP_GETRESOURCE_DISK_BACKUPS ) );

		$response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

		if( ! empty( $response[ 'errors' ] ) ) {
			$this->errors = $response[ 'errors' ];
			return false;
		}

		$result = $this->doCastResponseToClass( $response );

		return ( is_array( $result ) || ! $result ) ? $result : array( $result );
	}

	/**
	 * Convert backup to template
	 *
	 * @param string $label The label of new template
	 *
	 * @return mixed serialized Object instance from API
	 */
	function convert( $label ) {
		$this->logger->logMessage( 'Convert backup to template.' );
		$this->label = $label;
		$data        = array(
			'root' => $this->rootElement,
			'data' => array(
				'label' => $label,
				'id'    => $this->id
			)
		);
		// workaround because we get template data in response
		$this->rootElement = 'image_template';
		$this->className   = 'OnApp_Template';
		$this->sendPost( ONAPP_GETRESOURCE_BACKUP_CONVERT, $data );
	}

	/**
	 * Restore backup
	 */
	function restore() {
		$this->setAPIResource( $this->getURL( ONAPP_GETRESOURCE_BACKUP_RESTORE ) );
		$result                = $this->sendRequest( ONAPP_REQUEST_METHOD_POST );
		$this->loadedObject = $result;
	}
}