<?php
/**
 * Managing Messaging NotificationTemplates
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
 * Managing Messaging NotificationTemplates
 * 
 * {@link getList}, {@link load}, {@link add}, {@link edit}, {@link delete}
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */
class OnApp_Messaging_NotificationTemplates extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'messaging_notification_template';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'messaging/notification_templates';

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
                    'name'              => array(
                        ONAPP_FIELD_MAP         => '_name',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'template'                  => array(
                        ONAPP_FIELD_MAP         => '_template',
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
                    'system'            => array(
                        ONAPP_FIELD_MAP         => '_recipient_ids',
                        ONAPP_FIELD_TYPE        => 'boolean',
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
                 * @name Messaging NotificationTemplates
                 * @method GET
                 * @alias   /messaging/notification_templates(.:format)
                 * @format  {:controller=>"Messaging_NotificationTemplates", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Messaging NotificationTemplates
                 * @method POST
                 * @alias   /messaging/notification_templates(.:format)
                 * @format  {:controller=>"Messaging_NotificationTemplates", :action=>"add"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Messaging NotificationTemplates
                 * @method PUT
                 * @alias   /messaging/notification_templates/:id(.:format)
                 * @format  {:controller=>"Messaging_NotificationTemplates", :action=>"edit"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Messaging NotificationTemplates
                 * @method DELETE
                 * @alias   /messaging/notification_templates/:id(.:format)
                 * @format  {:controller=>"Messaging_NotificationTemplates", :action=>"delete"}
                 */

                $resource = $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
            
            case ONAPP_GETRESOURCE_LOAD:
                /**
                 * ROUTE :
                 *
                 * @name Messaging NotificationTemplates
                 * @method GET
                 * @alias   /messaging/notification_templates/:id/default(.:format)
                 * @format  {:controller=>"Messaging_NotificationTemplates", :action=>"load"}
                 */
                $resource = $this->_resource . '/' . $this->_id . '/default';
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }
   
    public function load($id = null) {
        if ( is_null( $this->_id ) && is_null( $this->_obj->_id ) ) {
            $this->logger->error(
                'load( ' . $action . ' ): argument _id not set.',
                __FILE__,
                __LINE__
            );
        } else {
            if ( is_null( $this->_id ) ) {
                $this->_id = $this->_obj->_id;
            }
        }

        $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_LOAD ) );
        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );
        
        if ( isset( $response['response_body'] ) && !is_null( $response['response_body'] ) ) {
            $response_body = $response['response_body'];
            $data = json_decode( $response_body );
            if ( isset( $data->notification_template ) ) {
                $response_body = json_encode($data->notification_template);
                $response['response_body'] = $response_body;
            }
        }
        
        $result   = $this->castStringToClass( $response );

        $this->_obj = $result;
        $this->_id  = $this->_obj->_id;

        return $result;
    }
}
