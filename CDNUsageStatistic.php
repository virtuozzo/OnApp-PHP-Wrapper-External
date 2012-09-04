<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Edge Groups
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Yakubskiy Yuriy
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * View CDN Usage Statistics
 *
 * The OnApp_CDNUsageStatistic class represents CDN Usage Statistics info
 * The OnApp_CDNUsageStatistic class is the parent of the OnApp class.
 *
 * The OnApp_EdgeGroup uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_CDNUsageStatistic extends OnApp {
	/**
	 * Magic properties
	 *
	 * @property integer  target_id
	 * @property float    not_cached
	 * @property datetime updated_at
	 * @property integer  user_id
	 * @property float    cached
	 */

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'user_stat';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'cdn_usage_statistics';

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
			case ONAPP_ACTIVATE_SAVE:
			case ONAPP_ACTIVATE_LOAD:
			case ONAPP_ACTIVATE_DELETE:
				exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
		}
	}
}