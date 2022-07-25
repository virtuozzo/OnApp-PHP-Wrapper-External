<?php

/**
 * User Virtual Server IP Addresses
 *
 * @category        API wrapper
 * @package         OnApp
 * @copyright       © 2022 OnApp
 */

/**
 * VirtualServerIPs
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The VirtualServerIPs class uses the following basic methods:
 * {@link edit}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */

class OnApp_User_VirtualServerIPs extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'ip_address_joins';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'virtual_server_ips';
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
            case 6.7:
                $this->fields = array(
                    'user_id'       => array(
                        ONAPP_FIELD_MAP     => '_user_id',
                        ONAPP_FIELD_TYPE    => 'integer',
                    ),
                    'ip_address_join'    => array(
                        ONAPP_FIELD_MAP     => '_ip_address_join',
                        ONAPP_FIELD_TYPE    => '_array',
                    ),
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
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name Get List of IP Addresses Assigned to User's Virtual Servers
                 * @method GET
                 * @alias  /users/:user_id/virtual_server_ips(.:format)
                 * @format {:controller=>"VirtualServerIPs", :action=>"getList"}
                 */
                if ( is_null( $this->_user_id ) && is_null( $this->_obj->_user_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _user_id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_user_id ) ) {
                        $this->_user_id = $this->obj->_user_id;
                    }
                }

                $resource = 'users/' . $this->_user_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    function activateCheck( $action_name ) {
        switch ( $action_name ) {
            case ONAPP_ACTIVATE_LOAD:
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}
