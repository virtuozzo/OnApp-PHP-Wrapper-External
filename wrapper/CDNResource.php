<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing CDN Resources
 *
 *
 * @category	API WRAPPER
 * @package		OnApp
 * @author		Yakubskiy Yuriy
 * @copyright	(c) 2011 OnApp
 * @link		http://www.onapp.com/
 * @see			OnApp
 */

/**
 * Managing CDN Resource
 *
 * The CDN Resource class represents the CDN Resources.
 * The ONAPP_CDNResource class is the parent of the OnApp class.
 *
 * The CDNResource uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 */
class OnApp_CDNResource extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	var $_tagRoot = 'cdn_resource';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	var $_resource = 'cdn_resources';

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
			case '2.3':
				$this->fields = array(
                    'created_at' => array(
						ONAPP_FIELD_MAP => '_created_at',
						ONAPP_FIELD_TYPE => 'string',
						ONAPP_FIELD_READ_ONLY => true
					),
                    'resource_type' => array(
						ONAPP_FIELD_MAP => '_resource_type',
						ONAPP_FIELD_TYPE => 'string',
					),
                    'updated_at' => array(
						ONAPP_FIELD_MAP => '_updated_at',
						ONAPP_FIELD_TYPE => 'string',
						ONAPP_FIELD_READ_ONLY => true
					),
					'id' => array(
						ONAPP_FIELD_MAP => '_id',
						ONAPP_FIELD_TYPE => 'integer',
						ONAPP_FIELD_READ_ONLY => true,
					),
					'user_id' => array(
						ONAPP_FIELD_MAP => '_user_id',
						ONAPP_FIELD_TYPE => 'integer',
					),
					'cdn_hostname' => array(
						ONAPP_FIELD_MAP => '_cdn_hostname',
						ONAPP_FIELD_TYPE => 'string',
					),
                    'aflexi_resource_id' => array(
						ONAPP_FIELD_MAP => 'aflexi_resource_id',
						ONAPP_FIELD_TYPE => 'integer',
					),
                    'aflexi_resource_id' => array(
						ONAPP_FIELD_MAP => 'aflexi_resource_id',
						ONAPP_FIELD_TYPE => 'integer',
					),
                    'aflexi_resource_id' => array(
						ONAPP_FIELD_MAP => 'aflexi_resource_id',
						ONAPP_FIELD_TYPE => 'integer',
					),


				);
                break;
		}

		parent::initFields( $version, __CLASS__ );
		return $this->fields;
	}
}