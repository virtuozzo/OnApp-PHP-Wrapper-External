<?php
/**
 * Hypervisor Zone
 *
 * @todo        Add description
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
 * Managing Hypervisor Zones
 *
 * The OnApp_HypervisorZone class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * The OnApp_HypervisorZone class represents virtual machine hypervisor groups.
 * The OnApp class is a parent of ONAPP_HypervisorZone class.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */

/**
 * Get the list of common CPU flags
 */
define( 'ONAPP_GET_LIST_OF_COMMON_CPU_FLAGS', 'cpu_flags/common' );


class OnApp_HypervisorZone extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'hypervisor_group';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/hypervisor_zones';

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
                    'id'         => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'created_at' => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'updated_at' => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'label'      => array(
                        ONAPP_FIELD_MAP       => '_label',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                break;

            case '2.1':
                $this->fields = $this->initFields( '2.0' );
                break;

            case 2.2:
            case 2.3:
                $this->fields = $this->initFields( 2.1 );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
                $this->fields = $this->initFields( 2.3 );
                break;
            case 4.2:
                $this->fields = $this->initFields( 4.1 );

                $this->fields[ 'cpu_flags' ]                 = array(
                    ONAPP_FIELD_MAP  => '_cpu_flags',
                    ONAPP_FIELD_TYPE => '_array',
                );

                $this->fields[ 'cpu_flags_enabled' ]        = array(
                    ONAPP_FIELD_MAP       => '_cpu_flags_enabled',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );

                $this->fields[ 'preconfigured_only' ]        = array(
                    ONAPP_FIELD_MAP       => '_preconfigured_only',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );

                $this->fields[ 'supplier_version' ]        = array(
                    ONAPP_FIELD_MAP       => '_supplier_version',
                    ONAPP_FIELD_TYPE      => 'string',
                );

                $this->fields[ 'supplier_provider' ]        = array(
                    ONAPP_FIELD_MAP       => '_supplier_provider',
                    ONAPP_FIELD_TYPE      => 'string',
                );

                $this->fields[ 'closed' ]        = array(
                    ONAPP_FIELD_MAP       => '_closed',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'cpu_units' ]        = array(
                    ONAPP_FIELD_MAP       => '_cpu_units',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'default_gateway' ]        = array(
                    ONAPP_FIELD_MAP       => '_default_gateway',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'draas_id' ]        = array(
                    ONAPP_FIELD_MAP       => '_draas_id',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'failover_timeout' ]        = array(
                    ONAPP_FIELD_MAP       => '_failover_timeout',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'federation_enabled' ]        = array(
                    ONAPP_FIELD_MAP       => '_federation_enabled',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'federation_id' ]        = array(
                    ONAPP_FIELD_MAP       => '_federation_id',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'hypervisor_id' ]        = array(
                    ONAPP_FIELD_MAP       => '_hypervisor_id',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'identifier' ]        = array(
                    ONAPP_FIELD_MAP       => '_identifier',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'location_group_id' ]        = array(
                    ONAPP_FIELD_MAP       => '_location_group_id',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'max_host_cpu' ]        = array(
                    ONAPP_FIELD_MAP       => '_max_host_cpu',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'max_host_free_memory' ]        = array(
                    ONAPP_FIELD_MAP       => '_max_host_free_memory',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'network_failure' ]        = array(
                    ONAPP_FIELD_MAP       => '_network_failure',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'prefer_local_reads' ]        = array(
                    ONAPP_FIELD_MAP       => '_prefer_local_reads',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'provider_name' ]        = array(
                    ONAPP_FIELD_MAP       => '_provider_name',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'recovery_type' ]        = array(
                    ONAPP_FIELD_MAP       => '_recovery_type',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'release_resource_type' ]        = array(
                    ONAPP_FIELD_MAP       => '_release_resource_type',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'run_sysprep' ]        = array(
                    ONAPP_FIELD_MAP       => '_run_sysprep',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'scheduled_for_deletion' ]        = array(
                    ONAPP_FIELD_MAP       => '_scheduled_for_deletion',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'server_type' ]        = array(
                    ONAPP_FIELD_MAP       => '_server_type',
                    ONAPP_FIELD_TYPE      => 'string',
                );
                $this->fields[ 'storage_channel' ]        = array(
                    ONAPP_FIELD_MAP       => '_storage_channel',
                    ONAPP_FIELD_TYPE      => 'integer',
                );
                $this->fields[ 'traded' ]        = array(
                    ONAPP_FIELD_MAP       => '_traded',
                    ONAPP_FIELD_TYPE      => 'boolean',
                );
                $this->fields[ 'vlan' ]        = array(
                    ONAPP_FIELD_MAP       => '_vlan',
                    ONAPP_FIELD_TYPE      => 'string',
                );

                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch( $action ) {
            case ONAPP_GET_LIST_OF_COMMON_CPU_FLAGS:
                /**
                 * ROUTE :
                 *
                 * @name hypervisor_groups
                 * @method GET
                 * @alias   /settings/hypervisor_zones/:hypervisor_zone_id/cpu_flags/common(.:format)
                 *
                 */

                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/cpu_flags/common';
                break;

            default:
                /**
                 * ROUTE :
                 *
                 * @name hypervisor_groups
                 * @method GET
                 * @alias  /settings/hypervisor_zones(.:format)
                 * @format {:controller=>"hypervisor_groups", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name hypervisor_group
                 * @method GET
                 * @alias   /settings/hypervisor_zones/:id(.:format)
                 * @format  {:controller=>"hypervisor_groups", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias   /settings/hypervisor_zones(.:format)
                 * @format  {:controller=>"hypervisor_groups", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method PUT
                 * @alias  /settings/hypervisor_zones/:id(.:format)
                 * @format {:controller=>"hypervisor_groups", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method DELETE
                 * @alias    /settings/hypervisor_zones/:id(.:format)
                 * @format   {:controller=>"hypervisor_groups", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
                break;
        }
        return $resource;
    }

    function getCommonCpuFlags(){
        return $this->sendGet(ONAPP_GET_LIST_OF_COMMON_CPU_FLAGS);
    }
}
