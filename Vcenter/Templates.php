<?php

/**
 * Vcenter Templates
 *
 * @category        API wrapper
 * @package         OnApp
 * @author          Mykola Vuy
 * @copyright       © 2019 OnApp
 */

/**
 * Vcenter_Templates
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_Vcenter_Templates class uses the
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Vcenter_Templates extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'vcenter_image_template';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'vcenter/templates';
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
            case 6.2:
                $this->fields = array(
                    'id'                            => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'label'                         => array(
                        ONAPP_FIELD_MAP  => '_label',
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
                    'version'                       => array(
                        ONAPP_FIELD_MAP  => '_version',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'file_name'                     => array(
                        ONAPP_FIELD_MAP  => '_file_name',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'operating_system'              => array(
                        ONAPP_FIELD_MAP  => '_operating_system',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'operating_system_distro'       => array(
                        ONAPP_FIELD_MAP  => '_operating_system_distro',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'allowed_swap'                  => array(
                        ONAPP_FIELD_MAP  => '_allowed_swap',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'state'                         => array(
                        ONAPP_FIELD_MAP  => '_state',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'checksum'                      => array(
                        ONAPP_FIELD_MAP  => '_checksum',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'allow_resize_without_reboot'   => array(
                        ONAPP_FIELD_MAP  => '_allow_resize_without_reboot',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'min_disk_size'                 => array(
                        ONAPP_FIELD_MAP  => '_min_disk_size',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'user_id'                       => array(
                        ONAPP_FIELD_MAP  => '_user_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'template_size'                 => array(
                        ONAPP_FIELD_MAP  => '_template_size',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'allowed_hot_migrate'           => array(
                        ONAPP_FIELD_MAP  => '_allowed_hot_migrate',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'operating_system_arch'         => array(
                        ONAPP_FIELD_MAP  => '_operating_system_arch',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'operating_system_edition'      => array(
                        ONAPP_FIELD_MAP  => '_operating_system_edition',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'operating_system_tail'         => array(
                        ONAPP_FIELD_MAP  => '_operating_system_tail',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'parent_template_id'            => array(
                        ONAPP_FIELD_MAP  => '_parent_template_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'virtualization'                => array(
                        ONAPP_FIELD_MAP  => '_virtualization',
                        ONAPP_FIELD_TYPE => '_array',
                    ),
                    'min_memory_size'               => array(
                        ONAPP_FIELD_MAP  => '_min_memory_size',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'disk_target_device'            => array(
                        ONAPP_FIELD_MAP  => '_disk_target_device',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'cdn'                           => array(
                        ONAPP_FIELD_MAP  => '_cdn',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'backup_server_id'              => array(
                        ONAPP_FIELD_MAP  => '_backup_server_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'ext4'                          => array(
                        ONAPP_FIELD_MAP  => '_ext4',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'smart_server'                  => array(
                        ONAPP_FIELD_MAP  => '_smart_server',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'baremetal_server'              => array(
                        ONAPP_FIELD_MAP  => '_baremetal_server',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'initial_password'              => array(
                        ONAPP_FIELD_MAP  => '_initial_password',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'initial_username'              => array(
                        ONAPP_FIELD_MAP  => '_initial_username',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'remote_id'                     => array(
                        ONAPP_FIELD_MAP  => '_remote_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'manager_id'                    => array(
                        ONAPP_FIELD_MAP  => '_manager_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'resize_without_reboot_policy'  => array(
                        ONAPP_FIELD_MAP  => '_resize_without_reboot_policy',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'application_server'            => array(
                        ONAPP_FIELD_MAP  => '_application_server',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'draas'                         => array(
                        ONAPP_FIELD_MAP  => '_draas',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'properties'                    => array(
                        ONAPP_FIELD_MAP  => '_properties',
                        ONAPP_FIELD_TYPE => '_array',
                    ),
                    'locked'                        => array(
                        ONAPP_FIELD_MAP  => '_locked',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'openstack_id'                  => array(
                        ONAPP_FIELD_MAP  => '_openstack_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'datacenter_id'                 => array(
                        ONAPP_FIELD_MAP  => '_datacenter_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'identifier'                    => array(
                        ONAPP_FIELD_MAP  => '_identifier',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'type'                          => array(
                        ONAPP_FIELD_MAP  => '_type',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                );
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

            case 6.7:
                $this->fields = $this->initFields( 6.6 );
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
    public function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name Vcenter Templates
                 * @method GET
                 * @alias   /vcenter/templates(.:format)
                 * @format  {:controller=>"Vcenter_Templates", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Vcenter Templates
                 * @method PUT
                 * @alias    /vcenter/templates/:id(.:format)
                 * @format   {:controller=>"Vcenter_Templates", :action=>"save"}
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

    public function save()
    {
        if ( is_null( $this->_id ) ) {
            $this->logger->error(
                'save(): argument id not set.',
                __FILE__,
                __LINE__
            );
        }

        if ( is_null( $this->_initial_password ) ) {
            $this->logger->error(
                'save(): argument initial_password not set.',
                __FILE__,
                __LINE__
            );
        }

        if ( is_null( $this->_initial_username ) ) {
            $this->logger->error(
                'save(): argument initial_username not set.',
                __FILE__,
                __LINE__
            );
        }

        $data = array(
            'root' => $this->_tagRoot,
            'data' => array(
                'initial_password' => $this->_initial_password,
                'initial_username' => $this->_initial_username,
            ),
        );

        $this->sendPut( ONAPP_GETRESOURCE_DEFAULT, $data );
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
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }

}
