<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Represents Edge Groups Assigned to the current logined user's Billling Plan
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Yakubskiy Yuriy
 * @subpackage  CDNResource
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing Edge Groups
 *
 * The Available Edge Group class represents the Edge groups.
 * The OnApp_CDNResource_AvailableEdgeGroup class is the parent of the OnApp class.
 *
 * The OnApp_CDNResource_AvailableEdgeGroup uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property string   label
 * @property string   created_at
 * @property string   updated_at
 * @property integer  id
 */
class OnApp_CDNResource_AvailableEdgeGroup extends OnApp {
	public static $nestedData = array(
		'edge_group_locations' => 'CDNResource_AvailableEdgeGroup_Location',
	);

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'edge_group';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'cdn_resources/available_edge_groups';

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
			case ONAPP_ACTIVATE_LOAD:
			case ONAPP_ACTIVATE_SAVE:
			case ONAPP_ACTIVATE_DELETE:
				exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
		}
	}
}