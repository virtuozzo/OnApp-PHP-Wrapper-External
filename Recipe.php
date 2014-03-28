<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Provisioning Profile
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Alexey Zbinyakov
 * @copyright   (c) 2014 ???
 * @link        http://www.onapp.com/
 * @see         OnApp
 */



class OnApp_Recipe extends OnApp {
	/**
	* root tag used in the API request
	*
	* @var string
	*/
	var $_tagRoot = 'recipe';

	/**
	* alias processing the object data
	*
	* @var string
	*/
	var $_resource = 'recipes';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}

	public function initFields( $version = null, $className = '' ) {
		if ((float)$version<3.2) return;
		$fields=array(
			"3.2"=> array(
				'id' => array(
					ONAPP_FIELD_MAP => '_id',
					ONAPP_FIELD_TYPE => 'integer',
					ONAPP_FIELD_READ_ONLY => true
				),
				'created_at' => array(
					ONAPP_FIELD_MAP => '_created_at',
					ONAPP_FIELD_TYPE => 'datetime',
					ONAPP_FIELD_READ_ONLY => true,
				),
				'updated_at' => array(
					ONAPP_FIELD_MAP => '_updated_at',
					ONAPP_FIELD_TYPE => 'datetime',
					ONAPP_FIELD_READ_ONLY => true,
				),
				'compatible_with' => array(
					ONAPP_FIELD_MAP => '_compatible_with',
					ONAPP_FIELD_REQUIRED => true,
					ONAPP_FIELD_TYPE => 'string',
					ONAPP_FIELD_DEFAULT_VALUE => ''
				),
				'description' => array(
					ONAPP_FIELD_MAP => '_description',
					ONAPP_FIELD_REQUIRED => true,
					ONAPP_FIELD_TYPE => 'string',
					ONAPP_FIELD_DEFAULT_VALUE => ''
				),
				'script_type' => array(
					ONAPP_FIELD_MAP => '_script_type',
					ONAPP_FIELD_REQUIRED => true,
					ONAPP_FIELD_TYPE => 'string',
					ONAPP_FIELD_DEFAULT_VALUE => 'vbs'
				),
				'label' => array(
					ONAPP_FIELD_MAP => '_label',
					ONAPP_FIELD_REQUIRED => true,
					ONAPP_FIELD_TYPE => 'string',
					ONAPP_FIELD_DEFAULT_VALUE => ''
				),
				'use_on_hv_zones'  => array(
					ONAPP_FIELD_MAP => '_use_on_hv_zones',
					ONAPP_FIELD_REQUIRED => true,
					ONAPP_FIELD_TYPE => 'boolean',
					ONAPP_FIELD_DEFAULT_VALUE => 'false'
				),
				'recipe_steps' => array(
					ONAPP_FIELD_MAP => '_recipe_steps',
					ONAPP_FIELD_TYPE => 'array',
					ONAPP_FIELD_READ_ONLY => true,
					ONAPP_FIELD_CLASS => 'Recipe_Step',
			),
		),
	);
	//get the latest available version.
	
	if (isset($fields[$version])) {
		$this->fields=$fields[$version];
	}
	/* search for nearest defined version, 
	*  less then requested
	*/
	while (count($fields) && $max=max(array_keys($fields))) {
		if ((float)$version >=(float) $max) {
			$this->fields=$fields[$max];
			return $this->fields;
		}
		unset($fields[$max]);
		
	}
	exit;
	return $this->fields;
	}
	
}
