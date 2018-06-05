<?php
/**
 * Managing Messaging Subscriptions
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
 * Managing Messaging Subscriptions
 * 
 * {@link getList}, {@link add}, {@link edit}, {@link delete}
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */
class OnApp_Messaging_Subscriptions extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'messaging_subscription';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'messaging/subscriptions';

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
                    'id'                                            => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'name'                                          => array(
                        ONAPP_FIELD_MAP         => '_name',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'created_at'                                    => array(
                        ONAPP_FIELD_MAP         => '_created_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true
                    ),
                    'updated_at'                                    => array(
                        ONAPP_FIELD_MAP         => '_updated_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true
                    ),
                    'recipients_list_ids'                           => array(
                        ONAPP_FIELD_MAP         => '_recipients_list_ids',
                        ONAPP_FIELD_TYPE        => '_array',
                    ),
                    'event_type_notification_template_attributes'   => array(
                        ONAPP_FIELD_MAP         => '_event_type_notification_template_attributes',
                        ONAPP_FIELD_TYPE        => '_array',
                    ),
                    'gateway_ids'                                   => array(
                        ONAPP_FIELD_MAP         => '_gateway_ids',
                        ONAPP_FIELD_TYPE        => '_array',
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
                 * @name Messaging Subscriptions
                 * @method GET
                 * @alias   /messaging/subscriptions(.:format)
                 * @format  {:controller=>"Messaging_Subscriptions", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Messaging Subscriptions
                 * @method POST
                 * @alias   /messaging/subscriptions(.:format)
                 * @format  {:controller=>"Messaging_Subscriptions", :action=>"add"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Messaging Subscriptions
                 * @method PUT
                 * @alias   /messaging/subscriptions/:id(.:format)
                 * @format  {:controller=>"Messaging_Subscriptions", :action=>"edit"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Messaging Subscriptions
                 * @method DELETE
                 * @alias   /messaging/subscriptions/:id(.:format)
                 * @format  {:controller=>"Messaging_Subscriptions", :action=>"delete"}
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
    
    public function save() {
        $this->unsetFields( array( 'id' ) );
        
        parent::save();
    }
}
