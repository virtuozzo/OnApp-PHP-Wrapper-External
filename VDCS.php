<?php
/**
 * Managing VDCS
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Edge Gateways
 *
 */
class OnApp_VDCS extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'vdc';

    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'vdcs';

    /**
     * API Fields description
     *
     * @param string|float $version   OnApp API version
     * @param string       $className current class' name
     *
     * @return array
     */
    public function initFields( $version = null, $className = '' ) {
        switch( $version ) {
            case 4.0:
            case 4.1:
                $this->fields = array(
                    'id' => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'allocation_model' => array(
                        ONAPP_FIELD_MAP       => '_allocation_model',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'cpu_allocated' => array(
                        ONAPP_FIELD_MAP       => '_cpu_allocated',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'cpu_limit' => array(
                        ONAPP_FIELD_MAP       => '_cpu_limit',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'label' => array(
                        ONAPP_FIELD_MAP       => '_label',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch( $action ) {
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }
}