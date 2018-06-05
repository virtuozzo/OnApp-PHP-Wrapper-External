<?php
/**
 * Template Store
 *
 * In OnApp, a template is a pre-configured OS image that you can immediately build a virtual machine on.
 * There are two types of templates for virtual machine deployment in
 * OnApp:
 *  - downloadable templates provisioned by the OnApp team
 *  - templates you can create by means of backing up and duplicating the existing virtual machine
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Templates
 *
 * This class represents the Templates of the OnApp installation that you can build VMs on.
 *
 * The OnApp_Template class uses the following basic methods:
 * {@link load}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( https://docs.onapp.com/display/43API/Template+Store )
 */
class OnApp_TemplateStore extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'image_template_group';
    /**
     * alias processing the object data
     *
     * @var string
     */
    //var $_resource = 'settings/image_template_groups';
    var $_resource = 'template_store';

    /**
     * API Fields description
     *
     * @param string|float $version OnApp API version
     * @param string $className current class' name
     *
     * @return array
     */
    public function initFields( $version = null, $className = '' ) {
        switch ( $version ) {
            case '2.0':
            case '2.1':
            case 2.2:
            case 2.3:
            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
            case 4.2:
                $this->fields                        = array();
                $this->fields['label']               = array(
                    ONAPP_FIELD_MAP  => '_label',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['created_at']          = array(
                    ONAPP_FIELD_MAP  => '_created_at',
                    ONAPP_FIELD_TYPE => 'datetime',
                );
                $this->fields['updated_at']          = array(
                    ONAPP_FIELD_MAP  => '_updated_at',
                    ONAPP_FIELD_TYPE => 'datetime',
                );
                $this->fields['id']                  = array(
                    ONAPP_FIELD_MAP  => '_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['kms_host']            = array(
                    ONAPP_FIELD_MAP  => '_kms_host',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['kms_port']            = array(
                    ONAPP_FIELD_MAP  => '_kms_port',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['kms_server_label']    = array(
                    ONAPP_FIELD_MAP  => '_kms_server_label',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['mak']                 = array(
                    ONAPP_FIELD_MAP  => '_mak',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['own']                 = array(
                    ONAPP_FIELD_MAP  => '_own',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['parent_id']           = array(
                    ONAPP_FIELD_MAP  => '_parent_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['depth']               = array(
                    ONAPP_FIELD_MAP  => '_depth',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['lft']                 = array(
                    ONAPP_FIELD_MAP  => '_lft',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['rgt']                 = array(
                    ONAPP_FIELD_MAP  => '_rgt',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['children']            = array(
                    ONAPP_FIELD_MAP  => '_children',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['hypervisor_group_id'] = array(
                    ONAPP_FIELD_MAP  => '_hypervisor_group_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['kms']                 = array(
                    ONAPP_FIELD_MAP  => '_kms',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['relations']           = array(
                    ONAPP_FIELD_MAP  => '_relations',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['system_group']        = array(
                    ONAPP_FIELD_MAP  => '_system_group',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['user_id']             = array(
                    ONAPP_FIELD_MAP  => '_user_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
            case 4.3:
            case 5.0:
                $this->fields = $this->initFields( 4.2 );
                break;
            case 5.1:
                $this->fields = $this->initFields( 5.0 );
                break;
            case 5.2:
                $this->fields = $this->initFields( 5.1 );
                break;
            case 5.3:
                $this->fields = $this->initFields( 5.2 );
                break;
            case 5.4:
                $this->fields = $this->initFields( 5.3 );
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
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
                $resource = parent::getResource( $action );
        }

        return $resource;
    }

}
