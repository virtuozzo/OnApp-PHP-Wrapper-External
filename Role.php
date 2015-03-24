<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Roles
 *
 * A role is a set of actions users are allowed to perform. OnApp allows you to
 * assign users roles and permissions to define who has access to OnApp and what
 * actions they can perform. OnApp maps users to the certain roles, and you can
 * restrict which operations each user role can perform. Users are not assigned
 * permissions directly, but acquire them through the roles. So granting users
 * with the ability to perform actions becomes a matter of assigning them to the
 * specific role. Users are assigned roles during the creation process.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Manages User Roles
 *
 * This class represents the roles assigned  to the users in this OnApp installation
 *
 * The OnApp_Role class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Role extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'role';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'roles';

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
            case '2.0':
            case '2.1':
            case 2.2:
                $this->fields = array(
                    'id'             => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'created_at'     => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'identifier'     => array(
                        ONAPP_FIELD_MAP  => '_identifier',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'permissions'    => array(
                        ONAPP_FIELD_MAP   => '_permissions',
                        ONAPP_FIELD_TYPE  => 'array',
                        ONAPP_FIELD_CLASS => 'Role_Permission',
                    ),
                    'label'          => array(
                        ONAPP_FIELD_MAP      => '_label',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'updated_at'     => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'permission_ids' => array(
                        ONAPP_FIELD_MAP       => '_permission_ids',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                break;

            case 2.3:
                $this->fields = $this->initFields( 2.2 );
                $fields       = array(
                    'permission_ids',
                );
                $this->unsetFields( $fields );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
                $this->fields = $this->initFields( 2.3 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        return parent::getResource( $action );
        /**
         * ROUTE :
         *
         * @name roles
         * @method GET
         * @alias   /roles(.:format)
         * @format  {:controller=>"roles", :action=>"index"}
         */
        /**
         * ROUTE :
         *
         * @name role
         * @method GET
         * @alias   /roles/:id(.:format)
         * @format  {:controller=>"roles", :action=>"show"}
         */
        /**
         * ROUTE :
         *
         * @name
         * @method POST
         * @alias   /roles(.:format)
         * @format  {:controller=>"roles", :action=>"create"}
         */
        /**
         * ROUTE :
         *
         * @name
         * @method PUT
         * @alias  /roles/:id(.:format)
         * @format {:controller=>"roles", :action=>"update"}
         */
        /**
         * ROUTE :
         *
         * @name
         * @method DELETE
         * @alias  /roles/:id(.:format)
         * @format {:controller=>"roles", :action=>"destroy"}
         */
    }
}
