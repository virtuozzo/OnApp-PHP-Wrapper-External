<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Recipes
 *
 * OnApp provides complete management for your virtual machines. You can start,
 * stop, reboot, and delete virtual machines. You can also move VM's between the
 * hypervisors with no downtime. Automatic and manual backups will help you
 * restore the VM’s in case of failure.
 * With OnApp you have an integrated console and complete root access to your
 * virtual machines that provides full control over all files and processes
 * running on the machines.
 *
 * With OnApp you can monitor the CPU usage for each virtual machine and Network
 * Utilization for each network interface. This lets you know when to consider
 * increasing resources available to the system. Also the cloud engine provides
 * the detailed log records of all the tasks which are currently running,
 * pending, failed or completed.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 *
 */
define( 'ONAPP_GETRESOURCE_RUN_ON_VMS', 'run_on_vms' );

/**
 * Recipes
 *
 * The OnApp_VirtualMachine class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Recipe extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'recipe';

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'recipes';

    /**
     * API Fields description
     *
     * @param string|float $version   OnApp API version
     * @param string       $className current class' name
     *
     * @return array
     */
    public function initFields( $version = null, $className = '' ) {
        switch( $version ) {
            case 3.5:
                $this->fields                          = array();
                $this->fields[ 'label' ]      = array(
                    ONAPP_FIELD_MAP             => 'label',
                    ONAPP_FIELD_TYPE            => 'string',
                    ONAPP_FIELD_REQUIRED        => true
                );
                $this->fields[ 'description' ]      = array(
                    ONAPP_FIELD_MAP             => 'description',
                    ONAPP_FIELD_TYPE            => 'string',
                );
                $this->fields[ 'compatible_with' ]       = array(
                    ONAPP_FIELD_MAP             => 'compatible_with',
                    ONAPP_FIELD_TYPE            => 'string',
                    ONAPP_FIELD_REQUIRED        => true,
                );
                $this->fields[ 'script_type' ] = array(
                    ONAPP_FIELD_MAP             => 'script_type',
                    ONAPP_FIELD_TYPE            => 'string',
                );
                break;
        }


        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch( $action ) {
            case ONAPP_GETRESOURCE_RUN_ON_VMS:
                /**
                 * ROUTE :
                 *
                 * @name reboot_virtual_machine
                 * @method POST
                 * @alias    /recipes/:id/run(.:format)
                 * @format   {:controller=>"recipes", :action=>"run_on_vms"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/run';
                break;

            default:
                /**
                 * ROUTE :
                 *
                 * @name recipes
                 * @method GET
                 * @alias   /recipes(.:format)
                 * @format  {:controller=>"recipes", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name recipe
                 * @method GET
                 * @alias    /recipes/:id(.:format)
                 * @format   {:controller=>"recipes", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias    /recipes(.:format)
                 * @format   {:controller=>"recipes", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method PUT
                 * @alias  /recipes/:id(.:format)
                 * @format {:controller=>"recipes", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method DELETE
                 * @alias   /recipes/:id(.:format)
                 * @format  {:controller=>"recipes", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
                break;
        }

        $actions = array(
            ONAPP_GETRESOURCE_RUN_ON_VMS,
        );

        if( in_array( $action, $actions ) ) {
            $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
        }

        return $resource;
    }

    /**
     * Run recipe on set of vms
     * @see https://docs.onapp.com/display/35API/Run+Recipe+on+Multiple+Virtual+Servers
     * @param array $vms
     * @param null  $id
     * @return bool|mixed
     */
    function run_on_vms( $vms = array(), $id = null ) {

        if($id)
        {
            $this->_id = $id;
        }

        $data = array(
            'root' => 'virtual_machines',
            'data' => $vms
        );

        return $this->sendPost( ONAPP_GETRESOURCE_RUN_ON_VMS, $data );
    }
}