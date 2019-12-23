<?php

/**
 * Manages Data Store Join
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  Hypervisor
 * @author
 * @copyright   © 2017 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * ONAPP_Hypervisor_DataStoreJoin
 *
 * This class reprsents the Data Store Joins for Hypervisor.
 *
 * The OnApp_Hypervisor_DataStoreJoin class uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Hypervisor_DataStoreJoin extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'data_store_join';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'data_store_joins';

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
            case 2.2:
            case 2.3:
            case '2.1':
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
            case 5.1:
            case 5.2:
            case 5.3:
                $this->fields = array(
                    'id'            => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                    ),
                    'created_at'    => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                    ),
                    'updated_at'    => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                    ),
                    'data_store_id' => array(
                        ONAPP_FIELD_MAP      => '_data_store_id',
                        ONAPP_FIELD_TYPE     => 'integer',
                    ),
                    'hypervisor_id' => array(
                        ONAPP_FIELD_MAP      => '_hypervisor_id',
                        ONAPP_FIELD_TYPE     => 'integer',
                    ),
                    'target_join_id' => array(
                        ONAPP_FIELD_MAP      => '_target_join_id',
                        ONAPP_FIELD_TYPE     => 'integer',
                    ),
                    'target_join_type' => array(
                        ONAPP_FIELD_MAP      => '_target_join_type',
                        ONAPP_FIELD_TYPE     => 'string',
                    ),
                );
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

            case 6.1:
                $this->fields = $this->initFields( 6.0 );
                break;

            case 6.2:
                $this->fields = $this->initFields( 6.1 );
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
                 * @name hypervisor_data_store_joins
                 * @method GET
                 * @alias   /settings/hyrvisor/:hypervisor_id/data_store_joins(.:format)
                 * @format  {:controller=>"data_store_joins", :action=>"index"}
                 */
                $resource = 'settings/hypervisors/' . $this->_target_join_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    /**
     * Gets list of datastore joins to particular hypervisor
     *
     * @param integet $target_join_id hypervisor id
     *
     * @return array of datastore join objects
     */
    function getList( $target_join_id = null, $url_args = null ) {
        if ( is_null( $target_join_id ) && ! is_null( $this->_target_join_id ) ) {
            $target_join_id = $this->_target_join_id;
        }

        if ( ! is_null( $target_join_id ) ) {
            $this->_target_join_id = $target_join_id;

            return parent::getList();
        } else {
            $this->logger->error(
                'getList: argument _target_join_id not set.',
                __FILE__,
                __LINE__
            );
        }
    }

    /**
     * Activates action performed with object
     *
     * @param string $action_name the name of action
     *
     * @access public
     */
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