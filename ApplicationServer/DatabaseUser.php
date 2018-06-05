<?php
/**
 * Database users
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  ApplicationServer
 * @author
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * The OnApp_ApplicationServer_DatabaseUser uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( https://docs.onapp.com/display/50API/Databases )
 */

/**
 * To change user password in application server
 */
define( 'ONAPP_APPLICATIONSERVER_DBUSER_CHANGEPASSWORD', 'appserver_changepassword' );

/**
 * db user privileges in application server
 */
define( 'ONAPP_APPLICATIONSERVER_PRIVILEGES', 'appserver_privileges' );

class OnApp_ApplicationServer_DatabaseUser extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'database_user';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'database_users';

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
            case 4.0:
            case 4.1:
            case 4.2:
            case 4.3:
            case 5.0:
                $this->fields                          = array();
                $this->fields['application_server_id'] = array(
                    ONAPP_FIELD_MAP  => '_application_server_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['name']                  = array(
                    ONAPP_FIELD_MAP  => '_name',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['db_name']                  = array(
                    ONAPP_FIELD_MAP  => '_db_name',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['password']              = array(
                    ONAPP_FIELD_MAP  => '_password',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['host']                  = array(
                    ONAPP_FIELD_MAP  => '_host',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['prilist']               = array(
                    ONAPP_FIELD_MAP  => '_prilist',
                    ONAPP_FIELD_TYPE => 'array',
                );

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
                 * @method GET
                 * @alias   /application_servers/:application_server_id/database_users(.:format)
                 * @format  {:controller=>"applications", :action=>"index"}
                 */
                if ( is_null( $this->_application_server_id ) && is_null( $this->_obj->_application_server_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _application_server_id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_application_server_id ) ) {
                        $this->_application_server_id = $this->_obj->_application_server_id;
                    }
                }
                $resource = 'application_servers/' . $this->_application_server_id . '/' . $this->_resource;
                break;
            case ONAPP_GETRESOURCE_DELETE:
                /**
                 * ROUTE :
                 *
                 * @method DELETE
                 * @alias   /application_servers/:application_server_id/database_users/:db(.:format)
                 * @format  {:controller=>"applications", :action=>"index"}
                 */
                if ( is_null( $this->_application_server_id ) && is_null( $this->_obj->_application_server_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _application_server_id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_application_server_id ) ) {
                        $this->_application_server_id = $this->_obj->_application_server_id;
                    }
                }
                if ( is_null( $this->_name ) && is_null( $this->_obj->_name ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _name not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_name ) ) {
                        $this->_name = $this->_obj->_name;
                    }
                }
                $resource = 'application_servers/' . $this->_application_server_id . '/' . $this->_resource . '/' . $this->_name;
                break;
            case ONAPP_APPLICATIONSERVER_PRIVILEGES:
                /**
                 * ROUTE :
                 *
                 * @method PUT
                 * @alias   /application_servers/:application_server_id/database_users/:name/privileges.json
                 * @format  {:controller=>"applications", :action=>"index"}
                 */
                if ( is_null( $this->_application_server_id ) && is_null( $this->_obj->_application_server_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _application_server_id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_application_server_id ) ) {
                        $this->_application_server_id = $this->_obj->_application_server_id;
                    }
                }
                if ( is_null( $this->_name ) && is_null( $this->_obj->_name ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _name not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_name ) ) {
                        $this->_name = $this->_obj->_name;
                    }
                }
                $resource = 'application_servers/' . $this->_application_server_id . '/' . $this->_resource . '/' . $this->_name . '/privileges';
                break;
            case ONAPP_APPLICATIONSERVER_DBUSER_CHANGEPASSWORD:
                /**
                 * ROUTE :
                 *
                 * @method PUT
                 * @alias   /application_servers/:application_server_id/database_users/:db(.:format)
                 * @format  {:controller=>"applications", :action=>"index"}
                 */
                if ( is_null( $this->_application_server_id ) && is_null( $this->_obj->_application_server_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _application_server_id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_application_server_id ) ) {
                        $this->_application_server_id = $this->_obj->_application_server_id;
                    }
                }
                if ( is_null( $this->_name ) && is_null( $this->_obj->_name ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _name not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_name ) ) {
                        $this->_name = $this->_obj->_name;
                    }
                }
                $resource = 'application_servers/' . $this->_application_server_id . '/' . $this->_resource . '/' . $this->_name . '/change_password';
                break;
            default:
                $resource     = parent::getResource( $action );
                $show_log_msg = false;
                break;
        }

        if ( $show_log_msg ) {
            $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
        }

        return $resource;
    }

    public function changePassword( $newPassword ) {
        if ( is_null( $newPassword ) && ! is_null( $this->_password ) ) {
            $newPassword = $this->_password;
        }

        $data = array(
            'root' => $this->_tagRoot,
            'data' => array(
                'password' => $newPassword,
            ),
        );
        $this->sendPut( ONAPP_APPLICATIONSERVER_DBUSER_CHANGEPASSWORD, $data );
    }

    public function updateUser( $prilist, $db_name = null, $host = null ) {
        if ( is_null( $db_name ) && ! is_null( $this->_db_name ) ) {
            $db_name = $this->_db_name;
        }
        if ( is_null( $host ) && ! is_null( $this->_host ) ) {
            $host = $this->_host;
        }
        $prilistDefault = array(
            'SELECT'                  => false,
            'CREATE'                  => false,
            'INSERT'                  => false,
            'UPDATE'                  => false,
            'ALTER'                   => false,
            'DELETE'                  => false,
            'INDEX'                   => false,
            'CREATE_TEMPORARY_TABLES' => false,
            'EXECUTE'                 => false,
            'DROP'                    => false,
            'LOCK_TABLES'             => false,
            'REFERENCES'              => false,
            'CREATE_ROUTINE'          => false,
            'CREATE_VIEW'             => false,
            'SHOW_VIEW'               => false,
            'TRIGGER'                 => false,
        );

        $prilistToSend = array();
        foreach($prilist as $key => $val){
            $key = strtoupper($key);
            if(isset($prilistDefault[$key])){
                $prilistToSend[$key] = $val;
            }
        }

        $data = array(
            'root' => $this->_tagRoot,
            'data' => array(
                'db_name' => $db_name,
                'host'    => $host,
                'prilist' => $prilistToSend,
            ),
        );
        $this->sendPut( ONAPP_APPLICATIONSERVER_PRIVILEGES, $data );
    }

    public function unassignFromDatabase( $db_name = null ) {
        if ( is_null( $db_name ) && ! is_null( $this->_db_name ) ) {
            $db_name = $this->_db_name;
        }

        $data = array(
            'root' => $this->_tagRoot,
            'data' => array(
                'db_name' => $db_name,
            ),
        );
        $this->sendPut( ONAPP_APPLICATIONSERVER_PRIVILEGES, $data );
    }


}