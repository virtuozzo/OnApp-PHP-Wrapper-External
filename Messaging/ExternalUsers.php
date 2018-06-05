<?php
/**
 * Managing Messaging ExternalUsers
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
 * Managing Messaging ExternalUsers
 * 
 * {@link getList}, {@link add}, {@link edit}, {@link delete}
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */
class OnApp_Messaging_ExternalUsers extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'messaging_external_user';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'messaging/external_users';

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
                    'id'    => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'name'                      => array(
                        ONAPP_FIELD_MAP         => '_name',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'email'                     => array(
                        ONAPP_FIELD_MAP         => '_email',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'phone'                     => array(
                        ONAPP_FIELD_MAP         => '_phone',
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
                 * @name Messaging ExternalUsers
                 * @method GET
                 * @alias   /messaging/external_users(.:format)
                 * @format  {:controller=>"Messaging_ExternalUsers", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Messaging ExternalUsers
                 * @method POST
                 * @alias   /messaging/external_users(.:format)
                 * @format  {:controller=>"Messaging_ExternalUsers", :action=>"add"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Messaging ExternalUsers
                 * @method PUT
                 * @alias   /messaging/external_users/:id(.:format)
                 * @format  {:controller=>"Messaging_ExternalUsers", :action=>"edit"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Messaging ExternalUsers
                 * @method DELETE
                 * @alias   /messaging/external_users/:id(.:format)
                 * @format  {:controller=>"Messaging_ExternalUsers", :action=>"delete"}
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
