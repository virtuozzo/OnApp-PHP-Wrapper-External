<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Manages Data Store Join
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  HypervisorZone
 * @author      Yakubskiy Yuriy
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * ONAPP_Hypervisor_DataStoreJoin
 *
 * This class reprsents the Data Store Joins for Hypervisor Zones.
 *
 * The OnApp_Hypervisor_DataStoreJoin class uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property integer  $id
 * @property string   $created_at
 * @property string   $updated_at
 * @property integer  $data_store_id
 * @property integer  $target_join_id
 * @property string   $target_join_type
 */
class OnApp_HypervisorZone_DataStoreJoin extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'data_store_join';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'data_store_joins';

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
				/**
				 * ROUTE :
				 *
				 * @name hypervisor_data_store_joins
				 * @method GET
				 * @alias   /settings/hyrvisor_zones/:hypervisor_id/data_store_joins(.:format)
				 * @format  {:controller=>"data_store_joins", :action=>"index"}
				 */
				$resource = 'settings/hypervisor_zones/' . $this->_target_join_id . '/' . $this->URLPath;
				$this->logger->logDebug( 'getURL( ' . $action . ' ): return ' . $resource );
				break;

			default:
				$resource = parent::getURL( $action );
		}

		return $resource;
	}

	/**
	 * Gets list of datastore joins to particular hypervisor zone
	 *
	 * @param integet $target_join_id hypervisor zone id
	 *
	 * @return array of datastore join objects
	 */
	function getList( $target_join_id = null, $url_args = null ) {
		if( is_null( $target_join_id ) && ! is_null( $this->_target_join_id ) ) {
			$target_join_id = $this->_target_join_id;
		}

		if( ! is_null( $target_join_id ) ) {
			$this->_target_join_id = $target_join_id;
			return parent::getList( $target_join_id, $url_args );
		}
		else {
			$this->logger->logError(
				'getList: property target_join_id not set.',
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