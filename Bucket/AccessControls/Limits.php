<?php
/**
 * Managing Bucket AccessControls Limits
 * 
 * much they will be charged per unit.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Mykola Vuy
 * @copyright   © 2018 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

class OnApp_Bucket_AccessControls_Limits extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'limits';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'limits';

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
            case 6.0:
                $this->fields = array(
                    'limit_ip'                                          => array(
                        ONAPP_FIELD_MAP       => '_limit_ip',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_rate '                                       => array(
                        ONAPP_FIELD_MAP       => '_limit_rate',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_cpu_share'                                   => array(
                        ONAPP_FIELD_MAP       => '_limit_cpu_share',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_cpu_units'                                   => array(
                        ONAPP_FIELD_MAP       => '_limit_cpu_units',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_memory'                                      => array(
                        ONAPP_FIELD_MAP       => '_limit_memory',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_default_cpu'                                 => array(
                        ONAPP_FIELD_MAP       => '_limit_default_cpu',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_min_cpu'                                     => array(
                        ONAPP_FIELD_MAP       => '_limit_min_cpu',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_min_memory'                                  => array(
                        ONAPP_FIELD_MAP       => '_limit_min_memory',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_default_cpu_share'                           => array(
                        ONAPP_FIELD_MAP       => '_limit_default_cpu_share',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_min_cpu_priority'                            => array(
                        ONAPP_FIELD_MAP       => '_limit_min_cpu_priority',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'use_cpu_units'                                     => array(
                        ONAPP_FIELD_MAP       => '_use_cpu_units',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit'                                             => array(
                        ONAPP_FIELD_MAP       => '_limit',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_cpu'                                         => array(
                        ONAPP_FIELD_MAP       => '_limit_cpu',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_min_allocation_cpu_allocation'               => array(
                        ONAPP_FIELD_MAP       => '_limit_min_allocation_cpu_allocation',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_min_allocation_memory_allocation'            => array(
                        ONAPP_FIELD_MAP       => '_limit_min_allocation_memory_allocation',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_min_allocation_cpu_resources_guaranteed'     => array(
                        ONAPP_FIELD_MAP       => '_limit_min_allocation_cpu_resources_guaranteed',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_min_allocation_memory_resources_guaranteed'  => array(
                        ONAPP_FIELD_MAP       => '_limit_min_allocation_memory_resources_guaranteed',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_min_allocation_vcpu_speed'                   => array(
                        ONAPP_FIELD_MAP       => '_limit_min_allocation_vcpu_speed',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_allocation_cpu_allocation'                   => array(
                        ONAPP_FIELD_MAP       => '_limit_allocation_cpu_allocation',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_allocation_memory_allocation'                => array(
                        ONAPP_FIELD_MAP       => '_limit_allocation_memory_allocation',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_allocation_cpu_resources_guaranteed'         => array(
                        ONAPP_FIELD_MAP       => '_limit_allocation_cpu_resources_guaranteed',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_allocation_memory_resources_guaranteed'      => array(
                        ONAPP_FIELD_MAP       => '_limit_allocation_memory_resources_guaranteed',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_allocation_vcpu_speed'                       => array(
                        ONAPP_FIELD_MAP       => '_limit_allocation_vcpu_speed',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_min_reservation_cpu_allocation'              => array(
                        ONAPP_FIELD_MAP       => '_limit_min_reservation_cpu_allocation',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_min_reservation_memory_allocation'           => array(
                        ONAPP_FIELD_MAP       => '_limit_min_reservation_memory_allocation',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_reservation_cpu_allocation'                  => array(
                        ONAPP_FIELD_MAP       => '_limit_reservation_cpu_allocation',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_reservation_memory_allocation'               => array(
                        ONAPP_FIELD_MAP       => '_limit_reservation_memory_allocation',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_min_pay_as_you_go_cpu_limit'                 => array(
                        ONAPP_FIELD_MAP       => '_limit_min_pay_as_you_go_cpu_limit',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_min_pay_as_you_go_memory_limit'              => array(
                        ONAPP_FIELD_MAP       => '_limit_min_pay_as_you_go_memory_limit',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_pay_as_you_go_cpu_limit'                     => array(
                        ONAPP_FIELD_MAP       => '_limit_pay_as_you_go_cpu_limit',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_pay_as_you_go_memory_limit'                  => array(
                        ONAPP_FIELD_MAP       => '_limit_pay_as_you_go_memory_limit',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'target_id'                                         => array(
                        ONAPP_FIELD_MAP       => '_target_id',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'target_name'                                       => array(
                        ONAPP_FIELD_MAP       => '_target_name',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_backup'                                      => array(
                        ONAPP_FIELD_MAP       => '_limit_backup',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_backup_disk_size'                            => array(
                        ONAPP_FIELD_MAP       => '_limit_backup_disk_size',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_template'                                    => array(
                        ONAPP_FIELD_MAP       => '_limit_template',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_template_disk_size'                          => array(
                        ONAPP_FIELD_MAP       => '_limit_template_disk_size',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'use_default_cpu'                                   => array(
                        ONAPP_FIELD_MAP       => '_use_default_cpu',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    
                    'use_default_cpu_share'                             => array(
                        ONAPP_FIELD_MAP       => '_use_default_cpu_share',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_ova'                                         => array(
                        ONAPP_FIELD_MAP       => '_limit_ova',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_ova_disk_size'                               => array(
                        ONAPP_FIELD_MAP       => '_limit_ova_disk_size',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_vs_cpu'                                      => array(
                        ONAPP_FIELD_MAP       => '_limit_vs_cpu',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_vs_memory'                                   => array(
                        ONAPP_FIELD_MAP       => '_limit_vs_memory',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_min_disk_size'                               => array(
                        ONAPP_FIELD_MAP       => '_limit_min_disk_size',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_disk_size'                                   => array(
                        ONAPP_FIELD_MAP       => '_limit_disk_size',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_vs_disk_size'                                => array(
                        ONAPP_FIELD_MAP       => '_limit_vs_disk_size',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_vs_ip'                                       => array(
                        ONAPP_FIELD_MAP       => '_limit_vs_ip',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                );

                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

}
