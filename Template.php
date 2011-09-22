<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Provisioning Templates
 *
 * In OnApp, a template is a pre-configured OS image that you can immediately build a virtual machine on.
 * There are two types of templates for virtual machine deployment in
 * OnApp:
 *  - downloadable templates provisioned by the OnApp team
 *  - templates you can create by means of backing up and duplicating the existing virtual machine
 *
 * @category	API WRAPPER
 * @package		OnApp
 * @author		Andrew Yatskovets
 * @copyright	(c) 2011 OnApp
 * @link		http://www.onapp.com/
 * @see			OnApp
 */

define( 'ONAPP_GET_USERTEMPLATES_LIST', 'user' );

/**
 * Templates
 *
 * This class represents the Templates of the OnApp installation that you can build VMs on.
 *
 * The ONAPP_Template class uses the following basic methods:
 * {@link load}, {@link delete}, and {@link getList}.
 *
 * <b>Use the following XML API requests:</b>
 *
 * Get the list of templates
 *
 *	 - <i>GET onapp.com/templates.xml</i>
 *
 * Get a particular template details
 *
 *	 - <i>GET onapp.com/templates/{ID}.xml</i>
 *
 * Add new template
 *
 *	 - <i>POST onapp.com/templates.xml</i>
 *
 * <code>
 * <?xml version="1.0" encoding="UTF-8"?>
 * <image-template>
 *	 <!-- TODO add description -->
 * </image-template>
 * </code>
 *
 * Edit existing template
 *
 *	 - <i>PUT onapp.com/templates/{ID}.xml</i>
 *
 * <code>
 * <?xml version="1.0" encoding="UTF-8"?>
 * <image-template>
 *	 <!-- TODO add description -->
 * </image-template>
 * </code>
 *
 * Delete template
 *
 *	 - <i>DELETE onapp.com/templates/{ID}.xml</i>
 *
 * <b>Use the following JSON API requests:</b>
 *
 * Get the list of templates
 *
 *	 - <i>GET onapp.com/templates.json</i>
 *
 * Get a particular template details
 *
 *	 - <i>GET onapp.com/templates/{ID}.json</i>
 *
 * Add new template
 *
 *	 - <i>POST onapp.com/templates.json</i>
 *
 * <code>
 * {
 *	  image-template: {
 *		  # TODO add description
 *	  }
 * }
 * </code>
 *
 * Edit existing template
 *
 *	 - <i>PUT onapp.com/templates/{ID}.json</i>
 *
 * <code>
 * {
 *	  image-template: {
 *		  # TODO add description
 *	  }
 * }
 * </code>
 *
 * Delete template
 *
 *	 - <i>DELETE onapp.com/templates/{ID}.json</i>
 */
class OnApp_Template extends OnApp {
	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	var $_tagRoot = 'image_template';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	var $_resource = 'templates';

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
				$this->fields = array(
					'id' => array(
						ONAPP_FIELD_MAP => '_id',
						ONAPP_FIELD_TYPE => 'integer',
						ONAPP_FIELD_READ_ONLY => true
					),
					'allow_resize_without_reboot' => array(
						ONAPP_FIELD_MAP => '_allow_resize_without_reboot',
						ONAPP_FIELD_TYPE => 'boolean',
						ONAPP_FIELD_READ_ONLY => true,
						ONAPP_FIELD_REQUIRED => true,
					),
					'allowed_swap' => array(
						ONAPP_FIELD_MAP => '_allowed_swap',
						ONAPP_FIELD_TYPE => 'boolean',
						ONAPP_FIELD_READ_ONLY => true,
						ONAPP_FIELD_REQUIRED => true,
					),
					'checksum' => array(
						ONAPP_FIELD_MAP => '_checksum',
						ONAPP_FIELD_READ_ONLY => true,
						ONAPP_FIELD_REQUIRED => true,
					),
					'created_at' => array(
						ONAPP_FIELD_MAP => '_created_at',
						ONAPP_FIELD_TYPE => 'datetime',
						ONAPP_FIELD_READ_ONLY => true,
						ONAPP_FIELD_REQUIRED => true,
					),
					'file_name' => array(
						ONAPP_FIELD_MAP => '_file_name',
						ONAPP_FIELD_READ_ONLY => true,
						ONAPP_FIELD_REQUIRED => true,
					),
					'label' => array(
						ONAPP_FIELD_MAP => '_label',
						ONAPP_FIELD_READ_ONLY => true,
						ONAPP_FIELD_REQUIRED => true,
					),
					'min_disk_size' => array(
						ONAPP_FIELD_MAP => '_min_disk_size',
						ONAPP_FIELD_TYPE => 'integer',
						ONAPP_FIELD_READ_ONLY => true,
						ONAPP_FIELD_REQUIRED => true,
					),
					'operating_system' => array(
						ONAPP_FIELD_MAP => '_operating_system',
						ONAPP_FIELD_READ_ONLY => true,
						ONAPP_FIELD_REQUIRED => true,
					),
					'operating_system_distro' => array(
						ONAPP_FIELD_MAP => '_operating_system_distro',
						ONAPP_FIELD_READ_ONLY => true,
						ONAPP_FIELD_REQUIRED => true,
					),
					'state' => array(
						ONAPP_FIELD_MAP => '_state',
						ONAPP_FIELD_READ_ONLY => true,
						ONAPP_FIELD_REQUIRED => true,
					),
					'updated_at' => array(
						ONAPP_FIELD_MAP => '_updated_at',
						ONAPP_FIELD_TYPE => 'datetime',
						ONAPP_FIELD_READ_ONLY => true,
						ONAPP_FIELD_REQUIRED => true,
					),
					'user_id' => array(
						ONAPP_FIELD_MAP => '_user_id',
						ONAPP_FIELD_TYPE => 'integer',
						ONAPP_FIELD_READ_ONLY => true,
						ONAPP_FIELD_REQUIRED => true,
					),
					'version' => array(
						ONAPP_FIELD_MAP => '_template_version',
						ONAPP_FIELD_READ_ONLY => true,
						ONAPP_FIELD_REQUIRED => true,
					),
					'template_size' => array(
						ONAPP_FIELD_MAP => '_template_size',
						ONAPP_FIELD_TYPE => 'integer',
						ONAPP_FIELD_READ_ONLY => true,
					),
				);
				break;

