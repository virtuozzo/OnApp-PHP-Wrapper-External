<?php
/**
 * Managing VDCS
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
 * Edge Gateways
 *
 */
class OnApp_VDCS extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'vdc';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'vdcs';

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
                    'id'               => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer'
                    ),
                    'allocation_model' => array(
                        ONAPP_FIELD_MAP  => '_allocation_model',
                        ONAPP_FIELD_TYPE => 'string'
                    ),
                    'cpu_allocated'    => array(
                        ONAPP_FIELD_MAP  => '_cpu_allocated',
                        ONAPP_FIELD_TYPE => 'string'
                    ),
                    'cpu_limit'        => array(
                        ONAPP_FIELD_MAP  => '_cpu_limit',
                        ONAPP_FIELD_TYPE => 'integer'
                    ),
                    'label'            => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string'
                    ),
                );
                break;
            case 4.2:
                $this->fields                      = $this->initFields( 4.1 );
                $this->fields['cpu_reserved']      = array(
                    ONAPP_FIELD_MAP  => '_cpu_reserved',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['cpu_used']          = array(
                    ONAPP_FIELD_MAP  => '_cpu_used',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['created_at']        = array(
                    ONAPP_FIELD_MAP  => '_created_at',
                    ONAPP_FIELD_TYPE => 'datetime'
                );
                $this->fields['enabled']           = array(
                    ONAPP_FIELD_MAP  => '_enabled',
                    ONAPP_FIELD_TYPE => 'boolean'
                );
                $this->fields['fast_provisioning'] = array(
                    ONAPP_FIELD_MAP  => '_fast_provisioning',
                    ONAPP_FIELD_TYPE => 'boolean'
                );
                $this->fields['guaranteed_cpu']    = array(
                    ONAPP_FIELD_MAP  => '_guaranteed_cpu',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['guaranteed_memory'] = array(
                    ONAPP_FIELD_MAP  => '_guaranteed_memory',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['identifier']        = array(
                    ONAPP_FIELD_MAP  => '_identifier',
                    ONAPP_FIELD_TYPE => 'string'
                );
                $this->fields['memory_allocated']  = array(
                    ONAPP_FIELD_MAP  => '_memory_allocated',
                    ONAPP_FIELD_TYPE => 'string'
                );
                $this->fields['memory_limit']      = array(
                    ONAPP_FIELD_MAP  => '_memory_limit',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['memory_reserved']   = array(
                    ONAPP_FIELD_MAP  => '_memory_reserved',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['memory_used']       = array(
                    ONAPP_FIELD_MAP  => '_memory_used',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['network_quota']     = array(
                    ONAPP_FIELD_MAP  => '_network_quota',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['thin_provisioning'] = array(
                    ONAPP_FIELD_MAP  => '_thin_provisioning',
                    ONAPP_FIELD_TYPE => 'boolean'
                );
                $this->fields['updated_at']        = array(
                    ONAPP_FIELD_MAP  => '_updated_at',
                    ONAPP_FIELD_TYPE => 'datetime'
                );
                $this->fields['user_group_id']     = array(
                    ONAPP_FIELD_MAP  => '_user_group_id',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['vcpu_speed']        = array(
                    ONAPP_FIELD_MAP  => '_vcpu_speed',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['vm_quota']          = array(
                    ONAPP_FIELD_MAP  => '_vm_quota',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                break;
            case 4.3:
                $this->fields                    = $this->initFields( 4.2 );
                $this->fields['provider_vdc_id'] = array(
                    ONAPP_FIELD_MAP  => '_provider_vdc_id',
                    ONAPP_FIELD_TYPE => 'string'
                );
                $this->fields['network_pool_identifier'] = array(
                    ONAPP_FIELD_MAP  => '_network_pool_identifier',
                    ONAPP_FIELD_TYPE => 'string'
                );
                $this->fields['data_stores_attributes'] = array(
                    ONAPP_FIELD_MAP  => '_data_stores_attributes',
                    ONAPP_FIELD_TYPE      => 'array',
                    ONAPP_FIELD_CLASS     => 'VDCS_DataStore',
                );

                break;
            case 5.0:
                $this->fields = $this->initFields( 4.3 );
                break;
            case 5.1:
                $this->fields = $this->initFields( 5.0 );
                $this->fields['network_pool_identifier'] = array(
                    ONAPP_FIELD_MAP  => '_network_pool_identifier',
                    ONAPP_FIELD_TYPE => 'string'
                );
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
                $this->fields['organization_id'] = array(
                    ONAPP_FIELD_MAP  => '_organization_id',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }
}