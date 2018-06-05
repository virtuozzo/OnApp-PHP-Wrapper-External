<?php

/**
 * Recipe
 *
 * @category        API wrapper
 * @package         OnApp
 * @subpackage      VirtualMachine
 * @author          Ivan Gavryliuk
 * @copyright       © 2016 OnApp
 * @link            https://docs.onapp.com/display/42API/Manage+Virtual+Server+Recipes
 * @see             OnApp
 */

/**
 * Recipe Joins
 *
 * Use the following API calls to view, assign and delete virtual server recipes in your cloud.
 *
 * The OnApp_VirtualMachine_Recipe class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_VirtualMachine_Recipe extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'recipe_joins';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'recipe_joins';

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
            case '2.0':
            case '2.1':
            case 2.2:
            case 2.3:
            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
            case 4.2:
                $this->fields = array(
                    'compatible_with'    => array(
                        ONAPP_FIELD_MAP  => '_compatible_with',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'created_at'         => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'description'        => array(
                        ONAPP_FIELD_MAP  => '_description',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'id'                 => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'label'              => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'script_type'        => array(
                        ONAPP_FIELD_MAP  => '_script_type',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'updated_at'         => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'user_id'            => array(
                        ONAPP_FIELD_MAP  => '_user_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'recipe_steps'       => array(
                        ONAPP_FIELD_MAP  => '_recipe_steps',
                        ONAPP_FIELD_TYPE => 'array',
                    ),
                    'virtual_machine_id' => array(
                        ONAPP_FIELD_MAP  => '_virtual_machine_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                );
                break;
            case 4.3:
            case 5.0:
                $this->fields = $this->initFields( 4.2 );
                break;
            case 5.1:
                $this->fields = $this->initFields( 5.0 );
                break;
            case 5.2:
                $this->fields = $this->initFields( 5.1 );
                $this->fields['vcenter_moref']     = array(
                    ONAPP_FIELD_MAP  => '_vcenter_moref',
                    ONAPP_FIELD_TYPE => 'string',
                );

                break;
            case 5.3:
                $this->fields = $this->initFields( 5.2 );
                break;
            case 5.4:
                $this->fields = $this->initFields( 5.3 );
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
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
        $show_log_msg = true;
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name virtual_machine_snapshot
                 * @method GET
                 * @alias    /virtual_machines/:virtual_machine_id/disk(.:format)
                 * @format    {:controller=>"snapshots", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method DELETE
                 * @alias    /virtual_machines/:virtual_machine_id/disk(.:format)
                 * @format    {:controller=>"snapshots", :action=>"destroy"}
                 */
                if ( is_null( $this->_virtual_machine_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _virtual_machine_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }

                $resource = 'virtual_machines/' . $this->_virtual_machine_id . '/' . $this->_resource;
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    /*
     * For test purpose
     * */
    public function modifyResponse( $response, $resource ) {
        switch ( $resource ) {
            case ONAPP_GETRESOURCE_LIST:
                $data = array();
                if ( isset( $response['response_body'] ) ) {
                    if ( is_string( $response['response_body'] ) ) {
                        $data = json_decode( $response['response_body'] );
                    }
                }
                $newData = array();
                foreach ( $data as $item ) {
                    $newData[] = $item[0]->recipe->recipe_joins;
                }
                $response['response_body'] = json_encode( $newData );

                return $response;
                break;
            default:
                return $response;
                break;
        }
    }
}
