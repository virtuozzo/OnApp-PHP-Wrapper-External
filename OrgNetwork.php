<?php

/**
 * Managing organization networks
 *
 */


/**
 * organization networks
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_OrgNetwork extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'org_network';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'org_networks';

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
            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
            case 4.2:
            case 4.3:
            case 5.0:
                $this->fields = array(
                    'created_at'                    => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'updated_at'                    => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'default_nat_rule_number'       => array(
                        ONAPP_FIELD_MAP  => '_default_nat_rule_number',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'default_outside_ip_address_id' => array(
                        ONAPP_FIELD_MAP  => '_default_outside_ip_address_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'dns_suffix'                    => array(
                        ONAPP_FIELD_MAP  => '_dns_suffix',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'dvportgroup'                   => array(
                        ONAPP_FIELD_MAP  => '_dvportgroup',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'enabled'                       => array(
                        ONAPP_FIELD_MAP  => '_enabled',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'fence_mode'                    => array(
                        ONAPP_FIELD_MAP  => '_fence_mode',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'gateway'                       => array(
                        ONAPP_FIELD_MAP  => '_gateway',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'id'                            => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'identifier'                    => array(
                        ONAPP_FIELD_MAP  => '_identifier',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'ip_address_pool_id'            => array(
                        ONAPP_FIELD_MAP  => '_ip_address_pool_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'is_nated'                      => array(
                        ONAPP_FIELD_MAP  => '_is_nated',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'label'                         => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'netmask'                       => array(
                        ONAPP_FIELD_MAP  => '_netmask',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'network_group_id'              => array(
                        ONAPP_FIELD_MAP  => '_network_group_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'prefix_size'                   => array(
                        ONAPP_FIELD_MAP  => '_prefix_size',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'primary_dns'                   => array(
                        ONAPP_FIELD_MAP  => '_primary_dns',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'secondary_dns'                 => array(
                        ONAPP_FIELD_MAP  => '_secondary_dns',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'shared'                        => array(
                        ONAPP_FIELD_MAP  => '_shared',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'user_id'                       => array(
                        ONAPP_FIELD_MAP  => '_user_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vapp_id'                       => array(
                        ONAPP_FIELD_MAP  => '_vapp_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vdc_id'                        => array(
                        ONAPP_FIELD_MAP  => '_vdc_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'vlan'                          => array(
                        ONAPP_FIELD_MAP  => '_vlan',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                );
                break;
            case 5.1:
            case 5.2:
            case 5.3:
                $this->fields = $this->initFields( 5.0 );
                break;
            case 5.4:
                $this->fields = $this->initFields( 5.3 );
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                $this->fields['openstack_id']      = array(
                    ONAPP_FIELD_MAP      => '_openstack_id',
                    ONAPP_FIELD_TYPE     => 'integer',
                    ONAPP_FIELD_REQUIRED => true
                );
                $this->fields['parent_network_id'] = array(
                    ONAPP_FIELD_MAP      => '_parent_network_id',
                    ONAPP_FIELD_TYPE     => 'integer',
                    ONAPP_FIELD_REQUIRED => true
                );
                $this->fields['type']               = array(
                    ONAPP_FIELD_MAP      => '_type',
                    ONAPP_FIELD_TYPE     => 'string',
                    ONAPP_FIELD_REQUIRED => true
                );
                $this->fields['vcenter_identifier'] = array(
                    ONAPP_FIELD_MAP      => '_vcenter_identifier',
                    ONAPP_FIELD_TYPE     => 'string',
                    ONAPP_FIELD_REQUIRED => true
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

    function createDirectNetwork( $user_group_id, $label, $vdc_id, $fence_mode, $parent_network_id ) {
        $data = array(
            'root' => 'tmp_holder',
            'data' => array(
                'user_group_id' => $user_group_id,
                'org_network'   => array(
                    'label'             => $label,
                    'vdc_id'            => $vdc_id,
                    'fence_mode'        => $fence_mode,
                    'parent_network_id' => $parent_network_id,
                ),
            )
        );
        $this->sendPost( ONAPP_GETRESOURCE_DEFAULT, $data );
    }

    function createRoutedNetwork( $user_group_id, $label, $vdc_id, $fence_mode, $network_gateway_cidr, $shared, $start_address, $end_address, $edge_gateway ) {
        $data = array(
            'root' => 'tmp_holder',
            'data' => array(
                'user_group_id' => $user_group_id,
                'org_network'   => array(
                    'label'                => $label,
                    'vdc_id'               => $vdc_id,
                    'fence_mode'           => $fence_mode,
                    'network_gateway_cidr' => $network_gateway_cidr,
                    'shared'               => $shared,
                    'ip_ranges_attributes' => array(
                        'start_address' => $start_address,
                        'end_address'   => $end_address,
                    ),
                    'edge_gateway'         => $edge_gateway,
                ),
            )
        );
        $this->sendPost( ONAPP_GETRESOURCE_DEFAULT, $data );
    }

    function createIsolatedNetwork( $user_group_id, $label, $vdc_id, $fence_mode, $network_gateway_cidr, $shared, $start_address, $end_address ) {
        $data = array(
            'root' => 'tmp_holder',
            'data' => array(
                'user_group_id' => $user_group_id,
                'org_network'   => array(
                    'label'                => $label,
                    'vdc_id'               => $vdc_id,
                    'fence_mode'           => $fence_mode,
                    'network_gateway_cidr' => $network_gateway_cidr,
                    'shared'               => $shared,
                    'ip_ranges_attributes' => array(
                        'start_address' => $start_address,
                        'end_address'   => $end_address,
                    ),
                ),
            )
        );
        $this->sendPost( ONAPP_GETRESOURCE_DEFAULT, $data );
    }

}
