<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * User Statistics
 *
 * @todo        write description
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  User
 * @author      Yakubskiy Yuriy
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * User IP User Statistics
 *
 *  The OnApp_User_Statistics class uses the following basic methods:
 *  {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property float backup_cost
 * @property float vm_cost
 * @property float monit_cost
 * @property float storage_disk_size_cost
 * @property float user_resources_cost
 * @property float template_cost
 * @property float total_cost
 * @property float edge_group_cost
 */
class OnApp_User_Statistics extends OnApp {
	public static $nestedData = array(
		'vm_stats' => 'User_Statistics_VmStat',
	);

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'user_stat';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'user_statistics';

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
		switch( $action ) {
			case ONAPP_GETRESOURCE_DEFAULT:
				/**
				 * ROUTE :
				 *
				 * @name user_vm_stats
				 * @method GET
				 * @alias   /users/:user_id/vm_stats(.:format)
				 * @format  {:controller=>"vm_stats", :action=>"index"}
				 */
				if( is_null( $this->_user_id ) && is_null( $this->inheritedObject->_user_id ) ) {
					$this->logger->error(
						'getURL( ' . $action . ' ): argument user_id not set.',
						__FILE__,
						__LINE__
					);
				}
				else {
					if( is_null( $this->_user_id ) ) {
						$this->_user_id = $this->inheritedObject->_user_id;
					}
				}
				$resource = 'users/' . $this->_user_id . '/' . $this->URLPath;
				$this->logger->debug( 'getURL( ' . $action . ' ): return ' . $resource );
				break;

			default:
				$resource = parent::getURL( $action );
		}

		return $resource;
	}

	/**
	 * Sends an API request to get the Objects. After requesting,
	 * unserializes the received response into the array of Objects
	 *
	 * @param integer $user_id User ID
	 *
	 * @return mixed an array of Object instances on success. Otherwise false
	 * @access public
	 */
	function getList( $user_id = NULL, $url_args = array() ) {
		if( is_null( $user_id ) && ! is_null( $this->_user_id ) ) {
			$user_id = $this->_user_id;
		}

		if( ! is_null( $user_id ) ) {
			$this->_user_id = $user_id;

			return parent::getList( $user_id, $url_args );
		}
		else {
			$this->logger->error(
				'getList: argument _user_id not set.',
				__FILE__,
				__LINE__
			);
		}
	}

	/**
	 * Activates action performed with object
	 *
	 * @param string $action_name the name of action
	 *
	 * @access public
	 */
	function activate( $action_name ) {
		switch( $action_name ) {
			case ONAPP_ACTIVATE_LOAD:
			case ONAPP_ACTIVATE_SAVE:
			case ONAPP_ACTIVATE_DELETE:
				$this->logger->error( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()',
					__FILE__,
					__LINE__
				);
		}
	}
}