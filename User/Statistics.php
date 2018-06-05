<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * User Statistics
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
 * To view the hourly cost and amount of the resources used by a user:
 */
define( 'ONAPP_GET_RESOURCE_HOURLY_STATS', 'hourly_stats' );


/**
 * User IP User Statistics
 *
 *  The OnApp_User_Statistics class uses the following basic methods:
 *  {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_User_Statistics extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'user_stat';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'user_statistics';

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
                    'backup_cost'            => array(
                        ONAPP_FIELD_MAP       => '_backup_cost',
                        ONAPP_FIELD_TYPE      => 'float',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'vm_cost'                => array(
                        ONAPP_FIELD_MAP       => '_vm_cost',
                        ONAPP_FIELD_TYPE      => 'float',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'monit_cost'             => array(
                        ONAPP_FIELD_MAP       => '_monit_cost',
                        ONAPP_FIELD_TYPE      => 'float',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    // Gets this class only by XML request see ticket#2451
                    'vm_stats'               => array(
                        ONAPP_FIELD_MAP       => '_vm_stats',
                        ONAPP_FIELD_TYPE      => 'array',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_CLASS     => 'User_Statistics_VmStat',
                    ),
                    'storage_disk_size_cost' => array(
                        ONAPP_FIELD_MAP       => '_storage_disk_size_cost',
                        ONAPP_FIELD_TYPE      => 'float',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'user_resources_cost'    => array(
                        ONAPP_FIELD_MAP       => '_user_resources_cost',
                        ONAPP_FIELD_TYPE      => 'float',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'template_cost'          => array(
                        ONAPP_FIELD_MAP       => '_template_cost',
                        ONAPP_FIELD_TYPE      => 'float',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'total_cost'             => array(
                        ONAPP_FIELD_MAP       => '_total_cost',
                        ONAPP_FIELD_TYPE      => 'float',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'edge_group_cost'        => array(
                        ONAPP_FIELD_MAP       => '_edge_group_cost',
                        ONAPP_FIELD_TYPE      => 'float',
                        ONAPP_FIELD_READ_ONLY => true,
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
                $this->fields                            = $this->initFields( 2.3 );
                $this->fields['acceleration_cost']       = array(
                    ONAPP_FIELD_MAP  => '_acceleration_cost',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['backup_count_cost']       = array(
                    ONAPP_FIELD_MAP  => '_backup_count_cost',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['backup_disk_size_cost']   = array(
                    ONAPP_FIELD_MAP  => '_backup_disk_size_cost',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['currency_code']           = array(
                    ONAPP_FIELD_MAP  => '_currency_code',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['customer_network_cost']   = array(
                    ONAPP_FIELD_MAP  => '_customer_network_cost',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['stat_time']               = array(
                    ONAPP_FIELD_MAP  => '_stat_time',
                    ONAPP_FIELD_TYPE => 'datetime',
                );
                $this->fields['template_count_cost']     = array(
                    ONAPP_FIELD_MAP  => '_template_count_cost',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['template_iso_cost']       = array(
                    ONAPP_FIELD_MAP  => '_template_iso_cost',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['user_id']                 = array(
                    ONAPP_FIELD_MAP  => '_user_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['template_disk_size_cost'] = array(
                    ONAPP_FIELD_MAP  => '_template_disk_size_cost',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                break;
            case 5.0:
                $this->fields = $this->initFields( 4.3 );
                break;
            case 5.1:
                $this->fields = $this->initFields( 5.0 );
                break;
            case 5.2:
                $this->fields                             = $this->initFields( 5.1 );
                $this->fields['limit_ova']                = array(
                    ONAPP_FIELD_MAP  => '_limit_ova',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['limit_ova_disk_size']      = array(
                    ONAPP_FIELD_MAP  => '_limit_ova_disk_size',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['limit_ova_free']           = array(
                    ONAPP_FIELD_MAP  => '_limit_ova_free',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['limit_ova_disk_size_free'] = array(
                    ONAPP_FIELD_MAP  => '_limit_ova_disk_size_free',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['price_ova']                = array(
                    ONAPP_FIELD_MAP  => '_price_ova',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['price_ova_disk_size']      = array(
                    ONAPP_FIELD_MAP  => '_price_ova_disk_size',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['parameters']               = array(
                    ONAPP_FIELD_MAP  => '_parameters',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['autoscale_cost']           = array(
                    ONAPP_FIELD_MAP  => '_autoscale_cost',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['ova_count_cost']           = array(
                    ONAPP_FIELD_MAP  => '_ova_count_cost',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['ova_size_cost']            = array(
                    ONAPP_FIELD_MAP  => '_ova_size_cost',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['provider_cpu_usage']       = array(
                    ONAPP_FIELD_MAP  => '_provider_cpu_usage',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['provider_storage_usage']   = array(
                    ONAPP_FIELD_MAP  => '_provider_storage_usage',
                    ONAPP_FIELD_TYPE => 'string',
                );
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
                $this->fields['acceleration_discount_due_to_free']         = array(
                    ONAPP_FIELD_MAP  => '_acceleration_discount_due_to_free',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['autoscale_discount_due_to_free']            = array(
                    ONAPP_FIELD_MAP  => '_autoscale_discount_due_to_free',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['backup_count_discount_due_to_free']         = array(
                    ONAPP_FIELD_MAP  => '_backup_count_discount_due_to_free',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['backup_discount_due_to_free']               = array(
                    ONAPP_FIELD_MAP  => '_backup_discount_due_to_free',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['backup_disk_size_discount_due_to_free']     = array(
                    ONAPP_FIELD_MAP  => '_backup_disk_size_discount_due_to_free',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['ova_count_discount_due_to_free']            = array(
                    ONAPP_FIELD_MAP  => '_ova_count_discount_due_to_free',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['ova_size_discount_due_to_free']             = array(
                    ONAPP_FIELD_MAP  => '_ova_size_discount_due_to_free',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['recovery_point_cost']                       = array(
                    ONAPP_FIELD_MAP  => '_recovery_point_cost',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['recovery_point_discount_due_to_free']       = array(
                    ONAPP_FIELD_MAP  => '_recovery_point_discount_due_to_free',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['storage_disk_size_discount_due_to_free']    = array(
                    ONAPP_FIELD_MAP  => '_storage_disk_size_discount_due_to_free',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['template_count_discount_due_to_free']       = array(
                    ONAPP_FIELD_MAP  => '_template_count_discount_due_to_free',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['template_discount_due_to_free']             = array(
                    ONAPP_FIELD_MAP  => '_template_discount_due_to_free',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['template_disk_size_discount_due_to_free']   = array(
                    ONAPP_FIELD_MAP  => '_template_disk_size_discount_due_to_free',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['template_iso_discount_due_to_free']         = array(
                    ONAPP_FIELD_MAP  => '_template_iso_discount_due_to_free',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['total_cost_with_discount']                  = array(
                    ONAPP_FIELD_MAP  => '_total_cost_with_discount',
                    ONAPP_FIELD_TYPE => 'float',
                );
                $this->fields['total_discount_due_to_free']                = array(
                    ONAPP_FIELD_MAP  => '_total_discount_due_to_free',
                    ONAPP_FIELD_TYPE => 'float',
                );
                $this->fields['user_resources_discount_due_to_free']       = array(
                    ONAPP_FIELD_MAP  => '_user_resources_discount_due_to_free',
                    ONAPP_FIELD_TYPE => 'float',
                );
                $this->fields['vm_discount_due_to_free']                   = array(
                    ONAPP_FIELD_MAP  => '_vm_discount_due_to_free',
                    ONAPP_FIELD_TYPE => 'float',
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
                 * @name user_vm_stats
                 * @method GET
                 * @alias   /users/:user_id/vm_stats(.:format)
                 * @format  {:controller=>"vm_stats", :action=>"index"}
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
            case ONAPP_GET_RESOURCE_HOURLY_STATS :
                /**
                 * ROUTE :
                 *
                 * @name hourly_stats
                 * @method GET
                 * @alias  /users/:user_id/user_statistics.xml(.:format)
                 * @format {:action=>"index", :controller=>"own"}
                 */
                if ( is_null( $this->_user_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _user_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = 'users/' . $this->_user_id . '/' . $this->_resource;
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
    function getList( $user_id = null, $url_args = array() ) {
        if ( is_null( $user_id ) && ! is_null( $this->_user_id ) ) {
            $user_id = $this->_user_id;
        }

        if ( ! is_null( $user_id ) ) {
            $this->_user_id = $user_id;

            return parent::getList( null, $url_args );
        } else {
            $this->logger->error(
                'getList: argument _user_id not set.',
                __FILE__,
                __LINE__
            );
        }
    }

    public function hourly_stats() {
        return $this->sendGet( ONAPP_GET_RESOURCE_HOURLY_STATS, null, 'hourly_stats' );
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
                $this->logger->error( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()',
                    __FILE__,
                    __LINE__
                );
        }
    }
}