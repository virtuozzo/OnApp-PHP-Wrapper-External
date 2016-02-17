<?php
/**
 * SystemApp
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
 * The OnApp_ApplicationServer_SystemApp uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */

/**
 *
*/
define( 'ONAPP_INSTALL', 'install' );

/**
 * To switch a PHP version
 */
define( 'ONAPP_SWITCH_PHP_VERSION', 'switch_php_version' );


/**
 * To switch a PHP version
 */
define( 'ONAPP_UNINSTALL', 'uninstall' );


class OnApp_ApplicationServer_SystemApp extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'system_app';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'system_apps';

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
            case 4.0:
            case 4.1:
            case 4.2:
                $this->fields                  = array();

                $this->fields[ 'application_server_id' ] = array(
                    ONAPP_FIELD_MAP  => '_application_server_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields[ 'api_name' ] = array(
                    ONAPP_FIELD_MAP  => '_api_name',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields[ 'id' ] = array(
                    ONAPP_FIELD_MAP  => '_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields[ 'name' ] = array(
                    ONAPP_FIELD_MAP  => '_name',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields[ 'version' ] = array(
                    ONAPP_FIELD_MAP  => '_version',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields[ 'system_app_id' ] = array(
                    ONAPP_FIELD_MAP  => '_system_app_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields[ 'php_version' ] = array(
                    ONAPP_FIELD_MAP  => '_php_version',
                    ONAPP_FIELD_TYPE => 'string',
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
        switch( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @method GET
                 * @alias   /application_servers/:application_server_id/applications(.:format)
                 * @format  {:controller=>"applications", :action=>"index"}
                 */
                if( is_null( $this->_application_server_id ) && is_null( $this->_obj->_application_server_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _application_server_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                else {
                    if( is_null( $this->_application_server_id ) ) {
                        $this->_application_server_id = $this->_obj->_application_server_id;
                    }
                }
                $resource = 'application_servers/' . $this->_application_server_id . '/' . $this->_resource;
                break;
            case ONAPP_INSTALL:
                /**
                 * ROUTE :
                 *
                 * @method PUT
                 * @alias   /application_servers/:application_server_id/system_apps/:system_app_id/install(.:format)
                 * @format  {:controller=>"applications", :action=>"index"}
                 */
                if( is_null( $this->_application_server_id ) && is_null( $this->_obj->_application_server_id ) ) {
                    if( is_null( $this->_system_app_id ) && is_null( $this->_obj->_system_app_id ) ) {
                        $this->logger->error(
                            'getResource( ' . $action . ' ): argument _system_app_id not set.',
                            __FILE__,
                            __LINE__
                        );
                    }
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _application_server_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                else {
                    if( is_null( $this->_application_server_id ) ) {
                        $this->_application_server_id = $this->_obj->_application_server_id;
                    }
                    if( is_null( $this->_system_app_id ) ) {
                        $this->_system_app_id = $this->_obj->_system_app_id;
                    }
                }
                $resource = 'application_servers/' . $this->_application_server_id . '/' . $this->_resource . '/' .$this->_system_app_id .'/install';
                break;

            case ONAPP_SWITCH_PHP_VERSION:
                /**
                 * ROUTE :
                 *
                 * @method PUT
                 * @alias   /application_servers/:application_server_id/settings/switch_php_version(.:format)
                 * @format  {:controller=>"applications", :action=>"index"}
                 */
                if( is_null( $this->_application_server_id ) && is_null( $this->_obj->_application_server_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _application_server_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                else {
                    if( is_null( $this->_application_server_id ) ) {
                        $this->_application_server_id = $this->_obj->_application_server_id;
                    }
                }
                $resource = 'application_servers/' . $this->_application_server_id .'/settings/switch_php_version';
                break;

            case ONAPP_UNINSTALL:
                /**
                 * ROUTE :
                 *
                 * @method PUT
                 *
                 * @alias   /application_servers/:application_server_id/system_apps/:system_app_id/uninstall(.:format)
                 * @format  {:controller=>"applications", :action=>"index"}
                 */
                if( is_null( $this->_application_server_id ) && is_null( $this->_obj->_application_server_id ) ) {
                    if( is_null( $this->_system_app_id ) && is_null( $this->_obj->_system_app_id ) ) {
                        $this->logger->error(
                            'getResource( ' . $action . ' ): argument _application_server_id not set.',
                            __FILE__,
                            __LINE__
                        );
                    }
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _system_app_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                else {
                    if( is_null( $this->_application_server_id ) ) {
                        $this->_application_server_id = $this->_obj->_application_server_id;
                    }
                    if( is_null( $this->_system_app_id ) ) {
                        $this->_system_app_id = $this->_obj->_system_app_id;
                    }
                }
                $resource = 'application_servers/' . $this->_application_server_id . '/' . $this->_resource . '/' .$this->_system_app_id .'/uninstall';
                break;
            default:
                $resource     = parent::getResource( $action );
                $show_log_msg = false;
                break;
        }

        if( $show_log_msg ) {
            $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
        }

        return $resource;
    }

    public function install($application_server_id = null, $system_app_id = null){
        if( is_null( $application_server_id ) && ! is_null( $this->_application_server_id ) ) {
            $application_server_id = $this->_application_server_id;
        }
        if( is_null( $system_app_id ) &&  !is_null( $this->_system_app_id ) ) {
            $system_app_id = $this->_system_app_id;
        }

        if( ! is_null( $application_server_id ) && ! is_null( $system_app_id ) ) {
            $this->_application_server_id = $application_server_id;
            $this->_system_app_id = $system_app_id;

            return $this->sendPut(ONAPP_INSTALL);
        }else{
            $this->logger->error(
                'getList: argument _application_server_id not set.',
                __FILE__,
                __LINE__
            );
            $this->logger->error(
                'getList: argument _system_app_id not set.',
                __FILE__,
                __LINE__
            );
        }
    }
    public function uninstall($application_server_id = null, $system_app_id = null){
        if( is_null( $application_server_id ) && ! is_null( $this->_application_server_id ) ) {
            $application_server_id = $this->_application_server_id;
        }
        if( is_null( $system_app_id ) &&  !is_null( $this->_system_app_id ) ) {
            $system_app_id = $this->_system_app_id;
        }

        if( ! is_null( $application_server_id ) && ! is_null( $system_app_id ) ) {
            $this->_application_server_id = $application_server_id;
            $this->_system_app_id = $system_app_id;

            return $this->sendPut(ONAPP_UNINSTALL);
        }else{
            $this->logger->error(
                'getList: argument _application_server_id not set.',
                __FILE__,
                __LINE__
            );
            $this->logger->error(
                'getList: argument _system_app_id not set.',
                __FILE__,
                __LINE__
            );
        }
    }

    public function switchPhpVersion($application_server_id = null, $php_version =null){
        if( is_null( $application_server_id ) && ! is_null( $this->_application_server_id ) ) {
            $application_server_id = $this->_application_server_id;
        }
        if( is_null( $php_version ) &&  !is_null( $this->_php_version ) ) {
            $php_version = $this->_php_version;
        }

        if( ! is_null( $application_server_id ) && ! is_null( $php_version ) ) {
            $this->_application_server_id = $application_server_id;
            $this->_php_version = $php_version;

            if(!$this->_php_version){
                return false;
            }
            $data = array(
                'root' => 'php_version',
                'data' => $this->_php_version
            );

            return $this->sendPut(ONAPP_SWITCH_PHP_VERSION, $data);
        }else{
            $this->logger->error(
                'getList: argument _application_server_id not set.',
                __FILE__,
                __LINE__
            );
            $this->logger->error(
                'getList: argument _php_version not set.',
                __FILE__,
                __LINE__
            );
        }
    }

}