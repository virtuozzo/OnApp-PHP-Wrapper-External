<?php
/**
 * Managing Messaging Deliveries
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
 * Managing Messaging Deliveries
 * 
 * {@link getList}
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */
class OnApp_Messaging_Deliveries extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'messaging_delivery';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'messaging/deliveries';

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
                    'recipient_id'                                  => array(
                        ONAPP_FIELD_MAP         => '_recipient_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'message_id'                                    => array(
                        ONAPP_FIELD_MAP         => '_message_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'destination'                                   => array(
                        ONAPP_FIELD_MAP         => '_destination',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'subscriber_name'                               => array(
                        ONAPP_FIELD_MAP         => '_subscriber_name',
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
                    'status'                                        => array(
                        ONAPP_FIELD_MAP         => '_status',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'output'                                        => array(
                        ONAPP_FIELD_MAP         => '_output',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'subscription_name'                             => array(
                        ONAPP_FIELD_MAP         => '_subscription_name',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'subscription_topic_notification_template_id'   => array(
                        ONAPP_FIELD_MAP         => '_subscription_topic_notification_template_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'gateway_id'                                    => array(
                        ONAPP_FIELD_MAP         => '_gateway_id',
                        ONAPP_FIELD_TYPE        => 'integer',
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
                 * @name Messaging Deliveries
                 * @method GET
                 * @alias   /messaging/deliveries(.:format)
                 * @format  {:controller=>"Messaging_Deliveries", :action=>"index"}
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
