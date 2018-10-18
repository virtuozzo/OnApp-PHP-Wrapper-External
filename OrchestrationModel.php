<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Orchestration Models
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @copyright   © 2016 OnApp
 * @link        https://docs.onapp.com/display/VCD/Create+and+Manage+Orchestration+Models
 * @see         OnApp
 */


/**
 * To deploy a orchestration model
 */
define( 'ONAPP_GETRESOURCE_DEPLOY', 'deploy' );

/**
 *
 */
define( 'ONAPP_CLONE_ORCHESTRATION_MODEL', 'clone' );

/**
 * Orchestration Models
 *
 */
class OnApp_OrchestrationModel extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'vcloud_template';

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'vcloud/templates';

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
            case 4.2:
                $this->fields = array(
                    'cpu_allocation_customizable'    => array(
                        ONAPP_FIELD_MAP  => '_cpu_allocation_customizable',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'cpu_allocation_default'         => array(
                        ONAPP_FIELD_MAP  => '_cpu_allocation_default',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'cpu_allocation_max'             => array(
                        ONAPP_FIELD_MAP  => '_cpu_allocation_max',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'cpu_allocation_min'             => array(
                        ONAPP_FIELD_MAP  => '_cpu_allocation_min',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'cpu_allocation_visible'         => array(
                        ONAPP_FIELD_MAP  => '_cpu_allocation_visible',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'cpu_guaranteed_customizable'    => array(
                        ONAPP_FIELD_MAP  => '_cpu_guaranteed_customizable',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'cpu_guaranteed_default'         => array(
                        ONAPP_FIELD_MAP  => '_cpu_guaranteed_default',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'cpu_guaranteed_max'             => array(
                        ONAPP_FIELD_MAP  => '_cpu_guaranteed_max',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'cpu_guaranteed_min'             => array(
                        ONAPP_FIELD_MAP  => '_cpu_guaranteed_min',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'cpu_guaranteed_visible'         => array(
                        ONAPP_FIELD_MAP  => '_cpu_guaranteed_visible',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'cpu_quota_customizable'         => array(
                        ONAPP_FIELD_MAP  => '_cpu_quota_customizable',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'cpu_quota_default'              => array(
                        ONAPP_FIELD_MAP  => '_cpu_quota_default',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'cpu_quota_max'                  => array(
                        ONAPP_FIELD_MAP  => '_cpu_quota_max',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'cpu_quota_min'                  => array(
                        ONAPP_FIELD_MAP  => '_cpu_quota_min',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'cpu_quota_visible'              => array(
                        ONAPP_FIELD_MAP  => '_cpu_quota_visible',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'create_networks'                => array(
                        ONAPP_FIELD_MAP  => '_create_networks',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'created_at'                     => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'data_stores_to_create'          => array(
                        ONAPP_FIELD_MAP   => '_data_stores_to_create',
                        ONAPP_FIELD_TYPE  => 'array',
                        ONAPP_FIELD_CLASS => 'OrchestrationModel_DataStore',
                    ),
                    'default_network_pool'           => array(
                        ONAPP_FIELD_MAP  => '_default_network_pool',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'deploy_edge_gateway'            => array(
                        ONAPP_FIELD_MAP  => '_deploy_edge_gateway',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'edge_gateway_name'              => array(
                        ONAPP_FIELD_MAP  => '_edge_gateway_name',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'edge_gateway_network_id'        => array(
                        ONAPP_FIELD_MAP  => '_edge_gateway_network_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'edge_gateway_uplink_network_id' => array(
                        ONAPP_FIELD_MAP  => '_edge_gateway_uplink_network_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'enable_fast_provisioning'       => array(
                        ONAPP_FIELD_MAP  => '_enable_fast_provisioning',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'enable_thin_provisioning'       => array(
                        ONAPP_FIELD_MAP  => '_enable_thin_provisioning',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'hypervisor_id'                  => array(
                        ONAPP_FIELD_MAP  => '_hypervisor_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'id'                             => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'label'                          => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'memory_customizable'            => array(
                        ONAPP_FIELD_MAP  => '_memory_customizable',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'memory_default'                 => array(
                        ONAPP_FIELD_MAP  => '_memory_default',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'memory_guaranteed_customizable' => array(
                        ONAPP_FIELD_MAP  => '_memory_guaranteed_customizable',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'memory_guaranteed_default'      => array(
                        ONAPP_FIELD_MAP  => '_memory_guaranteed_default',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'memory_guaranteed_max'          => array(
                        ONAPP_FIELD_MAP  => '_memory_guaranteed_max',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'memory_guaranteed_min'          => array(
                        ONAPP_FIELD_MAP  => '_memory_guaranteed_min',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'memory_guaranteed_visible'      => array(
                        ONAPP_FIELD_MAP  => '_memory_guaranteed_visible',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'memory_max'                     => array(
                        ONAPP_FIELD_MAP  => '_memory_max',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'memory_min'                     => array(
                        ONAPP_FIELD_MAP  => '_memory_min',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'memory_quota_customizable'      => array(
                        ONAPP_FIELD_MAP  => '_memory_quota_customizable',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'memory_quota_default'           => array(
                        ONAPP_FIELD_MAP  => '_memory_quota_default',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'memory_quota_max'               => array(
                        ONAPP_FIELD_MAP  => '_memory_quota_max',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'memory_quota_min'               => array(
                        ONAPP_FIELD_MAP  => '_memory_quota_min',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'memory_quota_visible'           => array(
                        ONAPP_FIELD_MAP  => '_memory_quota_visible',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'memory_visible'                 => array(
                        ONAPP_FIELD_MAP  => '_memory_visible',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'networks_to_create'             => array(
                        ONAPP_FIELD_MAP   => '_networks_to_create',
                        ONAPP_FIELD_TYPE  => 'array',
                        ONAPP_FIELD_CLASS => 'OrchestrationModel_Network',
                    ),
                    'provider_vdc_id'                => array(
                        ONAPP_FIELD_MAP  => '_provider_vdc_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'updated_at'                     => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'vcpu_speed_customizable'        => array(
                        ONAPP_FIELD_MAP  => '_vcpu_speed_customizable',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'vcpu_speed_default'             => array(
                        ONAPP_FIELD_MAP  => '_vcpu_speed_default',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'vcpu_speed_max'                 => array(
                        ONAPP_FIELD_MAP  => '_vcpu_speed_max',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'vcpu_speed_min'                 => array(
                        ONAPP_FIELD_MAP  => '_vcpu_speed_min',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'vcpu_speed_visible'             => array(
                        ONAPP_FIELD_MAP  => '_vcpu_speed_visible',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'vdc_model_type'                 => array(
                        ONAPP_FIELD_MAP  => '_vdc_model_type',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vm_number_customizable'         => array(
                        ONAPP_FIELD_MAP  => '_vm_number_customizable',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'vm_number_default'              => array(
                        ONAPP_FIELD_MAP  => '_vm_number_default',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'vm_number_max'                  => array(
                        ONAPP_FIELD_MAP  => '_vm_number_max',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'vm_number_min'                  => array(
                        ONAPP_FIELD_MAP  => '_vm_number_min',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'vm_number_visible'              => array(
                        ONAPP_FIELD_MAP  => '_vm_number_visible',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'storage_profile'                => array(
                        ONAPP_FIELD_MAP  => '_storage_profile',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vm_number'                      => array(
                        ONAPP_FIELD_MAP  => '_vm_number',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'memory_quota'                   => array(
                        ONAPP_FIELD_MAP  => '_memory_quota',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'memory_guaranteed'              => array(
                        ONAPP_FIELD_MAP  => '_memory_guaranteed',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'memory'                         => array(
                        ONAPP_FIELD_MAP  => '_memory',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'cpu_quota'                      => array(
                        ONAPP_FIELD_MAP  => '_cpu_quota',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vcpu_speed'                     => array(
                        ONAPP_FIELD_MAP  => '_vcpu_speed',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'cpu_guaranteed' => array(
                        ONAPP_FIELD_MAP  => '_cpu_guaranteed',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'cpu_allocation' => array(
                        ONAPP_FIELD_MAP  => '_cpu_allocation',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vdc_label' => array(
                        ONAPP_FIELD_MAP  => '_vdc_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'user_group_id' => array(
                        ONAPP_FIELD_MAP  => '_user_group_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
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
                break;
            case 5.4:
                $this->fields = $this->initFields( 5.3 );
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                $this->fields['networks_created']   = array(
                    ONAPP_FIELD_MAP  => '_networks_created',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['name']               = array(
                    ONAPP_FIELD_MAP  => '_name',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEPLOY:
                /**
                 * ROUTE :
                 *
                 * @name vcloud_template
                 * @method POST
                 * @alias   /vcloud/templates/:id/deploy(.:format)
                 * @format  {:controller=>"vcloud_template", :action=>"deploy"}
                 */
                if ( is_null( $this->_id ) && is_null( $this->_obj->_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _id not set.",
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_id ) ) {
                        $this->_id = $this->_obj->_id;
                    }
                }
                $resource = $this->_resource . '/' . $this->_id . '/deploy';
                break;
            case ONAPP_CLONE_ORCHESTRATION_MODEL:
                /**
                 * ROUTE :
                 *
                 * @name vcloud_template
                 * @method PUT
                 * @alias   /vcloud/templates/:id/clone(.:format)
                 * @format  {:controller=>"vcloud_template", :action=>"clone"}
                 */
                $resource = $this->_resource . '/' . $this->_id . '/' . ONAPP_CLONE_ORCHESTRATION_MODEL;
                break;
            default:
                /**
                 * ROUTE :
                 *
                 * @name vcloud_template
                 * @method GET
                 * @alias   /vcloud/templates(.:format)
                 * @format  {:controller=>"vapp_template_groups", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name vcloud_template
                 * @method GET
                 * @alias    /vcloud/templates/:id(.:format)
                 * @format   {:controller=>"vapp_template_groups", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name vcloud_template
                 * @method PUT
                 * @alias    /vcloud/templates/:id(.:format)
                 * @format   {:controller=>"vapp_template_groups", :action=>"edit"}
                 */
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    public function deploy() {
        $data = $this->getSerializedDataToSend();
        
        return $this->sendPost( ONAPP_GETRESOURCE_DEPLOY, $data );
    }

    public function cloneOrchestrationModel($id){
        if ( is_null( $id ) ) {
            $this->logger->error(
                'cloudConfig: argument _id not set.',
                __FILE__,
                __LINE__
            );
        }
        $this->_id = $id;

        $res = $this->sendPut( ONAPP_CLONE_ORCHESTRATION_MODEL );

        return $res;
    }
}