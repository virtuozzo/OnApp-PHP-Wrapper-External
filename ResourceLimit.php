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
 * @copyright   (c) 2011 OnApp
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
class OnApp_ResourceLimit extends OnApp {
	/**
	 * Magic properties
	 *
	 * @property integer  cpu_shares
	 * @property integer  cpus
	 * @property datetime created_at
	 * @property integer  disk_size
	 * @property integer  memory
	 * @property datetime updated_at
	 * @property integer  user_id
	 * @property integer  storage_disk_size
	 * @property integer  virtual_machines_count
	 * @property integer  ip_address_count
	 * @property integer  ip_address_mask
	 * @property integer  backups_templates_count
	 * @property integer  rate
	 */

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $_tagRoot = 'resource_limit';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $_resource = 'resource_limit';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}

	/**
	 * Returns the URL Alias of the API Class that inherits the OnApp class
	 *
	 * @return string API resource
	 * @access public
	 */
	function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
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
				if( is_null( $this->_user_id ) && is_null( $this->_obj->_user_id ) ) {
					$this->logger->error(
						"getResource($action): argument _user_id not set.",
						__FILE__,
						__LINE__
					);
				}
				else {
					if( is_null( $this->_user_id ) ) {
						$this->_user_id = $this->_obj->_user_id;
					}
				}
				$resource = 'users/' . $this->_user_id . '/' . $this->_resource;
				break;

			case ONAPP_GETRESOURCE_LOAD:
				$resource = $this->getResource();
				break;

			default:
				$resource = parent::getResource( $action );
				break;
		}

		$actions = array(
			ONAPP_GETRESOURCE_DEFAULT,
			ONAPP_GETRESOURCE_LOAD,
			ONAPP_GETRESOURCE_EDIT,
		);
		if( in_array( $action, $actions ) ) {
			$this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
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
	 * @access public
	 */
	function load( $user_id = null ) {
		if( is_null( $user_id ) && ! is_null( $this->_user_id ) ) {
			$user_id = $this->_user_id;
		}

		if( is_null( $user_id ) &&
			isset( $this->_obj ) &&
			! is_null( $this->_obj->_user_id )
		) {
			$user_id = $this->_obj->_user_id;
		}

		$this->logger->add( 'load: Load class ( id => ' . $user_id . ').' );

		if( ! is_null( $user_id ) ) {
			$this->_user_id = $user_id;

			$this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_LOAD ) );

			$response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

			$result = $this->_castResponseToClass( $response );

			$this->_obj     = $result;
			$this->_user_id = $this->_obj->_user_id;

			return $result;
		}
		else {
			$this->logger->error(
				'load: argument _user_id not set.',
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
	 * @access public
	 */
	function save() {
		if( isset( $this->_user_id ) ) {
			$obj = $this->_edit();

			if( isset( $obj ) && ! isset( $obj->errors ) ) {
				$this->load();
			}
		}
	}

	function activate( $action_name ) {
		switch( $action_name ) {
			case ONAPP_ACTIVATE_DELETE:
				exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
				break;
		}
	}
}