<?php
/**
 * Managing Settings CDN ManagersNetworks
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
 * @var
 */
define('ONAPP_RECREATE_BRIGES', 'bridges');

/**
 * Managing Settings CDN ManagersNetworks
 *
 * The OnApp_Settings_CDN_ManagersNetworks class uses the following basic methods:
 * {@link getlist} {@link load}, {@link add}, {@link delete}, {@link recreatebridges}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_Settings_CDN_ManagersNetworks extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'networking_sdn_network';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'networks';

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
                    'id'                    => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'label'                 => array(
                        ONAPP_FIELD_MAP         => '_label',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'identifier'            => array(
                        ONAPP_FIELD_MAP         => '_identifier',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'external_network_id'   => array(
                        ONAPP_FIELD_MAP         => '_external_network_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'vni'                   => array(
                        ONAPP_FIELD_MAP         => '_vni',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'manager_id'            => array(
                        ONAPP_FIELD_MAP         => '_manager_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'created_at'            => array(
                        ONAPP_FIELD_MAP         => '_created_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true
                    ),
                    'updated_at'            => array(
                        ONAPP_FIELD_MAP         => '_updated_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true
                    ),
                    'status'                => array(
                        ONAPP_FIELD_MAP         => '_status',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'nodes'                 => array(
                        ONAPP_FIELD_MAP         => '_nodes',
                        ONAPP_FIELD_TYPE        => '_array',
                    ),
                    'network_zone_id'       => array(
                        ONAPP_FIELD_MAP         => '_network_zone_id',
                        ONAPP_FIELD_TYPE        => 'integer',
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
    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name Settings CDN ManagersNetworks
                 * @method GET
                 * 
                 * @alias   /settings/sdn/managers/:manager_id/networks(.:format)
                 * @format  {:controller=>"Settings_CDN_ManagersNetworks", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Settings CDN ManagersNetworks
                 * @method GET
                 * 
                 * @alias   /settings/sdn/managers/:manager_id/networks/:id(.:format)
                 * @format  {:controller=>"Settings_CDN_ManagersNetworks", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Settings CDN ManagersNetworks
                 * @method POST
                 * 
                 * @alias   /settings/sdn/managers/:manager_id/networks(.:format)
                 * @format  {:controller=>"Settings_CDN_ManagersNetworks", :action=>"add"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Settings CDN ManagersNetworks
                 * @method DELETE
                 * 
                 * @alias   /settings/sdn/managers/:manager_id/networks/:id(.:format)
                 * @format  {:controller=>"Settings_CDN_ManagersNetworks", :action=>"delete"}
                 */
                if ( is_null( $this->_manager_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _manager_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = 'settings/sdn/managers/' . $this->_manager_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
                
            case ONAPP_RECREATE_BRIGES:
                /**
                 * ROUTE :
                 *
                 * @name Settings CDN ManagersNetworks
                 * @method PUT
                 * 
                 * @alias   /settings/sdn/managers/:manager_id/networks/:id/bridges/:bridges_id/recreate(.:format)
                 * @format  {:controller=>"Settings_CDN_ManagersNetworks", :action=>"recreate_bridges"}
                 */
                
                if ( is_null( $this->_manager_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _manager_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                if ( is_null( $this->_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                if ( is_null( $this->_bridges_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _bridges_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = 'settings/sdn/managers/' . $this->_manager_id . '/' . $this->_resource . '/' . $this->_id . '/' . ONAPP_RECREATE_BRIGES . '/' . $this->_bridges_id . '/recreate';
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
                
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }
    
    /**
     * recreateBridges
     *
     * @param integer $resource_id 
     */
    public function recreateBridges( $bridges_id = null ) {
        if ( ! is_null( $bridges_id ) ) {
            $this->_bridges_id = $bridges_id;
        }
        $this->sendPut( ONAPP_RECREATE_BRIGES );
    }
    
}
