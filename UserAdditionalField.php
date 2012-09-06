<?php
/**
 * User Additional Field
 *
 * @todo        Add description
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Yuriy Yakubskiy
 * @copyright   (c) 2012 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 *
 * Managing User Additional Fields
 *
 * The OnApp_UserAdditionalField class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
/**
 * Magic properties used for autocomplete
 *
 * @property integer $id
 * @property string  $name
 * @property integer $default_value
 * @property string  $data_type
 */
class OnApp_UserAdditionalField extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'user_additional_field';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'user_additional_fields';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}
}