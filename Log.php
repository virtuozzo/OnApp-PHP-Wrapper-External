<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing VM Logs
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Yakubskiy Yuriy
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */


/**
 * Approve Transaction
 */
define( 'ONAPP_APPROVE_TRANSACTION', 'approve_transaction' );

/**
 * Decline Transaction
 */
define( 'ONAPP_DECLINE_TRANSACTION', 'decline_transaction' );

/**
 * Vm Logs
 *
 * This class represents Vm logs
 *
 * The OnApp_Log class uses the following basic methods:
 * {@link load} and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Log extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'log_item';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'logs';

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
                    'id'          => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'target_id'   => array(
                        ONAPP_FIELD_MAP       => '_target_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'created_at'  => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'target_type' => array(
                        ONAPP_FIELD_MAP      => '_target_type',
                        ONAPP_FIELD_TYPE     => 'string',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'updated_at'  => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'action'      => array(
                        ONAPP_FIELD_MAP       => '_action',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'status'      => array(
                        ONAPP_FIELD_MAP       => '_status',
                        ONAPP_FIELD_TYPE      => 'string',
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
            case 5.0:
                $this->fields = $this->initFields( 2.3 );
                break;
            case 5.1:
                $this->fields = $this->initFields( 5.0 );
                break;
            case 5.2:
                $this->fields = $this->initFields( 5.1 );
                break;
            case 5.3:
                $this->fields                     = $this->initFields( 5.2 );
                $this->fields['resource_diff_id'] = array(
                    ONAPP_FIELD_MAP  => '_resource_diff_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
            case 5.4:
                $this->fields = $this->initFields( 5.3 );
                break;
            case 5.5:
                $this->fields                      = $this->initFields( 5.4 );
                $this->fields['resource_diff_ids'] = array(
                    ONAPP_FIELD_MAP  => 'resource_diff_ids',
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

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_APPROVE_TRANSACTION:
                /**
                 * ROUTE :
                 *
                 * @name approve
                 * @method PUT
                 * @alias  /logs/:id/approve.xml(.:format)
                 * @format {:controller=>"resources", :action=>"approve"}
                 */

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


                $resource = $this->_resource . '/' . $this->_id . '/approve';
                break;

            case ONAPP_DECLINE_TRANSACTION:
                /**
                 * ROUTE :
                 *
                 * @name decline
                 * @method PUT
                 * @alias  /logs/:id/decline.xml(.:format)
                 * @format {:controller=>"resources", :action=>"decline"}
                 */

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
                $resource = $this->_resource . '/' . $this->_id . '/decline';
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
     * @param array $url_args
     *
     * @return mixed an array of Object instances on success. Otherwise false
     * @access public
     */
    function getList( $params = null, $url_args = null ) {
        return parent::getList( null, $url_args );
    }

    function activateCheck( $action_name ) {
        switch ( $action_name ) {
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }

    function approve() {
        $this->sendPut( ONAPP_APPROVE_TRANSACTION );
    }

    function decline() {
        $this->sendPut( ONAPP_DECLINE_TRANSACTION );
    }
}
