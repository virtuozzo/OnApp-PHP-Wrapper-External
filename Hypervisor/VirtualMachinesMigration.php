<?php
/**
 * Managing Hypervisor VirtualMachinesMigration
 * 
 * much they will be charged per unit.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Mykola Vuy
 * @copyright   © 2019 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
/**
 * Managing Hypervisor VirtualMachinesMigration
 *
 * The OnApp_Hypervisor_VirtualMachinesMigration class uses the following basic methods:
 * {@link save}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_Hypervisor_VirtualMachinesMigration extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'virtual_machines';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'virtual_machines/migration';

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
            case 6.1:
                $this->fields = array(
                    'virtual_machines_identifiers' => array(
                        ONAPP_FIELD_MAP  => '_virtual_machines_identifiers',
                        ONAPP_FIELD_TYPE => '_array',
                    ),
                    'destination_hypervisor_id' => array(
                        ONAPP_FIELD_MAP  => '_destination_hypervisor_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'cold_migrate_on_rollback' => array(
                        ONAPP_FIELD_MAP  => '_cold_migrate_on_rollback',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                );
                break;

            case 6.2:
                $this->fields = $this->initFields( 6.1 );
                break;

            case 6.3:
                $this->fields = $this->initFields( 6.2 );
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
                 * @name Hypervisor VirtualMachinesMigration
                 * @method POST
                 * 
                 * @alias   /hypervisors/:hypervisor_id/virtual_machines/migration(.:format)
                 *
                 * @format  {:controller=>"Hypervisor VirtualMachinesMigration", :action=>"save"}
                 */
                if ( !isset( $this->_hypervisor_id ) && empty( $this->_hypervisor_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _hypervisor_id not set.",
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = 'hypervisors/' . $this->_hypervisor_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
                
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    /**
     * Activates action performed with object
     *
     * @param string $action_name the name of action
     *
     * @access public
     */
    public function activateCheck( $action_name ) {
        switch ( $action_name ) {
            case ONAPP_ACTIVATE_GETLIST:
            case ONAPP_ACTIVATE_LOAD:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}
