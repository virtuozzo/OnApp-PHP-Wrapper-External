<?php
/**
 * Applications
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
 *
 *
 */
define( 'ONAPP_GETRESOURCE_AVAILABLELIST', 'availablelist' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_SCRIPTINFO', 'scriptinfo' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_APPLICATION_BACKUP', 'applicationbackup' );

/**
 * The OnApp_ApplicationServer_Application uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_ApplicationServer_Application extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'application';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'applications';

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
                $this->fields = array();

                $this->fields['application_server_id'] = array(
                    ONAPP_FIELD_MAP  => '_application_server_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['admin_url']             = array(
                    ONAPP_FIELD_MAP  => '_admin_url',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['application_type']      = array(
                    ONAPP_FIELD_MAP  => '_application_type',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['id']                    = array(
                    ONAPP_FIELD_MAP  => '_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['software_url']          = array(
                    ONAPP_FIELD_MAP  => '_software_url',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['software_version']      = array(
                    ONAPP_FIELD_MAP  => '_software_version',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['script_id']             = array(
                    ONAPP_FIELD_MAP  => '_script_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['softdirectory']         = array(
                    ONAPP_FIELD_MAP  => '_softdirectory',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['admin_username']        = array(
                    ONAPP_FIELD_MAP  => '_admin_username',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['admin_pass']            = array(
                    ONAPP_FIELD_MAP  => '_admin_pass',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['admin_email']           = array(
                    ONAPP_FIELD_MAP  => '_admin_email',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['remove_database_user']  = array(
                    ONAPP_FIELD_MAP  => '_remove_database_user',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['remove_database']       = array(
                    ONAPP_FIELD_MAP  => '_remove_database',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['category']              = array(
                    ONAPP_FIELD_MAP  => '_category',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['remove_directory']      = array(
                    ONAPP_FIELD_MAP  => '_remove_directory',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['remove_data_directory'] = array(
                    ONAPP_FIELD_MAP  => '_remove_data_directory',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['description']           = array(
                    ONAPP_FIELD_MAP  => '_description',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['name']                  = array(
                    ONAPP_FIELD_MAP  => '_name',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['backup_directory']                  = array(
                    ONAPP_FIELD_MAP  => '_backup_directory',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['backup_data_directory']                  = array(
                    ONAPP_FIELD_MAP  => '_backup_data_directory',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['backup_database']                  = array(
                    ONAPP_FIELD_MAP  => '_backup_database',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['note']                  = array(
                    ONAPP_FIELD_MAP  => '_note',
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
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @method GET
                 * @alias   /application_servers/:application_server_id/applications(.:format)
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
            case ONAPP_GETRESOURCE_AVAILABLELIST:
                /**
                 * ROUTE :
                 *
                 * @method GET
                 * @alias   /application_servers/:application_server_id/applications/available(.:format)
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
                $resource = 'application_servers/' . $this->_application_server_id . '/' . $this->_resource . '/available';
                break;

            case ONAPP_GETRESOURCE_SCRIPTINFO:
                /**
                 * ROUTE :
                 *
                 * @method GET
                 * @alias   /application_servers/:application_server_id/script/:script_id(.:format)
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
                if ( is_null( $this->_script_id ) && is_null( $this->_obj->_script_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _script_id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_script_id ) ) {
                        $this->_script_id = $this->_obj->_script_id;
                    }
                }
                $resource = 'application_servers/' . $this->_application_server_id . '/script/' . $this->_script_id;
                break;
            case ONAPP_GETRESOURCE_APPLICATION_BACKUP:
                /**
                 * ROUTE :
                 *
                 * @method POST
                 * @alias   /application_servers/:application_server_id/applications/:id/backup(.:format)
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
                if ( is_null( $this->_id ) && is_null( $this->_obj->_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_id ) ) {
                        $this->_id = $this->_obj->_id;
                    }
                }
                $resource = 'application_servers/' . $this->_application_server_id . '/applications/' . $this->_id . '/backup';
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

    function getList( $application_server_id = null, $url_args = null ) {
        if ( is_null( $application_server_id ) && ! is_null( $this->_application_server_id ) ) {
            $application_server_id = $this->_application_server_id;
        }

        if ( ! is_null( $application_server_id ) ) {
            $this->_application_server_id = $application_server_id;

            return parent::getList();
        } else {
            $this->logger->error(
                'getList: argument _application_server_id not set.',
                __FILE__,
                __LINE__
            );
        }
    }

    function getAvailableList( $application_server_id = null, $url_args = null ) {
        if ( is_null( $application_server_id ) && ! is_null( $this->_application_server_id ) ) {
            $application_server_id = $this->_application_server_id;
        }

        if ( ! is_null( $application_server_id ) ) {
            $this->_application_server_id = $application_server_id;

            $this->logger->add( 'Run ' . __METHOD__ );

            $result = $this->sendGet( ONAPP_GETRESOURCE_AVAILABLELIST, null, $url_args );

            if ( ! is_null( $this->getErrorsAsArray() ) ) {
                return false;
            } else {
                if ( ! is_array( $result ) && ! is_null( $result ) ) {
                    $result = array( $result );
                }

                return $result;
            }
        } else {
            $this->logger->error(
                'getList: argument _application_server_id not set.',
                __FILE__,
                __LINE__
            );
        }
    }

    function getScriptInfo( $application_server_id = null, $script_id = null, $url_args = null ) {
        if ( is_null( $application_server_id ) && ! is_null( $this->_application_server_id ) ) {
            $application_server_id = $this->_application_server_id;
        }

        if ( is_null( $script_id ) && ! is_null( $this->_script_id ) ) {
            $script_id = $this->_script_id;
        }

        if ( ! is_null( $application_server_id ) && ! is_null( $script_id ) ) {
            $this->_application_server_id = $application_server_id;
            $this->_script_id             = $script_id;

            $this->logger->add( 'Run ' . __METHOD__ );

            $tagRootOld     = $this->_tagRoot;
            $this->_tagRoot = 'script';

            $result = $this->sendGet( ONAPP_GETRESOURCE_SCRIPTINFO, null, $url_args, true );

            $this->_tagRoot = $tagRootOld;

            if ( ! is_null( $this->getErrorsAsArray() ) ) {
                return false;
            } else {
                $result->_application_server_id = $this->_application_server_id;
                $result->_script_id = $this->_script_id;

                return $result;
            }
        } else {
            if ( is_null( $application_server_id ) ) {
                $this->logger->error(
                    'getList: argument _application_server_id not set.',
                    __FILE__,
                    __LINE__
                );

            }
            if ( is_null( $script_id ) ) {
                $this->logger->error(
                    'getList: argument _script_id not set.',
                    __FILE__,
                    __LINE__
                );

            }

        }
    }

    function backup( $application_server_id = null, $id = null, $url_args = null ) {
        if ( is_null( $application_server_id ) && ! is_null( $this->_application_server_id ) ) {
            $application_server_id = $this->_application_server_id;
        }

        if ( is_null( $id ) && ! is_null( $this->_id ) ) {
            $id = $this->_id;
        }

        if ( ! is_null( $application_server_id ) && ! is_null( $id ) ) {
            $this->_application_server_id = $application_server_id;
            $this->_id             = $id;

            $this->logger->add( 'Run ' . __METHOD__ );

            $data = array(
                'application_id' => $this->_id,
            );
            if($this->_backup_directory){
                $data['backup_directory'] = $this->_backup_directory;
            }
            if($this->_backup_data_directory){
                $data['backup_data_directory'] = $this->_backup_data_directory;
            }
            if($this->_backup_database){
                $data['backup_database'] = $this->_backup_database;
            }
            if($this->_note){
                $data['note'] = $this->_note;
            }
            $data = array(
                'root' => 'backup',
                'data' => $data,
            );

            $result = $this->sendPost( ONAPP_GETRESOURCE_APPLICATION_BACKUP, $data);

        } else {
            if ( is_null( $application_server_id ) ) {
                $this->logger->error(
                    'getList: argument _application_server_id not set.',
                    __FILE__,
                    __LINE__
                );

            }
            if ( is_null( $id ) ) {
                $this->logger->error(
                    'getList: argument _id not set.',
                    __FILE__,
                    __LINE__
                );

            }

        }
    }

    function delete( $application_server_id = null, $id = null, $url_args = null ) {
        if ( is_null( $application_server_id ) && ! is_null( $this->_application_server_id ) ) {
            $application_server_id = $this->_application_server_id;
        }

        if ( is_null( $id ) && ! is_null( $this->_id ) ) {
            $id = $this->_id;
        }

        if ( ! is_null( $application_server_id ) && ! is_null( $id ) ) {
            $this->_application_server_id = $application_server_id;
            $this->_id             = $id;

            $this->logger->add( 'Run ' . __METHOD__ );

            $data = array(
                'application_id' => $this->_id,
            );
            if($this->_remove_database_user){
                $data['remove_database_user'] = $this->_remove_database_user;
            }
            if($this->_remove_database){
                $data['remove_database'] = $this->_remove_database;
            }
            if($this->_remove_directory){
                $data['remove_directory'] = $this->_remove_directory;
            }
            if($this->_remove_data_directory){
                $data['remove_data_directory'] = $this->_remove_data_directory;
            }
            $data = array(
                'root' => 'application',
                'data' => $data,
            );

            $result = $this->sendDelete( ONAPP_GETRESOURCE_DELETE, $data);

        } else {
            if ( is_null( $application_server_id ) ) {
                $this->logger->error(
                    'getList: argument _application_server_id not set.',
                    __FILE__,
                    __LINE__
                );

            }
            if ( is_null( $id ) ) {
                $this->logger->error(
                    'getList: argument _id not set.',
                    __FILE__,
                    __LINE__
                );

            }

        }
    }

}