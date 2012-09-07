<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Billing Plan Base Resources
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  BillingPlan
 * @author      Yakubskiy Yuriy
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * The OnApp_BillingPlan_BaseResource uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property integer  $id
 * @property string   $label
 * @property string   $created_at
 * @property string   $updated_at
 * @property integer  $billing_plan_id
 * @property string   $unit
 * @property string   $resource_name
 * @property string   $limit
 * @property string   $limit_type
 * @property string   $limit_free
 * @property string   $price
 * @property string   $price_on
 * @property string   $price_off
 * @property string   $resource_class
 * @property integer  $target_id
 */
class OnApp_BillingPlan_BaseResource extends OnApp {
	public static $nestedData = array(
		'limits' => 'BillingPlan_BaseResource_Limit',
		'prices' => 'BillingPlan_BaseResource_Price',
	);

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'base_resource';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'base_resources';

	/**
	 * Returns the URL Alias of the API Class that inherits the OnApp class
	 *
	 * @param string $action action name
	 *
	 * @return string API resource
	 * @access public
	 */
	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		$show_log_msg = true;
		switch( $action ) {
			case ONAPP_GETRESOURCE_DEFAULT:
				/**
				 * ROUTE :
				 *
				 * @name billing_plan_base_resources
				 * @method GET
				 * @alias   /billing_plans/:billing_plan_id/base_resources(.:format)
				 * @format  {:controller=>"base_resources", :action=>"index"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name billing_plan_base_resource
				 * @method GET
				 * @alias    /billing_plans/:billing_plan_id/base_resources/:id(.:format)
				 * @format   {:controller=>"base_resources", :action=>"show"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method POST
				 * @alias   /billing_plans/:billing_plan_id/base_resources(.:format)
				 * @format  {:controller=>"base_resources", :action=>"create"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method PUT
				 * @alias  /billing_plans/:billing_plan_id/base_resources/:id(.:format)
				 * @format {:controller=>"base_resources", :action=>"update"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method DELETE
				 * @alias   /billing_plans/:billing_plan_id/base_resources/:id(.:format)
				 * @format  {:controller=>"base_resources", :action=>"destroy"}
				 */
				if( is_null( $this->_billing_plan_id ) && is_null( $this->inheritedObject->_billing_plan_id ) ) {
					$this->logger->error(
						'getURL( ' . $action . ' ): property billing_plan_id not set.',
						__FILE__,
						__LINE__
					);
				}
				else {
					if( is_null( $this->_billing_plan_id ) ) {
						$this->_billing_plan_id = $this->inheritedObject->_billing_plan_id;
					}
				}

				$resource = 'billing_plans/' . $this->_billing_plan_id . '/' . $this->URLPath;
				break;

			default:
				$resource     = parent::getURL( $action );
				$show_log_msg = false;
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
	function getList( $billing_plan_id = null, $url_args = null ) {
		if( is_null( $billing_plan_id ) && ! is_null( $this->_billing_plan_id ) ) {
			$billing_plan_id = $this->_billing_plan_id;
		}

		if( ! is_null( $billing_plan_id ) ) {
			$this->_billing_plan_id = $billing_plan_id;

			return parent::getList( $billing_plan_id, $url_args );
		}
		else {
			$this->logger->error(
				'getList: property billing_plan_id not set.',
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
	 * This method can be closed for read only objects of the inherited class
	 * <code>
	 *    function save() {
	 *        $this->logger->error(
	 *            "Call to undefined method ".__CLASS__."::save()",
	 *            __FILE__,
	 *            __LINE__
	 *        );
	 *    }
	 * </code>
	 *
	 * @return void
	 * @access public
	 */
	function save() {
		if( is_null( $this->_limit ) ) {
			$this->_limit = isset( $this->_limits->_limit )
				? $this->_limits->_limit : (
				isset( $this->inheritedObject->_limits->_limit )
					? $this->inheritedObject->_limits->_limit
					: ''
				);
		}

		if( is_null( $this->_limit_free ) ) {
			$this->_limit_free = isset( $this->_limits->_limit_free )
				? $this->_limits->_limit_free : (
				isset( $this->inheritedObject->_limits->_limit_free )
					? $this->inheritedObject->_limits->_limit_free
					: ''
				);
		}

		if( is_null( $this->_price_on ) ) {
			$this->_price_on = isset( $this->_prices->_price_on )
				? $this->_prices->_price_on : (
				isset( $this->inheritedObject->_prices->_price_on ) ?
					$this->inheritedObject->_prices->_price_on
					: ''
				);
		}

		if( is_null( $this->_price_off ) ) {
			$this->_price_off = isset( $this->_limits->_price_off )
				? $this->_prices->_price_off : (
				isset( $this->inheritedObject->_prices->_price_off )
					? $this->inheritedObject->_prices->_price_off
					: ""
				);
		}

		if( is_null( $this->_price ) ) {
			$this->_price = isset( $this->_limits->_price )
				? $this->_prices->_price
				: ( isset( $this->inheritedObject->_prices->_price )
					? $this->inheritedObject->_prices->_price
					: '' );
		}

		return parent::save();
	}
}