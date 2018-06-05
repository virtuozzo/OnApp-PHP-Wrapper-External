<?php
/**
 * Managing Settings HardwareInfo Children
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

class OnApp_Settings_HardwareInfo_Children extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'children';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'children';

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
                    'label'         => array(
                        ONAPP_FIELD_MAP         => '_label',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'slot_id'         => array(
                        ONAPP_FIELD_MAP         => '_slot_id',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'parent_id'         => array(
                        ONAPP_FIELD_MAP         => '_parent_id',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'children'      => array(
                        ONAPP_FIELD_MAP         => '_children',
                        ONAPP_FIELD_CLASS       => 'OnApp_Settings_HardwareInfo_Children',
                    ),
                    'relations'      => array(
                        ONAPP_FIELD_MAP         => '_relations',
                        ONAPP_FIELD_CLASS       => 'OnApp_Settings_HardwareInfo_Relations',
                    ),
                );

                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

}
