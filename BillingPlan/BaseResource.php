<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Billing Plan Base Resources
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  BillingPlan
 * @author      Yakubskiy Yuriy
 * @copyright   (c) 2012 OnApp
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
				if( is_null( $this->billing_plan_id ) && is_null( $this->loadedObject->billing_plan_id ) ) {
					$this->logger->logError(
						'getURL( ' . $action . ' ): property billing_plan_id not set.',
						__FILE__,
						__LINE__
					);
				}
				else {
					if( is_null( $this->billing_plan_id ) ) {
						$this->billing_plan_id = $this->loadedObject->billing_plan_id;
					}
				}

				$resource = 'billing_plans/' . $this->billing_plan_id . '/' . $this->URLPath;
				break;

			default:
				$resource     = parent::getURL( $action );
				$show_log_msg = false;
		}

		if( $show_log_msg ) {
			$this->logger->logDebug( 'getURL( ' . $action . ' ): return ' . $resource );
		}

		return $resource;
	}

	/**
	 * Sends an API request to get the Objects. After requesting,
	 * unserializes the received response into the array of Objects
	 *
	 * @param integer $billing_plan_id Virtual Machine id
	 * @param mixed   $url_args        additional parameters
	 *
	 * @return mixed an array of Object instances on success. Otherwise false
	 */
	public function getList( $billing_plan_id = null, $url_args = null ) {
		if( is_null( $billing_plan_id ) && ! is_null( $this->billing_plan_id ) ) {
			$billing_plan_id = $this->billing_plan_id;
		}

		if( ! is_null( $billing_plan_id ) ) {
			$this->billing_plan_id = $billing_plan_id;

			return parent::getList( $billing_plan_id, $url_args );
		}
		else {
			$this->logger->logError(
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
	 */
	public function save() {
		if( is_null( $this->limit ) ) {
			$this->limit = isset( $this->limits->limit )
				? $this->limits->limit : (
				isset( $this->loadedObject->limits->limit )
					? $this->loadedObject->limits->limit
					: ''
				);
		}

		if( is_null( $this->limit_free ) ) {
			$this->limit_free = isset( $this->limits->limit_free )
				? $this->limits->limit_free : (
				isset( $this->loadedObject->limits->limit_free )
					? $this->loadedObject->limits->limit_free
					: ''
				);
		}

		if( is_null( $this->price_on ) ) {
			$this->price_on = isset( $this->prices->price_on )
				? $this->prices->price_on : (
				isset( $this->loadedObject->prices->price_on ) ?
					$this->loadedObject->prices->price_on
					: ''
				);
		}

		if( is_null( $this->price_off ) ) {
			$this->price_off = isset( $this->limits->price_off )
				? $this->prices->price_off : (
				isset( $this->loadedObject->prices->price_off )
					? $this->loadedObject->prices->price_off
					: ""
				);
		}

		if( is_null( $this->price ) ) {
			$this->price = isset( $this->limits->price )
				? $this->prices->price
				: ( isset( $this->loadedObject->prices->price )
					? $this->loadedObject->prices->price
					: '' );
		}

		parent::save();
	}
}