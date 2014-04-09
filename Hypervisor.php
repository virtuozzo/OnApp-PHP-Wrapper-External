<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Hypervisors
 *
 * In computing, a hypervisor, also called virtual machine monitor (VMM), allows
 * multiple operating systems to run concurrently on a host computer - a feature
 * called hardware virtualization. The hypervisor presents the guest operating
 * systems with a virtual platform  and monitors the execution of the guest
 * operating systems. In that way, multiple operating systems, including
 * multiple instances of the same operating system, can share hardware
 * resources.
 * In OnApp the Hypervisor servers:
 *    - Provide the system resources, such as CPU, memory, and network
 *    - Control the virtual differentiation of entities, such as machines and corresponding application data being delivered to cloud-hosted applications
 *    - Take care of secure virtualization and channeling of storage, data communications and machine processing
 *    - Can be located at different geographical zones
 *    - Can have different CPU and RAM
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
 *
 */
define( 'ONAPP_GETRESOURCE_HYPERVISORS_BY_HYPERVISOR_GROUP_ID', 'hypervisors' );
/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_HYPERVISOR_REBOOT', 'hypervisor_reboot' );

/**
 * Hypervisors
 *
 * This class represents the Hypervisors of your OnApp installation. The OnApp class is the parent of the Hypervisors class.
 *
 * The OnApp_Hypervisor class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Hypervisor extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'hypervisor';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/hypervisors';

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
            case '2.0':
                $this->fields = array(
                    'id'              => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'called_in_at'    => array(
                        ONAPP_FIELD_MAP       => '_called_in_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'created_at'      => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'failure_count'   => array(
                        ONAPP_FIELD_MAP       => '_failure_count',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'health'          => array(
                        ONAPP_FIELD_MAP       => '_health',
                        ONAPP_FIELD_TYPE      => 'yaml',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'ip_address'      => array(
                        ONAPP_FIELD_MAP       => '_ip_address',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_REQUIRED  => true,
                    ),
                    'label'           => array(
                        ONAPP_FIELD_MAP           => '_label',
                        ONAPP_FIELD_READ_ONLY     => true,
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                    'locked'          => array(
                        ONAPP_FIELD_MAP       => '_locked',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'memory_overhead' => array(
                        ONAPP_FIELD_MAP       => '_memory_overhead',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'online'          => array(
                        ONAPP_FIELD_MAP       => '_online',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'spare'           => array(
                        ONAPP_FIELD_MAP       => '_spare',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'updated_at'      => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'xen_info'        => array(
                        ONAPP_FIELD_MAP       => '_xen_info',
                        ONAPP_FIELD_TYPE      => 'yaml',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                break;

            case '2.1':
                $this->fields = $this->initFields( '2.0' );

                $this->fields[ 'enabled' ] = array(
                    ONAPP_FIELD_MAP       => '_enabled',
                    ONAPP_FIELD_TYPE      => 'boolean',
                    ONAPP_FIELD_READ_ONLY => true,
                );

                $this->fields[ 'hypervisor_group_id' ] = array(
                    ONAPP_FIELD_MAP      => '_hypervisor_group_id',
                    ONAPP_FIELD_TYPE     => 'integer',
                    ONAPP_FIELD_REQUIRED => true,
                );

                $this->fields[ 'hypervisor_type' ] = array(
                    ONAPP_FIELD_MAP      => '_hypervisor_type',
                    ONAPP_FIELD_TYPE     => 'string',
                    ONAPP_FIELD_REQUIRED => true,
                );
                break;

            case 2.2:
                $this->fields = $this->initFields( 2.1 );
                break;

            case 2.3:
                $this->fields = $this->initFields( 2.2 );
                $fields = array(
                    'raw_stats',
                );
                $this->unsetFields( $fields );
                $this->fields[ 'cpu_cores' ] = array(
                    ONAPP_FIELD_MAP       => 'cpu_cores',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'free_memory' ] = array(
                    ONAPP_FIELD_MAP       => 'free_memory',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'total_cpus' ] = array(
                    ONAPP_FIELD_MAP       => 'total_cpus',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'total_memory' ] = array(
                    ONAPP_FIELD_MAP       => 'total_memory',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'used_cpu_resources' ] = array(
                    ONAPP_FIELD_MAP       => 'used_cpu_resources',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'memory_allocated_by_running_vms' ] = array(
                    ONAPP_FIELD_MAP  => '_memory_allocated_by_running_vms',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields[ 'total_memory_allocated_by_vms' ] = array(
                    ONAPP_FIELD_MAP  => '_total_memory_allocated_by_vms',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields[ 'disable_failover' ] = array(
                    ONAPP_FIELD_MAP  => '_disable_failover',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields[ 'redis_password' ] = array(
                    ONAPP_FIELD_MAP  => '_redis_password',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields[ 'free_disk_space' ] = array(
                    ONAPP_FIELD_MAP  => '_free_disk_space',
                    ONAPP_FIELD_TYPE => '_array',

                );

                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
                $this->fields = $this->initFields( 2.3 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch( $action ) {
            case ONAPP_GETRESOURCE_HYPERVISORS_BY_HYPERVISOR_GROUP_ID:
                /**
                 * ROUTE :
                 *
                 * @name hypervisor_group_hypervisors
                 * @method GET
                 * @alias  /settings/hypervisor_zones/:hypervisor_group_id/hypervisors(.:format)
                 * @format {:controller=>"hypervisors", :action=>"index"}
                 */
                $resource = 'settings/hypervisor_zones/' . $this->_hypervisor_group_id . '/hypervisors';
                break;

            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name hypervisors
                 * @method GET
                 * @alias  /settings/hypervisors(.:format)
                 * @format {:controller=>"settings_hypervisors", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name hypervisor
                 * @method GET
                 * @alias   /settings/hypervisors/:id(.:format)
                 * @format  {:controller=>"settings_hypervisors", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias   /settings/hypervisors(.:format)
                 * @format  {:controller=>"settings_hypervisors", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method PUT
                 * @alias  /settings/hypervisors/:id(.:format)
                 * @format {:controller=>"settings_hypervisors", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method DELETE
                 * @alias   /settings/hypervisors/:id(.:format)
                 * @format  {:controller=>"settings_hypervisors", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
                break;
            case ONAPP_GETRESOURCE_HYPERVISOR_REBOOT:
                /**
                 * ROUTE :
                 *
                 * @name reboot_hypervisor
                 * @method POST
                 * @alias   /settings/hypervisors/:id/reboot(.:format)
                 * @format  {:action=>"reboot", :controller=>"settings_hypervisors"}
                 */
                $resource = $this->_resource . '/' . $this->_id . '/reboot';
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    /**
     * Gets Hypervisors List by hypervisor group id
     *
     * @param integer|null $group_id hypervisor group id
     *
     * @return bool|mixed
     */
    function GetListByGroupId( $group_id = null ) {
        if( $group_id ) {
            $this->_hypervisor_group_id = $group_id;
        }
        else {
            $this->logger->error(
                'GetListByGroupId: argument _group_id not set.',
                __FILE__,
                __LINE__
            );
        }

        $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_HYPERVISORS_BY_HYPERVISOR_GROUP_ID ) );

        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

        if( ! empty( $response[ 'errors' ] ) ) {
            $this->errors = $response[ 'errors' ];

            return false;
        }

        $result = $this->castStringToClass( $response );
        $this->_obj = $result;

        return ( is_array( $result ) || ! $result ) ? $result : array( $result );
    }

    /**
     * Reboots hypervisor
     *
     * @param integer $hypervisor_id hypervisor id
     *
     * @return void
     *
     */
    function reboot( $hypervisor_id ) {
        if( $hypervisor_id ) {
            $this->_id = $hypervisor_id;
        }
        else {
            $this->logger->error(
                'reboot: argument _hypervisor_id not set.',
                __FILE__,
                __LINE__
            );
        }

        $data = array(
            'root' => 'tmp_holder',
            'data' => array(
                'confirm' => '1',
            ),
        );

        $this->sendPost( ONAPP_GETRESOURCE_HYPERVISOR_REBOOT, $data );
    }

    function save() {
        if( $this->_id ) {
            $this->fields[ 'hypervisor_group_id' ][ ONAPP_FIELD_REQUIRED ] = false;
        }

        return parent::save();
    }
}