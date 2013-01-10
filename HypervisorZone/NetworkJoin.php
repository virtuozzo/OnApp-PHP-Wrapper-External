<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Manages Network Zone Joins
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  HypervisorZone
 * @author      Yakubskiy Yuriy
 * @copyright   (c) 2012 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * ONAPP_Hypervisor_NetworkJoin
 *
 * This class reprsents the Networks for Hypervisor Zone.
 *
 * The OnApp_Hypervisor_NetworkJoin class uses the following basic methods:
 * {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property integer  $id
 * @property string   $created_at
 * @property string   $updated_at
 * @property integer  $network_id
 * @property string   $interface
 * @property integer  $hypervisor_id
 * @property integer  $target_join_id
 * @property string   $target_join_type
 */
class OnApp_HypervisorZone_NetworkJoin extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'network_join';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'network_joins';

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
				/**
				 * ROUTE :
				 *
				 * @name hypervisor_group_network_joins
				 * @method GET
				 * @alias   /settings/hypervisor_zones/:hypervisor_group_id/network_joins(.:format)
				 * @format  {:controller=>"network_joins", :action=>"index"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method POST
				 * @alias    /settings/hypervisor_zones/:hypervisor_group_id/network_joins(.:format)
				 * @format   {:controller=>"network_joins", :action=>"create"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name  hypervisor_group_network_join
				 * @method DELETE
				 * @alias   /settings/hypervisor_zones/:hypervisor_group_id/network_joins/:id(.:format)
				 * @format  {:controller=>"network_joins", :action=>"destroy"}
				 */
				$resource = 'settings/hypervisor_zones/' . $this->target_join_id . '/' . $this->URLPath;
				$this->logger->logDebug( 'getURL( ' . $action . ' ): return ' . $resource );
				break;

			default:
				$resource = parent::getURL( $action );
		}

		return $resource;
	}

	/**
	 * Gets list of network joins to particular hypervisor zone
	 *
	 * @param integer $target_join_id hypervisor zone id
	 * @param mixed   $url_args       additional parameters
	 *
	 * @return array of network join objects
	 */
	public function getList( $target_join_id = null, $url_args = null ) {
		if( is_null( $target_join_id ) && ! is_null( $this->target_join_id ) ) {
			$target_join_id = $this->target_join_id;
		}

		if( ! is_null( $target_join_id ) ) {
			$this->target_join_id = $target_join_id;
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
}