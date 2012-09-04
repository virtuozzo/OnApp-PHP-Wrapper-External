<?php
/**
 * Get locale from OnApp CP
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Lev Bartashevsky
 * @copyright   (c) 2012 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
class OnApp_Locale extends OnApp {
	/**
	 * Magic properties
	 *
	 * @property string code
	 * @property string name
	 */

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $_tagRoot = 'locale';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $_resource = '/settings/internationalization';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}

	function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		return parent::getResource( $action );
		/**
		 * ROUTE :
		 *
		 * @name roles
		 * @method GET
		 * @alias   /roles(.:format)
		 * @format  {:controller=>"roles", :action=>"index"}
		 */
		/**
		 * ROUTE :
		 *
		 * @name role
		 * @method GET
		 * @alias   /roles/:id(.:format)
		 * @format  {:controller=>"roles", :action=>"show"}
		 */
		/**
		 * ROUTE :
		 *
		 * @name
		 * @method POST
		 * @alias   /roles(.:format)
		 * @format  {:controller=>"roles", :action=>"create"}
		 */
		/**
		 * ROUTE :
		 *
		 * @name
		 * @method PUT
		 * @alias  /roles/:id(.:format)
		 * @format {:controller=>"roles", :action=>"update"}
		 */
		/**
		 * ROUTE :
		 *
		 * @name
		 * @method DELETE
		 * @alias  /roles/:id(.:format)
		 * @format {:controller=>"roles", :action=>"destroy"}
		 */
	}
}