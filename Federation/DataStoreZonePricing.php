<?php

/**
 * Manages Data Store Zone Pricing
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  Federation
 * @author      Bohdan Zemlyanskyi
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
class OnApp_Federation_DataStoreZonePricing extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'data_store_zone_pricing';
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
                    'data_read'       => array(
                        ONAPP_FIELD_MAP  => '_limit_free',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'data_write'      => array(
                        ONAPP_FIELD_MAP  => '_data_write',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'disk_size_max'   => array(
                        ONAPP_FIELD_MAP  => '_disk_size_max',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'disk_size_off'   => array(
                        ONAPP_FIELD_MAP  => '_disk_size_off',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'disk_size_on'    => array(
                        ONAPP_FIELD_MAP  => '_disk_size_on',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'input_requests'  => array(
                        ONAPP_FIELD_MAP  => '_input_requests',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'output_requests' => array(
                        ONAPP_FIELD_MAP  => '_output_requests',
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
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

}