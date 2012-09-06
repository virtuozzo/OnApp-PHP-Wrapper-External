<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * VM Backups
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  VirtualMachine
 * @author      Vitaliy Kondratyuk
 * @copyright   (c) 2011 OnApp
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

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}

	/**
	 * Returns the URL Alias of the API Class that inherits the OnApp class
	 *
	 * @param string $action action name
	 *
	 * @return string API resource
	 * @access public
	 */
	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		$show_log_msg = TRUE;
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
				if( is_null( $this->_virtual_machine_id ) && is_null( $this->inheritedObject->_virtual_machine_id ) ) {
					$this->logger->error(
						'getURL( ' . $action . ' ): property virtual_machine_id not set.',
						__FILE__,
						__LINE__
					);
				}
				else {
					if( is_null( $this->_virtual_machine_id ) ) {
						$this->_virtual_machine_id = $this->inheritedObject->_virtual_machine_id;
					}
				}

				$resource = 'virtual_machines/' . $this->_virtual_machine_id . '/' . $this->URLPath;
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
				if( is_null( $this->_disk_id ) && is_null( $this->inheritedObject->_disk_id ) ) {
					$this->logger->error(
						'getURL( ' . $action . ' ): property disk_id not set.',
						__FILE__,
						__LINE__
					);
				}
				else {
					if( is_null( $this->_disk_id ) ) {
						$this->_disk_id = $this->inheritedObject->_disk_id;
					}
				}

				$resource = 'settings/disks/' . $this->_disk_id . '/' . $this->URLPath;
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
				$resource = 'settings/disks/' . $this->_disk_id . '/' . $this->URLPath;
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
				if( is_null( $this->_id ) && is_null( $this->inheritedObject->_id ) ) {
					$this->logger->error(
						'getURL( ' . $action . ' ): property id not set.',
						__FILE__,
						__LINE__
					);
				}
				else {
					if( is_null( $this->_id ) ) {
						$this->_id = $this->inheritedObject->_id;
					}
				}

				return $this->URLPath . '/' . $this->_id;

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
				$show_log_msg = FALSE;
		}

		if( $show_log_msg ) {
			$this->logger->debug( 'getURL( ' . $action . ' ): return ' . $resource );
		}

		return $resource;
	}

	/**
	 * Sends an API request to get the Objects. After requesting,
	 * unserializes the received response into the array of Objects
	 *
	 * @param integer $virtual_machine_id Virtual Machine id
	 *
	 * @return mixed an array of Object instances on success. Otherwise false
	 * @access public
	 */
	function getList( $virtual_machine_id = NULL, $url_args = NULL ) {
		if( is_null( $virtual_machine_id ) && ! is_null( $this->_virtual_machine_id ) ) {
			$virtual_machine_id = $this->_virtual_machine_id;
		}

		if( ! is_null( $virtual_machine_id ) ) {
			$this->_virtual_machine_id = $virtual_machine_id;
			return parent::getList( $virtual_machine_id, $url_args );
		}
		else {
			$this->logger->error(
				'getList: argument virtual_machine_id not set.',
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
	function diskBackups( $disk_id = NULL ) {
		if( $disk_id ) {
			$this->_disk_id = $disk_id;
		}

		$this->setAPIResource( $this->getURL( ONAPP_GETRESOURCE_DISK_BACKUPS ) );

		$response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

		if( ! empty( $response[ 'errors' ] ) ) {
			$this->errors = $response[ 'errors' ];
			return FALSE;
		}

		$result = $this->castStringToClass( $response );

		return ( is_array( $result ) || ! $result ) ? $result : array( $result );
	}

	/**
	 * Convert backup to template
	 *
	 * @param string $label The label of new template
	 *
	 * @return mixed serialized Object instance from API
	 * @access public
	 */
	function convert( $label ) {
		$this->logger->add( 'Convert backup to template.' );
		$this->label = $label;
		$data        = array(
			'root' => $this->rootElement,
			'data' => array(
				'label' => $label,
				'id'    => $this->_id
			)
		);
		// workaround because we get template data in response
		$this->rootElement = 'image_template';
		$this->className   = 'OnApp_Template';
		//todo check this code
		//$template          = new OnApp_Template();
		//$this->fields      = $template->getClassFields();
		$this->sendPost( ONAPP_GETRESOURCE_BACKUP_CONVERT, $data );
	}

	/**
	 * Restore backup
	 *
	 * @access public
	 */
	function restore() {
		$this->setAPIResource( $this->getURL( ONAPP_GETRESOURCE_BACKUP_RESTORE ) );
		$response              = $this->sendRequest( ONAPP_REQUEST_METHOD_POST );
		$result                = $this->_castResponseToClass( $response );
		$this->inheritedObject = $result;
	}
}