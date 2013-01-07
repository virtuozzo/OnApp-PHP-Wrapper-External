<?php
/**
 * Hypervisor Zone
 *
 * @todo        Add description
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   (c) 2012 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 *
 * Managing Hypervisor Zones
 *
 * The OnApp_HypervisorZone class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * The OnApp_HypervisorZone class represents virtual machine hypervisor groups.
 * The OnApp class is a parent of ONAPP_HypervisorZone class.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property integer  $id
 * @property string   $created_at
 * @property string   $updated_at
 * @property string   $label
 */
class OnApp_HypervisorZone extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'hypervisor_group';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'settings/hypervisor_zones';

	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		return parent::getURL( $action );
		/**
		 * ROUTE :
		 *
		 * @name hypervisor_groups
		 * @method GET
		 * @alias  /settings/hypervisor_zones(.:format)
		 * @format {:controller=>"hypervisor_groups", :action=>"index"}
		 */
		/**
		 * ROUTE :
		 *
		 * @name hypervisor_group
		 * @method GET
		 * @alias   /settings/hypervisor_zones/:id(.:format)
		 * @format  {:controller=>"hypervisor_groups", :action=>"show"}
		 */
		/**
		 * ROUTE :
		 *
		 * @name
		 * @method POST
		 * @alias   /settings/hypervisor_zones(.:format)
		 * @format  {:controller=>"hypervisor_groups", :action=>"create"}
		 */
		/**
		 * ROUTE :
		 *
		 * @name
		 * @method PUT
		 * @alias  /settings/hypervisor_zones/:id(.:format)
		 * @format {:controller=>"hypervisor_groups", :action=>"update"}
		 */
		/**
		 * ROUTE :
		 *
		 * @name
		 * @method DELETE
		 * @alias    /settings/hypervisor_zones/:id(.:format)
		 * @format   {:controller=>"hypervisor_groups", :action=>"destroy"}
		 */
	}
}