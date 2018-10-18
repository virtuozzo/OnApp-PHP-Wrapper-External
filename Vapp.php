<?php
/**
 * Managing Vapps
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 *
 */
define( 'ONAPP_GETRESOURCE_VAPPS_COMPOSE', 'compose' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_VAPPS_ADD', 'add' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_VAPPS_DELETE', 'delete' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_VAPPS_RECOMPOSING', 'recomposing' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_VAPPS_EDITNAME', 'editname' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_VAPPS_START', 'start' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_VAPPS_STOP', 'stop' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_VAPPS_CHANGE_OWNER', 'change_owner' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_VAPPS_SUSPEND', 'suspend' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_VAPPS_UNSUSPEND', 'unsuspend' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_VAPPS_REBOOT', 'reboot' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_VAPPS_SHUTDOWN', 'shutdown' );

/**
 * Vapps
 *
 */
class OnApp_Vapp extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'vapp';

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'vapps';

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
            case 4.0:
            case 4.1:
                $this->fields = array(
                    'id'                     => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'created_at'             => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'identifier'             => array(
                        ONAPP_FIELD_MAP       => '_identifier',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'name'                   => array(
                        ONAPP_FIELD_MAP      => '_name',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'status'                 => array(
                        ONAPP_FIELD_MAP => '_status',
                    ),
                    'updated_at'             => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'user_id'                => array(
                        ONAPP_FIELD_MAP       => '_user_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    //todo check value type of vapp_template_id
                    'vapp_template_id'       => array(
                        ONAPP_FIELD_MAP       => '_vapp_template_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'vdc_id'                 => array(
                        ONAPP_FIELD_MAP       => '_vdc_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'virtual_machine_params' => array(
                        ONAPP_FIELD_MAP       => '_virtual_machine_params',
                        ONAPP_FIELD_TYPE      => 'array',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_CLASS     => 'Vapp_VirtualMachineParams',
                    ),
                );
                break;
            case 4.2:
            case 4.3:
                $this->fields                             = $this->initFields( 4.1 );
                $this->fields['storage_lease_expiration'] = array(
                    ONAPP_FIELD_MAP  => '_storage_lease_expiration',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
            case 5.0:
                $this->fields = $this->initFields( 4.3 );
                break;
            case 5.1:
                $this->fields = $this->initFields( 5.0 );
                break;
            case 5.2:
                $this->fields = $this->initFields( 5.1 );
                break;
            case 5.3:
                $this->fields = $this->initFields( 5.2 );
                break;
            case 5.4:
                $this->fields = $this->initFields( 5.3 );
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                $this->fields['deployed']       = array(
                    ONAPP_FIELD_MAP  => '_deployed',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['description']    = array(
                    ONAPP_FIELD_MAP  => '_description',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_VAPPS_ADD:
                /**
                 * ROUTE :
                 *
                 * @name compose
                 * @method POST
                 * @alias    /vapps/compose
                 * @format   {:controller=>"vapps", :action=>"compose"}
                 */
                $resource = $this->_resource;
                break;

            case ONAPP_GETRESOURCE_VAPPS_COMPOSE:
                /**
                 * ROUTE :
                 *
                 * @name compose
                 * @method POST
                 * @alias    /vapps/compose
                 * @format   {:controller=>"vapps", :action=>"compose"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . 'compose';
                break;

            case ONAPP_GETRESOURCE_VAPPS_RECOMPOSING:
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/recompose';
                break;

            case ONAPP_GETRESOURCE_VAPPS_CHANGE_OWNER:
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/owner';
                break;

            case ONAPP_GETRESOURCE_VAPPS_DELETE:
                /**
                 * ROUTE :
                 *
                 * @name recompose_vapp
                 * @method PUT
                 * @alias    /vapps/:id/reboot(.:format)
                 * @format   {:controller=>"vapps", :action=>"recompose"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD );
                break;
            case ONAPP_GETRESOURCE_VAPPS_EDITNAME:
                /**
                 * ROUTE :
                 *
                 * @name editname_vapp
                 * @method PUT
                 * @alias    /vapps/:id/edit(.:format)
                 * @format   {:controller=>"vapps", :action=>"editname"}
                 */
                //$resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/edit';
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD );
                break;
            case ONAPP_GETRESOURCE_VAPPS_START:
                /**
                 * ROUTE :
                 *
                 * @name start_vapp
                 * @method POST
                 * @alias    /vapps/:id/start(.:format)
                 * @format   {:controller=>"vapps", :action=>"start"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/start';
                break;
            case ONAPP_GETRESOURCE_VAPPS_STOP:
                /**
                 * ROUTE :
                 *
                 * @name stop_vapp
                 * @method POST
                 * @alias    /vapps/:id/stop(.:format)
                 * @format   {:controller=>"vapps", :action=>"stop"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/stop';
                break;

            default:
                /**
                 * ROUTE :
                 *
                 * @name vapps
                 * @method GET
                 * @alias   /vapps(.:format)
                 * @format  {:controller=>"vapps", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name vapp
                 * @method GET
                 * @alias    /vapps/:id(.:format)
                 * @format   {:controller=>"vapps", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name delete_vapp
                 * @method DELETE
                 * @alias    /vapps/:id(.:format)
                 * @format   {:controller=>"vapps", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    function compose( $data, $virtualMachines ) {
        /*
                "virtual_machines" => array(
                    "virtual_machine_0" => array(
                        "id"                                    => "vm-a111111-8885-4276-ac1c-479c724b9d6e",
                        "name"                                  => "Example",
                        "cpus"                                  => 1,
                        "cores_per_socket"                      => 1,
                        "memory"                                => 1024,
                        "storage_policy"                        => 2,
                        "hard_disks"                            => array(
                            "hard_disk_1" => array(
                                "disk_space" => 3,
                            ),
                        ),
                        "vcloud_guest_customization"            => array(
                            "enabled"                => "1",
                            "admin_password_enabled" => "1",
                            "admin_password_auto"    => "0",
                            "admin_password"         => "password",
                            "computer_name"          => "example",
                        ),
                        "recipe_ids"                            => [ 4, 5 ],
                        "custom_recipe_variables"               => array(
                            "variable_0" => array(
                                "name"    => "xxx",
                                "value"   => "xy",
                                "enabled" => "true",
                            )
                        ),
                        "boot_vm"                               => "1",
                        "disable_guest_customization_after_run" => "0",
                    )
                )
        */
        $data = array(
            'root' => 'tmp_holder',
            'data' => [
                'vapp'             => $data,
                "virtual_machines" => $virtualMachines,
            ]
        );
        $this->sendPost( ONAPP_GETRESOURCE_VAPPS_COMPOSE, $data );
    }

    function add( $data ) {
        $data = array(
            'root' => 'tmp_holder',
            'data' => [
                'vapp' => $data
            ]
        );
        $this->sendPost( ONAPP_GETRESOURCE_VAPPS_ADD, $data );
    }

    /**
     * recompose vApp
     *
     * @param $name
     *
     * @access    public
     */
    function recompose( $id ) {
        $data = array(
            'root' => 'tmp_holder',
            'data' => array(
                'vapp' => array(
                    'vapp_template_id' => $id,
                    ''
                )
            )
        );
        $this->sendPut( ONAPP_GETRESOURCE_VAPPS_RECOMPOSING, $data );
    }

    /**
     * recompose vApp
     *
     * @param $name
     *
     * @access    public
     */
    function editName( $name ) {
        $data = array(
            'root' => 'tmp_holder',
            'data' => array(
                'vapp' => array(
                    'name' => $name
                )
            )
        );
        $this->sendPut( ONAPP_GETRESOURCE_VAPPS_EDITNAME, $data );
    }

    /**
     * start vApp
     *
     * @access    public
     */
    function start() {
        $this->sendPost( ONAPP_GETRESOURCE_VAPPS_START );
    }

    /**
     * stop vApp
     *
     * @access    public
     */
    function stop() {
        $this->sendPost( ONAPP_GETRESOURCE_VAPPS_STOP );
    }

    function delete() {
        $this->sendDelete( ONAPP_GETRESOURCE_VAPPS_DELETE );
    }

    /**
     * create vApp
     *
     * @param string $vmp_identifier
     * @param string $vmp_name
     * @param string $vmp_vcpu_per_vm
     * @param string $vmp_core_per_socket
     * @param string $vmp_memory
     * @param string $vmp_hard_disks_identifier
     * @param string $vmp_hard_disks_storage_policy
     * @param string $vmp_hard_disks_disk_space
     *
     * @access    public
     */
    function create( $vmp_identifier, $vmp_name, $vmp_vcpu_per_vm, $vmp_core_per_socket, $vmp_memory, $vmp_hard_disks_identifier, $vmp_hard_disks_storage_policy, $vmp_hard_disks_disk_space ) {
        $virtual_machine_params                  = array(
            'name'                     => $vmp_name,
            'vcpu_per_vm'              => $vmp_vcpu_per_vm,
            'core_per_socket'          => $vmp_core_per_socket,
            'memory'                   => $vmp_memory,
            $vmp_hard_disks_identifier => array(
                'storage_policy' => $vmp_hard_disks_storage_policy,
                'disk_space'     => $vmp_hard_disks_disk_space,
            ),
        );
        $data                                    = array(
            'root' => 'tmp_holder',
            'data' => array(
                'vapp' => array(
                    'name'             => $this->_name,
                    'vapp_template_id' => $this->_vapp_template_id,
                    'vdc_id'           => $this->_vdc_id,
                    'network'          => $this->_network,
                )
            )
        );
        $data['data']['vapp'][ $vmp_identifier ] = $virtual_machine_params;

        $this->sendPost( ONAPP_GETRESOURCE_DEFAULT, $data );
    }

    /**
     * Change vApp Owner
     *
     * @param $new_owner_id
     *
     * @access    public
     */
    function changeOwner( $new_owner_id ) {
        $data = array(
            'root' => 'tmp_holder',
            'data' => array(
                'owner_change' => array(
                    'new_owner_id' => $new_owner_id
                )
            )
        );
        $this->sendPut( ONAPP_GETRESOURCE_VAPPS_CHANGE_OWNER, $data );
    }

    /**
     * Suspend vApp
     *
     * @access    public
     */
    function suspend() {
        $this->sendPost( ONAPP_GETRESOURCE_VAPPS_SUSPEND );
    }

    /**
     * Unsuspend vApp
     *
     * @access    public
     */
    function unsuspend() {
        $this->sendPost( ONAPP_GETRESOURCE_VAPPS_UNSUSPEND );
    }

    /**
     * Reboot vApp
     *
     * @access    public
     */
    function reboot() {
        $this->sendPost( ONAPP_GETRESOURCE_VAPPS_REBOOT );
    }

    /**
     * Shutdown vApp
     *
     * @access    public
     */
    function shutdown() {
        $this->sendPost( ONAPP_GETRESOURCE_VAPPS_SHUTDOWN );
    }

}