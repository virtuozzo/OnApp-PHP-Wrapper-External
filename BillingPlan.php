<?php
/**
 * Managing Billing Plans
 *
 * Billing Plans are created to set prices for the resources so that users know how
 * much they will be charged per unit.
 *
 * @category	API WRAPPER
 * @package		OnApp
 * @author		Lev Bartashevsky
 * @copyright	(c) 2011 OnApp
 * @link		http://www.onapp.com/
 * @see			OnApp
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
 * The ONAPP_BillingPlan class represents the billing plans.  The ONAPP class is the parent of the BillingPlan class.
 *
 * The ONAPP_BillingPlan class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * <b>Use the following XML API requests:</b>
 *
 * Get the list of groups
 *
 *	 - <i>GET onapp.com/settings/billing_plans.xml</i>
 *
 * Get a particular group details
 *
 *	 - <i>GET onapp.com/settings/billing_plans/{ID}.xml</i>
 *
 * Add new group
 *
 *	 - <i>POST onapp.com/settings/billing_plans.xml</i>
 *
 * <code>
 * <?xml version="1.0" encoding="UTF-8"?>
 * <billing-plan>
 *	<label>{LABEL}</label>
 * </billing-plan>
 * </code>
 *
 * Edit existing group
 *
 *	 - <i>PUT onapp.com/settings/billing_plans/{ID}.xml</i>
 *
 * <code>
 * <?xml version="1.0" encoding="UTF-8"?>
 * <billing-plan>
 *	<label>{LABEL}</label>
 * </billing-plan>
 * </code>
 *
 * Delete group
 *
 *	 - <i>DELETE onapp.com/settings/billing_plans/{ID}.xml</i>
 *
 * <b>Use the following JSON API requests:</b>
 *
 * Get the list of groups
 *
 *	 - <i>GET onapp.com/settings/billing_plans.json</i>
 *
 * Get a particular group details
 *
 *	 - <i>GET onapp.com/settings/billing_plans/{ID}.json</i>
 *
 * Add new group
 *
 *	 - <i>POST onapp.com/settings/billing_plans.json</i>
 *
 * <code>
 * {
 *	  billing-plan: {
 *		  label:'{LABEL}',
 *	  }
 * }
 * </code>
 *
 * Edit existing group
 *
 *	 - <i>PUT onapp.com/settings/billing_plans/{ID}.json</i>
 *
 * <code>
 * {
 *	  billing-plan: {
 *		  label:'{LABEL}',
 *	  }
 * }
 * </code>
 *
 * Delete group
 *
 *	 - <i>DELETE onapp.com/settings/billing_plans/{ID}.json</i>
 */
