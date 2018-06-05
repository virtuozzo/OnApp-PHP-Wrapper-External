<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Data Stores
 *
 * An operational data store (or "ODS") is a database  designed to integrate data from multiple
 * sources to make analysis and reporting easier. Data stores are core segments of the cloud system.
 * OnApp uses any block based storage, i.e. local disks in hypervisors, an Ethernet SAN like iSCSI / AoE, or hardware (fiber) SAN.
 * OnApp OnApp is configured to control SANs physical and virtual routing.
 * This control enables seamless SAN failover management, including SAN testing, emergency migration and data backup.
 * The minimum requirements for the virtual machine Data Stores are:
 *  - 1TB Block Storage (iSCSI, AoE, Fiber - can even be on a shared SAN)
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
define( 'ONAPP_GETRESOURCE_DATASTORES_LIST_BY_HYPERVISOR_GROUP_ID', 'hypervisor_zones_data_stores' );

define( 'ONAPP_GETRESOURCE_DATASTORE_IOLIMITS', 'io_limits' );

/**
 * Data Stores
 *
 * The DataStore class represents the Data Storages of the OnAPP installation.
 *
 * The OnApp_DataStore class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_DataStore extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'data_store';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/data_stores';

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
            case 2.0:
                $this->fields = array(
                    'id'                  => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'created_at'          => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'data_store_size'     => array(
                        ONAPP_FIELD_MAP      => '_data_store_size',
                        ONAPP_FIELD_TYPE     => 'integer',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'identifier'          => array(
                        ONAPP_FIELD_MAP       => '_identifier',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'label'               => array(
                        ONAPP_FIELD_MAP           => '_label',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => ''
                    ),
                    'local_hypervisor_id' => array(
                        ONAPP_FIELD_MAP       => '_local_hypervisor_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'updated_at'          => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'zombie_disks_size'   => array(
                        ONAPP_FIELD_MAP       => '_zombie_disks_size',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'enabled'             => array(
                        ONAPP_FIELD_MAP       => '_enabled',
                        ONAPP_FIELD_READ_ONLY => true,
                        ONAPP_FIELD_REQUIRED  => true,
                    ),
                );
                break;

            case 2.1:
                $this->fields = $this->initFields( 2.0 );

                $this->fields['data_store_group_id'] = array(
                    ONAPP_FIELD_MAP      => '_data_store_group_id',
                    ONAPP_FIELD_TYPE     => 'integer',
                    ONAPP_FIELD_REQUIRED => true,
                );
                $this->fields['ip']                  = array(
                    ONAPP_FIELD_MAP      => '_ip',
                    ONAPP_FIELD_TYPE     => 'string',
                    ONAPP_FIELD_REQUIRED => true,
                );
                break;

            case 2.2:
                $this->fields = $this->initFields( 2.1 );

                // check with OnApp, probably is nested class
                $this->fields['raw_stats'] = array(
                    ONAPP_FIELD_MAP       => '_raw_stats',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields['usage']     = array(
                    ONAPP_FIELD_MAP       => '_usage',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields['capacity']  = array(
                    ONAPP_FIELD_MAP       => '_capacity',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                break;

            case 2.3:
                $this->fields = $this->initFields( 2.2 );
                $fields       = array(
                    'raw_stats',
                );
                $this->unsetFields( $fields );
                $this->fields['usage'] = array(
                    ONAPP_FIELD_MAP       => 'usage',
                    ONAPP_FIELD_TYPE      => 'integer',
                    ONAPP_FIELD_READ_ONLY => true,
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

                $this->fields['data_store_type']                   = array(
                    ONAPP_FIELD_MAP  => '_data_store_type',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['hypervisor_group_id']               = array(
                    ONAPP_FIELD_MAP  => '_hypervisor_group_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['integrated_storage_cache_enabled']  = array(
                    ONAPP_FIELD_MAP  => '_integrated_storage_cache_enabled',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['integrated_storage_cache_settings'] = array(
                    ONAPP_FIELD_MAP  => '_integrated_storage_cache_settings',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['iscsi_ip']                          = array(
                    ONAPP_FIELD_MAP  => '_iscsi_ip',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['vdc_id']                            = array(
                    ONAPP_FIELD_MAP  => '_vdc_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;

            case 4.3:
            case 5.0:
                $this->fields = $this->initFields( 4.2 );
                break;
            case 5.1:
                $this->fields = $this->initFields( 5.0 );
                break;
            case 5.2:
                $this->fields = $this->initFields( 5.1 );
                break;
            case 5.3:
                $this->fields = $this->initFields( 5.2 );
                $this->fields['auto_healing'] = array(
                    ONAPP_FIELD_MAP  => '_auto_healing',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                break;
            case 5.4:
                $this->fields = $this->initFields( 5.3 );
                $this->fields['read_iops'] = array(
                    ONAPP_FIELD_MAP  => '_read_iops',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['write_iops'] = array(
                    ONAPP_FIELD_MAP  => '_write_iops',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['read_throughput'] = array(
                    ONAPP_FIELD_MAP  => '_read_throughput',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['write_throughput'] = array(
                    ONAPP_FIELD_MAP  => '_write_throughput',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['io_limits']                            = array(
                    ONAPP_FIELD_MAP  => '_io_limits',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
                $this->fields['epoch'] = array(
                    ONAPP_FIELD_MAP  => '_epoch',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DATASTORES_LIST_BY_HYPERVISOR_GROUP_ID:
                /**
                 * ROUTE :
                 *
                 * @name hypervisor_group_data_stores
                 * @method GET
                 * @alias  /settings/hypervisor_zones/:hypervisor_group_id/data_stores(.:format)
                 * @format {:action=>"index", :controller=>"data_stores"}
                 */
                $resource = 'settings/hypervisor_zones/' . $this->_hypervisor_group_id . '/data_stores';
                break;

            case ONAPP_GETRESOURCE_DATASTORE_IOLIMITS:
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/io_limits';
                break;

            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name data_stores
                 * @method GET
                 * @alias  /settings/data_stores(.:format)
                 * @format {:controller=>"data_stores", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name data_store
                 * @method GET
                 * @alias  /settings/data_stores/:id(.:format)
                 * @format {:controller=>"data_stores", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias   /settings/data_stores(.:format)
                 * @format  {:controller=>"data_stores", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method PUT
                 * @alias  /settings/data_stores/:id(.:format)
                 * @format {:controller=>"data_stores", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method DELETE
                 * @alias  /settings/data_stores/:id(.:format)
                 * @format {:controller=>"data_stores", :action=>"destroy"}
                 */
                return parent::getResource( $action );
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    /**
     * Description
     *
     * @param integer $hypervisor_group_id hypervisor_group_id
     *
     * @return bool|array
     */
    function getListByHypervisorGroupId( $hypervisor_group_id ) {
        if ( $hypervisor_group_id ) {
            $this->_hypervisor_group_id = $hypervisor_group_id;
        } else {
            $this->logger->error(
                'getListByHypervisorGroupId: argument _hypervisor_group_id not set.',
                __FILE__,
                __LINE__
            );
        }
        $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_DATASTORES_LIST_BY_HYPERVISOR_GROUP_ID ) );

        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

        $result = $this->castStringToClass( $response );

        if ( ! empty( $response['errors'] ) ) {
            return false;
        }

        $this->_obj = $result;

        return ( is_array( $result ) || ! $result ) ? $result : array( $result );
    }

    function ioLimits( $read_iops = null, $write_iops = null, $read_throughput = null, $write_throughput = null, $id = null ) {
        if ( $id ) {
            $this->_id = $id;
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
                'read_iops'          => $this->_read_iops,
                'write_iops'         => $this->_write_iops,
                'read_throughput'    => $this->_read_throughput,
                'write_throughput'   => $this->_write_throughput,
            )
        );
        $this->sendPut( ONAPP_GETRESOURCE_DATASTORE_IOLIMITS, $data );
    }

}