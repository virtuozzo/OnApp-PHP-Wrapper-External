<?php
/**
 * Domain
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
 * The OnApp_ApplicationServer_Domain uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */

class OnApp_ApplicationServer_Domain extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'domain';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'domains';

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
                $this->fields[ 'identifier' ] = array(
                    ONAPP_FIELD_MAP  => '_identifier',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields[ 'name' ] = array(
                    ONAPP_FIELD_MAP  => '_name',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields[ 'path' ] = array(
                    ONAPP_FIELD_MAP  => '_path',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields[ 'type' ] = array(
                    ONAPP_FIELD_MAP  => '_type',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields[ 'domain' ] = array(
                    ONAPP_FIELD_MAP  => '_domain',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields[ 'application_id' ] = array(
                    ONAPP_FIELD_MAP  => '_application_id',
                    ONAPP_FIELD_TYPE => 'integer',
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
                } else {
                    if( is_null( $this->_application_server_id ) ) {
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
                 * @alias   /application_servers/:application_server_id/domains(.:format)
                 * @format  {:controller=>"applications", :action=>"index"}
                 */
                if( is_null( $this->_application_server_id ) && is_null( $this->_obj->_application_server_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _application_server_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                if( is_null( $this->_identifier ) && is_null( $this->_obj->_identifier ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _identifier not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if( is_null( $this->_application_server_id ) ) {
                        $this->_application_server_id = $this->_obj->_application_server_id;
                    }
                    if( is_null( $this->_identifier ) ) {
                        $this->_identifier = $this->_obj->_identifier;
                    }
                }
                $resource = 'application_servers/' . $this->_application_server_id . '/' . $this->_resource . '/' . $this->_identifier;
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
}