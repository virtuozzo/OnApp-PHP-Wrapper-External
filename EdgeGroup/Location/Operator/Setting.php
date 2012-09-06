<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Edge Group Location
 *
 * @todo        Add description
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  EdgeGroup_Location_Operator
 * @author      Yakubskiy Yuriy
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * OnApp_EdgeGroup_Location
 *
 * Edge Group nested class and support no basic methods
 *
 */
/**
 * Magic properties used for autocomplete
 *
 * @property string  $logFtpUsername
 * @property string  $baseHostname
 * @property string  $sslCertificate
 * @property string  $trafficPolicy
 * @property string  $logDeliveryMethod
 * @property string  $logFtpPassword
 * @property integer $httpCacheExpiry
 * @property string  $httpErrorPage
 * @property string  $logFtpDirectory
 * @property string  $logFormat
 * @property string  $logSyslogHostname
 * @property string  $logFtpHostname
 * @property integer $logFtpPort
 * @property string  $sslKey
 */
class OnApp_EdgeGroup_Location_Operator_Setting extends OnApp {
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