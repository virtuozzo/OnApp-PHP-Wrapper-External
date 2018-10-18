<?php
/**
 * Managing Bucket RateCards Prices
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

class OnApp_Bucket_RateCards_Prices extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'prices';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'prices';

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
                    'limit_free_cpu'                                    => array(
                        ONAPP_FIELD_MAP       => '_limit_free_cpu',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_free_cpu_share'                              => array(
                        ONAPP_FIELD_MAP       => '_limit_free_cpu_share',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_free_cpu_units'                              => array(
                        ONAPP_FIELD_MAP       => '_limit_free_cpu_units',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_free_memory'                                 => array(
                        ONAPP_FIELD_MAP       => '_limit_free_memory',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_on_cpu'                                      => array(
                        ONAPP_FIELD_MAP       => '_price_on_cpu',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_off_cpu'                                     => array(
                        ONAPP_FIELD_MAP       => '_price_off_cpu',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_on_cpu_share'                                => array(
                        ONAPP_FIELD_MAP       => '_price_on_cpu_share',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_off_cpu_share'                               => array(
                        ONAPP_FIELD_MAP       => '_price_off_cpu_share',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_on_cpu_units'                                => array(
                        ONAPP_FIELD_MAP       => '_price_on_cpu_units',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_off_cpu_units'                               => array(
                        ONAPP_FIELD_MAP       => '_price_off_cpu_units',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_on_memory'                                   => array(
                        ONAPP_FIELD_MAP       => '_price_on_memory',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_off_memory'                                  => array(
                        ONAPP_FIELD_MAP       => '_price_off_memory',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_free'                                        => array(
                        ONAPP_FIELD_MAP       => '_limit_free',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_data_read_free'                              => array(
                        ONAPP_FIELD_MAP       => '_limit_data_read_free',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_data_written_free'                           => array(
                        ONAPP_FIELD_MAP       => '_limit_data_written_free',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_reads_completed_free'                        => array(
                        ONAPP_FIELD_MAP       => '_limit_reads_completed_free',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_writes_completed_free'                       => array(
                        ONAPP_FIELD_MAP       => '_limit_writes_completed_free',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_free_monthly'                                => array(
                        ONAPP_FIELD_MAP       => '_limit_free_monthly',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_data_read_free_monthly'                      => array(
                        ONAPP_FIELD_MAP       => '_limit_data_read_free_monthly',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_data_written_free_monthly'                   => array(
                        ONAPP_FIELD_MAP       => '_limit_data_written_free_monthly',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_reads_completed_free_monthly'                => array(
                        ONAPP_FIELD_MAP       => '_limit_reads_completed_free_monthly',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_writes_completed_free_monthly'               => array(
                        ONAPP_FIELD_MAP       => '_limit_writes_completed_free_monthly',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_on'                                          => array(
                        ONAPP_FIELD_MAP       => '_price_on',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_off'                                         => array(
                        ONAPP_FIELD_MAP       => '_price_off',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_data_read'                                   => array(
                        ONAPP_FIELD_MAP       => '_price_data_read',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_data_written'                                => array(
                        ONAPP_FIELD_MAP       => '_price_data_written',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_reads_completed'                             => array(
                        ONAPP_FIELD_MAP       => '_price_reads_completed',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_writes_completed'                            => array(
                        ONAPP_FIELD_MAP       => '_price_writes_completed',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_rate_free'                                   => array(
                        ONAPP_FIELD_MAP       => '_limit_rate_free',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_ip_free'                                     => array(
                        ONAPP_FIELD_MAP       => '_limit_ip_free',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_data_sent_free'                              => array(
                        ONAPP_FIELD_MAP       => '_limit_data_sent_free',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_data_received_free'                          => array(
                        ONAPP_FIELD_MAP       => '_limit_data_received_free',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_ip_free_monthly'                             => array(
                        ONAPP_FIELD_MAP       => '_limit_ip_free_monthly',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_data_sent_free_monthly'                      => array(
                        ONAPP_FIELD_MAP       => '_limit_data_sent_free_monthly',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_data_received_free_monthly'                  => array(
                        ONAPP_FIELD_MAP       => '_limit_data_received_free_monthly',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_rate_on'                                     => array(
                        ONAPP_FIELD_MAP       => '_price_rate_on',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_rate_off'                                    => array(
                        ONAPP_FIELD_MAP       => '_price_rate_off',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_ip_on'                                       => array(
                        ONAPP_FIELD_MAP       => '_price_ip_on',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_ip_off'                                      => array(
                        ONAPP_FIELD_MAP       => '_price_ip_off',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_data_sent'                                   => array(
                        ONAPP_FIELD_MAP       => '_price_data_sent',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_data_received'                               => array(
                        ONAPP_FIELD_MAP       => '_price_data_received',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_backup_free'                                 => array(
                        ONAPP_FIELD_MAP       => '_limit_backup_free',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_backup_disk_size_free'                       => array(
                        ONAPP_FIELD_MAP       => '_limit_backup_disk_size_free',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_template_free'                               => array(
                        ONAPP_FIELD_MAP       => '_limit_template_free',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_template_disk_size_free'                     => array(
                        ONAPP_FIELD_MAP       => '_limit_template_disk_size_free',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_ova_free'                                    => array(
                        ONAPP_FIELD_MAP       => '_limit_ova_free',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_ova_disk_size_free'                          => array(
                        ONAPP_FIELD_MAP       => '_limit_ova_disk_size_free',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_backup'                                      => array(
                        ONAPP_FIELD_MAP       => '_price_backup',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_backup_disk_size'                            => array(
                        ONAPP_FIELD_MAP       => '_price_backup_disk_size',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_template'                                    => array(
                        ONAPP_FIELD_MAP       => '_price_template',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_template_disk_size'                          => array(
                        ONAPP_FIELD_MAP       => '_price_template_disk_size',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_ova'                                         => array(
                        ONAPP_FIELD_MAP       => '_price_ova',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_ova_disk_size'                               => array(
                        ONAPP_FIELD_MAP       => '_price_ova_disk_size',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_disk_size'                                   => array(
                        ONAPP_FIELD_MAP       => '_price_disk_size',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_memory'                                      => array(
                        ONAPP_FIELD_MAP       => '_price_memory',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_cpus'                                        => array(
                        ONAPP_FIELD_MAP       => '_price_cpus',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_cpu_shares'                                  => array(
                        ONAPP_FIELD_MAP       => '_price_cpu_shares',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_cpu_units'                                   => array(
                        ONAPP_FIELD_MAP       => '_price_cpu_units',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_nodes'                                       => array(
                        ONAPP_FIELD_MAP       => '_price_nodes',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price'                                             => array(
                        ONAPP_FIELD_MAP       => '_price',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_vs_ip_on'                                    => array(
                        ONAPP_FIELD_MAP       => '_price_vs_ip_on',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_vs_ip_off'                                   => array(
                        ONAPP_FIELD_MAP       => '_price_vs_ip_off',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_free_allocation_cpu_allocation'              => array(
                        ONAPP_FIELD_MAP       => '_limit_free_allocation_cpu_allocation',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_free_allocation_memory_allocation'           => array(
                        ONAPP_FIELD_MAP       => '_limit_free_allocation_memory_allocation',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_free_allocation_cpu_used'                    => array(
                        ONAPP_FIELD_MAP       => '_limit_free_allocation_cpu_used',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_free_allocation_memory_used'                 => array(
                        ONAPP_FIELD_MAP       => '_limit_free_allocation_memory_used',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_free_allocation_cpu_resources_guaranteed'    => array(
                        ONAPP_FIELD_MAP       => '_limit_free_allocation_cpu_resources_guaranteed',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_free_alocation_memory_resources_guaranteed'  => array(
                        ONAPP_FIELD_MAP       => '_limit_free_alocation_memory_resources_guaranteed',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_free_allocation_vcpu_speed'                  => array(
                        ONAPP_FIELD_MAP       => '_limit_free_allocation_vcpu_speed',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_free_reservation_cpu_allocation'             => array(
                        ONAPP_FIELD_MAP       => '_limit_free_reservation_cpu_allocation',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_free_reservation_memory_allocation'          => array(
                        ONAPP_FIELD_MAP       => '_limit_free_reservation_memory_allocation',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_free_pay_as_you_go_cpu_limit'                => array(
                        ONAPP_FIELD_MAP       => '_limit_free_pay_as_you_go_cpu_limit',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_free_pay_as_you_go_memory_limit'             => array(
                        ONAPP_FIELD_MAP       => '_limit_free_pay_as_you_go_memory_limit',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_free_pay_as_you_go_cpu_used'                 => array(
                        ONAPP_FIELD_MAP       => '_limit_free_pay_as_you_go_cpu_used',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_free_pay_as_you_go_memory_used'              => array(
                        ONAPP_FIELD_MAP       => '_limit_free_pay_as_you_go_memory_used',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_allocation_cpu_allocation'                   => array(
                        ONAPP_FIELD_MAP       => '_price_allocation_cpu_allocation',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_allocation_memory_allocation'                => array(
                        ONAPP_FIELD_MAP       => '_price_allocation_memory_allocation',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_allocation_cpu_resources_guaranteed'         => array(
                        ONAPP_FIELD_MAP       => '_price_allocation_cpu_resources_guaranteed',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_allocation_memory_resources_guaranteed'      => array(
                        ONAPP_FIELD_MAP       => '_price_allocation_memory_resources_guaranteed',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_allocation_cpu_used'                         => array(
                        ONAPP_FIELD_MAP       => '_price_allocation_cpu_used',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_allocation_memory_used'                      => array(
                        ONAPP_FIELD_MAP       => '_price_allocation_memory_used',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_allocation_vcpu_speed'                       => array(
                        ONAPP_FIELD_MAP       => '_price_allocation_vcpu_speed',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_reservation_cpu_allocation'                  => array(
                        ONAPP_FIELD_MAP       => '_price_reservation_cpu_allocation',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_reservation_memory_allocation'               => array(
                        ONAPP_FIELD_MAP       => '_price_reservation_memory_allocation',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_pay_as_you_go_cpu_limit'                     => array(
                        ONAPP_FIELD_MAP       => '_price_pay_as_you_go_cpu_limit',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_pay_as_you_go_memory_limit'                  => array(
                        ONAPP_FIELD_MAP       => '_price_pay_as_you_go_memory_limit',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_pay_as_you_go_cpu_limit_unlimited'           => array(
                        ONAPP_FIELD_MAP       => '_price_pay_as_you_go_cpu_limit_unlimited',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_pay_as_you_go_memory_limit_unlimited'        => array(
                        ONAPP_FIELD_MAP       => '_price_pay_as_you_go_memory_limit_unlimited',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_pay_as_you_go_cpu_used'                      => array(
                        ONAPP_FIELD_MAP       => '_price_pay_as_you_go_cpu_used',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_pay_as_you_go_memory_used'                   => array(
                        ONAPP_FIELD_MAP       => '_price_pay_as_you_go_memory_used',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_free_disk_size'                              => array(
                        ONAPP_FIELD_MAP       => '_limit_free_disk_size',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_free_disk_size_used'                         => array(
                        ONAPP_FIELD_MAP       => '_limit_free_disk_size_used',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_disk_size_used'                              => array(
                        ONAPP_FIELD_MAP       => '_price_disk_size_used',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_disk_size_unlimited'                         => array(
                        ONAPP_FIELD_MAP       => '_price_disk_size_unlimited',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_free_ip'                                     => array(
                        ONAPP_FIELD_MAP       => '_limit_free_ip',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_free_data_sent'                              => array(
                        ONAPP_FIELD_MAP       => '_limit_free_data_sent',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_free_data_received'                          => array(
                        ONAPP_FIELD_MAP       => '_limit_free_data_received',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'price_ip'                                          => array(
                        ONAPP_FIELD_MAP       => '_price_ip',
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
                    'price_recovery_point_size'                         => array(
                        ONAPP_FIELD_MAP       => '_price_recovery_point_size',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'limit_recovery_point_size_free'                     => array(
                        ONAPP_FIELD_MAP       => '_limit_recovery_point_size_free',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                );

                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

}