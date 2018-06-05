<?php
/**
 * Managing Asset
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2017 OnApp
 * @link        http://www.onapp.com/
 * @docs        https://docs.onapp.com/display/55API
 * @see         OnApp
 */

/**
 * Managing Sif Groups
 *
 *
 * The OnApp_SIF_Page class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( https://docs.onapp.com/display/42API/Assets )
 */
class OnApp_SIF_Page extends OnApp_Hypervisor {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'iframe';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/sif/pages';

    /**
     * API Fields description
     *
     * @param string|float $version OnApp API version
     * @param string $className current class' name
     *
     * @return array
     */
    public function initFields( $version = null, $className = '' ) {
        parent::initFields( $version, __CLASS__ );

        switch ( $version ) {
            case 5.5:
                $this->fields = array(

                    'id'  => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'url'  => array(
                        ONAPP_FIELD_MAP  => '_url',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'user_credentials'  => array(
                        ONAPP_FIELD_MAP  => '_user_credentials',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'credentials_parameter'  => array(
                        ONAPP_FIELD_MAP  => '_credentials_parameter',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'custom_field'  => array(
                        ONAPP_FIELD_MAP  => '_custom_field',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'custom_field_parameter'  => array(
                        ONAPP_FIELD_MAP  => '_custom_field_parameter',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'custom_name'  => array(
                        ONAPP_FIELD_MAP  => '_custom_name',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'created_at'  => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'updated_at'  => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'legacy_mode'  => array(
                        ONAPP_FIELD_MAP  => '_legacy_mode',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'weight'  => array(
                        ONAPP_FIELD_MAP  => '_weight',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'credentials_type'  => array(
                        ONAPP_FIELD_MAP  => '_credentials_type',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'iframe_group_ids'  => array(
                        ONAPP_FIELD_MAP  => '_iframe_group_ids',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                break;
        }


        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            default:
                /**
                 * @alias   /settings/sif/groups.json
                 */
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;

    }
}