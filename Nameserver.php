<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Resolvers
 *
 * Resolvers in OnApp implement a name-service protocol. You can set the IP addresses corresponding to the hostnames added to the system.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Resolvers
 *
 * The Resolvers class represents the name-servers of the OnApp installation.
 *
 * The OnApp_Nameserver class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property integer  $id
 * @property  address
 * @property string   $created_at
 * @property integer  $network_id
 * @property string   $updated_at
 */
class OnApp_Nameserver extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'nameserver';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'settings/nameservers';

	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		return parent::getURL( $action );
		/**
		 * ROUTE :
		 *
		 * @name nameservers
		 * @method GET
		 * @alias   /settings/nameservers(.:format)
		 * @format  {:controller=>"nameservers", :action=>"index"}
		 */
		/**
		 * ROUTE :
		 *
		 * @name nameserver
		 * @method GET
		 * @alias   /settings/nameservers/:id(.:format)
		 * @format  {:controller=>"nameservers", :action=>"show"}
		 */
		/**
		 * ROUTE :
		 *
		 * @name
		 * @method POST
		 * @alias    /settings/nameservers(.:format)
		 * @format   {:controller=>"nameservers", :action=>"create"}
		 */
		/**
		 * ROUTE :
		 *
		 * @name
		 * @method PUT
		 * @alias  /settings/nameservers/:id(.:format)
		 * @format {:controller=>"nameservers", :action=>"update"}
		 */
		/**
		 * ROUTE :
		 *
		 * @name
		 * @method DELETE
		 * @alias    /settings/nameservers/:id(.:format)
		 * @format   {:controller=>"nameservers", :action=>"destroy"}
		 */
	}
}