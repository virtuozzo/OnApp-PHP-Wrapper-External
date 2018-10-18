<?php
/**
 * Managing Hypervisor CpuQuota
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
 * Managing Hypervisor CpuQuota
 *
 * The OnApp_Hypervisor_CpuQuota class uses the following basic methods:
 * {@link getList}, {@link edit}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_Hypervisor_CpuQuota extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'cpu_quota';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'cpu_quota';

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
                    'enabled'      => array(
                        ONAPP_FIELD_MAP     => '_enabled',
                        ONAPP_FIELD_TYPE    => 'boolean',
                    ),
                    'value'         => array(
                        ONAPP_FIELD_MAP     => '_value',
                        ONAPP_FIELD_TYPE    => 'integer',
                    ),
                    'hv_id'         => array(
                        ONAPP_FIELD_MAP     => '_hv_id',
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
                 * @name Hypervisor CpuQuota
                 * @method GET
                 * 
                 * @alias   /settings/hypervisors/:hv_id/cpu_quota(.:format)
                 * @format  {:controller=>"Hypervisor CpuQuota", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Hypervisor CpuQuota
                 * @method PUT
                 *
                 * @alias   /settings/hypervisors/:hv_id/cpu_quota(.:format)
                 * @format  {:controller=>"Hypervisor CpuQuota", :action=>"edit"}
                 */
                if ( !isset( $this->_hv_id ) && empty( $this->_hv_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _hv_id not set.",
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = 'settings/hypervisors/' . $this->_hv_id . '/' . $this->_resource;
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
        
        if ( !isset( $this->_enabled ) && empty( $this->_enabled ) ) {
            $this->logger->error(
                "save(): argument _enabled not set.",
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
            'root'        => $this->_tagRoot,
            'data'        => array(
                'enabled'   => $this->_enabled,
                'value'     => $this->_value,
            ),
        );
        
        $this->sendPut( ONAPP_GETRESOURCE_DEFAULT, $data );
            
    }
}
