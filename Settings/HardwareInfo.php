<?php
/**
 * Managing HardwareInfo
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
 * Managing Settings HardwareInfo
 *
 * The OnApp_Settings_HardwareInfo class uses the following basic methods:
 * {@link load} and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_Settings_HardwareInfo extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'hardware_info';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'hardware_info';

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
                    'id'                                => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'cpu_sockets'                       => array(
                        ONAPP_FIELD_MAP         => '_cpu_sockets',
                        ONAPP_FIELD_CLASS       => 'OnApp_Settings_HardwareInfo_CpuSockets',
                    ),
                    'memory_slots'                      => array(
                        ONAPP_FIELD_MAP         => '_memory_slots',
                        ONAPP_FIELD_CLASS       => 'OnApp_Settings_HardwareInfo_MemorySlots',
                    ),
                    'nics'                              => array(
                        ONAPP_FIELD_MAP         => '_nics',
                        ONAPP_FIELD_CLASS       => 'OnApp_Settings_HardwareInfo_Nics',
                    ),
                    'disks'                             => array(
                        ONAPP_FIELD_MAP         => '_disks',
                        ONAPP_FIELD_CLASS       => 'OnApp_Settings_HardwareInfo_Disks',
                    ),
                    'bios'                              => array(
                        ONAPP_FIELD_MAP         => '_bios',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'manufacturer'                      => array(
                        ONAPP_FIELD_MAP         => '_manufacturer',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'created_at'                        => array(
                        ONAPP_FIELD_MAP         => '_created_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true
                    ),
                    'updated_at'                        => array(
                        ONAPP_FIELD_MAP         => '_updated_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true
                    ),
                    'uptime_custom_fields'              => array(
                        ONAPP_FIELD_MAP         => '_uptime_custom_fields',
                        ONAPP_FIELD_TYPE        => 'array',
                    ),
                    'target_id'                         => array(
                        ONAPP_FIELD_MAP         => '_target_id',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'target_type'                       => array(
                        ONAPP_FIELD_MAP         => '_target_type',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'bios_serial_number_custom_fields'  => array(
                        ONAPP_FIELD_MAP         => '_bios_serial_number_custom_fields',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'cpu_custom_fields'                 => array(
                        ONAPP_FIELD_MAP         => '_cpu_custom_fields',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'cpu_sockets_custom_fields'         => array(
                        ONAPP_FIELD_MAP         => '_cpu_sockets_custom_fields',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'disks_custom_fields'               => array(
                        ONAPP_FIELD_MAP         => '_disks_custom_fields',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'manufacturer_model_custom_fields'  => array(
                        ONAPP_FIELD_MAP         => '_manufacturer_model_custom_fields',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'memory_custom_fields'              => array(
                        ONAPP_FIELD_MAP         => '_memory_custom_fields',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'memory_slots_custom_fields'        => array(
                        ONAPP_FIELD_MAP         => '_memory_slots_custom_fields',
                    ),
                    'nics_custom_fields'                => array(
                        ONAPP_FIELD_MAP         => '_nics_custom_fields',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'os_custom_fields'                  => array(
                        ONAPP_FIELD_MAP         => '_os_custom_fields',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'server_type_custom_fields'         => array(
                        ONAPP_FIELD_MAP         => '_server_type_custom_fields',
                        ONAPP_FIELD_TYPE        => 'string',
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
                 * @name Settings HardwareInfo
                 * @method GET
                 * 
                 * @alias   /settings/:target/:target_id/hardware_info(.:format)
                 * @format  {:controller=>"Settings_HardwareInfo", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Settings HardwareInfo
                 * @method PUT
                 * 
                 * @alias   /settings/:target/:target_id/hardware_info(.:format)
                 * @format  {:controller=>"Settings_HardwareInfo", :action=>"edit"}
                 */
                
                if ( is_null( $this->_target_type ) ) {
                    $this->logger->error(
                        "getResource($action): argument _target_type not set.",
                        __FILE__,
                        __LINE__
                    );
                }
                
                if ( is_null( $this->_target_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _target_id not set.",
                        __FILE__,
                        __LINE__
                    );
                }
                
                $resource = 'settings/' . $this->_target_type . '/' . $this->_target_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
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
     * @param integer $cdn_resource_id CDN Resource id
     *
     * @return mixed an array of Object instances on success. Otherwise false
     * @access public
     */
    public function getList($params = null, $url_args = null) {

        if ( ! is_null( $this->_target_type ) && ! is_null( $this->_target_id ) ) {
            
            $this->setAPIResource( $this->getResource() );
            
            $response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );
            
            if ( isset( $response['response_body'] ) && !is_null( $response['response_body'] ) ) {
                $response_body = $response['response_body'];
                $data = json_decode( $response_body );
                
                if ( isset( $data ) ) {
                    $response_body = json_encode(array($data));
                    $response['response_body'] = $response_body;
                }
            }
            
            $result = $this->_castResponseToClass( $response );
            
            $this->_obj = $result;
            
            return $result;
            
        } else {
            $this->logger->error(
                'getList: argument $_id not set.',
                __FILE__,
                __LINE__
            );
        }  
    }
    
    public function save() {
        if ( ! is_null( $this->_target_type ) && ! is_null( $this->_target_id ) ) {
            $this->sendPut( ONAPP_GETRESOURCE_DEFAULT );
            
        } else {
            $this->logger->error(
                'getList: argument $_id not set.',
                __FILE__,
                __LINE__
            );
        } 
    }
    
}
