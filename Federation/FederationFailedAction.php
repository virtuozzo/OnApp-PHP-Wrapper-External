<?php

/**
 * Manages List of Failed Actions
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  Federation
 * @author
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
class OnApp_Federation_FederationFailedAction extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'federation_failed_action';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'failed_actions';

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
                    'action'             => array(
                        ONAPP_FIELD_MAP  => '_action',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'created_at'         => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'errors'             => array(
                        ONAPP_FIELD_MAP  => '_errors',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    'id'                 => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'updated_at'         => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'virtual_machine_id' => array(
                        ONAPP_FIELD_MAP  => '_virtual_machine_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                $resourceAdd = '';
                if ( ! is_null( $this->_virtual_machine_id ) ) {
                    $resourceAdd = 'virtual_machines/' . $this->_virtual_machine_id . '/';
                }
                $resource = '/federation/' . $resourceAdd . $this->_resource;
                break;

            default:
                $resource = parent::getResource( $action );
                break;

        }

        return $resource;
    }

}