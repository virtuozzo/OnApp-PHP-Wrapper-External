<?php
/**
 * Managing UserGroup Report
 * 
 * much they will be charged per unit.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Mykola Vuy
 * @copyright   © 2018 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
/**
 * Managing UserGroup Report
 *
 * The OnApp_UserGroup_Report class uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_UserGroup_Report extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'billing_user_group_reports';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'reports';

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
            case 6.0:
                $this->fields = array(
                    'from'                      => array(
                        ONAPP_FIELD_MAP       => '_from',
                        ONAPP_FIELD_TYPE      => 'datetime',
                    ),
                    'till'                      => array(
                        ONAPP_FIELD_MAP       => '_till',
                        ONAPP_FIELD_TYPE      => 'datetime',
                    ),
                    'user_id'                   => array(
                        ONAPP_FIELD_MAP     => '_user_id',
                        ONAPP_FIELD_TYPE    => 'integer',
                    ),
                    'virtual_machine_id'        => array(
                        ONAPP_FIELD_MAP     => '_virtual_machine_id',
                        ONAPP_FIELD_TYPE    => 'integer',
                    ),
                    'resource_pool_costs'       => array(
                        ONAPP_FIELD_MAP     => '_resource_pool_costs',
                        ONAPP_FIELD_TYPE    => 'decimal',
                    ),
                    'network_costs'             => array(
                        ONAPP_FIELD_MAP     => '_network_costs',
                        ONAPP_FIELD_TYPE    => 'decimal',
                    ),
                    'storage_costs'             => array(
                        ONAPP_FIELD_MAP     => '_storage_costs',
                        ONAPP_FIELD_TYPE    => 'decimal',
                    ),
                    'service_addon_costs'       => array(
                        ONAPP_FIELD_MAP     => '_service_addon_costs',
                        ONAPP_FIELD_TYPE    => 'decimal',
                    ),
                    'total_cost'                => array(
                        ONAPP_FIELD_MAP     => '_total_cost',
                        ONAPP_FIELD_TYPE    => 'decimal',
                    ),
                    'id'                       => array(
                        ONAPP_FIELD_MAP     => '_id',
                        ONAPP_FIELD_TYPE    => 'integer',
                    ),
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
    public function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name UserGroup Report
                 * @method GET
                 * 
                 * @alias   /user_groups/:_id/report(.:format)
                 * @format  {:controller=>"Hypervisor Report", :action=>"index"}
                 */
                
                if ( !isset( $this->_id ) && empty( $this->_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _id not set.",
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = 'user_groups/' . $this->_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
                
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }
}
