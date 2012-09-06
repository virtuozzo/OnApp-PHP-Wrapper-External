<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Roles
 *
 * A role is a set of actions users are allowed to perform. OnApp allows you to
 * assign users roles and permissions to define who has access to OnApp and what
 * actions they can perform. OnApp maps users to the certain roles, and you can
 * restrict which operations each user role can perform. Users are not assigned
 * permissions directly, but acquire them through the roles. So granting users
 * with the ability to perform actions becomes a matter of assigning them to the
 * specific role. Users are assigned roles during the creation process.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Manages User Roles
 *
 * This class represents the roles assigned  to the users in this OnApp installation
 *
 * The OnApp_Role class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property integer  $id
 * @property string   $created_at
 * @property string   $identifier
 * @property string   $label
 * @property string   $updated_at
 */
class OnApp_Role extends OnApp {
	public static $nestedData = array(
		'permissions' => 'Role_Permission',
	);

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'role';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'roles';

	protected function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		return parent::getURL( $action );
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