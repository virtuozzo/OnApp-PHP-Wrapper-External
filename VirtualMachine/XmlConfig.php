<?php
/**
 * Managing VirtualMachine XmlConfig
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
 * Managing VirtualMachine XmlConfig
 * 
 * {@link getList}, {@link edit}, {@link delete}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */
class OnApp_VirtualMachine_XmlConfig extends OnApp {
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
    var $_resource = 'xml_config';

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
                    'virtual_machine_id'    => array(
                        ONAPP_FIELD_MAP         => '_virtual_machine_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'xml_config'            => array(
                        ONAPP_FIELD_MAP         => '_xml_config',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'xml_config_edited'     => array(
                        ONAPP_FIELD_MAP         => '_xml_config_edited',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'reboot'                => array(
                        ONAPP_FIELD_MAP         => '_reboot',
                        ONAPP_FIELD_TYPE        => 'boolean',
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
                 * @name VirtualMachine XmlConfig
                 * @method GET
                 * @alias   /virtual_machines/:virtual_machine_id/xml_config(.:format)
                 * @format  {:controller=>"VirtualMachine_XmlConfig", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name VirtualMachine XmlConfig
                 * @method PUT
                 * @alias   /virtual_machines/:virtual_machine_id/xml_config(.:format)
                 * @format  {:controller=>"VirtualMachine_XmlConfig", :action=>"edit"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name VirtualMachine XmlConfig
                 * @method DELETE
                 * @alias   /virtual_machines/:virtual_machine_id/xml_config(.:format)
                 * @format  {:controller=>"VirtualMachine_XmlConfig", :action=>"delete"}
                 */
                
                if ( is_null( $this->_virtual_machine_id ) ) {
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
    
    public function save() {
        $data = array(
            'root'        => $this->_tagRoot,
            'data'        => array(
                'xml_config'    => $this->_xml_config,
                'reboot'        => $this->_reboot,
            ),
        );
        $this->sendPut( ONAPP_GETRESOURCE_DEFAULT, $data );
    }
    
    public function delete() {
        $this->sendDelete( ONAPP_GETRESOURCE_DEFAULT );
    }
   
}
