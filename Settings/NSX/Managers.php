<?php

/**
 * Settings NSX Managers
 *
 * @category        API wrapper
 * @package         OnApp
 * @author          Mykola Vuy
 * @copyright       © 2019 OnApp
 */
/**
 * @var
 */
define('ONAPP_IMPORT_NSX_MANAGER', 'import');
/**
 * @var
 */
define('ONAPP_UPDATE_NSX_MANAGER_CREDENTIALS', 'credentials');
/**
 * Settings_NSX_Managers
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_Settings_NSX_Managers class uses the following basic methods:
 * {@link load}, {@link importNSXManager}, {@link updateNSXManagerCredentials}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Settings_NSX_Managers extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'nsx_manager';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/nsx/managers';
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
            case 6.2:
                $this->fields = array(
                    'id'                    => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'label'                 => array(
                        ONAPP_FIELD_MAP         => '_label',
                        ONAPP_FIELD_TYPE        => 'string',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'api_url'               => array(
                        ONAPP_FIELD_MAP         => '_api_url',
                        ONAPP_FIELD_TYPE        => 'string',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'login'                 => array(
                        ONAPP_FIELD_MAP         => '_login',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'password'              => array(
                        ONAPP_FIELD_MAP         => '_password',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'vcenter_type'          => array(
                        ONAPP_FIELD_MAP         => '_vcenter_type',
                        ONAPP_FIELD_TYPE        => 'string',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'vcenter_id'            => array(
                        ONAPP_FIELD_MAP         => '_vcenter_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
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
                    'last_seen_event'       => array(
                        ONAPP_FIELD_MAP         => '_last_seen_event',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'version'               => array(
                        ONAPP_FIELD_MAP         => '_version',
                        ONAPP_FIELD_TYPE        => 'string',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'host'                  => array(
                        ONAPP_FIELD_MAP         => '_host',
                        ONAPP_FIELD_TYPE        => 'string',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'status'                => array(
                        ONAPP_FIELD_MAP         => '_status',
                        ONAPP_FIELD_TYPE        => 'string',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'uptime'                => array(
                        ONAPP_FIELD_MAP         => '_uptime',
                        ONAPP_FIELD_TYPE        => 'string',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                );
                break;

            case 6.3:
                $this->fields = $this->initFields( 6.2 );
                $this->unsetFields(array('last_seen_event'));
                break;

            case 6.4:
                $this->fields = $this->initFields( 6.3 );
                $this->_tagRoot = 'nsx_managers';
                break;

            case 6.5:
                $this->fields = $this->initFields( 6.4 );
                break;

            case 6.6:
                $this->fields = $this->initFields( 6.5 );
                break;

            case 6.7:
                $this->fields = $this->initFields( 6.6 );
                break;

            default:
                $this->fields = $this->initFields( 6.7 );
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
                 * @name Get List of NSX Managers
                 * @method GET
                 * @alias  /settings/nsx/managers(.:format)
                 * @format {:controller=>"Settings_NSX_Managers", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Get NSX Manager Details
                 * @method GET
                 * @alias  /settings/nsx/managers/:id(.:format)
                 * @format {:controller=>"Settings_NSX_Managers", :action=>"load"}
                 */
                $resource = $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            case ONAPP_IMPORT_NSX_MANAGER:
                /**
                 * ROUTE :
                 *
                 * @name Import NSX Manager
                 * @method POST
                 * @alias  /settings/nsx/managers/:id/import(.:format)
                 * @format {:controller=>"Settings_NSX_Managers", :action=>"importNSXManager"}
                 */
                if ( is_null( $this->_id ) && is_null( $this->_obj->_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _id not set.",
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_id ) ) {
                        $this->_id = $this->_obj->_id;
                    }
                }
                $resource = $this->_resource . '/' . $this->_id . '/' . ONAPP_IMPORT_NSX_MANAGER;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            case ONAPP_UPDATE_NSX_MANAGER_CREDENTIALS:
                /**
                 * ROUTE :
                 *
                 * @name Update NSX Manager Credentials
                 * @method PUT
                 * @alias  /settings/nsx/managers/:id/credentials(.:format)
                 * @format {:controller=>"Settings_NSX_Managers", :action=>"updateNSXManagerCredentials"}
                 */
                if ( is_null( $this->_id ) && is_null( $this->_obj->_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _id not set.",
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_id ) ) {
                        $this->_id = $this->_obj->_id;
                    }
                }
                $resource = $this->_resource . '/' . $this->_id . '/' . ONAPP_UPDATE_NSX_MANAGER_CREDENTIALS;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    public function importNSXManager()
    {
        $this->sendPost(ONAPP_IMPORT_NSX_MANAGER);
    }

    public function updateNSXManagerCredentials()
    {
        if (is_null($this->_login)) {
            $this->logger->error(
                'updateNSXManagerCredentials(): argument _login not set.',
                __FILE__,
                __LINE__
            );
        }

        if (is_null($this->_password)) {
            $this->logger->error(
                'updateNSXManagerCredentials(): argument _password not set.',
                __FILE__,
                __LINE__
            );
        }

        $data = array(
            'root' => 'nsx_manager_credentials',
            'data' => array(
                'login' => $this->_login,
                'password' => $this->_password,
            ),
        );

        $this->sendPut(ONAPP_UPDATE_NSX_MANAGER_CREDENTIALS, $data);
    }

    /**
     * Activates action performed with object
     *
     * @param string $action_name the name of action
     *
     * @access public
     */
    public function activateCheck( $action_name ) {
        switch ( $action_name ) {
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }

    public function getList($params = null, $url_args = null)
    {
        if (parent::getAPIVersion() > 6.2) {
            $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_DEFAULT ) );
            $response = $this->sendRequest(ONAPP_REQUEST_METHOD_GET);

            if (isset( $response['response_body']) && null !== $response['response_body']) {
                $data = array_map(function($item){
                    $object = new \stdClass();
                    $object->nsx_manager = $item;
                    return $object;
                }, json_decode($response['response_body'])->nsx_managers);

                $response['response_body'] = json_encode($data);
            }

            $result = $this->_castResponseToClass( $response );

            if ( $response['info']['http_code'] > 400 ) {
                if ( is_null( $result ) ) {
                    $this->_obj = clone $this;
                } else {
                    $this->_obj = new \stdClass();
                    $this->_obj->errors = $result->getErrorsAsArray();
                }

                return false;
            } else {
                $this->_obj = $result;

                return $result;
            }
        }

        return parent::getList($params, $url_args);
    }
}
