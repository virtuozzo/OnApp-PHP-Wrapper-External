<?php
class OnApp_Vapp_StartupItems extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'vapps_startup_item';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'startup_items';

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
                    'id'                           => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'vapp_id'       => array(
                        ONAPP_FIELD_MAP         => '_vapp_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'virtual_machine_id'        => array(
                        ONAPP_FIELD_MAP         => '_virtual_machine_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'vm_name'                                   => array(
                        ONAPP_FIELD_MAP         => '_vm_name',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'order'                                    => array(
                        ONAPP_FIELD_MAP         => '_order',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'start_action'                                   => array(
                        ONAPP_FIELD_MAP         => '_start_action',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'start_delay'                       => array(
                        ONAPP_FIELD_MAP         => '_order',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'stop_action'           => array(
                        ONAPP_FIELD_MAP         => '_stop_action',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'stop_delay'                       => array(
                        ONAPP_FIELD_MAP         => '_stop_delay',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'created_at'                                    => array(
                        ONAPP_FIELD_MAP         => '_created_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true
                    ),
                    'updated_at'                                    => array(
                        ONAPP_FIELD_MAP         => '_updated_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true
                    ),
                    'startup_items_attributes'  => array(
                        ONAPP_FIELD_MAP         => '_startup_items_attributes',
                        ONAPP_FIELD_TYPE        => '_array',
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
                 * @name Vapp StartupItems
                 * @method GET
                 * @alias   /vapps/:vapp_id/startup_items(.:format)
                 * @format  {:controller=>"Vapp_StartupItems", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Vapp StartupItems
                 * @method PUT
                 * @alias   /vapps/:vapp_id/startup_items(.:format)
                 * @format  {:controller=>"Vapp_StartupItems", :action=>"edit"}
                 */
                
                $resource = 'vapps/' . $this->_vapp_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
            
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }
    
    public function save() {
        if ( isset( $this->_startup_items_attributes ) && !is_null( $this->_startup_items_attributes ) ) {
            $data = array(
                'root'        => 'vapp',
                'data'        => array(
                    'startup_items_attributes'     => $this->_startup_items_attributes,
                ),
            );
            $this->sendPut( ONAPP_GETRESOURCE_DEFAULT, $data );
        }
    }    
}
