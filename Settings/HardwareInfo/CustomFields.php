<?php
/**
 * Managing Settings HardwareInfo CustomFields
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
 * Managing Settings HardwareInfo CustomFields
 *
 * The OnApp_Settings_HardwareInfo_CustomFields class uses the following basic methods:
 * {@link getList} {@link save} and {@link delete}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_Settings_HardwareInfo_CustomFields extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = '';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'hardware_info/custom_fields';

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
                    'label'         => array(
                        ONAPP_FIELD_MAP         => '_label',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'children'      => array(
                        ONAPP_FIELD_MAP         => '_children',
                        ONAPP_FIELD_CLASS       => 'OnApp_Settings_HardwareInfo_Children',
                    ),
                    'target_id'    => array(
                        ONAPP_FIELD_MAP         => '_target_id',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'target_type'   => array(
                        ONAPP_FIELD_MAP         => '_target_type',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'field'         => array(
                        ONAPP_FIELD_MAP         => '_field',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'slot_id'       => array(
                        ONAPP_FIELD_MAP         => '_slot_id',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'value'         => array(
                        ONAPP_FIELD_MAP         => '_value',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'id'            => array(
                        ONAPP_FIELD_MAP         => '_id',
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
                 * @name Settings HardwareInfo CustomFields
                 * @method GET
                 * 
                 * @alias   /settings/:target/:target_id/hardware_info/custom_fields(.:format)
                 * @format  {:controller=>"Settings_HardwareInfo_CustomFields", :action=>"index"}
                 */
                
                /**
                 * ROUTE :
                 *
                 * @name Settings HardwareInfo CustomFields
                 * @method POST
                 * 
                 * @alias   /settings/:target/:target_id/hardware_info/custom_fields/:field/slot/:slot_id(.:format)
                 * @format  {:controller=>"Settings_HardwareInfo_CustomFields", :action=>"add with slot"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Settings HardwareInfo CustomFields
                 * @method POST
                 * 
                 * @alias   /settings/:target/:target_id/hardware_info/custom_fields/:field(.:format)
                 * @format  {:controller=>"Settings_HardwareInfo_CustomFields", :action=>"add without slot"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Settings HardwareInfo CustomFields
                 * @method PUT
                 * 
                 * @alias   /settings/:target/:target_id/hardware_info/custom_fields/:field/slot/:slot_id/:id(.:format)
                 * @format  {:controller=>"Settings_HardwareInfo_CustomFields", :action=>"edit with slot"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Settings HardwareInfo CustomFields
                 * @method PUT
                 * 
                 * @alias   /settings/:target/:target_id/hardware_info/custom_fields/:field/:id(.:format)
                 * @format  {:controller=>"Settings_HardwareInfo_CustomFields", :action=>"edit without slot"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Settings HardwareInfo CustomFields
                 * @method DELETE
                 * 
                 * @alias   /settings/:target/:target_id/hardware_info/custom_fields/:field/slot/:slot_id/:id(.:format)
                 * @format  {:controller=>"Settings_HardwareInfo_CustomFields", :action=>"delete with slot"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Settings HardwareInfo CustomFields
                 * @method DELETE
                 * 
                 * @alias   /settings/:target/:target_id/hardware_info/custom_fields/:field/:id(.:format)
                 * @format  {:controller=>"Settings_HardwareInfo_CustomFields", :action=>"delete without slot"}
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
                
                if ( !is_null( $this->_field ) ) {
                    $query_sufix = '/' . $this->_field;
                    $query_sufix .= !is_null( $this->_slot_id ) ? '/slot/' . $this->_slot_id : null;
                    $query_sufix .= !is_null( $this->_id ) ? '/' . $this->_id : null;
                } else {
                    $query_sufix = null;
                }
                
                
                $resource = 'settings/' . $this->_target_type . '/' . $this->_target_id . '/' . $this->_resource . $query_sufix;
                
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
            default:
                $resource = parent::getResource( $action );
                break;
        }
        
        return $resource;
    }
    
    public function save() {
        
        if ( !isset( $this->_label ) && empty( $this->_label ) ) {
            $this->logger->error(
                "save(): argument _label not set.",
                __FILE__,
                __LINE__
            );
        }
        if ( !isset( $this->_value ) && empty( $this->_value ) ) {
            $this->logger->error(
                "save(): argument _value not set.",
                __FILE__,
                __LINE__
            );
        }
        
        $data = array(
            'root'        => 'custom_fields',
            'data'        => array(
                'label'     => $this->_label,
                'value'     => $this->_value,
            ),
        );
        
        if ( is_null( $this->_id ) ) {
            $this->sendPost( ONAPP_GETRESOURCE_DEFAULT, $data );
        } else {
            $this->sendPut( ONAPP_GETRESOURCE_DEFAULT, $data );
        }
        
    }
    
    public function delete() {
        if ( !is_null( $this->_id ) ) {
            $this->sendDelete( ONAPP_GETRESOURCE_DEFAULT );
        }
    }
    
}
