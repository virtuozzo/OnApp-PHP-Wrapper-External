<?php

/**
 * User Assigned IP Addresses
 *
 * @category        API wrapper
 * @package         OnApp
 * @copyright       © 2022 OnApp
 */

/**
 * User_AssignedIPs
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_User_AssignedIPs class uses the following basic methods:
 * {@link edit}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */

class OnApp_User_AssignedIPs extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'ip_addresses';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'assigned_ips';
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
                    'ip_address'    => array(
                        ONAPP_FIELD_MAP     => '_ip_address',
                        ONAPP_FIELD_TYPE    => '_array',
                    ),
                );
                break;

            default:
                $this->fields = $this->initFields( 6.7 );
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
                 * @name Get List of IP Addresses Assigned to User
                 * @method GET
                 * @alias  /users/:user_id/assigned_ips(.:format)
                 * @format {:controller=>"User_AssignedIPs", :action=>"getList"}
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
