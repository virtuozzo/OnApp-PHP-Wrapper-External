<?php
/**
 * Managing Settings HardwareInfo Relations
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

class OnApp_Settings_HardwareInfo_Relations extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'relations';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'relations';

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
                    'label'             => array(
                        ONAPP_FIELD_MAP         => '_label',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'value'             => array(
                        ONAPP_FIELD_MAP         => '_value',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'id'                => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                );

                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

}
