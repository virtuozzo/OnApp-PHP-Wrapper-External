<?php
/**
 * Managing Role Approvals
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  Role
 * @author      Ivan Gavryliuk
 * @copyright   © 2017 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing Role Approvals
 *
 * The OnApp_Role_Approval class represents the billing plans. The OnApp class is the parent of the OnApp class.
 *
 * The OnApp_Role_Approval class uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Role_Approval extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'role';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'set_approvals';

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
            case 5.5:
                $this->fields = array(
                    'id'                         => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer'
                    ),
                    'label'                      => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string'
                    ),
                    'identifier'                 => array(
                        ONAPP_FIELD_MAP  => '_identifier',
                        ONAPP_FIELD_TYPE => 'string'
                    ),
                    'created_at'                 => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime'
                    ),
                    'updated_at'                 => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime'
                    ),
                    'system'                     => array(
                        ONAPP_FIELD_MAP  => '_system',
                        ONAPP_FIELD_TYPE => 'boolean'
                    ),
                    'users_count'                => array(
                        ONAPP_FIELD_MAP  => '_users_count',
                        ONAPP_FIELD_TYPE => 'integer'
                    ),
                    'permissions'                => array(
                        ONAPP_FIELD_MAP   => '_permissions',
                        ONAPP_FIELD_CLASS => 'Role_Permission',
                    ),
                    'transaction_action_approve' => array(
                        ONAPP_FIELD_MAP  => '_transaction_action_approve',
                        ONAPP_FIELD_CLASS => 'Role_TransactionActionApprove',
                    ),
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

            default:
                if ( is_null( $this->_role_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _role_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = 'roles/' . $this->_role_id . '/' . $this->_resource;
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
}