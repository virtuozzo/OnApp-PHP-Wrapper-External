<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Manages Edge Group Location
 *
 * @todo        Add description
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  EdgeGroup
 * @author      Yakubskiy Yuriy
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * OnApp_EdgeGroup_Location
 *
 * Edge Group nested class
 *
 */
class OnApp_EdgeGroup_Location extends OnApp {
	/**
	 * Magic properties
	 *
	 * @property string  city
	 * @property string  region
	 * @property float   price
	 * @property float   latitude
	 * @property string  country
	 * @property boolean deleted
	 * @property integer id
	 * @property boolean geoblocking
	 * @property string  createdAt
	 * @property integer updatedAt
	 * @property string  description
	 * @property float   longitude
	 * @property string  status
	 */

	public static $nestedData = array(
		'operator' => 'EdgeGroup_Location_Operator',
	);

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $_tagRoot = '';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $_resource = '';

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
			case ONAPP_ACTIVATE_SAVE:
			case ONAPP_ACTIVATE_DELETE:
				exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
				break;
		}
	}
}