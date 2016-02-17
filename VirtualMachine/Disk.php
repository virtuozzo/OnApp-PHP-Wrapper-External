<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Disk
 *
 * @category        API wrapper
 * @package         OnApp
 * @subpackage      VirtualMachine
 * @author
 * @copyright       © 2016 OnApp
 * @link            http://www.onapp.com/
 * @see             OnApp
 */

/**
 * @todo: Add description
 */
define( 'ONAPP_GETRESOURCE_SNAPSHOT_RESTORE', 'restore' );

/**
 * @todo: Add description
 */
define( 'ONAPP_GETRESOURCE_SNAPSHOT_BUILD', 'build' );

/**
 * VM Snapshot
 *
 * This class represents the Disk which have been taken or are waiting to be taken for Virtual Machine.
 *
 * The OnApp_VirtualMachine_Disk class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_VirtualMachine_Disk extends OnApp {
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
    var $_resource = 'disks';

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
            case 4.0:
            case 4.1:
                $this->fields = array(
                    'id'                          => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'add_to_freebsd_fstab'          => array(
                        ONAPP_FIELD_MAP       => '_add_to_freebsd_fstab',
                        ONAPP_FIELD_TYPE      => 'boolean'
                    ),
                    'add_to_linux_fstab'          => array(
                        ONAPP_FIELD_MAP       => '_add_to_linux_fstab',
                        ONAPP_FIELD_TYPE      => 'boolean'
                    ),
                    'built'                   => array(
                        ONAPP_FIELD_MAP       => '_built',
                        ONAPP_FIELD_TYPE      => 'boolean'
                    ),
                    'created_at'              => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime'
                    ),
                    'updated_at'              => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime'
                    ),
                    'data_store_id'           => array(
                        ONAPP_FIELD_MAP       => '_data_store_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                    ),
                    'disk_size'               => array(
                        ONAPP_FIELD_MAP       => '_disk_size',
                        ONAPP_FIELD_TYPE      => 'integer'
                    ),
                    'disk_vm_number'          => array(
                        ONAPP_FIELD_MAP       => '_disk_vm_number',
                        ONAPP_FIELD_TYPE      => 'integer'
                    ),
                    'file_system'             => array(
                        ONAPP_FIELD_MAP       => '_file_system',
                        ONAPP_FIELD_TYPE      => 'boolean'
                    ),
                    'identifier'              => array(
                        ONAPP_FIELD_MAP       => '_identifier',
                        ONAPP_FIELD_TYPE      => 'string'
                    ),
                    'is_swap'                 => array(
                        ONAPP_FIELD_MAP       => '_is_swap',
                        ONAPP_FIELD_TYPE      => 'boolean'
                    ),
                    'label'                   => array(
                        ONAPP_FIELD_MAP       => '_label',
                        ONAPP_FIELD_TYPE      => 'boolean'
                    ),
                    'locked'                  => array(
                        ONAPP_FIELD_MAP       => '_locked',
                        ONAPP_FIELD_TYPE      => 'boolean'
                    ),
                    'mount_point'             => array(
                        ONAPP_FIELD_MAP       => '_mount_point',
                        ONAPP_FIELD_TYPE      => 'string'
                    ),
                    'primary'                 => array(
                        ONAPP_FIELD_MAP       => '_primary',
                        ONAPP_FIELD_TYPE      => 'boolean'
                    ),
                    'virtual_machine_id'      => array(
                        ONAPP_FIELD_MAP       => '_locked',
                        ONAPP_FIELD_TYPE      => 'integer'
                    ),
                    'volume_id'               => array(
                        ONAPP_FIELD_MAP       => '_volume_id',
                        ONAPP_FIELD_TYPE      => 'boolean'
                    ),
                    'has_autobackups'         => array(
                        ONAPP_FIELD_MAP       => '_has_autobackups',
                        ONAPP_FIELD_TYPE      => 'boolean'
                    ),
                    'iqn'      => array(
                        ONAPP_FIELD_MAP       => '_iqn',
                        ONAPP_FIELD_TYPE      => 'boolean'
                    ),
                    'burst_bw'      => array(
                        ONAPP_FIELD_MAP       => '_burst_bw',
                        ONAPP_FIELD_TYPE      => 'integer'
                    ),
                    'max_bw'      => array(
                        ONAPP_FIELD_MAP       => '_max_bw',
                        ONAPP_FIELD_TYPE      => 'integer'
                    ),
                    'max_iops'      => array(
                        ONAPP_FIELD_MAP       => '_max_iops',
                        ONAPP_FIELD_TYPE      => 'integer'
                    ),
                    'burst_iops'      => array(
                        ONAPP_FIELD_MAP       => '_burst_iops',
                        ONAPP_FIELD_TYPE      => 'integer'
                    ),
                    'integrated_storage_cache_enabled'      => array(
                        ONAPP_FIELD_MAP       => '_integrated_storage_cache_enabled',
                        ONAPP_FIELD_TYPE      => 'boolean'
                    ),
                    'integrated_storage_cache_override'      => array(
                        ONAPP_FIELD_MAP       => '_integrated_storage_cache_override',
                        ONAPP_FIELD_TYPE      => 'boolean'
                    ),
                );
                break;
            case 4.2:
                $this->fields = $this->initFields( 4.1 );
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
        $show_log_msg = true;
        switch( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name virtual_machine_snapshot
                 * @method GET
                 * @alias    /virtual_machines/:virtual_machine_id/disk(.:format)
                 * @format    {:controller=>"snapshots", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method DELETE
                 * @alias    /virtual_machines/:virtual_machine_id/disk(.:format)
                 * @format    {:controller=>"snapshots", :action=>"destroy"}
                 */
                if( is_null( $this->_virtual_machine_id ) && is_null( $this->_obj->_virtual_machine_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _virtual_machine_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                else {
                    if( is_null( $this->_virtual_machine_id ) ) {
                        $this->_virtual_machine_id = $this->_obj->_virtual_machine_id;
                    }
                }

                $resource = 'virtual_machines/' . $this->_virtual_machine_id . '/' . $this->_resource;
                break;

            default:
                $resource = parent::getResource( $action );

                break;
        }

        if( $show_log_msg ) {
            $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
        }

        return $resource;
    }

    /**
     * Sends an API request to get the Objects. After requesting,
     * unserializes the received response into the array of Objects
     *
     * @param integer $virtual_machine_id Virtual Machine id
     * @param mixed   $url_args
     *
     * @return mixed an array of Object instances on success. Otherwise false
     * @access public
     */
    function getList( $virtual_machine_id = null, $url_args = null ) {
        if( is_null( $virtual_machine_id ) && ! is_null( $this->_virtual_machine_id ) ) {
            $virtual_machine_id = $this->_virtual_machine_id;
        }

        if( ! is_null( $virtual_machine_id ) ) {
            $this->_virtual_machine_id = $virtual_machine_id;

            return parent::getList();
        }
        else {
            $this->logger->error(
                'getList: argument _virtual_machine_id not set.',
                __FILE__,
                __LINE__
            );
        }
    }
}
