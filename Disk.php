<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Disks
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Vitaliy Kondratyuk
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 *
 */
define( 'ONAPP_GETRESOURCE_AUTOBACKUP_ENABLE', 'autobackup_enable' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_AUTOBACKUP_DISABLE', 'autobackup_disable' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_TAKE_BACKUP', 'backups' );

define( 'ONAPP_GETRESOURCE_MIGRATE', 'migrate' );

define( 'ONAPP_GETRESOURCE_DISK_IOLIMITS', 'io_limits' );

define( 'ONAPP_GETRESOURCE_DISK_ASSIGN', 'assign' );
/**
 * Managing Disks
 *
 * The OnApp_Disk class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Disk extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'disk';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/disks';

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
            case '2.0':
            case '2.1':
            case 2.2:
            case 2.3:
                $this->fields = array(
                    'id'                  => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'created_at'          => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'updated_at'          => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'add_to_linux_fstab'  => array(
                        ONAPP_FIELD_MAP  => '_add_to_linux_fstab',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'disk_size'           => array(
                        ONAPP_FIELD_MAP      => '_disk_size',
                        ONAPP_FIELD_TYPE     => 'integer',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'primary'             => array(
                        ONAPP_FIELD_MAP       => '_primary',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'data_store_id'       => array(
                        ONAPP_FIELD_MAP      => '_data_store_id',
                        ONAPP_FIELD_TYPE     => 'integer',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'disk_vm_number'      => array(
                        ONAPP_FIELD_MAP       => '_disk_vm_number',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'is_swap'             => array(
                        ONAPP_FIELD_MAP  => '_is_swap',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'mount_point'         => array(
                        ONAPP_FIELD_MAP => '_mount_point',
                    ),
                    'identifier'          => array(
                        ONAPP_FIELD_MAP => '_identifier',
                    ),
                    'file_system'         => array(
                        ONAPP_FIELD_MAP       => '_file_system',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'virtual_machine_id'  => array(
                        ONAPP_FIELD_MAP       => '_virtual_machine_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'require_format_disk' => array(
                        ONAPP_FIELD_MAP       => '_require_format_disk',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'built'               => array(
                        ONAPP_FIELD_MAP       => '_built',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'locked'              => array(
                        ONAPP_FIELD_MAP       => '_locked',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'has_autobackups'     => array(
                        ONAPP_FIELD_MAP               => '_has_autobackups',
                        ONAPP_FIELD_TYPE              => 'boolean',
                        ONAPP_FIELD_READ_ONLY         => true,
                        ONAPP_FIELD_SKIP_FROM_REQUEST => true,
                    ),
                );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
            case 4.2:
                $this->fields = $this->initFields( 2.3 );

                $this->fields['add_to_freebsd_fstab']              = array(
                    ONAPP_FIELD_MAP  => '_add_to_freebsd_fstab',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['burst_bw']                          = array(
                    ONAPP_FIELD_MAP  => '_burst_bw',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['burst_iops']                        = array(
                    ONAPP_FIELD_MAP  => '_burst_iops',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['integrated_storage_cache_enabled']  = array(
                    ONAPP_FIELD_MAP  => '_integrated_storage_cache_enabled',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['integrated_storage_cache_override'] = array(
                    ONAPP_FIELD_MAP  => '_integrated_storage_cache_override',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['integrated_storage_cache_settings'] = array(
                    ONAPP_FIELD_MAP  => '_integrated_storage_cache_settings',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['iqn']                               = array(
                    ONAPP_FIELD_MAP  => '_iqn',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['label']                             = array(
                    ONAPP_FIELD_MAP  => '_label',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['max_bw']                            = array(
                    ONAPP_FIELD_MAP  => '_max_bw',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['max_iops']                          = array(
                    ONAPP_FIELD_MAP  => '_max_iops',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['min_iops']                          = array(
                    ONAPP_FIELD_MAP  => '_min_iops',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['volume_id']                         = array(
                    ONAPP_FIELD_MAP  => '_volume_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;

            case 4.3:
                $this->fields = $this->initFields( 4.2 );

                $this->fields['mounted'] = array(
                    ONAPP_FIELD_MAP  => '_mounted',
                    ONAPP_FIELD_TYPE => 'boolean',
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

                $this->fields['io_limits_override']           = array(
                    ONAPP_FIELD_MAP  => '_io_limits_override',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['read_iops']                    = array(
                    ONAPP_FIELD_MAP  => '_read_iops',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['write_iops']                   = array(
                    ONAPP_FIELD_MAP  => '_write_iops',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['read_throughput']              = array(
                    ONAPP_FIELD_MAP  => '_read_throughput',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['write_throughput']             = array(
                    ONAPP_FIELD_MAP  => '_write_throughput',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['temporary_virtual_machine_id'] = array(
                    ONAPP_FIELD_MAP  => '_temporary_virtual_machine_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['io_limits']                    = array(
                    ONAPP_FIELD_MAP  => '_io_limits',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['openstack_id']                 = array(
                    ONAPP_FIELD_MAP  => '_openstack_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                $this->fields['hot_migrate_disk']   = array(
                    ONAPP_FIELD_MAP  => '_hot_migrate_disk',
                    ONAPP_FIELD_TYPE => 'string',
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
            case ONAPP_GETRESOURCE_LIST:
                /**
                 * ROUTE :
                 *
                 * @name virtual_machine_disks
                 * @method GET
                 * @alias  /virtual_machines/:virtual_machine_id/disks(.:format)
                 * @format {:controller=>"disks", :action=>"index"}
                 */
                $resource = $this->_virtual_machine_id ?
                    'virtual_machines/' . $this->_virtual_machine_id . '/disks' :
                    $this->getResource();
                break;

            case ONAPP_GETRESOURCE_ADD:
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias     /virtual_machines/:virtual_machine_id/disks(.:format)
                 * @format    {:controller=>"disks", :action=>"create"}
                 */
                if ( is_null( $this->_virtual_machine_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _virtual_machine_id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    $resource = 'virtual_machines/' . $this->_virtual_machine_id . '/disks';
                }
                break;

            case ONAPP_GETRESOURCE_AUTOBACKUP_ENABLE:
                /**
                 * ROUTE :
                 *
                 * @name autobackup_enable_disk
                 * @method POST
                 * @alias     /settings/disks/:id/autobackup_enable(.:format)
                 * @format    {:controller=>"disks", :action=>"autobackup_enable"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/autobackup_enable';
                break;

            case ONAPP_GETRESOURCE_AUTOBACKUP_DISABLE:
                /**
                 * ROUTE :
                 *
                 * @name autobackup_disable_disk
                 * @method POST
                 * @alias  /settings/disks/:id/autobackup_disable(.:format)
                 * @format {:controller=>"disks", :action=>"autobackup_disable"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/autobackup_disable';
                break;

            case ONAPP_GETRESOURCE_TAKE_BACKUP:
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias  /settings/disks/:disk_id/backups(.:format)
                 * @format {:controller=>"backups", :action=>"create"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/backups';
                break;

            case ONAPP_GETRESOURCE_MIGRATE:
                /**
                 * ROUTE :
                 *
                 * @name migrate
                 * @method POST
                 * @format {:controller=>"disks", :action=>"migrate"}
                 */
                if ( is_null( $this->_virtual_machine_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _virtual_machine_id not set.',
                        __FILE__,
                        __LINE__
                    );
                } elseif ( is_null( $this->_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    $resource = 'virtual_machines/' . $this->_virtual_machine_id . '/disks/' . $this->_id . '/migrate';
                }
                break;

            case ONAPP_GETRESOURCE_DISK_IOLIMITS:
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/io_limits';
                break;

            case ONAPP_GETRESOURCE_DISK_ASSIGN:
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/assign';
                break;

            default:
                /**
                 * ROUTE :
                 *
                 * @name disks
                 * @method GET
                 * @alias     /settings/disks(.:format)
                 * @format    {:controller=>"disks", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name disk
                 * @method GET
                 * @alias     /settings/disks/:id(.:format)
                 * @format    {:controller=>"disks", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias     /settings/disks(.:format)
                 * @format    {:controller=>"disks", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method PUT
                 * @alias  /settings/disks/:id(.:format)
                 * @format {:controller=>"disks", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method DELETE
                 * @alias  /settings/disks/:id(.:format)
                 * @format {:controller=>"disks", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
                break;
        }

        $actions = array(
            ONAPP_GETRESOURCE_LIST,
            ONAPP_GETRESOURCE_ADD,
            ONAPP_GETRESOURCE_AUTOBACKUP_ENABLE,
            ONAPP_GETRESOURCE_AUTOBACKUP_DISABLE,
            ONAPP_GETRESOURCE_MIGRATE,
        );

        if ( in_array( $action, $actions ) ) {
            $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
        }

        return $resource;
    }

    /**
     * Enable autobackup
     *
     * @param null $id
     *
     * @return void
     */
    function enableAutobackup( $id = null ) {
        if ( $id ) {
            $this->_id = $id;
        }
        $this->sendPost( ONAPP_GETRESOURCE_AUTOBACKUP_ENABLE, '' );
    }

    /**
     * Disable autobackup
     *
     * @param null $id
     *
     * @return void
     */
    function disableAutobackup( $id = null ) {
        if ( $id ) {
            $this->_id = $id;
        }

        $this->sendPost( ONAPP_GETRESOURCE_AUTOBACKUP_DISABLE, '' );
    }

    /**
     * Sends an API request to get the Objects. After requesting,
     * unserializes the received response into the array of Objects
     *
     * @param integer $vm_id VM ID
     *
     * @return mixed an array of Object instances on success. Otherwise false
     * @access public
     */
    function getList( $vm_id = null, $url_args = null ) {
        if ( $vm_id ) {
            $this->_virtual_machine_id = $vm_id;
        }

        return parent::getList();
    }

    /**
     * The method saves an Object to your account
     *
     * @param integer $vm_id VM ID
     *
     * @return mixed Serialized API Response
     * @access private
     */
    function save() {
        if ( $this->_virtual_machine_id ) {
            $this->fields['require_format_disk'] = array(
                ONAPP_FIELD_MAP           => '_require_format_disk',
                ONAPP_FIELD_TYPE          => 'integer',
                ONAPP_FIELD_REQUIRED      => true,
                ONAPP_FIELD_DEFAULT_VALUE => false,
            );
        }

        if ( $this->_id ) {
            $this->fields['add_to_linux_fstab'][ ONAPP_FIELD_REQUIRED ] = false;
            $this->fields['data_store_id'][ ONAPP_FIELD_REQUIRED ]      = false;
            $this->fields['is_swap'][ ONAPP_FIELD_REQUIRED ]            = false;
            $this->fields['mount_point'][ ONAPP_FIELD_REQUIRED ]        = false;
        }

        return parent::save();
    }

    /**
     * Takes Disk Backup
     *
     * @param integer $disk_id Disk Id
     *
     * @return void
     */
    function takeBackup( $disk_id ) {
        if ( $disk_id ) {
            $this->_id = $disk_id;
        }
        // workaround because we get backup data in response
        $this->_tagRoot  = 'backup';
        $this->className = 'OnApp_VirtualMachine_Backup';
        $backup          = new OnApp_VirtualMachine_Backup();
        $backup->initFields( $this->getAPIVersion() );
        $this->fields = $backup->getClassFields();
        $this->sendPost( ONAPP_GETRESOURCE_TAKE_BACKUP );
    }

    /**
     * Migrates disk to different data store
     *
     * @param integer $id virtual machine id
     * @param         $data_store_id
     *
     * @access    public
     */
    function migrate( $data_store_id, $id = null, $type=null, $virtual_machine_identifier=null, $disk_id=null ) {
        if ( $id ) {
            $this->_id = $id;
        }
        $data = array(
            'root' => 'tmp_holder',
            'data' => array(
                'disk' => array(
                    'data_store_id' => $data_store_id
                )
            )
        );
        
        if ( $type ) {
            $data['data']['type'] = $type;
        }
        if ( $virtual_machine_identifier ) {
            $data['data']['virtual_machine_identifier'] = $virtual_machine_identifier;
        }
        if ( $disk_id ) {
            $data['data']['disk_id'] = $disk_id;
        }
        
        $this->sendPost( ONAPP_GETRESOURCE_MIGRATE, $data );
    }

    function ioLimits( $io_limits_override = null, $read_iops = null, $write_iops = null, $read_throughput = null, $write_throughput = null, $id = null ) {
        if ( $id ) {
            $this->_id = $id;
        }
        if ( $io_limits_override !== null ) {
            $this->_io_limits_override = $io_limits_override;
        }
        if ( $read_iops ) {
            $this->_read_iops = $read_iops;
        }
        if ( $write_iops ) {
            $this->_write_iops = $write_iops;
        }
        if ( $read_throughput ) {
            $this->_read_throughput = $read_throughput;
        }
        if ( $write_throughput ) {
            $this->_write_throughput = $write_throughput;
        }

        $data = array(
            'root'      => 'io_limits',
            'data' => array(
                'io_limits_override' => $this->_io_limits_override,
                'read_iops'          => $this->_read_iops,
                'write_iops'         => $this->_write_iops,
                'read_throughput'    => $this->_read_throughput,
                'write_throughput'   => $this->_write_throughput,
            )
        );
        $this->sendPut( ONAPP_GETRESOURCE_DISK_IOLIMITS, $data );
    }

    function assign( $id = null, $temporary_virtual_machine_id = null ) {
        if ( $id ) {
            $this->_id = $id;
        }
        if ( $temporary_virtual_machine_id !== null ) {
            $this->_temporary_virtual_machine_id = $temporary_virtual_machine_id;
        }

        $data = array(
            'root' => 'disk',
            'data' => array(
                'temporary_virtual_machine_id' => $this->_temporary_virtual_machine_id,
            )
        );
        $this->sendPost( ONAPP_GETRESOURCE_DISK_ASSIGN, $data );
    }

    function deassign( $id = null ) {
        if ( $id ) {
            $this->_id = $id;
        }

        $this->sendDelete( ONAPP_GETRESOURCE_DISK_ASSIGN );
    }

}
