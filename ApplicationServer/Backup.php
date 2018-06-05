<?php
/**
 * Backup
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
 * The OnApp_ApplicationServer_Backup uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */

/**
 * To restore application backup
 */
define( 'ONAPP_RESTORE_BACKUP', 'restore' );

class OnApp_ApplicationServer_Backup extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'backup';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'backups';

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
                $this->fields['application_id']        = array(
                    ONAPP_FIELD_MAP  => '_application_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['application_type']      = array(
                    ONAPP_FIELD_MAP  => '_application_type',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['backup_note']           = array(
                    ONAPP_FIELD_MAP  => '_backup_note',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['identifier']            = array(
                    ONAPP_FIELD_MAP  => '_identifier',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['software_url']          = array(
                    ONAPP_FIELD_MAP  => '_software_url',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['software_version']      = array(
                    ONAPP_FIELD_MAP  => '_software_version',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['size']                  = array(
                    ONAPP_FIELD_MAP  => '_size',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['restore_directory']     = array(
                    ONAPP_FIELD_MAP  => '_restore_directory',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['restore_database']      = array(
                    ONAPP_FIELD_MAP  => '_restore_database',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['identifier']            = array(
                    ONAPP_FIELD_MAP  => '_identifier',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
            case 4.3:
                $this->fields = $this->initFields( 4.2 );
                break;
            case 5.0:
                $this->fields = $this->initFields( 4.3 );
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
                $resource = 'application_servers/' . $this->_application_server_id . '/applications/' . $this->_resource;
                break;

            case ONAPP_RESTORE_BACKUP:
                /**
                 * ROUTE :
                 *
                 * @method POST
                 * @alias   /application_servers/:application_server_id/applications/backups/:identifier/restore(.:format)
                 * @format  {:controller=>"applications", :action=>"index"}
                 */
                if ( is_null( $this->_application_server_id ) && is_null( $this->_obj->_application_server_id ) ) {
                    if ( is_null( $this->_identifier ) && is_null( $this->_obj->_identifier ) ) {
                        $this->logger->error(
                            'getResource( ' . $action . ' ): argument _identifier not set.',
                            __FILE__,
                            __LINE__
                        );
                    }
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _application_server_id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_application_server_id ) ) {
                        $this->_application_server_id = $this->_obj->_application_server_id;
                    }
                    if ( is_null( $this->_identifier ) ) {
                        $this->_identifier = $this->_obj->_identifier;
                    }
                }
                $resource = 'application_servers/' . $this->_application_server_id . '/applications/' . $this->_resource . '/' . $this->_identifier . '/restore';
                break;

            case ONAPP_GETRESOURCE_DELETE:
                /**
                 * ROUTE :
                 *
                 * @method DELETE
                 * @alias   /application_servers/:application_server_id/applications/backups/:identifier/destroy(.:format)
                 * @format  {:controller=>"applications", :action=>"index"}
                 */
                if ( is_null( $this->_application_server_id ) && is_null( $this->_obj->_application_server_id ) ) {
                    if ( is_null( $this->_identifier ) && is_null( $this->_obj->_identifier ) ) {
                        $this->logger->error(
                            'getResource( ' . $action . ' ): argument _identifier not set.',
                            __FILE__,
                            __LINE__
                        );
                    }
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _application_server_id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_application_server_id ) ) {
                        $this->_application_server_id = $this->_obj->_application_server_id;
                    }
                    if ( is_null( $this->_identifier ) ) {
                        $this->_identifier = $this->_obj->_identifier;
                    }
                }
                $resource = 'application_servers/' . $this->_application_server_id . '/applications/' . $this->_resource . '/' . $this->_identifier . '/destroy';
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

    public function restore( $application_server_id = null, $identifier = null ) {
        if ( is_null( $application_server_id ) && ! is_null( $this->_application_server_id ) ) {
            $application_server_id = $this->_application_server_id;
        }
        if ( is_null( $identifier ) && ! is_null( $this->_identifier ) ) {
            $identifier = $this->_identifier;
        }

        if ( ! is_null( $application_server_id ) && ! is_null( $identifier ) ) {
            $this->_application_server_id = $application_server_id;
            $this->_identifier            = $identifier;
            $data                         = array();

            if ( $this->_restore_directory ) {
                $data['restore_directory'] = $this->_restore_directory;
            }
            if ( $this->_restore_database ) {
                $data['restore_database'] = $this->_restore_database;
            }
            $data = array(
                'root' => 'backup',
                'data' => $data
            );

            return $this->sendPost( ONAPP_RESTORE_BACKUP, $data );
        } else {
            $this->logger->error(
                'getList: argument _application_server_id or _identifier not set.',
                __FILE__,
                __LINE__
            );
        }
    }
}