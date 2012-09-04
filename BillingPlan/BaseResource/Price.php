<?php
/**
 * Manages Billing Plan Base Resource Prices
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  BillingPlan_BaseResource
 * @author      Andrew Yatskovets
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
class OnApp_BillingPlan_BaseResource_Price extends OnApp {
	/**
	 * Magic properties
	 *
	 * @property integer price_on
	 * @property integer price_off
	 * @property integer price
	 */

	protected $_tagRoot = 'price';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}
}