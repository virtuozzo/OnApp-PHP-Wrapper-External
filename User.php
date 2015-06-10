<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Users
 *
 * Users are created by administrators and have access only to those actions
 * which are specified by the administrator. You can add as many users as you
 * need. When creating, you can edit User Details, track Payments, and set the
 * Limits.
 * With OnApp you can assign resource limits to users. This will prevent users
 * from exceeding the resources you specify.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 *
 */
define( 'ONAPP_GETRESOURCE_SUSPEND_USER', 'suspend' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_ACTIVATE', 'activate' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_NETWORKS_LIST_BY_GROUP_ID', 'get_list_by_group_id' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_DELETE_USER', 'delete_user' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_MAKE_NEW_API_KEY_USER', 'make_new_api_key' );

/**
 * Users
 *
 * The User class represents the Users of the OnApp installation.
 *
 * The OnApp_User class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_User extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'user';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'users';

    /**
     * API Fields description
     *
     * @param string|float $version   OnApp API version
     * @param string       $className current class' name
     *
     * @return array
     */
    public function initFields( $version = null, $className = '' ) {
        switch( $version ) {
            case '2.0':
                $this->fields = array(
                    'id'                        => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'activated_at'              => array(
                        ONAPP_FIELD_MAP       => '_activated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'activation_code'           => array(
                        ONAPP_FIELD_MAP       => '_activation_code',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'created_at'                => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'email'                     => array(
                        ONAPP_FIELD_MAP      => '_email',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'first_name'                => array(
                        ONAPP_FIELD_MAP       => '_first_name',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_REQUIRED  => true,
                    ),
                    'outstanding_amount'        => array(
                        ONAPP_FIELD_MAP       => '_outstanding_amount',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'payment_amount'            => array(
                        ONAPP_FIELD_MAP       => '_payment_amount',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'group_id'                  => array(
                        ONAPP_FIELD_MAP      => '_group_id',
                        ONAPP_FIELD_TYPE     => 'integer',
                        ONAPP_FIELD_REQUIRED => true
                    ),
                    'last_name'                 => array(
                        ONAPP_FIELD_MAP       => '_last_name',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_REQUIRED  => true,
                    ),
                    'login'                     => array(
                        ONAPP_FIELD_MAP      => '_login',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'remember_token'            => array(
                        ONAPP_FIELD_MAP       => '_remember_token',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'deleted_at'                => array(
                        ONAPP_FIELD_MAP       => '_deleted_at',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'remember_token_expires_at' => array(
                        ONAPP_FIELD_MAP       => '_remember_token_expires_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'roles'                     => array(
                        ONAPP_FIELD_MAP   => '_roles',
                        ONAPP_FIELD_TYPE  => 'array',
                        ONAPP_FIELD_CLASS => 'Role',
                    ),
                    'time_zone'                 => array(
                        ONAPP_FIELD_MAP           => '_time_zone',
                        ONAPP_FIELD_TYPE          => 'string',
                        ONAPP_FIELD_DEFAULT_VALUE => '',
                    ),
                    'total_amount'              => array(
                        ONAPP_FIELD_MAP       => '_total_amount',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'updated_at'                => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'used_cpu_shares'           => array(
                        ONAPP_FIELD_MAP       => '_used_cpu_shares',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'used_cpus'                 => array(
                        ONAPP_FIELD_MAP       => '_used_cpus',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'used_disk_size'            => array(
                        ONAPP_FIELD_MAP       => '_used_disk_size',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'used_ip_addresses'         => array(
                        ONAPP_FIELD_MAP       => '_used_ip_addresses',
                        ONAPP_FIELD_TYPE      => 'array',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_CLASS     => 'User_UsedIpAddress',
                    ),
                    'used_memory'               => array(
                        ONAPP_FIELD_MAP       => '_used_memory',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'memory_available'          => array(
                        ONAPP_FIELD_MAP       => '_memory_available',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'disk_space_available'      => array(
                        ONAPP_FIELD_MAP       => '_disk_space_available',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'status'                    => array(
                        ONAPP_FIELD_MAP => '_status'
                    ),
                );
                break;

            case '2.1':
                $this->fields = $this->initFields( '2.0' );

                unset( $this->fields[ 'activation_code' ] );

                $this->fields[ 'group_id' ][ ONAPP_FIELD_REQUIRED ] = false;
                $this->fields[ 'billing_plan_id' ]                  = array(
                    ONAPP_FIELD_MAP  => '_billing_plan_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields[ 'image_template_group_id' ]          = array(
                    ONAPP_FIELD_MAP  => '_image_template_group_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields[ 'api_key' ]                          = array(
                    ONAPP_FIELD_MAP       => '_api_key',
                    ONAPP_FIELD_TYPE      => 'string',
                    ONAPP_FIELD_READ_ONLY => true
                );
                $this->fields[ 'suspend_at' ]                       = array(
                    ONAPP_FIELD_MAP       => '_suspend_at',
                    ONAPP_FIELD_TYPE      => 'string',
                    ONAPP_FIELD_READ_ONLY => true
                );
                $this->fields[ 'user_group_id' ]                    = array(
                    ONAPP_FIELD_MAP           => '_user_group_id',
                    ONAPP_FIELD_TYPE          => 'integer',
                    ONAPP_FIELD_DEFAULT_VALUE => '',
                );
                $this->fields[ 'locale' ]                           = array(
                    ONAPP_FIELD_MAP           => '_locale',
                    ONAPP_FIELD_TYPE          => 'string',
                    ONAPP_FIELD_DEFAULT_VALUE => 'en',
                );
                break;

            case 2.2:
                $this->fields                          = $this->initFields( 2.1 );
                $this->fields[ 'update_billing_stat' ] = array(
                    ONAPP_FIELD_MAP       => 'update_billing_stat',
                    ONAPP_FIELD_TYPE      => 'string',
                    ONAPP_FIELD_READ_ONLY => true
                );
                break;

            case 2.3:
                $this->fields                         = $this->initFields( 2.2 );
                $this->fields[ 'aflexi_username' ]    = array(
                    ONAPP_FIELD_MAP       => 'aflexi_username',
                    ONAPP_FIELD_TYPE      => 'string',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'aflexi_key' ]         = array(
                    ONAPP_FIELD_MAP       => 'aflexi_key',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'cdn_status' ]         = array(
                    ONAPP_FIELD_MAP       => 'cdn_status',
                    ONAPP_FIELD_TYPE      => 'string',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'cdn_account_status' ] = array(
                    ONAPP_FIELD_MAP       => 'cdn_account_status',
                    ONAPP_FIELD_TYPE      => 'string',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'aflexi_password' ]    = array(
                    ONAPP_FIELD_MAP       => 'aflexi_password',
                    ONAPP_FIELD_TYPE      => 'string',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'aflexi_user_id' ]     = array(
                    ONAPP_FIELD_MAP       => 'aflexi_user_id',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'additional_fields' ]  = array(
                    ONAPP_FIELD_MAP => '_additional_fields',
                );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
                $this->fields                          = $this->initFields( 2.3 );
                $this->fields[ 'firewall_id' ]         = array(
                    ONAPP_FIELD_MAP       => '_firewall_id',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'wowza_key' ]           = array(
                    ONAPP_FIELD_MAP       => '_wowza_key',
                    ONAPP_FIELD_TYPE      => 'string',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'avatar' ]              = array(
                    ONAPP_FIELD_MAP       => 'avatar',
                    ONAPP_FIELD_TYPE      => 'string',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'password_changed_at' ] = array(
                    ONAPP_FIELD_MAP       => 'password_changed_at',
                    ONAPP_FIELD_TYPE      => 'string',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'use_gravatar' ]        = array(
                    ONAPP_FIELD_MAP       => 'use_gravatar',
                    ONAPP_FIELD_TYPE      => 'boolean',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'infoboxes' ]           = array(
                    ONAPP_FIELD_MAP => 'infoboxes',
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
        switch( $action ) {
            case ONAPP_GETRESOURCE_NETWORKS_LIST_BY_GROUP_ID:
                /**
                 * ROUTE :
                 *
                 * @name user_group_users
                 * @method GET
                 * @alias   /user_groups/:user_group_id/users(.:format)
                 * @format  {:controller=>"users", :action=>"index"}
                 */
                $resource = 'user_groups/' . $this->_user_group_id . '/' . $this->_resource;
                break;
            case ONAPP_GETRESOURCE_SUSPEND_USER:
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/suspend';
                break;

            case ONAPP_GETRESOURCE_DELETE_USER:
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD );
                break;

            case ONAPP_GETRESOURCE_ACTIVATE:
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/activate';
                break;

            case ONAPP_GETRESOURCE_MAKE_NEW_API_KEY_USER:
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/make_new_api_key';
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        $actions = array(
            ONAPP_GETRESOURCE_SUSPEND_USER,
            ONAPP_GETRESOURCE_ACTIVATE,
            ONAPP_GETRESOURCE_MAKE_NEW_API_KEY_USER,
        );

        if( in_array( $action, $actions ) ) {
            $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
        }

        return $resource;
    }

    /**
     * Suspend User
     *
     * @access public
     */
    function suspend() {
        $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_SUSPEND_USER ) );

        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_POST );

        $result = $this->_castResponseToClass( $response );

        $this->_obj = $result;
    }

    /**
     * Activate User
     *
     * @access public
     */
    function activate_user() {
        $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_ACTIVATE ) );

        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_POST );

        $result = $this->_castResponseToClass( $response );

        $this->_obj = $result;
    }

    /**
     * Generate a new API Key
     *
     * @access public
     */
    function make_new_api_key() {
        $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_MAKE_NEW_API_KEY_USER ) );

        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_POST );

        $result = $this->_castResponseToClass( $response );

        $this->_obj = $result;
    }

    /**
     * Save Object in to your account.
     */
    function save() {
        $this->_role_ids                         = $this->fillRolesIDs();
        $this->fields[ 'password' ]              = array(
            ONAPP_FIELD_MAP => '_password',
        );
        $this->fields[ 'password_confirmation' ] = array(
            ONAPP_FIELD_MAP => '_password_confirmation',
        );

        if( is_null( $this->_id ) ) {
            if( is_null( $this->_id ) ) {
                $this->fields[ 'password' ][ ONAPP_FIELD_REQUIRED ] = true;
            }
            $obj = $this->_create();
        }
        else {
            $this->fields[ 'email' ][ ONAPP_FIELD_REQUIRED ]      = false;
            $this->fields[ 'first_name' ][ ONAPP_FIELD_REQUIRED ] = false;
            $this->fields[ 'last_name' ][ ONAPP_FIELD_REQUIRED ]  = false;
            $this->fields[ 'login' ][ ONAPP_FIELD_REQUIRED ]      = false;

            $obj = $this->_edit();
        }
        unset( $this->fields[ 'password' ], $this->fields[ 'password_confirmation' ] );

        if( isset( $obj ) && ! isset( $obj->errors ) ) {
            $this->load( $obj->_id );
        }
    }

    function load( $id = null ) {
        $result = parent::load( $id );
        $this->initFields( $this->getAPIVersion() );
        $this->parseAdditionalFields();

        return $result;
    }

    /**
     * Gets list of users by group id
     *
     * @param integer|null $group_id user group id
     *
     * @return bool|mixed
     */
    function getListByGroupId( $group_id = null ) {
        if( $group_id ) {
            $this->_user_group_id = $group_id;
        }
        else {
            $this->logger->error(
                'getListByHypervisorGroupId: argument _hypervisor_group_id not set.',
                __FILE__,
                __LINE__
            );
        }

        $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_NETWORKS_LIST_BY_GROUP_ID ) );

        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

        if( ! empty( $response[ 'errors' ] ) ) {
            $this->errors = $response[ 'errors' ];

            return false;
        }

        $result     = $this->castStringToClass( $response );
        $this->_obj = $result;

        return ( is_array( $result ) || ! $result ) ? $result : array( $result );
    }

    private function fillRolesIDs() {
        $this->fields[ 'role_ids' ] = array(
            ONAPP_FIELD_MAP => '_role_ids',
        );

        if( is_null( $this->_role_ids ) ) {
            $ids = array();
            if( ! is_null( $this->_roles ) ) {
                $data = $this->_roles;
            }
            elseif( isset( $this->_obj->_roles ) && ! is_null( $this->_obj->_roles ) ) {
                $data = $this->_obj->_roles;
            }
            else {
                return null;
            }

            foreach( $data as $role ) {
                $ids[ ] = $role->_id;
            }

            return $ids;
        }
        else {
            return $this->_role_ids;
        }
    }

    /**
     * Deletes User from OnApp CP
     *
     * @param boolean $force whether to delete completely
     */
    public function delete( $force = false ) {
        if( ! $this->_id ) {
            $this->logger->error(
                'DeleteUser: argument _id not set.',
                __FILE__,
                __LINE__
            );
        }

        if( $force ) {
            $data = array(
                'root' => 'tmp_holder',
                'data' => array(
                    'force' => '1'
                )
            );

            $this->sendDelete( ONAPP_GETRESOURCE_DELETE_USER, $data );
        }
        else {
            parent::delete();
        }
    }

    private function parseAdditionalFields() {
        if( ! empty( $this->_obj->_additional_fields ) ) {
            $tmp = new stdClass();
            foreach( $this->_obj->_additional_fields as $field ) {
                $tmp->{$field->additional_field->name} = $field->additional_field->value;
            }
            $this->_obj->_additional_fields = $tmp;
            unset( $tmp );
        }
    }
}