<?php
/**
 * Manages Billing Plan Base Resource Prices
 *
 * @category	API WRAPPER
 * @package		OnApp
 * @subpackage	BillingPlan_BaseResource
 * @author		Andrew Yatskovets
 * @copyright	(c) 2011 OnApp
 * @link		http://www.onapp.com/
 * @see			OnApp
 */
class OnApp_BillingPlan_BaseResource_Price extends OnApp {
	var $_tagRoot = 'price';

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
					'price_on' => array(
						ONAPP_FIELD_MAP => '_price_on',
						ONAPP_FIELD_TYPE => 'integer',
						ONAPP_FIELD_READ_ONLY => true
					),
					'price_off' => array(
						ONAPP_FIELD_MAP => '_price_off',
						ONAPP_FIELD_TYPE => 'integer',
						ONAPP_FIELD_READ_ONLY => true,
					),
					'price' => array(
						ONAPP_FIELD_MAP => '_price',
						ONAPP_FIELD_TYPE => 'integer',
						ONAPP_FIELD_READ_ONLY => true,
					),
				);
				break;

			case 2.2:
			case 2.3:
				$this->fields = $this->initFields( 2.1 );
				break;
		}

		parent::initFields( $version, __CLASS__ );
		return $this->fields;
	}
}