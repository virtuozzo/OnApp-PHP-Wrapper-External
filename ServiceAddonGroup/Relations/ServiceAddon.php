<?php

/**
 * Manages ServiceAddonGroup Relations ServiceAddon
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  ServiceAddonGroup
 * @author
 * @copyright   © 2017 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
class OnApp_ServiceAddonGroup_Relations_ServiceAddon extends OnApp {
    var $_tagRoot = 'service_addon';

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
            case 5.4:
                $this->fields = array(
                    'id'                           => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'label'                        => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'description'                  => array(
                        ONAPP_FIELD_MAP  => '_description',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'compatible_with'              => array(
                        ONAPP_FIELD_MAP  => '_compatible_with',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    'user_id'                      => array(
                        ONAPP_FIELD_MAP  => '_user_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'icon'                         => array(
                        ONAPP_FIELD_MAP   => '_icon',
                        ONAPP_FIELD_CLASS => 'OnApp_ServiceAddonGroup_Icon',
                    ),
                    'created_at'                   => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime'
                    ),
                    'updated_at'                   => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime'
                    ),
                    'available_on_vm_provisioning' => array(
                        ONAPP_FIELD_MAP  => '_available_on_vm_provisioning',
                        ONAPP_FIELD_TYPE => 'boolean'
                    ),
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }
}