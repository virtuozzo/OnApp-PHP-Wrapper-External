<?php
/**
 * Manages Billing Plan Base Resource Limits
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  BillingPlan_BaseResource
 * @author      Andrew Yatskovets
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
class OnApp_BillingPlan_BaseResource_Limit extends OnApp {
	/**
	 * Magic properties
	 *
	 * @property integer limit_free
	 * @property integer limit
	 */

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}
}