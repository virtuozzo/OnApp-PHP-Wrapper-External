<?php
/**
 * Managing Messaging Gateways
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
 * Managing Messaging Gateways
 * 
 * {@link getList}, {@link add}, {@link delete}
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */
class OnApp_Messaging_Gateways extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'messaging_gateway';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'messaging/gateways';

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
                    'id'                    => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'name'                  => array(
                        ONAPP_FIELD_MAP         => '_name',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'delivery_method'       => array(
                        ONAPP_FIELD_MAP         => '_delivery_method',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'options'               => array(
                        ONAPP_FIELD_MAP         => '_options',
                        ONAPP_FIELD_TYPE        => '_array',
                    ),
                    'created_at'            => array(
                        ONAPP_FIELD_MAP         => '_created_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true
                    ),
                    'updated_at'            => array(
                        ONAPP_FIELD_MAP         => '_updated_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true
                    ),
                    'primary'               => array(
                        ONAPP_FIELD_MAP  => '_primary',
                        ONAPP_FIELD_TYPE => 'boolean',
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
                 * @name Messaging Gateways
                 * @method GET
                 * @alias   /messaging/gateways(.:format)
                 * @format  {:controller=>"Messaging_Gateways", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Messaging Gateways
                 * @method POST
                 * @alias   /messaging/gateways(.:format)
                 * @format  {:controller=>"Messaging_Gateways", :action=>"add"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Messaging Gateways
                 * @method DELETE
                 * @alias   /messaging/gateways/:id(.:format)
                 * @format  {:controller=>"Messaging_Gateways", :action=>"delete"}
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
