<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * CDN Resource Billing Statistics
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
 * CDN Resource Billing Statistics
 *
 * The OnApp_CDNResource_BillingStatistic uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property integer $id
 * @property string  $data_cached
 * @property string  $data_non_cached
 * @property integer $edge_group_id
 * @property string  $cost
 * @property string  $edge_group_label
 * @property string  $stat_time
 * @property string  $value
 */
class OnApp_CDNResource_BillingStatistic extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'user_hourly_stat';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'billing';

	/**
	 * Returns the URL Alias of the API Class that inherits the OnApp class
	 *
	 * @param string $action action name
	 *
	 * @return string API resource
	 * @access public
	 */
	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			case ONAPP_GETRESOURCE_DEFAULT:
				$resource = 'cdn_resources/' . $this->_id . '/' . $this->URLPath;
				$this->logger->logDebugMessage( 'getURL( ' . $action . ' ): return ' . $resource );
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
	 *
	 * @return mixed an array of Object instances on success. Otherwise false
	 * @access public
	 */
	public function getList( $cdn_resource_id = null, $url_args = null ) {
		if( is_null( $cdn_resource_id ) && ! is_null( $this->_id ) ) {
			$cdn_resource_id = $this->_id;
		}

		if( ! is_null( $cdn_resource_id ) ) {
			$this->_id = $cdn_resource_id;

			return parent::getList( $cdn_resource_id, $url_args );
		}
		else {
			$this->logger->logErrorMessage(
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