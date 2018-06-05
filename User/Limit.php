<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * User Limits
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  User
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        https://docs.onapp.com/display/42API/Get+List+of+User+Limits
 * @see         OnApp
 */

/**
 * User Limits
 *
 *  The OnApp_User_Limit class uses the following basic methods:
 *  {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_User_Limit extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'limits';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'limits';

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
                    'memory'                           => array(
                        ONAPP_FIELD_MAP  => '_memory',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'cpus'                             => array(
                        ONAPP_FIELD_MAP  => '_cpus',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'cpu_shares'                       => array(
                        ONAPP_FIELD_MAP  => '_cpu_shares',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'cpu_units'                        => array(
                        ONAPP_FIELD_MAP  => '_cpu_units',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'rate'                             => array(
                        ONAPP_FIELD_MAP  => '_rate',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'disk_size'                        => array(
                        ONAPP_FIELD_MAP  => '_disk_size',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'primary_disk_size'                => array(
                        ONAPP_FIELD_MAP  => '_primary_disk_size',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'swap_disk_size'                   => array(
                        ONAPP_FIELD_MAP  => '_swap_disk_size',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'network_groups'                   => array(
                        ONAPP_FIELD_MAP  => '_network_groups',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    'customer_networks'                => array(
                        ONAPP_FIELD_MAP  => '_customer_networks',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    'resource_network_groups'          => array(
                        ONAPP_FIELD_MAP  => '_resource_network_groups',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    'hypervisor_groups'                => array(
                        ONAPP_FIELD_MAP  => '_hypervisor_groups',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    'hypervisors'                      => array(
                        ONAPP_FIELD_MAP  => '_hypervisors',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    'available_hypervisors'            => array(
                        ONAPP_FIELD_MAP  => '_available_hypervisors',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    'data_store_groups'                => array(
                        ONAPP_FIELD_MAP  => '_data_store_groups',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    'data_store_group_sizes'           => array(
                        ONAPP_FIELD_MAP  => '_data_store_group_sizes',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    'best_data_store_group_primary_id' => array(
                        ONAPP_FIELD_MAP  => '_best_data_store_group_primary_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'best_data_store_group_swap_id'    => array(
                        ONAPP_FIELD_MAP  => '_best_data_store_group_swap_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'best_network_group_id'            => array(
                        ONAPP_FIELD_MAP  => '_best_network_group_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
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
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name limits
                 * @method GET
                 * @alias   /users/:user_id/limits(.:format)
                 * @format  {:controller=>"limits", :action=>"index"}
                 */
                if ( is_null( $this->_user_id ) && is_null( $this->_obj->_user_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _user_id not set.",
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_user_id ) ) {
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