<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * VM IP Adresses
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  CDNResource_Advanced
 * @author      Yakubskiy Yuriy
 * @copyright   (c) 2012 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * CDN Origins For API
 *
 * The OnApp_CDNResource_Advanced_Country class doesn't support any basic method.
 *
 */
/**
 * Magic properties used for autocomplete
 *
 * @property string $continent
 * @property string $name
 * @property string $created_at
 * @property string $code
 * @property string $updated_at
 * @property string $id
 */
class OnApp_CDNResource_Advanced_Country extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'aflexi_country';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = '';

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