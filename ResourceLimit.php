<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Resource Limit
 *
 * With OnApp you can assign resource limits to users. This will prevent users from exceeding the resources you specify.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   (c) 2012 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Manages Resource Limit
 *
 * This class represents the resource limits set to users.
 *
 * The OnApp_ResourceLimit class uses the following basic methods:
 * {@link load}, {@link save} and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property integer  $cpu_shares
 * @property integer  $cpus
 * @property string   $created_at
 * @property integer  $disk_size
 * @property integer  $memory
 * @property string   $updated_at
 * @property integer  $user_id
 * @property integer  $storage_disk_size
 * @property integer  $virtual_machines_count
 * @property integer  $ip_address_count
 * @property integer  $ip_address_mask
 * @property integer  $backups_templates_count
 * @property integer  $rate
 */
class OnApp_ResourceLimit extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'resource_limit';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'resource_limit';

	/**
	 * Returns the URL Alias of the API Class that inherits the OnApp class
	 *
	 * @param string $action action name
	 *
	 * @return string API resource
	 */
	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			case ONAPP_GETRESOURCE_DEFAULT:
			case ONAPP_GETRESOURCE_EDIT:
				/**
				 * ROUTE :
				 *
				 * @name user_resource_limit
				 * @method GET
				 * @alias   /users/:user_id/resource_limit(.:format)
				 * @format  {:controller=>"resource_limits", :action=>"show"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name user_resource_limit
				 * @method GET
				 * @alias   /users/:user_id/resource_limit(.:format)
				 * @format  {:controller=>"resource_limits", :action=>"update"}
				 */
				if( is_null( $this->user_id ) && is_null( $this->loadedObject->user_id ) ) {
					$this->logger->logError(
						'getURL( ' . $action . ' ): property user_id not set.',
						__FILE__,
						__LINE__
					);
				}
				else {
					if( is_null( $this->user_id ) ) {
						$this->user_id = $this->loadedObject->user_id;
					}
				}
				$resource = 'users/' . $this->user_id . '/' . $this->URLPath;
				break;

			case ONAPP_GETRESOURCE_LOAD:
				$resource = $this->getURL();
				break;

			default:
				$resource = parent::getURL( $action );
		}

		$actions = array(
			ONAPP_GETRESOURCE_DEFAULT,
			ONAPP_GETRESOURCE_LOAD,
			ONAPP_GETRESOURCE_EDIT,
		);
		if( in_array( $action, $actions ) ) {
			$this->logger->logDebug( 'getURL( ' . $action . ' ): return ' . $resource );
		}

		return $resource;
	}

	/**
	 * Sends an API request to get the Object after sending,
	 * unserializes the response into an object
	 *
	 * The key field Parameter ID is used to load the Object. You can re-set
	 * this parameter in the class inheriting OnApp class.
	 *
	 * @param integer $id Object id
	 *
	 * @return object serialized Object instance from API
	 */
	public function load( $user_id = null ) {
		if( is_null( $user_id ) && ! is_null( $this->user_id ) ) {
			$user_id = $this->user_id;
		}

		if( is_null( $user_id ) &&
			isset( $this->loadedObject ) &&
			! is_null( $this->loadedObject->user_id )
		) {
			$user_id = $this->loadedObject->user_id;
		}

		$this->logger->logMessage( 'load: Load class ( id => ' . $user_id . ').' );

		if( ! is_null( $user_id ) ) {
			$this->user_id = $user_id;

			$this->setAPIResource( $this->getURL( ONAPP_GETRESOURCE_LOAD ) );

			$result                = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );
			$this->loadedObject = $result;
			$this->user_id         = $this->loadedObject->user_id;

			return $result;
		}
		else {
			$this->logger->logError(
				'load: property user_id not set.',
				__FILE__,
				__LINE__
			);
		}
	}

	/**
	 * The method saves an Object to your account
	 *
	 * After sending an API request to create an object or change the data in
	 * the existing object, the method checks the response and loads the
	 * exisitng object with the new data.
	 *
	 * @return void
	 */
	public function save() {
		if( isset( $this->user_id ) ) {
			$obj = $this->editObject();

			if( isset( $obj ) && ! isset( $obj->errors ) ) {
				$this->load();
			}
		}
	}

	public function activate( $action_name ) {
		switch( $action_name ) {
			case ONAPP_ACTIVATE_DELETE:
				exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
		}
	}
}