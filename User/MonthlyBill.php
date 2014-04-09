<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * User Monthly Bill
 *
 * Root tag is missed in Json Ticket #2505
 *
 * @todo        write description
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  User
 * @author      Yakubskiy Yuriy
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * User Monthly Bills
 *
 * The OnApp_User_MonthlyBill class supports the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_User_MonthlyBill extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'vm_stat';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'monthly_bills';

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
            case 2.2:
            case 2.3:
                $this->fields = array(
                    'cost'  => array(
                        ONAPP_FIELD_MAP       => '_cost',
                        ONAPP_FIELD_TYPE      => 'float',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'month' => array(
                        ONAPP_FIELD_MAP       => '_month',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    )
                );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
                $this->fields = $this->initFields( 2.3 );
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
        switch( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name user_monthly_bills
                 * @method GET
                 * @alias   /users/:user_id/monthly_bills(.:format)
                 * @format  {:controller=>"monthly_bills", :action=>"index"}
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
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    /**
     * Sends an API request to get the Objects. After requesting,
     * unserializes the received response into the array of Objects
     *
     * @param integer $user_id User ID
     *
     * @return mixed an array of Object instances on success. Otherwise false
     * @access public
     */
    function getList( $user_id = null, $url_args = null ) {
        if( is_null( $user_id ) && ! is_null( $this->_user_id ) ) {
            $user_id = $this->_user_id;
        }

        if( ! is_null( $user_id ) ) {
            $this->_user_id = $user_id;

            return parent::getList( null, $url_args );
        }
        else {
            $this->logger->error(
                'getList: argument _user_id not set.',
                __FILE__,
                __LINE__
            );
        }
    }

    /**
     * Checks if method is supported
     *
     * @param string $action_name Action name
     */
    function activate( $action_name ) {
        switch( $action_name ) {
            case ONAPP_ACTIVATE_LOAD:
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}