			case '2.1':
				$this->fields = $this->initFields( '2.0' );

				$this->fields[ 'allowed_hot_migrate' ] = array(
					ONAPP_FIELD_MAP => '_allowed_hot_migrate',
					ONAPP_FIELD_TYPE => 'boolean',
					ONAPP_FIELD_REQUIRED => true
				);
				$this->fields[ 'operating_system_arch' ] = array(
					ONAPP_FIELD_MAP => '_operating_system_arch',
					ONAPP_FIELD_TYPE => 'string',
					ONAPP_FIELD_REQUIRED => true
				);
				$this->fields[ 'operating_system_edition' ] = array(
					ONAPP_FIELD_MAP => '_operating_system_edition',
					ONAPP_FIELD_TYPE => 'string',
					ONAPP_FIELD_REQUIRED => true
				);
				$this->fields[ 'operating_system_tail' ] = array(
					ONAPP_FIELD_MAP => '_operating_system_tail',
					ONAPP_FIELD_TYPE => 'string',
					ONAPP_FIELD_REQUIRED => true
				);
				$this->fields[ 'virtualization' ] = array(
					ONAPP_FIELD_MAP => '_virtualization',
					ONAPP_FIELD_TYPE => 'string',
					ONAPP_FIELD_REQUIRED => true
				);
				$this->fields[ 'parent_template_id' ] = array(
					ONAPP_FIELD_MAP => '_template_size',
					ONAPP_FIELD_TYPE => 'integer',
					ONAPP_FIELD_READ_ONLY => true,
				);
				break;

			case 2.2:
				$this->fields = $this->initFields( 2.1 );
				$this->fields[ 'min_memory_size' ] = array(
					ONAPP_FIELD_MAP => 'min_memory_size',
					ONAPP_FIELD_TYPE => 'integer',
					ONAPP_FIELD_READ_ONLY => true,
				);
				$this->fields[ 'disk_target_device' ] = array(
					ONAPP_FIELD_MAP => 'disk_target_device',
					ONAPP_FIELD_TYPE => 'string',
					ONAPP_FIELD_READ_ONLY => true,
				);
				break;

			case 2.3:
				$this->fields = $this->initFields( 2.2 );
				$this->fields[ 'disk_target_device' ] = array(
					ONAPP_FIELD_MAP => 'disk_target_device',
					ONAPP_FIELD_TYPE => 'string',
					ONAPP_FIELD_READ_ONLY => true,
				);
				$this->fields[ 'cdn' ] = array(
					ONAPP_FIELD_MAP => 'cdn',
					ONAPP_FIELD_TYPE => 'boolean',
					ONAPP_FIELD_READ_ONLY => true,
				);
				// nested class
				$this->fields[ 'template_set_ids' ] = array(
					ONAPP_FIELD_MAP => 'template_set_ids',
					ONAPP_FIELD_READ_ONLY => true,
				);
				break;
		}

		parent::initFields( $version, __CLASS__ );
		return $this->fields;
	}

	public function getUserTemplates() {
		return $this->sendGet( ONAPP_GET_USERTEMPLATES_LIST );
	}

	function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			case ONAPP_GET_USERTEMPLATES_LIST:
			case 'user':
				$resource = $this->getResource( ONAPP_GETRESOURCE_LIST ) . '/' . ONAPP_GET_USERTEMPLATES_LIST;
				break;

			default:
				/**
				 * ROUTE :
				 * @name image_templates
				 * @method GET
				 * @alias  /templates(.:format)
				 * @format  {:controller=>"image_templates", :action=>"index"}
				 */
				/**
				 * ROUTE :
				 * @name image_template
				 * @method GET
				 * @alias  /templates/:id(.:format)
				 * @format  {:controller=>"image_templates", :action=>"show"}
				 */
				/**
				 * ROUTE :
				 * @name
				 * @method DELETE
				 * @alias  /templates/:id(.:format)
				 * @format   {:controller=>"image_templates", :action=>"destroy"}
				 */
				$resource = parent::getResource( $action );
		}
		return $resource;
	}

	function activate( $action_name ) {
		switch( $action_name ) {
			case ONAPP_ACTIVATE_SAVE:
				exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
				break;
		}
	}
}