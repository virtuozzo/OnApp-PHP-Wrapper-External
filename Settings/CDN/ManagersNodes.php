<?php
/**
 * Managing Settings CDN ManagersNodes
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
define('ONAPP_RETTACH_NODES', 'reattach');

/**
 * Managing Settings CDN ManagersNodes
 *
 * The OnApp_Settings_CDN_ManagersNodes class uses the following basic methods:
 * {@link load}, {@link add}, {@link edit}, {@link delete}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_Settings_CDN_ManagersNodes extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'networking_sdn_node';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'nodes';

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
                    'manager_id'            => array(
                        ONAPP_FIELD_MAP         => '_manager_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'id'                    => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'compute_resource_id'   => array(
                        ONAPP_FIELD_MAP         => '_compute_resource_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'connection_option_id'  => array(
                        ONAPP_FIELD_MAP         => '_connection_option_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'system_id'             => array(
                        ONAPP_FIELD_MAP         => '_system_id',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'status'                => array(
                        ONAPP_FIELD_MAP         => '_status',
                        ONAPP_FIELD_TYPE        => 'string',
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
                 * @name Settings CDN ManagersNodes
                 * @method GET
                 * 
                 * @alias   /settings/sdn/managers/:manager_id/nodes(.:format)
                 * @format  {:controller=>"Settings_CDN_ManagersNodes", :action=>"index"}
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
                
            case ONAPP_GETRESOURCE_ADD:
                /**
                 * ROUTE :
                 *
                 * @name Settings CDN ManagersNodes
                 * @method POST
                 * 
                 * @alias   /settings/sdn/managers/:manager_id/nodes/:compute_resource_id(.:format)
                 * @format  {:controller=>"Settings_CDN_ManagersNodes", :action=>"add"}
                 */
                if ( is_null( $this->_manager_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _manager_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                if ( is_null( $this->_connection_option_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _connection_option_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                if ( is_null( $this->_compute_resource_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _compute_resource_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = 'settings/sdn/managers/' . $this->_manager_id . '/' . $this->_resource . '/' . $this->_compute_resource_id;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
            case ONAPP_RETTACH_NODES:
                /**
                 * ROUTE :
                 *
                 * @name Settings CDN ManagersNodes Rettach
                 * @method DELETE
                 * 
                 * @alias   /settings/sdn/managers/:manager_id/nodes/:node_id/reattach(.:format)
                 * @format  {:controller=>"Settings_CDN_ManagersNodes", :action=>"add"}
                 */
                if ( is_null( $this->_manager_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _manager_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                if ( is_null( $this->_node_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _node_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = 'settings/sdn/managers/' . $this->_manager_id . '/' . $this->_resource . '/' . $this->_node_id . '/' . ONAPP_RETTACH_NODES;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
                
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }
    
    public function save() {
        $data = array(
            'manager_id'            => $this->_manager_id,
            'connection_option_id'  => $this->_connection_option_id,
            'compute_resource_id'   => $this->_compute_resource_id,
        );
        
        if ( ! is_null( $data ) && is_array( $data ) ) {
            $data = json_encode($data);
            $this->logger->debug( 'Additional parameters: ' . $data );
        }

        $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_ADD ) );
        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_POST, $data );

        $result     = $this->_castResponseToClass( $response );
        $this->_obj = $result;
    }
    
    function rettachNodes( $node_id ) {
        $this->_node_id = $node_id;
        
        $this->sendDelete( ONAPP_RETTACH_NODES );
    }
}
