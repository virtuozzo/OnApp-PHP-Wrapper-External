<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Edge Group Location
 *
 * @todo        Add description
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  EdgeGroup_Location
 * @author      Yakubskiy Yuriy
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * OnApp_EdgeGroup_Location
 *
 * Edge Group nested class and support no basic methods.
 *
 */
/**
 * Magic properties used for autocomplete
 *
 * @property string  name
 * @property string  companyName
 * @property string  companyDescription
 * @property string  statusReason
 * @property string  updatedAt
 * @property string  username
 * @property string  role
 * @property integer id
 * @property string  companyPhone
 * @property integer principal
 * @property string  createdAt
 * @property string  status
 * @property string  email
 */
class OnApp_EdgeGroup_Location_Operator extends OnApp {
	public static $nestedData = array(
		'settings' => 'EdgeGroup_Location_Operator_Setting',
	);

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = '';

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
			case ONAPP_ACTIVATE_SAVE:
			case ONAPP_ACTIVATE_DELETE:
				exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
		}
	}
}