<?php

/**
 * Managing ISO
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        https://docs.onapp.com/display/42API/ISOs
 * @see         OnApp
 */

/**
 * To view the list of public ISOs
 */
define( 'ONAPP_GET_LIST_PUBLIC_ISO', 'public' );

/**
 * To view the list of ISOs that a particular user uploaded
 * Get List of ISOs of Particular User
 */
define( 'ONAPP_GET_LIST_PARTICULAR_USER_ISO', 'particular_user_iso' );

/**
 * To view the list of user ISOs
 */
define( 'ONAPP_GET_LIST_OF_USER_ISOS', 'list_of_user_isos' );

/**
 * To view the list of user ISOs
 */
define( 'ONAPP_GET_LIST_OF_OWN_ISOS', 'list_of_own_isos' );

/**
 * To view the list of user ISOs
 */
define( 'ONAPP__MAKE_ISO_PUBLIC', 'make_public' );


/**
 * ISO
 *
 * The OnApp_ISO class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_ISO extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'image_template_iso';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'template_isos';

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
                $this->fields = array(
                    'allow_resize_without_reboot'  => array(
                        ONAPP_FIELD_MAP  => '_allow_resize_without_reboot',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'allowed_hot_migrate'          => array(
                        ONAPP_FIELD_MAP  => '_allowed_hot_migrate',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'allowed_swap'                 => array(
                        ONAPP_FIELD_MAP  => '_allowed_swap',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'application_server'           => array(
                        ONAPP_FIELD_MAP  => '_application_server',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'backup_server_id'             => array(
                        ONAPP_FIELD_MAP  => '_backup_server_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'baremetal_server'             => array(
                        ONAPP_FIELD_MAP  => '_baremetal_server',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'cdn'                          => array(
                        ONAPP_FIELD_MAP  => '_cdn',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'checksum'                     => array(
                        ONAPP_FIELD_MAP  => '_checksum',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'created_at'                   => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'disk_target_device'           => array(
                        ONAPP_FIELD_MAP  => '_disk_target_device',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'draas'                        => array(
                        ONAPP_FIELD_MAP  => '_draas',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'ext4'                         => array(
                        ONAPP_FIELD_MAP  => '_ext4',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'file_name'                    => array(
                        ONAPP_FIELD_MAP  => '_file_name',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'id'                           => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'initial_password'             => array(
                        ONAPP_FIELD_MAP  => '_initial_password',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'initial_username'             => array(
                        ONAPP_FIELD_MAP  => '_initial_username',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'label'                        => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'manager_id'                   => array(
                        ONAPP_FIELD_MAP  => '_manager_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'min_disk_size'                => array(
                        ONAPP_FIELD_MAP  => '_min_disk_size',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'min_memory_size'              => array(
                        ONAPP_FIELD_MAP  => '_min_memory_size',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'operating_system'             => array(
                        ONAPP_FIELD_MAP  => '_operating_system',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'operating_system_arch'        => array(
                        ONAPP_FIELD_MAP  => '_operating_system_arch',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'operating_system_distro'      => array(
                        ONAPP_FIELD_MAP  => '_operating_system_distro',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'operating_system_edition'     => array(
                        ONAPP_FIELD_MAP  => '_operating_system_edition',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'operating_system_tail'        => array(
                        ONAPP_FIELD_MAP  => '_operating_system_tail',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'parent_template_id'           => array(
                        ONAPP_FIELD_MAP  => '_parent_template_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'remote_id'                    => array(
                        ONAPP_FIELD_MAP  => '_remote_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'resize_without_reboot_policy' => array(
                        ONAPP_FIELD_MAP  => '_resize_without_reboot_policy',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'smart_server'                 => array(
                        ONAPP_FIELD_MAP  => '_smart_server',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'state'                        => array(
                        ONAPP_FIELD_MAP  => '_state',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'template_size'                => array(
                        ONAPP_FIELD_MAP  => '_template_size',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'updated_at'                   => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'user_id'                      => array(
                        ONAPP_FIELD_MAP  => '_user_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'version'                      => array(
                        ONAPP_FIELD_MAP  => '_version',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'virtualization'               => array(
                        ONAPP_FIELD_MAP  => '_virtualization',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    'virtualization_array'         => array(
                        ONAPP_FIELD_MAP  => '_file_url',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    'type'                         => array(
                        ONAPP_FIELD_MAP  => '_type',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'file_url'                     => array(
                        ONAPP_FIELD_MAP  => '_file_url',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
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
                $this->fields['properties'] = array(
                    ONAPP_FIELD_MAP  => '_properties',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
            case 5.3:
                $this->fields = $this->initFields( 5.2 );
                $this->fields['locked'] = array(
                    ONAPP_FIELD_MAP  => '_locked',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                break;
            case 5.4:
                $this->fields = $this->initFields( 5.3 );
                $this->fields['openstack_id'] = array(
                    ONAPP_FIELD_MAP  => '_openstack_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
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
            case ONAPP_GET_LIST_PUBLIC_ISO :
                /**
                 * ROUTE :
                 *
                 * @name template_isos
                 * @method GET
                 * @alias  /template_isos/system(.:format)
                 * @format {:action=>"index", :controller=>"system"}
                 */
                $resource = $this->_resource . '/system';
                break;
            case ONAPP_GET_LIST_PARTICULAR_USER_ISO :
                /**
                 * ROUTE :
                 *
                 * @name template_isos
                 * @method GET
                 * @alias  /template_isos/user/:user_id(.:format)
                 * @format {:action=>"index", :controller=>"user"}
                 */
                if ( is_null( $this->_user_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _user_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = $this->_resource . '/user/' . $this->_user_id;
                break;
            case ONAPP_GET_LIST_OF_USER_ISOS :
                /**
                 * ROUTE :
                 *
                 * @name template_isos
                 * @method GET
                 * @alias  /template_isos/user(.:format)
                 * @format {:action=>"index", :controller=>"user"}
                 */
                $resource = $this->_resource . '/user';
                break;
            case ONAPP_GET_LIST_OF_OWN_ISOS :
                /**
                 * ROUTE :
                 *
                 * @name template_isos
                 * @method GET
                 * @alias  /template_isos/own(.:format)
                 * @format {:action=>"index", :controller=>"own"}
                 */
                $resource = $this->_resource . '/own';
                break;
            case ONAPP__MAKE_ISO_PUBLIC :
                /**
                 * ROUTE :
                 *
                 * @name template_isos
                 * @method GET
                 * @alias  /template_isos/own(.:format)
                 * @format {:action=>"index", :controller=>"own"}
                 */
                if ( is_null( $this->_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = $this->_resource . '/' . $this->_id . '/make_public';
                break;
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    public function getPublicISO() {
        return $this->sendGet( ONAPP_GET_LIST_PUBLIC_ISO );
    }

    public function getUserISO() {
        return $this->sendGet( ONAPP_GET_LIST_PARTICULAR_USER_ISO );
    }

    public function getListOfUsersISO() {
        return $this->sendGet( ONAPP_GET_LIST_OF_USER_ISOS );
    }

    public function getListOfOwnISO() {
        return $this->sendGet( ONAPP_GET_LIST_OF_OWN_ISOS );
    }

    public function makeISOPublic() {
        return $this->sendPost( ONAPP__MAKE_ISO_PUBLIC );
    }
}