class OnApp_BillingPlan extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	var $_tagRoot = 'billing_plan';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	var $_resource = 'billing_plans';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}

	/**
	 * API Fields description
	 *
	 * @param string|float $version OnApp API version
	 * @param string $className current class' name
	 * @return array
	 */
	public function initFields( $version = null, $className = '' ) {
		switch( $version ) {
			case '2.0':
			case '2.1':
				$this->fields = array(
					'label' => array(
						ONAPP_FIELD_MAP => '_label',
						ONAPP_FIELD_REQUIRED => true,
						ONAPP_FIELD_DEFAULT_VALUE => ''
					),
					'created_at' => array(
						ONAPP_FIELD_MAP => '_created_at',
						ONAPP_FIELD_TYPE => 'datetime',
						ONAPP_FIELD_READ_ONLY => true
					),
					'updated_at' => array(
						ONAPP_FIELD_MAP => '_updated_at',
						ONAPP_FIELD_TYPE => 'datetime',
						ONAPP_FIELD_READ_ONLY => true
					),
					'base_resources' => array(
						ONAPP_FIELD_MAP => '_base_resources',
						ONAPP_FIELD_TYPE => 'array',
						ONAPP_FIELD_READ_ONLY => true,
						ONAPP_FIELD_CLASS => 'BillingPlan_BaseResource',
					),
					'id' => array(
						ONAPP_FIELD_MAP => '_id',
						ONAPP_FIELD_TYPE => 'integer',
						ONAPP_FIELD_READ_ONLY => true,
					),
					'monthly_price' => array(
						ONAPP_FIELD_MAP => '_monthly_price',
						ONAPP_FIELD_TYPE => 'integer',
						ONAPP_FIELD_REQUIRED => true,
					),
					'currency_code' => array(
						ONAPP_FIELD_MAP => '_currency_code',
						ONAPP_FIELD_TYPE => 'string',
						ONAPP_FIELD_REQUIRED => true,
						ONAPP_FIELD_READ_ONLY => true,
					),
					'show_price' => array(
						ONAPP_FIELD_MAP => '_show_price',
						ONAPP_FIELD_TYPE => 'boolean',
						ONAPP_FIELD_REQUIRED => true,
						ONAPP_FIELD_DEFAULT_VALUE => true,
						ONAPP_FIELD_READ_ONLY => true
					)
				);
				break;

			case 2.2:
				$this->fields = $this->initFields( 2.1 );
				break;
		}

		parent::initFields( $version, __CLASS__ );
		return $this->fields;
	}

	function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			case ONAPP_GETRESOURCE_GETLIST_USERS:
				/**
				 * ROUTE :
				 * @name billing_plan_users
				 * @method GET
				 * @alias  /billing_plans/:billing_plan_id/users(.:format)
				 * @format {:controller=>"users", :action=>"index"}
				 */
				$resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/users';
				break;

			case ONAPP_GETRESOURCE_CREATE_COPY:
				/**
				 * ROUTE :
				 * @name create_copy_billing_plan
				 * @method POST
				 * @alias  /billing_plans/:id/create_copy(.:format)
				 * @format {:controller=>"internationalization", :action=>"show"}
				 */
				$resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/create_copy';
				break;

			default:
				/**
				 * ROUTE :
				 * @name billing_plans
				 * @method GET
				 * @alias  /billing_plans(.:format)
				 * @format {:controller=>"billing_plans", :action=>"index"}
				 */
				/**
				 * ROUTE :
				 * @name billing_plan
				 * @method GET
				 * @alias  /billing_plans/:id(.:format)
				 * @format {:controller=>"billing_plans", :action=>"show"}
				 */
				/**
				 * ROUTE :
				 * @name billing_plans
				 * @method POST
				 * @alias  /billing_plans(.:format)
				 * @format {:controller=>"billing_plans", :action=>"create"}
				 */
				/**
				 * ROUTE :
				 * @name
				 * @method PUT
				 * @alias  /billing_plans/:id(.:format)
				 * @format {:controller=>"billing_plans", :action=>"update"}
				 */
				/**
				 * ROUTE :
				 * @name
				 * @method DELETE
				 * @alias  billing_plans/:id(.:format)
				 * @format {:controller=>"billing_plans", :action=>"destroy"}
				 */
				$resource = parent::getResource( $action );
		}

		return $resource;
	}

	function users() {
		$this->logger->add( "getList: Get Users list." );

		$this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_GETLIST_USERS ) );

		$response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

		if( !empty( $response[ 'errors' ] ) ) {
			$this->errors = $response[ 'errors' ];
			return false;
		}

		$class = new ONAPP_User();

		$class->logger = $this->logger;

		$class->options = $this->options;

		$class->logger->setTimezone();

		$class->_ch = $this->_ch;

		$class->initFields( $this->getAPIVersion() );

		$result = $class->castStringToClass( $response );

		return $result;
	}

	function create_copy() {
		$this->logger->add( "getList: Create Billing plan copy" );

		$this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_CREATE_COPY ) );

		$data = "<billing_plan><label>TEST</label></billing_plan>";

		$response = $this->sendRequest( ONAPP_REQUEST_METHOD_POST, $data );

		$result = $this->castStringToClass( $response );

		return $result;
	}
}