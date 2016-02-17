<?php
/**
 * Custom Recipe Variables
 *
 * @category        API wrapper
 * @package         OnApp
 * @subpackage      VirtualMachine
 * @author
 * @copyright       © 2011 OnApp
 * @link            http://www.onapp.com/
 * @see             OnApp
 */

/**
 * Custom Recipe Variables
 *
 * This class represents the Custom Recipe Variables for Virtual Machine.
 *
 * The CustomRecipeVariables class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, {@link getList}.
 *
 * For full fields reference and curl request details visit: ( https://docs.onapp.com/display/42API/Custom+Recipe+Variables )
 */
class OnApp_VirtualMachine_CustomRecipeVariable extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'custom_recipe_variable';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'custom_recipe_variables';

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
                    'created_at'                  => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                    ),
                    'updated_at'                  => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                    ),
                    'enabled'                => array(
                        ONAPP_FIELD_MAP       => '_enabled',
                        ONAPP_FIELD_TYPE      => 'boolean',
                    ),
                    'id'                          => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                    ),
                    'name'                          => array(
                        ONAPP_FIELD_MAP       => '_name',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'value'                          => array(
                        ONAPP_FIELD_MAP       => '_value',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'virtual_machine_id'                          => array(
                        ONAPP_FIELD_MAP       => '_virtual_machine_id',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                    'parent_id'                          => array(
                        ONAPP_FIELD_MAP       => '_parent_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                    ),
                    'parent_type'                          => array(
                        ONAPP_FIELD_MAP       => '_parent_type',
                        ONAPP_FIELD_TYPE      => 'string',
                    ),
                );
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
        switch( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name virtual_machine_backups
                 * @method GET
                 * @alias    /virtual_machines/:virtual_machine_id/backups(.:format)
                 * @format    {:controller=>"backups", :action=>"index"}
                 */
                if( is_null( $this->_virtual_machine_id ) && is_null( $this->_obj->_virtual_machine_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _virtual_machine_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                else {
                    if( is_null( $this->_virtual_machine_id ) ) {
                        $this->_virtual_machine_id = $this->_obj->_virtual_machine_id;
                    }
                }

                $resource = 'virtual_machines/' . $this->_virtual_machine_id . '/' . $this->_resource;
                break;

            default:
                $resource = parent::getResource( $action );

                $show_log_msg = false;
                break;
        }

        if( $show_log_msg ) {
            $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
        }

        return $resource;
    }

    /**
     * Sends an API request to get the Objects. After requesting,
     * unserializes the received response into the array of Objects
     *
     * @param integer $virtual_machine_id Virtual Machine id
     * @param mixed   $url_args
     *
     * @return mixed an array of Object instances on success. Otherwise false
     * @access public
     */
    function getList( $virtual_machine_id = null, $url_args = null ) {
        if( is_null( $virtual_machine_id ) && ! is_null( $this->_virtual_machine_id ) ) {
            $virtual_machine_id = $this->_virtual_machine_id;
        }

        if( ! is_null( $virtual_machine_id ) ) {
            $this->_virtual_machine_id = $virtual_machine_id;

            return parent::getList();
        }
        else {
            $this->logger->error(
                'getList: argument _virtual_machine_id not set.',
                __FILE__,
                __LINE__
            );
        }
    }

}
