<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * User Monthly Bill
 *
 * Root tag is missed in Json Ticket #2505
 *
 * @todo        write description
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  User
 * @author      Yakubskiy Yuriy
 * @copyright   (c) 2012 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * User Monthly Bills
 *
 * The OnApp_User_MonthlyBill class supports the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property float   $cost
 * @property integer $month
 */
class OnApp_User_MonthlyBill extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'vm_stat';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'monthly_bills';

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
				/**
				 * ROUTE :
				 *
				 * @name user_monthly_bills
				 * @method GET
				 * @alias   /users/:user_id/monthly_bills(.:format)
				 * @format  {:controller=>"monthly_bills", :action=>"index"}
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
				$this->logger->logDebug( 'getURL( ' . $action . ' ): return ' . $resource );
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
	 * @param integer $user_id  User ID
	 * @param mixed   $url_args additional parameters
	 *
	 * @return mixed an array of Object instances on success. Otherwise false
	 */
	public function getList( $user_id = null, $url_args = null ) {
		if( is_null( $user_id ) && ! is_null( $this->user_id ) ) {
			$user_id = $this->user_id;
		}

		if( ! is_null( $user_id ) ) {
			$this->user_id = $user_id;

			return parent::getList( $user_id, $url_args );
		}
		else {
			$this->logger->logError(
				'getList: property user_id not set.',
				__FILE__,
				__LINE__
			);
		}
	}

	/**
	 * Checks if method is supported
	 *
	 * @param string $action_name Action name
	 */
	public function activate( $action_name ) {
		switch( $action_name ) {
			case ONAPP_ACTIVATE_LOAD:
			case ONAPP_ACTIVATE_SAVE:
			case ONAPP_ACTIVATE_DELETE:
				exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
		}
	}
}