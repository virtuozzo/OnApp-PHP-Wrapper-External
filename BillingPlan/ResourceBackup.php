<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Billing Plan Base Resources
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  BillingPlan
 * @author      Andrew Yatskovets
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * The OnApp_BillingPlan_ResourceBackup class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_BillingPlan_ResourceBackup extends OnApp_BillingPlan_BaseResource {
	/**
	 * Magic properties
	 *
	 * @property integer  id
	 * @property string   label
	 * @property datetime created_at
	 * @property datetime updated_at
	 * @property integer  billing_plan_id
	 * @property unit
	 * @property string   resource_name
	 * @property string   limit
	 * @property string   limit_type
	 * @property string   limit_free
	 * @property string   price
	 * @property string   price_on
	 * @property string   price_off
	 * @property string   resource_class
	 * @property integer  target_id
	 */

	public static $nestedData = array(
		'limits' => 'BillingPlan_BaseResource_Limit',
		'prices' => 'BillingPlan_BaseResource_Price',
	);
}