<?php

/**
 * Template_SystemServiceAddons
 *
 * @category        API wrapper
 * @package         OnApp
 * @author          Mykola Vuy
 * @copyright       © 2020 OnApp
 */

/**
 * Template_SystemServiceAddons
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_NSX_Edges class uses the following basic methods:
 * {@link load} and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */

/**
 *
 */
define( 'ONAPP_ASSIGN_SYSTEM_SERVICE_ADD_ON_TO_TEMPLATE', 'assign_add_on_to_template' );

/**
 *
 */
define( 'ONAPP_UNASSIGN_SYSTEM_SERVICE_ADD_ON_FROM_TEMPLATE', 'unassign_add_on_from_template' );

class OnApp_Template_SystemServiceAddons extends OnApp {
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
    var $_resource = 'system_service_addons';
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
                    'id'                            => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'label'                         => array(
                        ONAPP_FIELD_MAP         => '_label',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'description'                   => array(
                        ONAPP_FIELD_MAP         => '_description',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'compatible_with'               => array(
                        ONAPP_FIELD_MAP         => '_compatible_with',
                        ONAPP_FIELD_TYPE        => '_array',
                    ),
                    'user_id'                       => array(
                        ONAPP_FIELD_MAP         => '_user_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'icon'                          => array(
                        ONAPP_FIELD_MAP         => '_icon',
                        ONAPP_FIELD_TYPE        => '_array',
                    ),
                    'created_at'                    => array(
                        ONAPP_FIELD_MAP         => '_created_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'updated_at'                    => array(
                        ONAPP_FIELD_MAP         => '_updated_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'available_on_vm_provisioning'  => array(
                        ONAPP_FIELD_MAP         => '_available_on_vm_provisioning',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'system'                        => array(
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
                 * @name Get a List of System Service Add-ons Assigned to Template
                 * @method GET
                 * @alias  /templates/:template_id/system_service_addons(.:format)
                 * @format {:controller=>"Template_SystemServiceAddons", :action=>"index"}
                 */
                if ( is_null( $this->_template_id ) && is_null( $this->_obj->_template_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _template_id not set.",
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_template_id ) ) {
                        $this->_template_id = $this->_obj->_template_id;
                    }
                }

                $resource = 'templates/' . $this->_template_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            case ONAPP_ASSIGN_SYSTEM_SERVICE_ADD_ON_TO_TEMPLATE:
                /**
                 * ROUTE :
                 *
                 * @name Assign System Service Add-on to Template
                 * @method POST
                 * @alias  /templates/:template_id/system_service_addons(.:format)
                 * @format {:controller=>"Template_SystemServiceAddons", :action=>"assignToTemplate"}
                 */

                if ( is_null( $this->_template_id ) && is_null( $this->_obj->_template_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _template_id not set.",
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_template_id ) ) {
                        $this->_template_id = $this->_obj->_template_id;
                    }
                }

                $resource = 'templates/' . $this->_template_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            case ONAPP_UNASSIGN_SYSTEM_SERVICE_ADD_ON_FROM_TEMPLATE:
                /**
                 * ROUTE :
                 *
                 * @name Unassign System Service Add-on from Template
                 * @method DELETE
                 * @alias  /templates/:template_id/system_service_addons/:service_addon_id(.:format)
                 * @format {:controller=>"Template_SystemServiceAddons", :action=>"unassignFromTemplate"}
                 */

                if ( is_null( $this->_template_id ) && is_null( $this->_obj->_template_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _template_id not set.",
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_template_id ) ) {
                        $this->_template_id = $this->_obj->_template_id;
                    }
                }

                if ( is_null( $this->_service_addon_id ) && is_null( $this->_obj->_service_addon_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument service_addon_id not set.",
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_service_addon_id ) ) {
                        $this->_service_addon_id = $this->_obj->_service_addon_id;
                    }
                }

                $resource = 'templates/' . $this->_template_id . '/' . $this->_resource . '/' . $this->_service_addon_id;
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
            case ONAPP_ACTIVATE_LOAD:
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }

    public function assignToTemplate()
    {
        if ( is_null( $this->_service_addon_id ) && is_null( $this->_obj->_service_addon_id ) ) {
            $this->logger->error(
                "assignToTemplate: argument service_addon_id not set.",
                __FILE__,
                __LINE__
            );
        } else {
            if ( is_null( $this->_service_addon_id ) ) {
                $this->_service_addon_id = $this->_obj->_service_addon_id;
            }
        }

        $data = array(
            "service_addon_id" => $this->_service_addon_id,
            'service_addon_form' => $this->_service_addon_form,
        );

        if ( ! is_null( $data ) && is_array( $data ) ) {
            $data = json_encode($data);
            $this->logger->debug( 'Additional parameters: ' . $data );
        }

        $this->setAPIResource( $this->getResource( ONAPP_ASSIGN_SYSTEM_SERVICE_ADD_ON_TO_TEMPLATE ) );
        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_POST, $data );

        $result     = $this->_castResponseToClass( $response );
        $this->_obj = $result;
    }

    public function unassignFromTemplate()
    {
        $this->sendDelete(ONAPP_UNASSIGN_SYSTEM_SERVICE_ADD_ON_FROM_TEMPLATE);
    }
}
