<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing User Payments
 *
 * Payments list the invoices paid by the users.
 * Once the invoice is paid, you have to put it to the system to keep track of
 * them.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

define('ONAPP_VERSION_SIX', 6);

/**
 * User Payments
 *
 * This class represents the user payments entered to the system.
 *
 * The OnApp_Payment class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Payment extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'payment';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'payments';

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
            case '2.0':
            case '2.1':
            case 2.2:
            case 2.3:
                $this->fields = array(
                    'id'             => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'amount'         => array(
                        ONAPP_FIELD_MAP           => '_amount',
                        ONAPP_FIELD_TYPE          => 'decimal',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => '0.0',
                    ),
                    'created_at'     => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'invoice_number' => array(
                        ONAPP_FIELD_MAP      => '_invoice_number',
                        ONAPP_FIELD_TYPE     => 'string',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'updated_at'     => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'user_id'        => array(
                        ONAPP_FIELD_MAP       => '_user_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
            case 4.2:
            case 4.3:
                $this->fields             = $this->initFields( 2.3 );
                $this->fields['payer_id'] = array(
                    ONAPP_FIELD_MAP  => '_payer_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['type']     = array(
                    ONAPP_FIELD_MAP  => '_type',
                    ONAPP_FIELD_TYPE => 'string',
                );
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
                $this->fields['payer_type']     = array(
                    ONAPP_FIELD_MAP  => '_payer_type',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name    payment
                 * @method  GET
                 * @alias   (v < 6) /users/:user_id/payments(.:format)
                 * @alias   (v >= 6) /billing/payments(.:format)?payer_type=:payer_type
                 * @format  {:controller=>"payments", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name    payment
                 * @method  GET
                 * @alias   (v < 6) /users/:user_id/payments/:id(.:format)
                 * @alias   (v >= 6) /billing/payments/:id(.:format)
                 * @format  {:controller=>"payments", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method  POST
                 * @alias   (v < 6) /users/:user_id/payments(.:format)
                 * @alias   (v >= 6) /billing/payments(.:format)
                 * @format  {:controller=>"payments", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method  PUT
                 * @alias   (v < 6) /users/:user_id/payments/:id(.:format)
                 * @alias   (v >= 6) /billing/payments/:id(.:format)
                 * @format  {:controller=>"payments", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method DELETE
                 * @alias (v < 6) /users/:user_id/payments/:id(.:format)
                 * @alias (v >= 6) /billing/payments/:id(.:format)
                 * @format  {:controller=>"payments", :action=>"destroy"}
                 */
                if ( $this->getAPIVersion() < ONAPP_VERSION_SIX ) {
                    $resource = 'users/' . $this->_user_id . '/' . $this->_resource;
                } else {
                    $resource = 'billing/user/' . $this->_resource;
                }
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
        if (null === $user_id && null !== $this->_user_id) {
            $user_id = $this->_user_id;
        }

        if ($this->getAPIVersion() < ONAPP_VERSION_SIX) {
            if (null === $user_id) {
                $this->logger->error(
                    'getList: argument _user_id not set.',
                    __FILE__,
                    __LINE__
                );

                return false;
            }

            $this->_user_id = $user_id;

            return parent::getList();
        }

        if (null === $url_args) {
            $url_args = array();
        }

        if (null !== $this->_payer_type && !array_key_exists('payer_type', $url_args)) {
            $url_args['payer_type'] = $this->_payer_type;
        }

        if (null !== $user_id) {
            $url_args['payer_id'] = $user_id;
        }

        if (!array_key_exists('payer_type', $url_args)) {
            $this->logger->error(
                'getList: argument _payer_type not set.',
                __FILE__,
                __LINE__
            );
        }

        return parent::getList(null, $url_args);
    }

    /**
     * Sends an API request to get the Object after sending,
     * unserializes the response into an object
     *
     * The key field Parameter ID is used to load the Object. You can re-set
     * this parameter in the class inheriting OnApp class.
     *
     * @param integer $id Payment ID
     * @param integer $user_id User ID
     *
     * @return mixed serialized Object instance from API
     * @access public
     */
    function load( $id = null, $user_id = null ) {
        if ( $this->getAPIVersion() < ONAPP_VERSION_SIX ) {
            if ( is_null( $user_id ) && ! is_null( $this->_user_id ) ) {
                $user_id = $this->_user_id;
            }

            if ( is_null( $id ) && ! is_null( $this->_id ) ) {
                $id = $this->_id;
            }

            if ( is_null( $id ) &&
                 isset( $this->_obj ) &&
                 ! is_null( $this->_obj->_id )
            ) {
                $id = $this->_obj->_id;
            }

            $this->logger->add( 'load: Load class ( id => ' . $id . ' ).' );

            if ( ! is_null( $id ) && ! is_null( $user_id ) ) {
                $this->_id      = $id;
                $this->_user_id = $user_id;

                $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_LOAD ) );

                $response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

                $result = $this->_castResponseToClass( $response );

                $this->_obj = $result;

                return $result;
            } else {
                if ( is_null( $id ) ) {
                    $this->logger->error(
                        'load: argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    $this->logger->error(
                        'load: argument _user_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
            }
        } else {
            
            return parent::load();
        }
    }
}