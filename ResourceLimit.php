<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Resource Limit
 *
 * With OnApp you can assign resource limits to users. This will prevent users from exceeding the resources you specify.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Manages Resource Limit
 *
 * This class represents the resource limits set to users.
 *
 * The OnApp_ResourceLimit class uses the following basic methods:
 * {@link load}, {@link save} and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_ResourceLimit extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'resource_limit';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'resource_limit';

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
            case '2.1':
                $this->fields = array(
                    'id'                     => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'cpu_shares'             => array(
                        ONAPP_FIELD_MAP           => '_cpu_shares',
                        ONAPP_FIELD_TYPE          => 'integer',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                    'cpus'                   => array(
                        ONAPP_FIELD_MAP           => '_cpus',
                        ONAPP_FIELD_TYPE          => 'integer',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                    'created_at'             => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'disk_size'              => array(
                        ONAPP_FIELD_MAP           => '_disk_size',
                        ONAPP_FIELD_TYPE          => 'integer',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                    'memory'                 => array(
                        ONAPP_FIELD_MAP           => '_memory',
                        ONAPP_FIELD_TYPE          => 'integer',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                    'updated_at'             => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'user_id'                => array(
                        ONAPP_FIELD_MAP       => '_user_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'storage_disk_size'      => array(
                        ONAPP_FIELD_MAP           => '_storage_disk_size',
                        ONAPP_FIELD_TYPE          => 'integer',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                    'virtual_machines_count' => array(
                        ONAPP_FIELD_MAP           => '_virtual_machines_count',
                        ONAPP_FIELD_TYPE          => 'integer',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                );
                break;

            case 2.2:
            case 2.3:
                $this->fields = $this->initFields( 2.1 );

                $this->fields[ 'ip_address_count' ]        = array(
                    ONAPP_FIELD_MAP       => 'ip_address_count',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'ip_address_mask' ]         = array(
                    ONAPP_FIELD_MAP       => 'ip_address_mask',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'backups_templates_count' ] = array(
                    ONAPP_FIELD_MAP       => 'backups_templates_count',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'rate' ]                    = array(
                    ONAPP_FIELD_MAP       => 'rate',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );

                $fields = array(
                    'id'
                );
                $this->unsetFields( $fields );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
                $this->fields = $this->initFields( 2.3 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    /**
     * Returns the URL Alias of the API Class that inherits the OnApp class
     *
     * @return string API resource
     * @access public
     */
    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
            case ONAPP_GETRESOURCE_EDIT:
                /**
                 * ROUTE :
                 *
                 * @name user_resource_limit
                 * @method GET
                 * @alias   /users/:user_id/resource_limit(.:format)
                 * @format  {:controller=>"resource_limits", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name user_resource_limit
                 * @method GET
                 * @alias   /users/:user_id/resource_limit(.:format)
                 * @format  {:controller=>"resource_limits", :action=>"update"}
                 */
                if( is_null( $this->_user_id ) && is_null( $this->_obj->_user_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _user_id not set.",
                        __FILE__,
                        __LINE__
                    );
                }
                else {
                    if( is_null( $this->_user_id ) ) {
                        $this->_user_id = $this->_obj->_user_id;
                    }
                }
                $resource = 'users/' . $this->_user_id . '/' . $this->_resource;
                break;

            case ONAPP_GETRESOURCE_LOAD:
                $resource = $this->getResource();
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        $actions = array(
            ONAPP_GETRESOURCE_DEFAULT,
            ONAPP_GETRESOURCE_LOAD,
            ONAPP_GETRESOURCE_EDIT,
        );
        if( in_array( $action, $actions ) ) {
            $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
        }

        return $resource;
    }

    /**
     * Sends an API request to get the Object after sending,
     * unserializes the response into an object
     *
     * The key field Parameter ID is used to load the Object. You can re-set
     * this parameter in the class inheriting OnApp class.
     *
     * @param integer $id Object id
     *
     * @return object serialized Object instance from API
     * @access public
     */
    function load( $user_id = null ) {
        if( is_null( $user_id ) && ! is_null( $this->_user_id ) ) {
            $user_id = $this->_user_id;
        }

        if( is_null( $user_id ) &&
            isset( $this->_obj ) &&
            ! is_null( $this->_obj->_user_id )
        ) {
            $user_id = $this->_obj->_user_id;
        }

        $this->logger->add( 'load: Load class ( id => ' . $user_id . ').' );

        if( ! is_null( $user_id ) ) {
            $this->_user_id = $user_id;

            $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_LOAD ) );

            $response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

            $result = $this->_castResponseToClass( $response );

            $this->_obj     = $result;
            $this->_user_id = $this->_obj->_user_id;

            return $result;
        }
        else {
            $this->logger->error(
                'load: argument _user_id not set.',
                __FILE__,
                __LINE__
            );
        }
    }

    /**
     * The method saves an Object to your account
     *
     * After sending an API request to create an object or change the data in
     * the existing object, the method checks the response and loads the
     * exisitng object with the new data.
     *
     * @return void
     * @access public
     */
    function save() {
        if( isset( $this->_user_id ) ) {
            $obj = $this->_edit();

            if( isset( $obj ) && ! isset( $obj->errors ) ) {
                $this->load();
            }
        }
    }

    function activate( $action_name ) {
        switch( $action_name ) {
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}