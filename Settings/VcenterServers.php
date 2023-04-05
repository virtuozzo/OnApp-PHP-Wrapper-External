<?php
/**
 * Settings_VcenterServers
 *
 * much they will be charged per unit.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Mykola Vuy
 * @copyright   © 2020 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Settings_VcenterServers
 *
 * The OnApp_Settings_VcenterServers class uses the following basic methods:
 * {@link load} {@link save} {@link delete} and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_Settings_VcenterServers extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'vcenter_server';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/vcenter_servers';

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
            case 6.4:
                $this->fields = array(
                    'id'                    => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'label'                 => array(
                        ONAPP_FIELD_MAP         => '_label',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'api_url'               => array(
                        ONAPP_FIELD_MAP         => '_api_url',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'login'                 => array(
                        ONAPP_FIELD_MAP         => '_login',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'online'                => array(
                        ONAPP_FIELD_MAP         => '_online',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'host'              => array(
                        ONAPP_FIELD_MAP         => '_host',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'machine'           => array(
                        ONAPP_FIELD_MAP         => '_machine',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'release'           => array(
                        ONAPP_FIELD_MAP         => '_release',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'instance_uuid'     => array(
                        ONAPP_FIELD_MAP         => '_instance_uuid',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'cpu_mhz'           => array(
                        ONAPP_FIELD_MAP         => '_cpu_mhz',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'cpus'              => array(
                        ONAPP_FIELD_MAP         => '_cpus',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'threads_per_core'  => array(
                        ONAPP_FIELD_MAP         => '_threads_per_core',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'cpu_cores'         => array(
                        ONAPP_FIELD_MAP         => '_cpu_cores',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'total_mem'         => array(
                        ONAPP_FIELD_MAP         => '_total_mem',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'free_mem'          => array(
                        ONAPP_FIELD_MAP         => '_free_mem',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'public_key_hash'   => array(
                        ONAPP_FIELD_MAP         => '_public_key_hash',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'password'          => array(
                        ONAPP_FIELD_MAP         => '_password',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                );
                break;

            case 6.5:
                $this->fields = $this->initFields( 6.4 );
                break;

            case 6.6:
                $this->fields = $this->initFields( 6.5 );
                break;

            case 6.7:
                $this->fields = $this->initFields( 6.6 );
                break;

            default:
                $this->fields = $this->initFields( 6.7 );
                break;
        }
        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name Get List of vCenter Servers
                 * @method GET
                 * @alias  /settings/vcenter_servers(.:format)
                 * @format {:controller=>"TemplateRoles", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Add vCenter Server
                 * @method POST
                 * @alias  /settings/vcenter_servers(.:format)
                 * @format {:controller=>"TemplateRoles", :action=>"load"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Edit vCenter Server
                 * @method PUT
                 * @alias  /settings/vcenter_servers/:id(.:format)
                 * @format {:controller=>"TemplateRoles", :action=>"load"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Delete vCenter Server
                 * @method DELETE
                 * @alias  /settings/vcenter_servers/:id(.:format)
                 * @format {:controller=>"TemplateRoles", :action=>"load"}
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

}
