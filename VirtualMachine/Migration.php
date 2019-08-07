<?php
/**
 * Managing VirtualMachine Migration
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
 * Managing VirtualMachine Migration
 * 
 * {@link add}
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */
class OnApp_VirtualMachine_Migration extends OnApp {
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
    var $_resource = 'migration';

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
                    'virtual_machine_id'    => array(
                        ONAPP_FIELD_MAP         => '_virtual_machine_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'migration_type'            => array(
                        ONAPP_FIELD_MAP         => '_migration_type',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'cold_migrate_on_rollback'            => array(
                        ONAPP_FIELD_MAP         => '_cold_migrate_on_rollback',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'destination'     => array(
                        ONAPP_FIELD_MAP         => '_destination',
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
                 * @name VirtualMachine Migration
                 * @method POST
                 *
                 * @alias   /virtual_machines/:virtual_machine_id/migrate(.:format)
                 * @format  {:controller=>"OnApp_VirtualMachine_Migration", :action=>"add"}
                 */
                
                if ( is_null( $this->_virtual_machine_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _virtual_machine_id not set.",
                        __FILE__,
                        __LINE__
                    );
                }

                $resource = 'virtual_machines/' . $this->_virtual_machine_id . '/' . $this->_resource;
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
    function activateCheck( $action_name ) {
        switch ( $action_name ) {
            case ONAPP_ACTIVATE_GETLIST:
            case ONAPP_ACTIVATE_LOAD:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}
