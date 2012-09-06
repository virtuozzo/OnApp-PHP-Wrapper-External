<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 *  Represents OnApp CDNResource AvailableEdgeGroup Locations
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  CDNResource_AvailableEdgeGroup
 * @author      Yakubskiy Yuriy
 * @copyright   (c) 2012 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * CDN Origins For API
 *
 * The OnApp_CDNResource_AvailableEdgeGroup_Location class doesn't support any basic method.
 *
 */
/**
 * Magic properties used for autocomplete
 *
 * @property string  $price
 * @property string  $city
 * @property string  $created_at
 * @property string  $updated_at
 * @property string  $country
 * @property integer $aflexi_location_id
 * @property integer $id
 * @property string  $operator
 * @property integer $edge_group_id
 * @property boolean $streamSupported
 * @property boolean $httpSupported
 */
class OnApp_CDNResource_AvailableEdgeGroup_Location extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'edge_group_location';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = '';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}

	/**
	 * Activates action performed with object
	 *
	 * @param string $action_name the name of action
	 *
	 * @access public
	 */
	function activate( $action_name ) {
		switch( $action_name ) {
			case ONAPP_ACTIVATE_GETLIST:
			case ONAPP_ACTIVATE_LOAD:
			case ONAPP_ACTIVATE_SAVE:
			case ONAPP_ACTIVATE_DELETE:
				exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
		}
	}
}