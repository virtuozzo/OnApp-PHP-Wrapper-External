<?php
/**
 * Managing Settings HardwareInfo CpuSockets
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

class OnApp_Settings_HardwareInfo_CpuSockets extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'cpu_sockets';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'cpu_sockets';

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
                    'id'                => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'version'           => array(
                        ONAPP_FIELD_MAP         => '_version',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'current_speed'     => array(
                        ONAPP_FIELD_MAP         => '_current_speed',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'manufacturer'      => array(
                        ONAPP_FIELD_MAP         => '_manufacturer',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'socket_type'       => array(
                        ONAPP_FIELD_MAP         => '_socket_type',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'status'            => array(
                        ONAPP_FIELD_MAP         => '_status',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                );

                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

}