<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Transactions
 *
 * The system records in the database a detailed log of all the transactions
 * happening to your virtual machines. You can view the transactions output from
 * the Control Panel.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Transactions
 *
 * This class represents the Transactions of the OnApp installation.
 *
 * The OnApp_Transaction class uses the following basic methods:
 * {@link load} and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Transaction extends OnApp {
	/**
	 * Magic properties
	 *
	 * @property integer  id
	 * @property action
	 * @property actor
	 * @property datetime created_at
	 * @property integer  dependent_transaction_id
	 * @property log_output
	 * @property yaml     params
	 * @property integer  parent_id
	 * @property parent_type
	 * @property integer  pid
	 * @property integer  priority
	 * @property status
	 * @property datetime updated_at
	 * @property integer  user_id
	 * @property boolean  allowed_cancel
	 * @property string   identifier
	 * @property datetime start_after
	 * @property datetime started_at
	 */

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'transaction';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'transactions';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}

	function activate( $action_name ) {
		switch( $action_name ) {
			case ONAPP_ACTIVATE_SAVE:
			case ONAPP_ACTIVATE_DELETE:
				exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
		}
	}

	/**
	 * Sends an API request to get the Objects. After requesting,
	 * unserializes the received response into the array of Objects
	 *
	 * @param int $page
	 *
	 * @return the array of Object instances
	 */
	function getList( $page = 1, $url_args = NULL ) {
		$data = array(
			'root' => 'page',
			'data' => $page,
		);

		return parent::getList( $data, $url_args );
	}

	function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		return parent::getURL( $action );
		/**
		 * ROUTE :
		 *
		 * @name transactions
		 * @method GET
		 * @alias   /settings/nameservers(.:format)
		 * @format  {:controller=>"transactions", :action=>"index"}
		 */
		/**
		 * ROUTE :
		 *
		 * @name transaction
		 * @method GET
		 * @alias    /transactions/:id(.:format)
		 * @format   {:controller=>"transactions", :action=>"show"}
		 */
	}

	/**
	 * Load transaction with log_output
	 *
	 * @param type $id
	 *
	 * @return type
	 */
	function load_with_output( $id ) {
		$this->_id = $id;
		return $this->sendGet( ONAPP_GETRESOURCE_LOAD, NULL, array( 'log' => '' ) );
	}
}