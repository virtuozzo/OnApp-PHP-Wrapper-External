<?php

/**
 * Settings ExternalNetworks
 *
 * @category        API wrapper
 * @package         OnApp
 * @subpackage      Settings
 * @copyright       © 2021 OnApp
 *
 */

/**
 * Settings ExternalNetworks
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_Settings_ExternalNetworks class uses the
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Settings_ExternalNetworks extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'external_network';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'external_networks';
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
                    'id'                            => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'label'                         => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'identifier'                    => array(
                        ONAPP_FIELD_MAP  => '_identifier',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'created_at'                    => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'updated_at'                    => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'vlan'                          => array(
                        ONAPP_FIELD_MAP  => '_vlan',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'network_group_id'              => array(
                        ONAPP_FIELD_MAP  => '_network_group_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'type'                          => array(
                        ONAPP_FIELD_MAP  => '_type',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'user_id'                       => array(
                        ONAPP_FIELD_MAP  => '_user_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'ip_address_pool_id'            => array(
                        ONAPP_FIELD_MAP  => '_ip_address_pool_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'default_outside_ip_address_id' => array(
                        ONAPP_FIELD_MAP  => '_default_outside_ip_address_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'default_nat_rule_number'       => array(
                        ONAPP_FIELD_MAP  => '_default_nat_rule_number',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'prefix_size'                   => array(
                        ONAPP_FIELD_MAP  => '_prefix_size',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'is_nated'                      => array(
                        ONAPP_FIELD_MAP  => '_is_nated',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'vapp_id'                       => array(
                        ONAPP_FIELD_MAP  => '_vapp_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'vdc_id'                        => array(
                        ONAPP_FIELD_MAP  => '_vdc_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'enabled'                       => array(
                        ONAPP_FIELD_MAP  => '_enabled',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'gateway'                       => array(
                        ONAPP_FIELD_MAP  => '_gateway',
                        ONAPP_FIELD_TYPE => 'string',
                    ),

                    'netmask'                       => array(
                        ONAPP_FIELD_MAP  => '_netmask',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'primary_dns'                   => array(
                        ONAPP_FIELD_MAP  => '_primary_dns',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'secondary_dns'                 => array(
                        ONAPP_FIELD_MAP  => '_secondary_dns',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'dns_suffix'                    => array(
                        ONAPP_FIELD_MAP  => '_dns_suffix',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'shared'                        => array(
                        ONAPP_FIELD_MAP  => '_shared',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'fence_mode'                    => array(
                        ONAPP_FIELD_MAP  => '_fence_mode',
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
                $this->fields['vcenter_identifier']     = array(
                    ONAPP_FIELD_MAP  => '_vcenter_identifier',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['parent_network_id']      = array(
                    ONAPP_FIELD_MAP  => '_parent_network_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['openstack_id']           = array(
                    ONAPP_FIELD_MAP  => '_openstack_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['dv_switch_id']           = array(
                    ONAPP_FIELD_MAP  => '_dv_switch_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['vdc_group_id']           = array(
                    ONAPP_FIELD_MAP  => '_vdc_group_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['universal_router_id']    = array(
                    ONAPP_FIELD_MAP  => '_universal_router_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['backing_type']           = array(
                    ONAPP_FIELD_MAP  => '_backing_type',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['ip_nets']                = array(
                    ONAPP_FIELD_MAP  => '_ip_nets',
                    ONAPP_FIELD_TYPE => '_array',
                );
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
                 * @name Get vCloud External Network
                 * @method GET
                 * @alias   /settings/external_networks(.:format)
                 */
                /**
                 * ROUTE :
                 *
                 * @name Get vCloud External Network Details
                 * @method GET
                 * @alias   GET /settings/external_networks/:id(.:format)
                 */

                $resource = 'settings/' . $this->_resource;
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    /**
     * Activates action performed with object
     *
     * @param string $action_name the name of action
     *
     * @access public
     */
    function activateCheck( $action_name ) {
        switch ( $action_name ) {
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }

}
