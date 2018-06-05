<?php
/**
 * Service Addon Group Relations
 *
 * @category        API wrapper
 * @package         OnApp
 * @subpackage      ServiceAddonGroup
 * @author
 * @copyright       © 2017 OnApp
 * @link            http://www.onapp.com/
 * @see             OnApp
 */

/**
 * Service Addon Group Relations
 *
 * This class represents the Disk which have been taken or are waiting to be taken for Virtual Machine.
 *
 * The OnApp_ServiceAddonGroup_Relations class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, {@link getList}.
 *
 */
class OnApp_ServiceAddonGroup_Relations extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'service_addon_group_relation';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'service_addon_group_relations';

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
            case 5.5:
                $this->fields = array(
                    'id'                                => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'service_addon_id'                  => array(
                        ONAPP_FIELD_MAP  => '_service_addon_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'service_addon_group_id'            => array(
                        ONAPP_FIELD_MAP  => '_service_addon_group_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'price'            => array(
                        ONAPP_FIELD_MAP  => '_price',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'created_at'                        => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime'
                    ),
                    'updated_at'                        => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime'
                    ),
                    'service_addon'                        => array(
                        ONAPP_FIELD_MAP  => '_service_addon',
                        ONAPP_FIELD_CLASS => 'OnApp_ServiceAddonGroup_Relations_ServiceAddon',
                    ),
                );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    /**
     * Returns the URL Alias of the API Class that inherits the OnApp class
     *
     * @param string $action action name
     *
     * @return string API resource
     * @access public
     */
    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                if ( is_null( $this->_service_addon_group_id ) && is_null( $this->_obj->_service_addon_group_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _service_addon_group_id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_service_addon_group_id ) ) {
                        $this->_service_addon_group_id = $this->_obj->_service_addon_group_id;
                    }
                }

                $resource = 'service_addon_groups/' . $this->_service_addon_group_id . '/' . $this->_resource;
                break;

            default:
                $resource = parent::getResource( $action );

                break;
        }

        return $resource;
    }

}
