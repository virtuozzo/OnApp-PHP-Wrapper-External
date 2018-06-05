<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 *  Company Billing Plan Base Resources VCloud Compute Zone
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  BillingCompany
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * The OnApp_BillingCompany_ResourceVCloudComputeZone class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_BillingCompany_ResourceVCloudComputeZone extends OnApp_BillingCompany_BaseResource {
    /**
     * alias processing the object data
     *
     * @var string
     */
//    var $_resource = 'resource_edge_groups';

    /**
     * API Fields description
     *
     * @param string|float $version OnApp API version
     * @param string $className current class' name
     *
     * @return array
     */
    public function initFields( $version = null, $className = '' ) {
        parent::initFields( $version, __CLASS__ );

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
                $this->fields['resource_class']                                    = array(
                    ONAPP_FIELD_MAP           => '_resource_class',
                    ONAPP_FIELD_TYPE          => 'string',
                    ONAPP_FIELD_REQUIRED      => true,
                    ONAPP_FIELD_READ_ONLY     => true,
                    ONAPP_FIELD_DEFAULT_VALUE => 'Billing::Company::Resource::VCloud::ComputeZone',
                );
                $this->fields['limit_free_allocation_cpu_allocation']              = array(
                    ONAPP_FIELD_MAP  => '_limit_free_allocation_cpu_allocation',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_min_allocation_cpu_allocation']               = array(
                    ONAPP_FIELD_MAP  => '_limit_min_allocation_cpu_allocation',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_allocation_cpu_allocation']                   = array(
                    ONAPP_FIELD_MAP  => '_limit_allocation_cpu_allocation',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['price_allocation_cpu_allocation']                   = array(
                    ONAPP_FIELD_MAP  => '_price_allocation_cpu_allocation',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_free_allocation_cpu_resources_guaranteed']    = array(
                    ONAPP_FIELD_MAP  => '_limit_free_allocation_cpu_resources_guaranteed',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_min_allocation_cpu_resources_guaranteed']     = array(
                    ONAPP_FIELD_MAP  => '_limit_min_allocation_cpu_resources_guaranteed',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_allocation_cpu_resources_guaranteed']         = array(
                    ONAPP_FIELD_MAP  => '_limit_allocation_cpu_resources_guaranteed',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['price_allocation_cpu_resources_guaranteed']         = array(
                    ONAPP_FIELD_MAP  => '_price_allocation_cpu_resources_guaranteed',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_free_allocation_memory_allocation']           = array(
                    ONAPP_FIELD_MAP  => '_limit_free_allocation_memory_allocation',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_min_allocation_memory_allocation']            = array(
                    ONAPP_FIELD_MAP  => '_limit_min_allocation_memory_allocation',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_allocation_memory_allocation']                = array(
                    ONAPP_FIELD_MAP  => '_limit_allocation_memory_allocation',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['price_allocation_memory_allocation']                = array(
                    ONAPP_FIELD_MAP  => '_price_allocation_memory_allocation',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_free_allocation_memory_resources_guaranteed'] = array(
                    ONAPP_FIELD_MAP  => '_limit_free_allocation_memory_resources_guaranteed',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_min_allocation_memory_resources_guaranteed']  = array(
                    ONAPP_FIELD_MAP  => '_limit_min_allocation_memory_resources_guaranteed',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_allocation_memory_resources_guaranteed']      = array(
                    ONAPP_FIELD_MAP  => '_limit_allocation_memory_resources_guaranteed',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['price_allocation_memory_resources_guaranteed']      = array(
                    ONAPP_FIELD_MAP  => '_price_allocation_memory_resources_guaranteed',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_free_allocation_vcpu_speed']                  = array(
                    ONAPP_FIELD_MAP  => '_limit_free_allocation_vcpu_speed',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_min_allocation_vcpu_speed']                   = array(
                    ONAPP_FIELD_MAP  => '_limit_min_allocation_vcpu_speed',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_allocation_vcpu_speed']                       = array(
                    ONAPP_FIELD_MAP  => '_limit_allocation_vcpu_speed',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['price_allocation_vcpu_speed']                       = array(
                    ONAPP_FIELD_MAP  => '_price_allocation_vcpu_speed',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_free_reservation_cpu_allocation']             = array(
                    ONAPP_FIELD_MAP  => '_limit_free_reservation_cpu_allocation',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_min_reservation_cpu_allocation']              = array(
                    ONAPP_FIELD_MAP  => '_limit_min_reservation_cpu_allocation',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_reservation_cpu_allocation']                  = array(
                    ONAPP_FIELD_MAP  => '_limit_reservation_cpu_allocation',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['price_reservation_cpu_allocation']                  = array(
                    ONAPP_FIELD_MAP  => '_price_reservation_cpu_allocation',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_free_reservation_memory_allocation']          = array(
                    ONAPP_FIELD_MAP  => '_limit_free_reservation_memory_allocation',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_min_reservation_memory_allocation']           = array(
                    ONAPP_FIELD_MAP  => '_limit_min_reservation_memory_allocation',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_reservation_memory_allocation']               = array(
                    ONAPP_FIELD_MAP  => '_limit_reservation_memory_allocation',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['price_reservation_memory_allocation']               = array(
                    ONAPP_FIELD_MAP  => '_price_reservation_memory_allocation',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['target_type']                                       = array(
                    ONAPP_FIELD_MAP           => '_target_type',
                    ONAPP_FIELD_TYPE          => 'string',
                    ONAPP_FIELD_REQUIRED      => true,
                    ONAPP_FIELD_DEFAULT_VALUE => 'Pack',
                );
                break;
            case 4.3:
                $this->fields = $this->initFields( 4.2 );
                break;
            case 5.0:
                $this->fields                                               = $this->initFields( 4.3 );
                $this->fields['limit_free_pay_as_you_go_cpu_limit']         = array(
                    ONAPP_FIELD_MAP  => '_limit_free_pay_as_you_go_cpu_limit',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_free_pay_as_you_go_memory_limit']      = array(
                    ONAPP_FIELD_MAP  => '_limit_free_pay_as_you_go_memory_limit',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_free_pay_as_you_go_cpu_used']          = array(
                    ONAPP_FIELD_MAP  => '_limit_free_pay_as_you_go_cpu_used',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_free_pay_as_you_go_memory_used']       = array(
                    ONAPP_FIELD_MAP  => '_limit_free_pay_as_you_go_memory_used',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_min_pay_as_you_go_cpu_limit']          = array(
                    ONAPP_FIELD_MAP  => '_limit_min_pay_as_you_go_cpu_limit',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_min_pay_as_you_go_memory_limit']       = array(
                    ONAPP_FIELD_MAP  => '_limit_min_pay_as_you_go_memory_limit',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_pay_as_you_go_cpu_limit']              = array(
                    ONAPP_FIELD_MAP  => '_limit_pay_as_you_go_cpu_limit',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['limit_pay_as_you_go_memory_limit']           = array(
                    ONAPP_FIELD_MAP  => '_limit_pay_as_you_go_memory_limit',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['price_pay_as_you_go_cpu_limit']              = array(
                    ONAPP_FIELD_MAP  => '_price_pay_as_you_go_cpu_limit',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['price_pay_as_you_go_memory_limit']           = array(
                    ONAPP_FIELD_MAP  => '_price_pay_as_you_go_memory_limit',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['price_pay_as_you_go_cpu_used']               = array(
                    ONAPP_FIELD_MAP  => '_price_pay_as_you_go_cpu_used',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['price_pay_as_you_go_memory_used']            = array(
                    ONAPP_FIELD_MAP  => '_price_pay_as_you_go_memory_used',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['price_pay_as_you_go_cpu_limit_unlimited']    = array(
                    ONAPP_FIELD_MAP  => '_price_pay_as_you_go_cpu_limit_unlimited',
                    ONAPP_FIELD_TYPE => 'integer'
                );
                $this->fields['price_pay_as_you_go_memory_limit_unlimited'] = array(
                    ONAPP_FIELD_MAP  => '_price_pay_as_you_go_memory_limit_unlimited',
                    ONAPP_FIELD_TYPE => 'integer'
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

        return $this->fields;
    }

}

