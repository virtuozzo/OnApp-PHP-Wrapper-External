<?php

/**
 * Manages Network Zone Pricing
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  Federation
 * @author
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
class OnApp_Federation_NetworkZonePricing extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'network_zone_pricing';
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
                    'data_rxed'        => array(
                        ONAPP_FIELD_MAP  => '_data_rxed',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'data_sent'        => array(
                        ONAPP_FIELD_MAP  => '_data_sent',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'ip_addresses_max' => array(
                        ONAPP_FIELD_MAP  => '_ip_addresses_max',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'ip_addresses_off' => array(
                        ONAPP_FIELD_MAP  => '_ip_addresses_off',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'ip_addresses_on'  => array(
                        ONAPP_FIELD_MAP  => '_ip_addresses_on',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'port_speed'       => array(
                        ONAPP_FIELD_MAP  => '_port_speed',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'port_speed_max'   => array(
                        ONAPP_FIELD_MAP  => '_port_speed_max',
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

            case 6.1:
                $this->fields = $this->initFields( 6.0 );
                break;

            case 6.2:
                $this->fields = $this->initFields( 6.1 );
                break;

            case 6.3:
                $this->fields = $this->initFields( 6.2 );
                break;

            case 6.4:
                $this->fields = $this->initFields( 6.3 );
                break;

            case 6.5:
                $this->fields = $this->initFields( 6.4 );
                break;

            case 6.6:
                $this->fields = $this->initFields( 6.5 );
                break;

            case 6.7:
                $this->fields = $this->initFields( 6.6 );
                break;

            default:
                $this->fields = $this->initFields( 6.7 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

}