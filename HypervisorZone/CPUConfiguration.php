<?php
/**
 * Managing HypervisorZone CPUConfiguration
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
 * Managing HypervisorZone CPUConfiguration
 *
 * The OnApp_HypervisorZone_CPUConfiguration class uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_HypervisorZone_CPUConfiguration extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'cpu_configuration';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'cpu_configuration';

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
                    'hypervisor_zone_id'         => array(
                        ONAPP_FIELD_MAP         => '_hypervisor_zone_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'baseline_cpu_flags'        => array (
                        ONAPP_FIELD_MAP         => '_baseline_cpu_flags',
                        ONAPP_FIELD_TYPE        => 'array',
                    ),
                    'cpu_flags'        => array (
                        ONAPP_FIELD_MAP         => '_cpu_flags',
                        ONAPP_FIELD_TYPE        => 'array',
                    ),
                    'cpu_model'        => array (
                        ONAPP_FIELD_MAP         => '_cpu_model',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'default_cpu_flags'        => array (
                        ONAPP_FIELD_MAP         => '_default_cpu_flags',
                        ONAPP_FIELD_TYPE        => 'array',
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
                 * @name HypervisorZone CPUConfiguration
                 * @method GET
                 * 
                 * @alias   /settings/hypervisor_zones/:hypervisor_zone_id/cpu_configuration(.:format)
                 * @format  {:controller=>"HypervisorZone_CPUConfiguration", :action=>"index"}
                 */
                if ( is_null( $this->_hypervisor_zone_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _hypervisor_zone_id not set.",
                        __FILE__,
                        __LINE__
                    );
                }
                
                $resource = 'settings/hypervisor_zones/' . $this->_hypervisor_zone_id . '/' .  $this->_resource;
                
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
            default:
                $resource = parent::getResource( $action );
                break;
        }
        
        return $resource;
    }
    
}
