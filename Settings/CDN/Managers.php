<?php
/**
 * Managing Settings CDN Managers
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
 * Managing Settings CDN Managers
 *
 * The OnApp_Settings_CDN_Managers class uses the following basic methods:
 * {@link load}, {@link add}, {@link edit}, {@link delete}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_Settings_CDN_Managers extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'networking_sdn_manager';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/sdn/managers';

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
                    'id'                => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'label'             => array(
                        ONAPP_FIELD_MAP         => '_label',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'host'              => array(
                        ONAPP_FIELD_MAP         => '_host',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'port'              => array(
                        ONAPP_FIELD_MAP         => '_port',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'login'             => array(
                        ONAPP_FIELD_MAP         => '_login',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'password'          => array(
                        ONAPP_FIELD_MAP         => '_password',
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
    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name Settings CDN Managers
                 * @method GET
                 * 
                 * @alias   /settings/sdn/managers/:id(.:format)
                 * @format  {:controller=>"Settings_CDN_Managers", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Settings CDN Managers
                 * @method POST
                 * 
                 * @alias   /settings/sdn/managers(.:format)
                 * @format  {:controller=>"Settings_CDN_Managers", :action=>"add"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Settings CDN Managers
                 * @method PUT
                 * 
                 * @alias   /settings/sdn/managers/:id(.:format)
                 * @format  {:controller=>"Settings_CDN_Managers", :action=>"edit"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Settings CDN Managers
                 * @method DELETE
                 * 
                 * @alias   /settings/sdn/managers/:id(.:format)
                 * @format  {:controller=>"Settings_CDN_Managers", :action=>"delete"}
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
}
