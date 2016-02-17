<?php
/**
 * API calls for managing accelerators' disk.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing Accelerators' Disks
 *
 * The OnApp_CDNAccelerator_Disk class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_CDNAccelerator_Disk extends OnApp {
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
            case 2.0:
            case 2.1:
            case 2.2:
            case 2.3:
            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
            case 4.2:
                $this->fields = array(
                    'add_to_freebsd_fstab'	=> array(
                        ONAPP_FIELD_MAP => '_add_to_freebsd_fstab',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'add_to_linux_fstab'	=> array(
                        ONAPP_FIELD_MAP => '_add_to_linux_fstab',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'built'	=> array(
                        ONAPP_FIELD_MAP => '_built',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'burst_bw'	=> array(
                        ONAPP_FIELD_MAP => '_burst_bw',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'created_at'	=> array(
                        ONAPP_FIELD_MAP => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'data_store_id'	=> array(
                        ONAPP_FIELD_MAP => '_data_store_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'disk_size'	=> array(
                        ONAPP_FIELD_MAP => '_disk_size',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'disk_vm_number'	=> array(
                        ONAPP_FIELD_MAP => '_disk_vm_number',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'file_system'	=> array(
                        ONAPP_FIELD_MAP => '_file_system',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'id'	=> array(
                        ONAPP_FIELD_MAP => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'identifier'	=> array(
                        ONAPP_FIELD_MAP => '_identifier',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'iqn'	=> array(
                        ONAPP_FIELD_MAP => '_iqn',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'is_swap'	=> array(
                        ONAPP_FIELD_MAP => '_is_swap',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'label'	=> array(
                        ONAPP_FIELD_MAP => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'locked'	=> array(
                        ONAPP_FIELD_MAP => '_locked',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'max_bw'	=> array(
                        ONAPP_FIELD_MAP => '_max_bw',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'mount_point'	=> array(
                        ONAPP_FIELD_MAP => '_mount_point',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'primary'	=> array(
                        ONAPP_FIELD_MAP => '_primary',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'updated_at'	=> array(
                        ONAPP_FIELD_MAP => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'virtual_machine_id'	=> array(
                        ONAPP_FIELD_MAP => '_virtual_machine_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'volume_id'	=> array(
                        ONAPP_FIELD_MAP => '_volume_id',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'has_autobackups'	=> array(
                        ONAPP_FIELD_MAP => '_has_autobackups',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'burst_iops'	=> array(
                        ONAPP_FIELD_MAP => '_burst_iops',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'integrated_storage_cache_enabled'	=> array(
                        ONAPP_FIELD_MAP => '_integrated_storage_cache_enabled',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'integrated_storage_cache_override'	=> array(
                        ONAPP_FIELD_MAP => '_integrated_storage_cache_override',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'integrated_storage_cache_settings'	=> array(
                        ONAPP_FIELD_MAP => '_integrated_storage_cache_settings',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'max_iops'	=> array(
                        ONAPP_FIELD_MAP => '_max_iops',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'min_iops'	=> array(
                        ONAPP_FIELD_MAP => '_min_iops',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name disks
                 * @method GET
                 * @alias   /accelerators/:virtual_machine_id/disks(.:format)
                 * @format  {:controller=>"disks", :action=>"index"}
                 */
                if( is_null( $this->_virtual_machine_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _virtual_machine_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = 'accelerators/' . $this->_virtual_machine_id . '/' . $this->_resource;
                break;

            default:
                /**
                 * ROUTE :
                 *
                 * @name disks
                 * @method GET
                 * @alias  accelerators/:virtual_machine_id/disks(.:format)
                 * @format {:controller=>"disks", :action=>"index"}
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }

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