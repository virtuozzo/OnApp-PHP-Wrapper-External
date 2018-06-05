<?php
/**
 * Managing Settings CDN ManagersConnectionOptions
 * 
 * much they will be charged per unit.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Mykola Vuy
 * @copyright   © 2018 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing Settings CDN ManagersConnectionOptions
 *
 * The OnApp_Settings_CDN_ManagersConnectionOptions class uses the following basic methods:
 * {@link add}, {@link delete}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_Settings_CDN_ManagersConnectionOptions extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'networking_sdn_connection_option';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'connection_options';

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
            case 6.0:
                $this->fields = array(
                    'manager_id'        => array(
                        ONAPP_FIELD_MAP         => '_manager_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'id'                => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'target'            => array(
                        ONAPP_FIELD_MAP         => '_target',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'created_at'        => array(
                        ONAPP_FIELD_MAP         => '_created_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true
                    ),
                    'updated_at'        => array(
                        ONAPP_FIELD_MAP         => '_updated_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true
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
    public function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name Settings CDN ManagersConnectionOptions
                 * @method POST
                 * 
                 * @alias   /settings/sdn/managers/manager_id(.:format)
                 * @format  {:controller=>"Settings_CDN_Managers", :action=>"add"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Settings CDN ManagersConnectionOptions
                 * @method DELETE
                 * 
                 * @alias   /settings/sdn/managers/manager_id(.:format)
                 * @format  {:controller=>"Settings_CDN_Managers", :action=>"delete"}
                 */
                
                $resource = 'settings/sdn/managers/' . $this->_manager_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
                
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }
}
