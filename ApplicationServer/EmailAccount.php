<?php
/**
 * Email Accounts
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
 * The OnApp_ApplicationServer_EmailAccounts uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_ApplicationServer_EmailAccount extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'email_account';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'email_accounts';

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
            case 5.1:
                $this->fields = array();

                $this->fields['count'] = array(
                    ONAPP_FIELD_MAP  => '_count',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['identifier']            = array(
                    ONAPP_FIELD_MAP  => '_identifier',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['space']                 = array(
                    ONAPP_FIELD_MAP  => '_space',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['user']                  = array(
                    ONAPP_FIELD_MAP  => '_user',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['password']                  = array(
                    ONAPP_FIELD_MAP  => '_password',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['password_confirmation']                  = array(
                    ONAPP_FIELD_MAP  => '_password_confirmation',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['domain']                  = array(
                    ONAPP_FIELD_MAP  => '_domain',
                    ONAPP_FIELD_TYPE => 'string',
                );
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
                 * @alias   /application_servers/:application_server_id/email_accounts(.:format)
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
                 * @alias   /application_servers/:application_server_id/ftp_users/:ftp_user_identifier(.:format)
                 * @format  {:controller=>"applications", :action=>"index"}
                 */
                if ( is_null( $this->_application_server_id ) && is_null( $this->_obj->_application_server_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _application_server_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                if ( is_null( $this->_identifier ) && is_null( $this->_obj->_identifier ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _identifier not set.',
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
                $resource = 'application_servers/' . $this->_application_server_id . '/' . $this->_resource . '/' . $this->_identifier;
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

    /**
     * Sends an API request to get the Objects. After requesting,
     * unserializes the received response into the array of Objects
     *
     * @param integer $application_server_id Application_Server_ID
     *
     * @return mixed an array of Object instances on success. Otherwise false
     * @access public
     */
    function getListByDomain( $domain, $application_server_id = null) {
        if ( is_null( $application_server_id ) && ! is_null( $this->_application_server_id ) ) {
            $application_server_id = $this->_application_server_id;
        }

        if ( ! is_null( $application_server_id ) ) {
            $this->_application_server_id = $application_server_id;
            $url_args = array('domain' => $domain);
            return parent::getList(null, $url_args);
        } else {
            $this->logger->error(
                'getList: argument _application_server_id not set.',
                __FILE__,
                __LINE__
            );
        }
    }

    function delete() {
        $url_args = array();
        if ( ! is_null( $this->_domain ) ) {
            $url_args = array('domain_name' => $this->_domain);
        }

        $this->logger->add( 'Delete existing Object ( identifier => ' . $this->_identifier . ' ).' );
        $this->sendDelete( ONAPP_GETRESOURCE_DELETE, null, $url_args );
        if ( !is_countable($this->getErrorsAsArray()) || count( $this->getErrorsAsArray() ) < 1 ) {
            $this->_is_deleted = true;
        }
    }

}