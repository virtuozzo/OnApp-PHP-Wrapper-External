<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing VM Logs
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Yakubskiy Yuriy
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Vm Logs
 *
 * This class represents Vm logs
 *
 * The OnApp_Log class uses the following basic methods:
 * {@link load} and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property integer  $id
 * @property integer  $target_id
 * @property string   $created_at
 * @property string   $target_type
 * @property string   $updated_at
 * @property string   $action
 * @property string   $status
 */
class OnApp_Log extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'log_item';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'logs';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}

	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			case ONAPP_GETRESOURCE_DEFAULT:
				/**
				 * ROUTE :
				 *
				 * @name log_items
				 * @method GET
				 * @alias   /logs(.:format)
				 * @format  {:controller=>"log_items", :action=>"index"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name log_item
				 * @method GET
				 * @alias    /logs/:id(.:format)
				 * @format   {:controller=>"log_items", :action=>"show"}
				 */

				$this->logger->debug( 'getURL( ' . $action . ' ): return ' . $this->URLPath );
				break;

			default:
				$this->URLPath = parent::getURL( $action );
		}

		return $this->URLPath;
	}

	/**
	 * Sends an API request to get the Objects. After requesting,
	 * unserializes the received response into the array of Objects
	 *
	 * @param array $url_args
	 *
	 * @return mixed an array of Object instances on success. Otherwise false
	 * @access public
	 */
	function getList( $params = NULL, $url_args = NULL ) {
		return parent::getList( $params, $url_args );
	}

	function activate( $action_name ) {
		switch( $action_name ) {
			case ONAPP_ACTIVATE_SAVE:
			case ONAPP_ACTIVATE_DELETE:
				exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
		}
	}
}