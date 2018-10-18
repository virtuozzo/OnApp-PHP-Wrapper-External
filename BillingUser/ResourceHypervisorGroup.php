<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Billing Plan Base Resources
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  BillingUser
 * @author      Andrew Yatskovets
 * @copyright   © 2014 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * The OnApp_BillingUser_ResourceHypervisorGroup class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_BillingUser_ResourceHypervisorGroup extends OnApp_BillingUser_BaseResource {
    /**
     * alias processing the object data
     *
     * @var string
     */
//    var $_resource = 'resource_edge_groups';

    /**
     * specified resource name for getList
     *
     * @var string
     */
    var $_specified_resource_name = 'hypervisor_group';

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
                $this->fields['resource_class'] = array(
                    ONAPP_FIELD_MAP           => '_resource_class',
                    ONAPP_FIELD_TYPE          => 'string',
                    ONAPP_FIELD_REQUIRED      => true,
                    ONAPP_FIELD_READ_ONLY     => true,
                    ONAPP_FIELD_DEFAULT_VALUE => 'Resource::HypervisorGroup',
                );

                $this->fields['in_master_zone'] = array(
                    ONAPP_FIELD_MAP  => '_in_master_zone',
                    ONAPP_FIELD_TYPE => 'string',
                );

                $this->fields['master'] = array(
                    ONAPP_FIELD_MAP  => '_master',
                    ONAPP_FIELD_TYPE => 'boolean',
                );

                $this->fields['master_resource_id'] = array(
                    ONAPP_FIELD_MAP  => '_master_resource_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );

                $this->fields['use_cpu_units'] = array(
                    ONAPP_FIELD_MAP  => '_use_cpu_units',
                    ONAPP_FIELD_TYPE => 'string',
                );

                $this->fields['target_type'] = array(
                    ONAPP_FIELD_MAP           => '_target_type',
                    ONAPP_FIELD_TYPE          => 'string',
                    ONAPP_FIELD_REQUIRED      => true,
                    ONAPP_FIELD_DEFAULT_VALUE => 'Pack',
                );

                $this->fields['limit_cpu']               = array(
                    ONAPP_FIELD_MAP  => '_limit_cpu',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['limit_free_cpu']          = array(
                    ONAPP_FIELD_MAP  => '_limit_free_cpu',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['price_on_cpu']            = array(
                    ONAPP_FIELD_MAP  => '_price_on_cpu',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['price_off_cpu']           = array(
                    ONAPP_FIELD_MAP  => '_price_off_cpu',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['limit_default_cpu']       = array(
                    ONAPP_FIELD_MAP  => '_limit_default_cpu',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['use_default_cpu']         = array(
                    ONAPP_FIELD_MAP  => '_use_default_cpu',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['limit_cpu_share']         = array(
                    ONAPP_FIELD_MAP  => '_limit_cpu_share',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['limit_free_cpu_share']    = array(
                    ONAPP_FIELD_MAP  => '_limit_free_cpu_share',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['price_on_cpu_share']      = array(
                    ONAPP_FIELD_MAP  => '_price_on_cpu_share',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['price_off_cpu_share']     = array(
                    ONAPP_FIELD_MAP  => '_price_off_cpu_share',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['limit_default_cpu_share'] = array(
                    ONAPP_FIELD_MAP  => '_limit_default_cpu_share',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['use_default_cpu_share']   = array(
                    ONAPP_FIELD_MAP  => '_use_default_cpu_share',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['limit_memory']            = array(
                    ONAPP_FIELD_MAP  => '_limit_memory',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['limit_free_memory']       = array(
                    ONAPP_FIELD_MAP  => '_limit_free_memory',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['price_on_memory']         = array(
                    ONAPP_FIELD_MAP  => '_price_on_memory',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['price_off_memory']        = array(
                    ONAPP_FIELD_MAP  => '_price_off_memory',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['limit_cpu_units']         = array(
                    ONAPP_FIELD_MAP  => '_limit_cpu_units',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['limit_free_cpu_units']    = array(
                    ONAPP_FIELD_MAP  => '_limit_free_cpu_units',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['price_on_cpu_units']      = array(
                    ONAPP_FIELD_MAP  => '_price_on_cpu_units',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['price_off_cpu_units']     = array(
                    ONAPP_FIELD_MAP  => '_price_off_cpu_units',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['limit_min_memory']        = array(
                    ONAPP_FIELD_MAP  => '_limit_min_memory',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['limit_min_cpu_priority']  = array(
                    ONAPP_FIELD_MAP  => '_limit_min_cpu_priority',
                    ONAPP_FIELD_TYPE => 'string',
                );

                break;
            case 4.3:
                $this->fields = $this->initFields( 4.2 );
                break;
            case 5.0:
                $this->fields = $this->initFields( 4.3 );
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

        $this->fields['id'][ ONAPP_FIELD_REQUIRED ] = false;

        foreach ( array( 'unit', 'limit', 'limit_free', 'price', 'price_on', 'price_off' ) as $field ) {
            unset( $this->fields[ $field ] );
        }

        return $this->fields;
    }

    public function editCPULimits( $limit_cpu = null, $limit_free_cpu = null, $price_on_cpu = null, $price_off_cpu = null, $limit_default_cpu = null ) {
        $dataArray = array();
        if ( $limit_cpu != null ) {
            $dataArray['limit_cpu'] = $limit_cpu;
        }
        if ( $limit_free_cpu != null ) {
            $dataArray['limit_free_cpu'] = $limit_free_cpu;
        }
        if ( $price_on_cpu != null ) {
            $dataArray['price_on_cpu'] = $price_on_cpu;
        }
        if ( $price_off_cpu != null ) {
            $dataArray['price_off_cpu'] = $price_off_cpu;
        }
        if ( $limit_default_cpu != null ) {
            $dataArray['limit_default_cpu'] = $limit_default_cpu;
        }

        if ( !is_countable($dataArray) || count( $dataArray ) == 0 ) {
            return false;
        }
        $data = array(
            'root' => 'resource',
            'data' => $dataArray,
        );
        $this->sendPut( ONAPP_GETRESOURCE_LOAD, $data );
    }

    public function resetCPULimitsToDefault() {
        $dataArray = array(
            'use_default_cpu' => true,
        );
        $data      = array(
            'root' => 'resource',
            'data' => $dataArray,
        );
        $this->sendPut( ONAPP_GETRESOURCE_LOAD, $data );
    }

    public function editCPUShareLimits( $limit_cpu_share = null, $limit_free_cpu_share = null, $price_on_cpu_share = null, $price_off_cpu_share = null, $limit_default_cpu_share = null ) {
        $dataArray = array();
        if ( $limit_cpu_share != null ) {
            $dataArray['limit_cpu_share'] = $limit_cpu_share;
        }
        if ( $limit_free_cpu_share != null ) {
            $dataArray['limit_free_cpu_share'] = $limit_free_cpu_share;
        }
        if ( $price_on_cpu_share != null ) {
            $dataArray['price_on_cpu_share'] = $price_on_cpu_share;
        }
        if ( $price_off_cpu_share != null ) {
            $dataArray['price_off_cpu_share'] = $price_off_cpu_share;
        }
        if ( $limit_default_cpu_share != null ) {
            $dataArray['limit_default_cpu_share'] = $limit_default_cpu_share;
        }

        if ( !is_countable($dataArray) || count( $dataArray ) == 0 ) {
            return false;
        }
        $data = array(
            'root' => 'resource',
            'data' => $dataArray,
        );
        $this->sendPut( ONAPP_GETRESOURCE_LOAD, $data );
    }

    public function resetCPUShareLimitsToDefault() {
        $dataArray = array(
            'use_default_cpu_share' => true,
        );
        $data      = array(
            'root' => 'resource',
            'data' => $dataArray,
        );
        $this->sendPut( ONAPP_GETRESOURCE_LOAD, $data );
    }

    public function editMemoryLimits( $limit_memory = null, $limit_free_memory = null, $price_on_memory = null, $price_off_memory = null ) {
        $dataArray = array();
        if ( $limit_memory != null ) {
            $dataArray['limit_memory'] = $limit_memory;
        }
        if ( $limit_free_memory != null ) {
            $dataArray['limit_free_memory'] = $limit_free_memory;
        }
        if ( $price_on_memory != null ) {
            $dataArray['price_on_memory'] = $price_on_memory;
        }
        if ( $price_off_memory != null ) {
            $dataArray['price_off_memory'] = $price_off_memory;
        }

        if ( !is_countable($dataArray) || count( $dataArray ) == 0 ) {
            return false;
        }
        $data = array(
            'root' => 'resource',
            'data' => $dataArray,
        );
        $this->sendPut( ONAPP_GETRESOURCE_LOAD, $data );
    }

    public function editCPUUnitsLimits( $limit_cpu_units = null, $limit_free_cpu_units = null, $price_on_cpu_units = null, $price_off_cpu_units = null ) {
        $dataArray = array();
        if ( $limit_cpu_units != null ) {
            $dataArray['limit_cpu_units'] = $limit_cpu_units;
        }
        if ( $limit_free_cpu_units != null ) {
            $dataArray['limit_free_cpu_units'] = $limit_free_cpu_units;
        }
        if ( $price_on_cpu_units != null ) {
            $dataArray['price_on_cpu_units'] = $price_on_cpu_units;
        }
        if ( $price_off_cpu_units != null ) {
            $dataArray['price_off_cpu_units'] = $price_off_cpu_units;
        }

        if ( !is_countable($dataArray) || count( $dataArray ) == 0 ) {
            return false;
        }
        $data = array(
            'root' => 'resource',
            'data' => $dataArray,
        );
        $this->sendPut( ONAPP_GETRESOURCE_LOAD, $data );
    }

}

