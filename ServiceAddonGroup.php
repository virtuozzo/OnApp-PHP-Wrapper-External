<?php
/**
 * Service Add-on Groups
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2017 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Manages Service Add-on Groups
 *
 * This class represents the roles assigned  to the users in this OnApp installation
 *
 * The OnApp_ServiceAddonGroup class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_ServiceAddonGroup extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'service_addon_group';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'service_addon_groups';

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
                    'id'         => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'label'      => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'parent_id'  => array(
                        ONAPP_FIELD_MAP  => '_parent_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'lft'        => array(
                        ONAPP_FIELD_MAP  => '_lft',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'rgt'        => array(
                        ONAPP_FIELD_MAP  => '_rgt',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'depth'      => array(
                        ONAPP_FIELD_MAP  => '_depth',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'created_at' => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'updated_at' => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'icon'       => array(
                        ONAPP_FIELD_MAP   => '_icon',
                        ONAPP_FIELD_CLASS => 'OnApp_ServiceAddonGroup_Icon',
                    ),
                    'children'   => array(
                        ONAPP_FIELD_MAP  => '_children',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    'relations'  => array(
                        ONAPP_FIELD_MAP   => '_relations',
                        ONAPP_FIELD_CLASS => 'array',
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

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }
}
