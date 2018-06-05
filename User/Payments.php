<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * User Payment
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  User
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        https://docs.onapp.com/display/42API/Get+List+of+User+Payments
 * @see         OnApp
 */

/**
 * User Payment
 *
 *  The OnApp_User_Payments class uses the following basic methods:
 *  {@link getList}.
 *
 * For full fields reference and curl request details visit: ( https://docs.onapp.com/display/42API/Get+List+of+User+Payments )
 */
class OnApp_User_Payments extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'billing_user_payment';
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
            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
            case 4.2:
                $this->fields = array(
                    'created_at'           => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime'
                    ),
                    'updated_at'           => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime'
                    ),
                    'amount'               => array(
                        ONAPP_FIELD_MAP  => '_amount',
                        ONAPP_FIELD_TYPE => 'float'
                    ),
                    'invoice_number'       => array(
                        ONAPP_FIELD_MAP  => '_invoice_number',
                        ONAPP_FIELD_TYPE => 'string'
                    ),
                    'id'                   => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer'
                    ),
                    'user_id'              => array(
                        ONAPP_FIELD_MAP  => '_user_id',
                        ONAPP_FIELD_TYPE => 'integer'
                    ),
                    'billing_user_payment' => array(
                        ONAPP_FIELD_MAP  => '_billing_user_payment',
                        ONAPP_FIELD_TYPE => 'array'
                    ),
                    'payer_id' => array(
                        ONAPP_FIELD_MAP  => '_payer_id',
                        ONAPP_FIELD_TYPE => 'integer'
                    )
                );
                break;
            case 4.3:
            case 5.0:
                $this->fields = $this->initFields( 4.2 );
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
                $this->fields            = $this->initFields( 5.4 );
                $this->fields['payment'] = array(
                    ONAPP_FIELD_MAP  => '_payment',
                    ONAPP_FIELD_TYPE => 'string',
                );
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
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                if ( is_null( $this->_user_id ) && is_null( $this->_obj->_user_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _user_id not set.",
                        __FILE__,
                        __LINE__
                    );
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
     * The method creates a new Object
     *
     * @return object Serialized API Response
     * @access private
     */
    function _create() {
        $this->logger->add( 'Create new Object.' );

        $data = array(
            'root' => 'payment',
            'data' => array(
                'amount'         => $this->_amount,
                'invoice_number' => $this->_invoice_number,
            ),
        );

        return $this->sendPost( ONAPP_GETRESOURCE_ADD, $data );
    }

    /**
     * The method edits an existing Object
     *
     * @return object Serialized API Response
     * @access private
     */
    function _edit() {
        $data = array(
            'root' => 'payment',
            'data' => array(
                'amount'         => $this->_amount,
                'invoice_number' => $this->_invoice_number,
            ),
        );

        return $this->sendPut( ONAPP_GETRESOURCE_EDIT, $data );
    }

    function getList( $params = null, $url_args = null ) {
        $tagRootOld     = $this->_tagRoot;
        $result         = $this->sendGet( ONAPP_GETRESOURCE_LIST );
        $this->_tagRoot = $tagRootOld;

        return $result;
    }
}