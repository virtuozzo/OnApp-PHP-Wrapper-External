<?php
/**
 * Managing Bucket AccessControls Preferences
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

class OnApp_Bucket_AccessControls_Preferences extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'preferences';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'preferences';

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
                    'hypervisor_group_ids'  => array(
                        ONAPP_FIELD_MAP       => '_hypervisor_group_ids',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'data_store_group_ids'  => array(
                        ONAPP_FIELD_MAP       => '_data_store_group_ids',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'network_group_ids'     => array(
                        ONAPP_FIELD_MAP       => '_network_group_ids',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                );

                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

}