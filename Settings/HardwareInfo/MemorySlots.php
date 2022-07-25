<?php
/**
 * Managing Settings HardwareInfo MemorySlots
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

class OnApp_Settings_HardwareInfo_MemorySlots extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'memory_slots';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'memory_slots';

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
                    'locator'           => array(
                        ONAPP_FIELD_MAP         => '_locator',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'size'              => array(
                        ONAPP_FIELD_MAP         => '_size',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'speed'             => array(
                        ONAPP_FIELD_MAP         => '_speed',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'type'              => array(
                        ONAPP_FIELD_MAP         => '_type',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                );

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