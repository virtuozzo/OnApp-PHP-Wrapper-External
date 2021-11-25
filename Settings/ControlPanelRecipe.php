<?php

/**
 * ControlPanelRecipe
 *
 * @category        API wrapper
 * @package         OnApp
 * @subpackage      Settings
 * @author          Mykola Vuy
 * @copyright       © 2019 OnApp
 *
 */

/**
 * ControlPanelRecipe Joins
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_Settings_ControlPanelRecipe class uses the
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Settings_ControlPanelRecipe extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'recipe_join';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'recipe_joins';
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
            case 6.1:
                $this->fields = array(
                    'recipe_id'                 => array(
                        ONAPP_FIELD_MAP  => '_recipe_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'event_type'                => array(
                        ONAPP_FIELD_MAP  => '_event_type',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'kvm_hv_goes_online'        => array(
                        ONAPP_FIELD_MAP  => '_kvm_hv_goes_online',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'kvm_hv_goes_offline'       => array(
                        ONAPP_FIELD_MAP  => '_kvm_hv_goes_offline',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'xen_hv_goes_online'        => array(
                        ONAPP_FIELD_MAP  => '_xen_hv_goes_online',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'xen_hv_goes_offline'       => array(
                        ONAPP_FIELD_MAP  => '_xen_hv_goes_offline',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vmware_hv_goes_online'     => array(
                        ONAPP_FIELD_MAP  => '_vmware_hv_goes_online',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vmware_hv_goes_offline'    => array(
                        ONAPP_FIELD_MAP  => '_vmware_hv_goes_offline',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'hv_added'                  => array(
                        ONAPP_FIELD_MAP  => '_hv_added',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'hv_removed'                => array(
                        ONAPP_FIELD_MAP  => '_hv_removed',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'ip_allocated_to_vm_nic'    => array(
                        ONAPP_FIELD_MAP  => '_ip_allocated_to_vm_nic',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'ip_revoked_from_vm_nic'    => array(
                        ONAPP_FIELD_MAP  => '_ip_revoked_from_vm_nic',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vm_provisioning'           => array(
                        ONAPP_FIELD_MAP  => '_vm_provisioning',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vm_network_rebuild'        => array(
                        ONAPP_FIELD_MAP  => '_vm_network_rebuild',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vm_disk_add'               => array(
                        ONAPP_FIELD_MAP  => '_vm_disk_add',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vm_nic_add'                => array(
                        ONAPP_FIELD_MAP  => '_vm_nic_add',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vm_nic_remove'             => array(
                        ONAPP_FIELD_MAP  => '_vm_nic_remove',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vm_disk_resize'            => array(
                        ONAPP_FIELD_MAP  => '_vm_disk_resize',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vm_resize'                 => array(
                        ONAPP_FIELD_MAP  => '_vm_resize',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vm_ip_address_add'         => array(
                        ONAPP_FIELD_MAP  => '_vm_ip_address_add',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vm_ip_address_remove'      => array(
                        ONAPP_FIELD_MAP  => '_vm_ip_address_remove',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vm_start'                  => array(
                        ONAPP_FIELD_MAP  => '_vm_start',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vm_reboot'                 => array(
                        ONAPP_FIELD_MAP  => '_vm_reboot',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vm_hot_migrate'            => array(
                        ONAPP_FIELD_MAP  => '_vm_hot_migrate',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vm_hot_full_migrate'       => array(
                        ONAPP_FIELD_MAP  => '_vm_hot_full_migrate',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vm_failover'               => array(
                        ONAPP_FIELD_MAP  => '_vm_failover',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                );
                break;

            case 6.2:
                $this->fields = $this->initFields( 6.1 );
                break;

            case 6.3:
                $this->fields = $this->initFields( 6.2 );
                break;

            case 6.4:
                $this->fields = $this->initFields( 6.3 );
                break;

            case 6.5:
                $this->fields = $this->initFields( 6.4 );
                break;

            case 6.6:
                $this->fields = $this->initFields( 6.5 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

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
        $show_log_msg = true;
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name settings_control_panel_recipe
                 * @method GET
                 * @alias    /settings/control_panel/recipe_joins(.:format)
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias    /settings/control_panel/recipe_joins(.:format)
                 */
                $resource = 'settings/control_panel/' . $this->_resource;
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }
}
