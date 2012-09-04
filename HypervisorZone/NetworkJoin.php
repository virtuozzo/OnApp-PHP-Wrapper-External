<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Manages Network Zone Joins
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
 * ONAPP_Hypervisor_NetworkJoin
 *
 * This class reprsents the Networks for Hypervisor Zone.
 *
 * The OnApp_Hypervisor_NetworkJoin class uses the following basic methods:
 * {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_HypervisorZone_NetworkJoin extends OnApp {
	/**
	 * Magic properties
	 *
	 * @property integer  id
	 * @property datetime created_at
	 * @property datetime updated_at
	 * @property integer  network_id
	 * @property interface
	 * @property integer  hypervisor_id
	 * @property integer  target_join_id
	 * @property string   target_join_type
	 */

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
	 * @access public
	 */
	function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
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
				$resource = 'settings/hypervisor_zones/' . $this->_target_join_id . '/' . $this->_resource;
				$this->logger->debug( 'getURL( ' . $action . ' ): return ' . $resource );
				break;

			default:
				$resource = parent::getURL( $action );
				break;
		}

		return $resource;
	}

	/**
	 * Gets list of network joins to particular hypervisor zone
	 *
	 * @param integet hypervisor zone id
	 *
	 * @return array of newtwork join objects
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
			$this->logger->error(
				'getList: argument _target_join_id not set.',
				__FILE__,
				__LINE__
			);
		}
	}
}