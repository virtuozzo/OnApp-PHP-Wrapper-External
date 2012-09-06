<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * User IP Adresses
 *
 * @todo        write description
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  User
 * @author      Vitaliy Kondratyuk
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * User IP Adresses
 *
 * The OnApp_User_UsedIpAddress class doesn't support any basic method.
 *
 */
class OnApp_User_UsedIpAddress extends OnApp_IpAddress {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'used_ip_address';

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