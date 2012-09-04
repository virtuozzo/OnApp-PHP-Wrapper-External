<?php
/**
 * Managing Billing Plans
 *
 * Billing Plans are created to set prices for the resources so that users know how
 * much they will be charged per unit.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Lev Bartashevsky
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * TODO Add description
 */
define( 'ONAPP_GETRESOURCE_GETLIST_USERS', 'users' );

/**
 * TODO Add description
 */
define( 'ONAPP_GETRESOURCE_CREATE_COPY', 'copy' );

/**
 * Managing Billing Plans
 *
 * The OnApp_BillingPlan class represents the billing plans. The OnApp class is the parent of the BillingPlan class.
 *
 * The OnApp_BillingPlan class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_BillingPlan extends OnApp {
	/**
	 * Magic properties
	 *
	 * @property label
	 * @property datetime created_at
	 * @property datetime updated_at
	 * @property integer  id
	 * @property integer  monthly_price
	 * @property string   currency_code
	 * @property boolean  show_price
	 * @property boolean  allows_mak
	 * @property boolean  allows_kms
	 * @property boolean  allows_own
	 */

	public static $nestedData = array(
		'base_resources' => 'BillingPlan_BaseResource',
	);

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'billing_plan';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'billing_plans';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}

	function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			case ONAPP_GETRESOURCE_GETLIST_USERS:
				/**
				 * ROUTE :
				 *
				 * @name billing_plan_users
				 * @method GET
				 * @alias  /billing_plans/:billing_plan_id/users(.:format)
				 * @format {:controller=>"users", :action=>"index"}
				 */
				$resource = $this->getURL( ONAPP_GETRESOURCE_LOAD ) . '/users';
				break;

			case ONAPP_GETRESOURCE_CREATE_COPY:
				/**
				 * ROUTE :
				 *
				 * @name create_copy_billing_plan
				 * @method POST
				 * @alias  /billing_plans/:id/create_copy(.:format)
				 * @format {:controller=>"internationalization", :action=>"show"}
				 */
				$resource = $this->getURL( ONAPP_GETRESOURCE_LOAD ) . '/create_copy';
				break;

			default:
				/**
				 * ROUTE :
				 *
				 * @name billing_plans
				 * @method GET
				 * @alias  /billing_plans(.:format)
				 * @format {:controller=>"billing_plans", :action=>"index"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name billing_plan
				 * @method GET
				 * @alias  /billing_plans/:id(.:format)
				 * @format {:controller=>"billing_plans", :action=>"show"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name billing_plans
				 * @method POST
				 * @alias  /billing_plans(.:format)
				 * @format {:controller=>"billing_plans", :action=>"create"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method PUT
				 * @alias  /billing_plans/:id(.:format)
				 * @format {:controller=>"billing_plans", :action=>"update"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method DELETE
				 * @alias  billing_plans/:id(.:format)
				 * @format {:controller=>"billing_plans", :action=>"destroy"}
				 */
				$resource = parent::getURL( $action );
		}

		return $resource;
	}

	function users() {
		$this->logger->add( 'getList: Get Users list.' );

		$this->setAPIResource( $this->getURL( ONAPP_GETRESOURCE_GETLIST_USERS ) );

		$response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

		if( ! empty( $response[ 'errors' ] ) ) {
			$this->errors = $response[ 'errors' ];
			return FALSE;
		}

		$class = new ONAPP_User();

		$class->logger = $this->logger;

		$class->options = $this->options;

		$class->logger->setTimezone();

		$class->_ch = $this->_ch;

		$result = $class->castStringToClass( $response );

		return $result;
	}

	function create_copy() {
		$this->logger->add( 'getList: Create Billing plan copy' );

		$this->setAPIResource( $this->getURL( ONAPP_GETRESOURCE_CREATE_COPY ) );

		$data = '<billing_plan><label>TEST</label></billing_plan>';

		$response = $this->sendRequest( ONAPP_REQUEST_METHOD_POST, $data );

		$result = $this->castStringToClass( $response );

		return $result;
	}
}