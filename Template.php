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
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   (c) 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

define( 'ONAPP_GET_USERTEMPLATES_LIST', 'user' );

/**
 * Templates
 *
 * This class represents the Templates of the OnApp installation that you can build VMs on.
 *
 * The OnApp_Template class uses the following basic methods:
 * {@link load}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Template extends OnApp {
	/**
	 * Magic properties
	 *
	 * @property integer  id
	 * @property boolean  allow_resize_without_reboot
	 * @property boolean  allowed_swap
	 * @property checksum
	 * @property datetime created_at
	 * @property file_name
	 * @property label
	 * @property integer  min_disk_size
	 * @property operating_system
	 * @property operating_system_distro
	 * @property state
	 * @property datetime updated_at
	 * @property integer  user_id
	 * @property version
	 * @property integer  template_size
	 * @property boolean  allowed_hot_migrate
	 * @property string   operating_system_arch
	 * @property string   operating_system_edition
	 * @property string   operating_system_tail
	 * @property string   virtualization
	 * @property integer  parent_template_id
	 * @property integer  min_memory_size
	 * @property string   disk_target_device
	 * @property boolean  cdn
	 * @property template_set_ids
	 * @property integer  backup_server_id
	 */

	/**
	 * root tag used in the API request
	 *
	 * @var string
	 */
	protected $rootElement = 'image_template';

	/**
	 * alias processing the object data
	 *
	 * @var string
	 */
	protected $URLPath = 'templates';

	public function __construct() {
		parent::__construct();
		$this->className = __CLASS__;
	}

	public function getUserTemplates() {
		return $this->sendGet( ONAPP_GET_USERTEMPLATES_LIST );
	}

	function getURL( $action = ONAPP_GETRESOURCE_DEFAULT ) {
		switch( $action ) {
			case ONAPP_GET_USERTEMPLATES_LIST:
			case 'user':
				$resource = $this->getURL( ONAPP_GETRESOURCE_LIST ) . '/' . ONAPP_GET_USERTEMPLATES_LIST;
				break;

			default:
				/**
				 * ROUTE :
				 *
				 * @name image_templates
				 * @method GET
				 * @alias   /templates(.:format)
				 * @format  {:controller=>"image_templates", :action=>"index"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name image_template
				 * @method GET
				 * @alias   /templates/:id(.:format)
				 * @format  {:controller=>"image_templates", :action=>"show"}
				 */
				/**
				 * ROUTE :
				 *
				 * @name
				 * @method DELETE
				 * @alias    /templates/:id(.:format)
				 * @format   {:controller=>"image_templates", :action=>"destroy"}
				 */
				$resource = parent::getURL( $action );
		}
		return $resource;
	}

	function activate( $action_name ) {
		switch( $action_name ) {
			case ONAPP_ACTIVATE_SAVE:
				exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
		}
	}
}