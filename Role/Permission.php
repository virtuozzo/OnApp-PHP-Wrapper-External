<?php
/**
 * Managing Role Permissions
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  Role
 * @author      Lev Bartashevsky
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing Role Permissions
 *
 * The OnApp_Role_Permission class represents the billing plans. The OnApp class is the parent of the OnApp class.
 *
 * The OnApp_BillingPlan class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Role_Permission extends OnApp {
	/**
	 * Magic properties
	 *
	 * @property integer  id
	 * @property label
	 * @property datetime created_at
	 * @property datetime updated_at
	 * @property identifier
	 */

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'permission';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'permissions';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}
}