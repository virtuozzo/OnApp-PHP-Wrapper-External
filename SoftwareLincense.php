<?php
/**
 * Software Licenses
 *
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
 * Managing Software Lincenses
 *
 * The OnApp_SoftwareLincense class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * The OnApp_SoftwareLincense class represents Software Lincenses.
 * The OnApp class is a parent of ONAPP_SoftwareLincense class.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_SoftwareLincense extends OnApp {
	/**
	 * Magic properties
	 *
	 * @property integer  id
	 * @property datetime created_at
	 * @property datetime updated_at
	 * @property string   arch
	 * @property integer  total
	 * @property string   distro
	 * @property integer  count
	 * @property string   tail
	 * @property string   edition
	 * @property string   license
	 */

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $_tagRoot = 'software_license';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $_resource = 'software_licenses';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}
}