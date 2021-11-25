<?php

/**
 * Provider Vdcs
 *
 * @category        API wrapper
 * @package         OnApp
 * @copyright       © 2021 OnApp
 */

/**
 * Provider_Vdcs
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_Provider_Vdcs class uses the following basic methods:
 * {@link load} and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Provider_Vdcs extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'provider_vdc';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'provider_vdcs';
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
            case 6.6:
                $this->fields = array(
                    'id'                                => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'label'                             => array(
                        ONAPP_FIELD_MAP         => '_label',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'cpu_allocated'                     => array(
                        ONAPP_FIELD_MAP         => '_cpu_allocated',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'cpu_total'                         => array(
                        ONAPP_FIELD_MAP         => '_cpu_total',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'cpu_used'                          => array(
                        ONAPP_FIELD_MAP         => '_cpu_used',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'created_at'                        => array(
                        ONAPP_FIELD_MAP         => '_created_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'updated_at'                        => array(
                        ONAPP_FIELD_MAP         => '_updated_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'enabled'                           => array(
                        ONAPP_FIELD_MAP         => '_enabled',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'hypervisor_id'                     => array(
                        ONAPP_FIELD_MAP         => '_hypervisor_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'identifier'                        => array(
                        ONAPP_FIELD_MAP         => '_identifier',
                        ONAPP_FIELD_TYPE        => 'string',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'memory_allocated'                  => array(
                        ONAPP_FIELD_MAP         => '_memory_allocated',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'memory_total'                      => array(
                        ONAPP_FIELD_MAP         => '_memory_total',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'memory_used'                       => array(
                        ONAPP_FIELD_MAP         => '_memory_used',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'network_provider_type'             => array(
                        ONAPP_FIELD_MAP         => '_network_provider_type',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'external_networks'                 => array(
                        ONAPP_FIELD_MAP         => '_external_networks',
                        ONAPP_FIELD_TYPE        => '_array',
                    ),
                    'storage_policies'                  => array(
                        ONAPP_FIELD_MAP         => '_storage_policies',
                        ONAPP_FIELD_TYPE        => '_array',
                    ),
                    'network_pools'                     => array(
                        ONAPP_FIELD_MAP         => '_network_pools',
                        ONAPP_FIELD_TYPE        => '_array',
                    ),
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
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name Get List of Provider Resource Pools
                 * @method GET
                 * @alias  /provider_vdcs(.:format)
                 * @format {:controller=>"Provider_Vdcs", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Get Provider Resource Pool details
                 * @method GET
                 * @alias  /provider_vdcs/:id(.:format)
                 * @format {:controller=>"Provider_Vdcs", :action=>"load"}
                 */

                $resource = $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
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
