<?php

/**
 * Manages Company Billing Plan Base Resource Limits
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  BillingCompany_BaseResource_Limit
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
class OnApp_BillingCompany_BaseResource_Limit extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'resource';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'resources';

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
                $this->fields                                                      = array();
                $this->fields['limit_free_ip']                                     = array(
                    ONAPP_FIELD_MAP => '_limit_free_ip',
                );
                $this->fields['limit_free_data_sent']                              = array(
                    ONAPP_FIELD_MAP => '_limit_free_data_sent',
                );
                $this->fields['limit_free_data_received']                          = array(
                    ONAPP_FIELD_MAP => '_limit_free_data_received',
                );
                $this->fields['limit_ip']                                          = array(
                    ONAPP_FIELD_MAP => '_limit_ip',
                );
                $this->fields['limit_free_disk_size']                              = array(
                    ONAPP_FIELD_MAP => '_limit_free_disk_size',
                );
                $this->fields['limit_min_disk_size']                               = array(
                    ONAPP_FIELD_MAP => '_limit_min_disk_size',
                );
                $this->fields['limit_disk_size']                                   = array(
                    ONAPP_FIELD_MAP => '_limit_disk_size',
                );
                $this->fields['limit_free_allocation_cpu_allocation']              = array(
                    ONAPP_FIELD_MAP => '_limit_free_allocation_cpu_allocation',
                );
                $this->fields['limit_free_allocation_cpu_resources_guaranteed']    = array(
                    ONAPP_FIELD_MAP => '_limit_free_allocation_cpu_resources_guaranteed',
                );
                $this->fields['limit_free_allocation_memory_allocation']           = array(
                    ONAPP_FIELD_MAP => '_limit_free_allocation_memory_allocation',
                );
                $this->fields['limit_free_allocation_memory_resources_guaranteed'] = array(
                    ONAPP_FIELD_MAP => '_limit_free_allocation_memory_resources_guaranteed',
                );
                $this->fields['limit_min_allocation_cpu_allocation']               = array(
                    ONAPP_FIELD_MAP => '_limit_min_allocation_cpu_allocation',
                );
                $this->fields['limit_min_allocation_cpu_resources_guaranteed']     = array(
                    ONAPP_FIELD_MAP => '_limit_min_allocation_cpu_resources_guaranteed',
                );
                $this->fields['limit_min_allocation_memory_allocation']            = array(
                    ONAPP_FIELD_MAP => '_limit_min_allocation_memory_allocation',
                );
                $this->fields['limit_min_allocation_memory_resources_guaranteed']  = array(
                    ONAPP_FIELD_MAP => '_limit_min_allocation_memory_resources_guaranteed',
                );
                $this->fields['limit_allocation_cpu_allocation']                   = array(
                    ONAPP_FIELD_MAP => '_limit_allocation_cpu_allocation',
                );
                $this->fields['limit_allocation_cpu_resources_guaranteed']         = array(
                    ONAPP_FIELD_MAP => '_limit_allocation_cpu_resources_guaranteed',
                );
                $this->fields['limit_allocation_memory_allocation']                = array(
                    ONAPP_FIELD_MAP => '_limit_allocation_memory_allocation',
                );
                $this->fields['limit_allocation_memory_resources_guaranteed']      = array(
                    ONAPP_FIELD_MAP => '_limit_allocation_memory_resources_guaranteed',
                );
                $this->fields['limit_free_reservation_cpu_allocation']             = array(
                    ONAPP_FIELD_MAP => '_limit_free_reservation_cpu_allocation',
                );
                $this->fields['limit_free_reservation_memory_allocation']          = array(
                    ONAPP_FIELD_MAP => '_limit_free_reservation_memory_allocation',
                );
                $this->fields['limit_min_reservation_cpu_allocation']              = array(
                    ONAPP_FIELD_MAP => '_limit_min_reservation_cpu_allocation',
                );
                $this->fields['limit_min_reservation_memory_allocation']           = array(
                    ONAPP_FIELD_MAP => '_limit_min_reservation_memory_allocation',
                );
                $this->fields['limit_reservation_cpu_allocation']                  = array(
                    ONAPP_FIELD_MAP => '_limit_reservation_cpu_allocation',
                );
                $this->fields['limit_reservation_memory_allocation']               = array(
                    ONAPP_FIELD_MAP => '_limit_reservation_memory_allocation',
                );
                $this->fields['limit_free_allocation_vcpu_speed']                  = array(
                    ONAPP_FIELD_MAP => '_limit_free_allocation_vcpu_speed',
                );
                $this->fields['limit_min_allocation_vcpu_speed']                   = array(
                    ONAPP_FIELD_MAP => '_limit_min_allocation_vcpu_speed',
                );
                $this->fields['limit_allocation_vcpu_speed']                       = array(
                    ONAPP_FIELD_MAP => '_limit_allocation_vcpu_speed',
                );

                break;
            case 4.3:
                $this->fields = $this->initFields( 4.2 );
                break;
            case 5.0:
                $this->fields                                          = $this->initFields( 4.3 );
                $this->fields['limit_free_pay_as_you_go_cpu_limit']    = array(
                    ONAPP_FIELD_MAP => '_limit_free_pay_as_you_go_cpu_limit',
                );
                $this->fields['limit_free_pay_as_you_go_memory_limit'] = array(
                    ONAPP_FIELD_MAP => '_limit_free_pay_as_you_go_memory_limit',
                );
                $this->fields['limit_free_pay_as_you_go_cpu_used']     = array(
                    ONAPP_FIELD_MAP => '_limit_free_pay_as_you_go_cpu_used',
                );
                $this->fields['limit_free_pay_as_you_go_memory_used']  = array(
                    ONAPP_FIELD_MAP => '_limit_free_pay_as_you_go_memory_used',
                );
                $this->fields['limit_min_pay_as_you_go_cpu_limit']     = array(
                    ONAPP_FIELD_MAP => '_limit_min_pay_as_you_go_cpu_limit',
                );
                $this->fields['limit_min_pay_as_you_go_memory_limit']  = array(
                    ONAPP_FIELD_MAP => '_limit_min_pay_as_you_go_memory_limit',
                );
                $this->fields['limit_pay_as_you_go_cpu_limit']         = array(
                    ONAPP_FIELD_MAP => '_limit_pay_as_you_go_cpu_limit',
                );
                $this->fields['limit_pay_as_you_go_memory_limit']      = array(
                    ONAPP_FIELD_MAP => '_limit_pay_as_you_go_memory_limit',
                );
                $this->fields['limit_free_disk_size_used']             = array(
                    ONAPP_FIELD_MAP => '_limit_free_disk_size_used',
                );
                $this->fields['limit_min_disk_size_used']              = array(
                    ONAPP_FIELD_MAP => '_limit_min_disk_size_used',
                );
                $this->fields['limit_disk_size_used']                  = array(
                    ONAPP_FIELD_MAP => '_limit_disk_size_used',
                );
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
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

}