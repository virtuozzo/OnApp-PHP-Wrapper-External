<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Service Addon
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2017 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Manages Service Addons
 *
 * This class represents the roles assigned  to the users in this OnApp installation
 *
 * The OnApp_ServiceAddon class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_ServiceAddon extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'service_addon';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'service_addons';

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
            case 5.3:
                $this->fields = array(
                    'id'             => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                    ),
                    'label'          => array(
                        ONAPP_FIELD_MAP      => '_label',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'description'     => array(
                        ONAPP_FIELD_MAP  => '_description',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'compatible_with'     => array(
                        ONAPP_FIELD_MAP  => '_compatible_with',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    'user_id'     => array(
                        ONAPP_FIELD_MAP  => '_user_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'icon'     => array(
                        ONAPP_FIELD_MAP  => '_icon',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    'created_at'     => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                    ),
                    'updated_at'     => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                    ),
                );
                break;
            case 5.4:
                $this->fields = $this->initFields( 5.3 );
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
                $this->fields['available_on_vm_provisioning'] = array(
                    ONAPP_FIELD_MAP  => '_available_on_vm_provisioning',
                    ONAPP_FIELD_TYPE => 'string',
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
                /**
                 * ROUTE :
                 *
                 * @name service_addons
                 * @method GET
                 * @alias   /service_addons(.:format)
                 * @format  {:controller=>"roles", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name service_addons
                 * @method GET
                 * @alias   /service_addons/:id(.:format)
                 * @format  {:controller=>"roles", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias   /service_addons(.:format)
                 * @format  {:controller=>"service_addons", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method PUT
                 * @alias  /service_addons/:id(.:format)
                 * @format {:controller=>"service_addons", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method DELETE
                 * @alias  /service_addons/:id(.:format)
                 * @format {:controller=>"service_addons", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
                break;

        }

        return $resource;
    }
}
