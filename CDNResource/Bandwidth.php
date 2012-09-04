<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * CDN Resource Bandwidth Statistics
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  CDNResource
 * @author      Yakubskiy Yuriy
 * @copyright   (c) 2012 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * CDN Resource Bandwidth Statistics
 *
 * The OnApp_CDNResource_Bandwidth uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_CDNResource_Bandwidth extends OnApp {
	/**
	 * Magic properties
	 *
	 * @property string non_cached
	 * @property string date
	 * @property string cached
	 */

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'stat';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'cdn_resources/bandwidth';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}

	/**
	 * Sends an API request to get the Objects. After requesting,
	 * unserializes the received response into the array of Objects
	 *
	 * @param array $url_args [start, end, type, resource_type, resources[] ]
	 *
	 * @return mixed an array of Object instances on success. Otherwise false
	 * @access public
	 */
	public function getList( $params = null, $url_args = null ) {
		return parent::getList( null, $url_args );
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