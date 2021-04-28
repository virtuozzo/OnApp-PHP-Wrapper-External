<?php
/**
 * Managing Hypervisor VirtualMachinesList
 *
 * much they will be charged per unit.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Mykola Vuy
 * @copyright   © 2021 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
/**
 * Managing Hypervisor VirtualMachinesList
 *
 * The OnApp_Hypervisor_VirtualMachinesList class uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_Hypervisor_VirtualMachinesList extends OnApp_VirtualMachine {
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
    var $_resource = 'hypervisors';

    /**
     * API Fields description
     *
     * @param string|float $version OnApp API version
     * @param string $className current class' name
     *
     * @return array
     */
    public function initFields( $version = null, $className = '' ) {
        parent::initFields( $version, __CLASS__ );

        $this->fields['hypervisor_id'] = array(
            ONAPP_FIELD_MAP           => '_hypervisor_id',
            ONAPP_FIELD_TYPE          => 'integer',
        );

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
                 * @method GET
                 *
                 * @alias   /hypervisors/:hypervisor_id/virtual_machines(.:format)
                 * @format  {:controller=>"Hypervisor", :action=>"getList"}
                 */

                if ( is_null( $this->_hypervisor_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _hypervisor_id not set.",
                        __FILE__,
                        __LINE__
                    );
                }

                $resource = 'hypervisors/' . $this->_hypervisor_id . '/virtual_machines';
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
            case ONAPP_ACTIVATE_LOAD:
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}
