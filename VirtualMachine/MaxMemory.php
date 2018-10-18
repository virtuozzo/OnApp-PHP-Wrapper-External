<?php
/**
 * Managing VirtualMachine MaxMemory
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
 * Managing VirtualMachine MaxMemory
 *
 * The OnApp_VirtualMachine_MaxMemory class uses the following basic methods:
 * {@link getList}, {@link edit}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_VirtualMachine_MaxMemory extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'virtual_machine';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'max_memory';

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
                    'max_memory_override'   => array(
                        ONAPP_FIELD_MAP     => '_max_memory_override',
                        ONAPP_FIELD_TYPE    => 'boolean',
                    ),
                    'preset_max_memory'     => array(
                        ONAPP_FIELD_MAP     => '_preset_max_memory',
                        ONAPP_FIELD_TYPE    => 'integer',
                    ),
                    'virtual_machine_id'    => array(
                        ONAPP_FIELD_MAP     => '_virtual_machine_id',
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
                 * @name VirtualMachine MaxMemory
                 * @method GET
                 *
                 * @alias   /virtual_machines/:virtual_machine_id/max_memory(.:format)
                 * @format  {:controller=>"VirtualServers BackupsResources", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name VirtualMachine MaxMemory
                 * @method PUT
                 *
                 * @alias   /virtual_machines/:virtual_machine_id/max_memory(.:format)
                 * @format  {:controller=>"VirtualServers BackupsResources", :action=>"index"}
                 */
                if ( !isset( $this->_virtual_machine_id ) && empty( $this->_virtual_machine_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _virtual_machine_id not set.",
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = 'virtual_machines/' . $this->_virtual_machine_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
                
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }
    
    /**
     * The method saves an Object
     *
     * @return void
     */
    public function save() {
        
        if ( !isset( $this->_max_memory_override ) && empty( $this->_max_memory_override ) ) {
            $this->logger->error(
                "save(): argument _max_memory_override not set.",
                __FILE__,
                __LINE__
            );
        }
        if ( !isset( $this->_preset_max_memory ) && empty( $this->_preset_max_memory ) ) {
            $this->logger->error(
                "save(): argument _preset_max_memory not set.",
                __FILE__,
                __LINE__
            );
        }
        
        $data = array(
            'root'        => $this->_tagRoot,
            'data'        => array(
                'max_memory_override'   => $this->_max_memory_override,
                'preset_max_memory'     => $this->_preset_max_memory,
            ),
        );
        
        $this->sendPut( ONAPP_GETRESOURCE_DEFAULT, $data );
            
    }
}
