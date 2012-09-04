<?php
/**
 * Network Zone
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
 * Managing Network Zones
 *
 * The OnApp_NetworkZone class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_NetworkZone extends OnApp {
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
	protected $_tagRoot = 'network_group';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $_resource = 'network_zones';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}
}