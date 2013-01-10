<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * CDN Resource Advanced Details
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
 * CDN Resource Advanced Details
 *
 * The OnApp_CDNResource_Advanced uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property integer $id
 * @property array   $countries
 * @property string  $hotlink_policy
 * @property string  $ip_access_policy
 * @property string  $country_access_policy
 * @property string  $passwords
 * @property string  $domains
 * @property integer $cache_expiry
 * @property string  $publisher_name
 * @property boolean $password_on
 * @property boolean $url_signing_on
 * @property string  $password_unauthorized_html
 * @property string  $ip_addresses
 * @property string  $url_signing_key
 * @property array   $secondary_hostnames
 * @property boolean $flv_pseudo_on
 * @property boolean $mp4_pseudo_on
 * @property boolean $ssl_on
 * @property boolean $ignore_set_cookie_on
 */
class OnApp_CDNResource_Advanced extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'cdn_resource';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'advanced';

	/**
	 * Returns the URL Alias of the API Class that inherits the OnApp class
	 *
	 * @param string $action action name
	 *
	 * @return string API resource
	 */
	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			case ONAPP_GETRESOURCE_DEFAULT:
				$resource = 'cdn_resources/' . $this->id . '/' . $this->URLPath;
				$this->logger->logDebug( 'getURL( ' . $action . ' ): return ' . $resource );
				break;

			default:
				$resource = parent::getURL( $action );
		}
		return $resource;
	}

	/**
	 * Sends an API request to get the Objects. After requesting,
	 * unserializes the received response into the array of Objects
	 *
	 * @param integer $cdn_resource_id CDN Resource id
	 * @param mixed   $url_args        additional parameters
	 *
	 * @return mixed an array of Object instances on success. Otherwise false
	 */
	public function getList( $cdn_resource_id = null, $url_args = null ) {
		if( is_null( $cdn_resource_id ) && ! is_null( $this->id ) ) {
			$cdn_resource_id = $this->id;
		}

		if( ! is_null( $cdn_resource_id ) ) {
			$this->id = $cdn_resource_id;

			return parent::getList( $cdn_resource_id, $url_args );
		}
		else {
			$this->logger->logError(
				'getList: property cdn_resource_id not set.',
				__FILE__,
				__LINE__
			);
		}
	}

	/**
	 * Activates action performed with object
	 *
	 * @param string $action_name the name of action
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