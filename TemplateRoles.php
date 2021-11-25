<?php

/**
 * TemplateRoles
 *
 * @category        API wrapper
 * @package         OnApp
 * @author          Mykola Vuy
 * @copyright       © 2020 OnApp
 */

/**
 * TemplateRoles
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_NSX_Edges class uses the following basic methods:
 * {@link load} and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_TemplateRoles extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'template_role';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'template_roles';
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
            case 6.4:
                $this->fields = array(
                    'id'                    => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'label'                 => array(
                        ONAPP_FIELD_MAP         => '_label',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'identifier'            => array(
                        ONAPP_FIELD_MAP         => '_identifier',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'created_at'            => array(
                        ONAPP_FIELD_MAP         => '_created_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'updated_at'            => array(
                        ONAPP_FIELD_MAP         => '_updated_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'users_count'           => array(
                        ONAPP_FIELD_MAP         => '_users_count',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'system'                => array(
                        ONAPP_FIELD_MAP         => '_system',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                );
                break;

            case 6.5:
                $this->fields = $this->initFields( 6.4 );
                break;

            case 6.6:
                $this->fields = $this->initFields( 6.5 );
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
                /**
                 * ROUTE :
                 *
                 * @name Get Role Templates
                 * @method GET
                 * @alias  /template_roles(.:format)
                 * @format {:controller=>"TemplateRoles", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Get a list of role templates by ID
                 * @method GET
                 * @alias  /template_roles/:id(.:format)
                 * @format {:controller=>"TemplateRoles", :action=>"load"}
                 */

                $resource = $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    /**
     * Activates action performed with object
     *
     * @param string $action_name the name of action
     *
     * @access public
     */
    function activateCheck( $action_name ) {
        switch ( $action_name ) {
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}
