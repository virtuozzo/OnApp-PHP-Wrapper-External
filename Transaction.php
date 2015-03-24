<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Transactions
 *
 * The system records in the database a detailed log of all the transactions
 * happening to your virtual machines. You can view the transactions output from
 * the Control Panel.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Transactions
 *
 * This class represents the Transactions of the OnApp installation.
 *
 * The OnApp_Transaction class uses the following basic methods:
 * {@link load} and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Transaction extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'transaction';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'transactions';

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
                $this->fields = array(
                    'id'                       => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'action'                   => array(
                        ONAPP_FIELD_MAP           => '_action',
                        ONAPP_FIELD_DEFAULT_VALUE => '',
                        ONAPP_FIELD_READ_ONLY     => true
                    ),
                    'actor'                    => array(
                        ONAPP_FIELD_MAP       => '_actor',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'created_at'               => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'dependent_transaction_id' => array(
                        ONAPP_FIELD_MAP       => '_dependent_transaction_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'log_output'               => array(
                        ONAPP_FIELD_MAP       => '_log_output',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'params'                   => array(
                        ONAPP_FIELD_MAP       => '_params',
                        ONAPP_FIELD_TYPE      => 'yaml',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'parent_id'                => array(
                        ONAPP_FIELD_MAP       => '_parent_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'parent_type'              => array(
                        ONAPP_FIELD_MAP       => '_parent_type',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'pid'                      => array(
                        ONAPP_FIELD_MAP       => '_pid',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'priority'                 => array(
                        ONAPP_FIELD_MAP       => '_priority',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'status'                   => array(
                        ONAPP_FIELD_MAP       => '_status',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'updated_at'               => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'user_id'                  => array(
                        ONAPP_FIELD_MAP       => '_user_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                );
                break;

            case '2.1':
                $this->fields                     = $this->initFields( '2.0' );
                $this->fields[ 'allowed_cancel' ] = array(
                    ONAPP_FIELD_MAP       => '_allowed_cancel',
                    ONAPP_FIELD_TYPE      => 'boolean',
                    ONAPP_FIELD_READ_ONLY => true
                );
                $this->fields[ 'identifier' ]     = array(
                    ONAPP_FIELD_MAP       => '_identifier',
                    ONAPP_FIELD_TYPE      => 'string',
                    ONAPP_FIELD_READ_ONLY => true
                );
                $this->fields[ 'start_after' ]    = array(
                    ONAPP_FIELD_MAP       => '_start_after',
                    ONAPP_FIELD_TYPE      => 'datetime',
                    ONAPP_FIELD_READ_ONLY => true
                );
                break;

            case 2.2:
                $this->fields                  = $this->initFields( 2.1 );
                $this->fields[ 'started_at' ]  = array(
                    ONAPP_FIELD_MAP       => 'started_at',
                    ONAPP_FIELD_TYPE      => 'datetime',
                    ONAPP_FIELD_READ_ONLY => true
                );
                $this->fields[ 'finished_at' ] = array(
                    ONAPP_FIELD_MAP       => 'finished_at',
                    ONAPP_FIELD_TYPE      => 'datetime',
                    ONAPP_FIELD_READ_ONLY => true
                );
                break;

            case 2.3:
                $this->fields = $this->initFields( 2.2 );
                $fields       = array(
                    'finished_at',
                );
                $this->unsetFields( $fields );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
                $this->fields = $this->initFields( 2.3 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function activate( $action_name ) {
        switch( $action_name ) {
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }

    /**
     * Sends an API request to get the Objects. After requesting,
     * unserializes the received response into the array of Objects
     *
     * @param int $page
     *
     * @return the array of Object instances
     */
    function getList( $page = 1 ) {
        $data = array(
            'root' => 'page',
            'data' => $page,
        );

        return parent::getList( $data );
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        return parent::getResource( $action );
        /**
         * ROUTE :
         *
         * @name transactions
         * @method GET
         * @alias   /settings/nameservers(.:format)
         * @format  {:controller=>"transactions", :action=>"index"}
         */
        /**
         * ROUTE :
         *
         * @name transaction
         * @method GET
         * @alias    /transactions/:id(.:format)
         * @format   {:controller=>"transactions", :action=>"show"}
         */
    }

    /**
     * Load transaction with log_output
     *
     * @param type $id
     *
     * @return type
     */
    function load_with_output( $id ) {
        $this->_id = $id;

        return $this->sendGet( ONAPP_GETRESOURCE_LOAD, null, array( 'log' => '' ) );
    }
}