<?php
/**
 * Managing User Groups
 *
 * User Groups are created to set custom layout to selected users.
 *
 * @category	API WRAPPER
 * @package		OnApp
 * @author		Lev Bartashevsky
 * @copyright	(c) 2011 OnApp
 * @link		http://www.onapp.com/
 * @see			OnApp
 */
class OnApp_UserGroup extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	var $_tagRoot = 'user_group';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	var $_resource = 'user_groups';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}

	/**
	 * API Fields description
	 *
	 * @param string|float $version OnApp API version
	 * @param string $className current class' name
	 * @return array
	 */
	public function initFields( $version = null, $className = '' ) {
		switch( $version ) {
			case '2.0':
			case '2.1':
				$this->fields = array(
					'label' => array(
						ONAPP_FIELD_MAP => '_label',
						ONAPP_FIELD_REQUIRED => true,
						ONAPP_FIELD_DEFAULT_VALUE => ''
					),
					'created_at' => array(
						ONAPP_FIELD_MAP => '_created_at',
						ONAPP_FIELD_TYPE => 'datetime',
						ONAPP_FIELD_READ_ONLY => true
					),
					'updated_at' => array(
						ONAPP_FIELD_MAP => '_updated_at',
						ONAPP_FIELD_TYPE => 'datetime',
						ONAPP_FIELD_READ_ONLY => true
					),
					'id' => array(
						ONAPP_FIELD_MAP => '_id',
						ONAPP_FIELD_TYPE => 'integer',
						ONAPP_FIELD_READ_ONLY => true,
					),
				);
				break;

			case 2.2:
			case 2.3:
				$this->fields = $this->initFields( 2.1 );
				break;
		}

		parent::initFields( $version, __CLASS__ );
		return $this->fields;
	}
}