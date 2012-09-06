<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing User Payments
 *
 * Payments list the invoices paid by the users.
 * Once the invoice is paid, you have to put it to the system to keep track of
 * them.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * User Payments
 *
 * This class represents the user payments entered to the system.
 *
 * The OnApp_Payment class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property integer  $id
 * @property decimal  $amount
 * @property string   $created_at
 * @property string   $invoice_number
 * @property string   $updated_at
 * @property integer  $user_id
 */
class OnApp_Payment extends OnApp {

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'payment';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'payments';

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
				 * @name    /users/:user_id/payments(.:format)
				 * @method GET
				 * @alias   /virtual_machines(.:format)
				 * @format  {:controller=>"payments", :action=>"index"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name user_payment
				 * @method GET
				 * @alias    /users/:user_id/payments/:id(.:format)
				 * @format   {:controller=>"payments", :action=>"show"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method POST
				 * @alias   /users/:user_id/payments(.:format)
				 * @format  {:controller=>"payments", :action=>"create"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method PUT
				 * @alias   /users/:user_id/payments/:id(.:format)
				 * @format  {:controller=>"payments", :action=>"update"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method DELETE
				 * @alias   /users/:user_id/payments/:id(.:format)
				 * @format  {:controller=>"payments", :action=>"destroy"}
				 */
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
	function getList( $user_id = NULL, $url_args = NULL ) {
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
	 * Sends an API request to get the Object after sending,
	 * unserializes the response into an object
	 *
	 * The key field Parameter ID is used to load the Object. You can re-set
	 * this parameter in the class inheriting OnApp class.
	 *
	 * @param integer $id      Payment ID
	 * @param integer $user_id User ID
	 *
	 * @return mixed serialized Object instance from API
	 * @access public
	 */
	function load( $id = NULL, $user_id = NULL ) {
		if( is_null( $user_id ) && ! is_null( $this->_user_id ) ) {
			$user_id = $this->_user_id;
		}

		if( is_null( $id ) && ! is_null( $this->_id ) ) {
			$id = $this->_id;
		}

		if( is_null( $id ) &&
			isset( $this->inheritedObject ) &&
			! is_null( $this->inheritedObject->_id )
		) {
			$id = $this->inheritedObject->_id;
		}

		$this->logger->add( 'load: Load class ( id => ' . $id . ' ).' );

		if( ! is_null( $id ) && ! is_null( $user_id ) ) {
			$this->_id      = $id;
			$this->_user_id = $user_id;

			$this->setAPIResource( $this->getURL( ONAPP_GETRESOURCE_LOAD ) );

			$response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

			$result = $this->_castResponseToClass( $response );

			$this->inheritedObject = $result;

			return $result;
		}
		else {
			if( is_null( $id ) ) {
				$this->logger->error(
					'load: argument _id not set.',
					__FILE__,
					__LINE__
				);
			}
			else {
				$this->logger->error(
					'load: argument _user_id not set.',
					__FILE__,
					__LINE__
				);
			}
		}
	}
}