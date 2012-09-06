<?php
/**
 * Data Store Zone
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
 * Managing Data Store Zones
 *
 * The OnApp_Disk class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, {@link getList}.
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
class OnApp_DataStoreZone extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'data_store_group';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'settings/data_store_zones';

	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		return parent::getURL( $action );
		/**
		 * ROUTE :
		 *
		 * @name user_data_store_groups
		 * @method GET
		 * @alias  /data_store_zones(.:format)
		 * @format {:controller=>"data_store_groups", :action=>"index"}
		 */
		/**
		 * ROUTE :
		 *
		 * @name user_data_store_group
		 * @method GET
		 * @alias   /data_store_zones/:id(.:format)
		 * @format  {:controller=>"data_store_groups", :action=>"show"}
		 */
		/**
		 * ROUTE :
		 *
		 * @name
		 * @method POST
		 * @alias   /data_store_zones(.:format)
		 * @format  {:controller=>"data_store_groups", :action=>"create"}
		 */
		/**
		 * ROUTE :
		 *
		 * @name
		 * @method PUT
		 * @alias  /data_store_zones/:id(.:format)
		 * @format {:controller=>"data_store_groups", :action=>"update"}
		 */
		/**
		 * ROUTE :
		 *
		 * @name
		 * @method DELETE
		 * @alias  /data_store_zones/:id(.:format)
		 * @format {:controller=>"data_store_groups", :action=>"destroy"}
		 */
	}
}