<?php
/**
 * Hypervisor Zone
 *
 * @todo        Add description
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   (c) 2011 OnApp
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
class OnApp_HypervisorZone extends OnApp {
	/**
	 * Magic properties
	 *
	 * @property integer  id
	 * @property datetime created_at
	 * @property datetime updated_at
	 * @property string   label
	 */

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $_tagRoot = 'hypervisor_group';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $_resource = 'settings/hypervisor_zones';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}

	function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		return parent::getResource( $action );
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