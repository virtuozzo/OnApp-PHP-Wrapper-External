<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * VM IP Adresses
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  Recipe
 * @author      Alexey Zbinyakov
 * @copyright   (c) 2014 ????
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
 
class Recipe_Step extends OnApp {
	/**
	* root tag used in the API request
	*
	* @var string
	*/
	var $_tagRoot = 'recipe_step';

	/**
	* alias processing the object data
	*
	* @var string
	*/
	var $_resource = 'recipe_steps';
	
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
				'on_failure' => array(
					ONAPP_FIELD_MAP=> '_on_failure',
					ONAPP_FIELD_REQUIRED => true,
					ONAPP_FIELD_TYPE => 'string',
				),
				'on_success' => array(
					ONAPP_FIELD_MAP=> '_on_success',
					ONAPP_FIELD_REQUIRED => true,
					ONAPP_FIELD_TYPE => 'string',
				),
				'pass_anything_else' => array(
					ONAPP_FIELD_MAP=> '_pass_anything_else',
					ONAPP_FIELD_REQUIRED => true,
					ONAPP_FIELD_TYPE => 'boolean',
				),
				'fail_anything_else' => array(
					ONAPP_FIELD_MAP=> '_fail_anything_else',
					ONAPP_FIELD_REQUIRED => true,
					ONAPP_FIELD_TYPE => 'boolean',
				),
				
				
				
				'failure_goto_step' => array(
					ONAPP_FIELD_MAP=> '_failure_goto_step',
					ONAPP_FIELD_REQUIRED => true,
					ONAPP_FIELD_TYPE => 'integer',
				),
				'number' => array(
					ONAPP_FIELD_MAP=> '_number',
					ONAPP_FIELD_REQUIRED => true,
					ONAPP_FIELD_TYPE => 'integer',
				),
				
				'pass_values' => array(
					ONAPP_FIELD_MAP=> '_pass_values',
					ONAPP_FIELD_REQUIRED => true,
					ONAPP_FIELD_TYPE => 'boolean',
				),
				'recipe_id' => array(
					ONAPP_FIELD_MAP=> '_recipe_id',
					ONAPP_FIELD_REQUIRED => true,
					ONAPP_FIELD_TYPE => 'integer',
				),
				'result_source' => array(
					ONAPP_FIELD_MAP=> '_result_source',
					ONAPP_FIELD_REQUIRED => true,
					ONAPP_FIELD_TYPE => 'string',
				),
				'success_goto_step' => array(
					ONAPP_FIELD_MAP=> '_success_goto_step',
					ONAPP_FIELD_REQUIRED => true,
					ONAPP_FIELD_TYPE => 'string',
				),
	));

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
	return $this->fields;
	}

		/**
	* Returns the URL Alias of the API Class that inherits the OnApp class
	*
	* @param string $action action name
	*
	* @return string API resource
	* @access public
	*/
	function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
				case ONAPP_GETRESOURCE_DEFAULT:
					if( is_null( $this->_recipe_id ) && is_null( $this->_obj->_recipe_id ) ) {
							$this->logger->error(
									"getResource($action): argument _recipe_id not set.",
									__FILE__,
									__LINE__
							);
					}
					else {
							if( is_null( $this->_recipe_id ) ) {
									$this->_recipe_id = $this->_obj->_recipe_id;
							}
					}
					$resource = 'recipes/' . $this->_recipe_id . '/' . $this->_resource;
					$this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
					break;

				default:
						$resource = parent::getResource( $action );
						break;
		}

		return $resource;
	}
}
