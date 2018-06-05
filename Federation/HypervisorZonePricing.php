<?php

/**
 * Manages Hypervisor Zone Pricing
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  Federation
 * @author
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
class OnApp_Federation_HypervisorZonePricing extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'hypervisor_zone_pricing';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'federation/hypervisor_zones';

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
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
            case 4.2:
                $this->fields = array(
                    'cpu_max'          => array(
                        ONAPP_FIELD_MAP  => '_cpu_max',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'cpu_off'          => array(
                        ONAPP_FIELD_MAP  => '_cpu_off',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'cpu_on'           => array(
                        ONAPP_FIELD_MAP  => '_cpu_on',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'cpu_priority_max' => array(
                        ONAPP_FIELD_MAP  => '_cpu_priority_max',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'cpu_priority_off' => array(
                        ONAPP_FIELD_MAP  => '_cpu_priority_off',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'cpu_priority_on'  => array(
                        ONAPP_FIELD_MAP  => '_cpu_priority_on',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'memory_max'       => array(
                        ONAPP_FIELD_MAP  => '_memory_max',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'memory_off'       => array(
                        ONAPP_FIELD_MAP  => '_memory_off',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'memory_on'        => array(
                        ONAPP_FIELD_MAP  => '_memory_on',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
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

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

}