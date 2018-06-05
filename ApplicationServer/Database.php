<?php
/**
 * Database
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
 * The OnApp_ApplicationServer_Database uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( https://docs.onapp.com/display/50API/Databases )
 */

/**
 * To assign user to db in application server
 */
define( 'ONAPP_APPLICATIONSERVER_ASSIGN_USER', 'appserver_assign_user' );

class OnApp_ApplicationServer_Database extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'database';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'databases';

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
                $this->fields['db']                    = array(
                    ONAPP_FIELD_MAP  => '_db',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['db_user']               = array(
                    ONAPP_FIELD_MAP  => '_db_user',
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
                $this->fields['database_user']         = array(
                    ONAPP_FIELD_MAP   => '_database_user',
                    ONAPP_FIELD_CLASS => 'BillingCompany_BaseResource_Limit',
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
                 * @alias   /application_servers/:application_server_id/databases(.:format)
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
                 * @alias   /application_servers/:application_server_id/databases/:db(.:format)
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
                if ( is_null( $this->_db ) && is_null( $this->_obj->_db ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _db not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_db ) ) {
                        $this->_db = $this->_obj->_db;
                    }
                }
                $resource = 'application_servers/' . $this->_application_server_id . '/' . $this->_resource . '/' . $this->_db;
                break;
            case ONAPP_APPLICATIONSERVER_PRIVILEGES:
                /**
                 * ROUTE :
                 *
                 * @method GET/POST
                 * @alias   /application_servers/:application_server_id/database_users/:name/privileges.json(.:format)
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
                if ( is_null( $this->_db ) && is_null( $this->_obj->_db ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _db not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_db ) ) {
                        $this->_db = $this->_obj->_db;
                    }
                }
                $resource = 'application_servers/' . $this->_application_server_id . '/' . $this->_resource . '/' . $this->_db . '/privileges';
                break;
            case ONAPP_APPLICATIONSERVER_ASSIGN_USER:
                /**
                 * ROUTE :
                 *
                 * @method POST
                 * @alias   /application_servers/:application_server_id/databases/:db(.:format)
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
                if ( is_null( $this->_db ) && is_null( $this->_obj->_db ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _db not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_db ) ) {
                        $this->_db = $this->_obj->_db;
                    }
                }
                $resource = 'application_servers/' . $this->_application_server_id . '/' . $this->_resource . '/' . $this->_db . '/assign_user';
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

    public function assignUser( $prilist, $db_user = null, $host = null ) {
        if ( is_null( $db_user ) && ! is_null( $this->_db_user ) ) {
            $db_user = $this->_db_user;
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
        foreach ( $prilist as $key => $val ) {
            $key = strtoupper( $key );
            if ( isset( $prilistDefault[ $key ] ) ) {
                $prilistToSend[ $key ] = $val;
            }
        }

        $data = array(
            'root' => $this->_tagRoot,
            'data' => array(
                'db_user' => $db_user,
                'host'    => $host,
                'prilist' => $prilistToSend,
            ),
        );
        $this->sendPost( ONAPP_APPLICATIONSERVER_ASSIGN_USER, $data );
    }

    public function getListOfUsersAssignedToDatabase() {
        return $this->sendGet( ONAPP_APPLICATIONSERVER_PRIVILEGES );
    }


}