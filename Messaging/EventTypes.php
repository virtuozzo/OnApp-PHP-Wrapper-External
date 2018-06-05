<?php
/**
 * Managing Messaging EventTypes
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
 * @var
 */
define('ONAPP_CUSTOM_EVENT_TRIGGERS', 'custom_event_triggers');

/**
 * Managing Messaging EventTypes
 * 
 * {@link getList}, {@link add}, {@link edit}, {@link delete}
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */
class OnApp_Messaging_EventTypes extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'messaging_topic';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'messaging/event_types';

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
                    'kind'              => array(
                        ONAPP_FIELD_MAP         => '_kind',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'description'       => array(
                        ONAPP_FIELD_MAP         => '_description',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'placeholders'      => array(
                        ONAPP_FIELD_MAP         => '_placeholders',
                        ONAPP_FIELD_TYPE        => '_array',
                    ),
                    'message'           => array(
                        ONAPP_FIELD_MAP         => '_message',
                        ONAPP_FIELD_TYPE        => 'string',
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
                 * @name Messaging EventTypes
                 * @method GET
                 * @alias   /messaging/event_types(.:format)
                 * @format  {:controller=>"Messaging_EventTypes", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Messaging EventTypes
                 * @method POST
                 * @alias   /messaging/event_types(.:format)
                 * @format  {:controller=>"Messaging_EventTypes", :action=>"add"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Messaging EventTypes
                 * @method PUT
                 * @alias   /messaging/event_types/:id(.:format)
                 * @format  {:controller=>"Messaging_EventTypes", :action=>"edit"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Messaging EventTypes
                 * @method DELETE
                 * @alias   /messaging/event_types/:id(.:format)
                 * @format  {:controller=>"Messaging_EventTypes", :action=>"delete"}
                 */

                $resource = $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
            
            case ONAPP_CUSTOM_EVENT_TRIGGERS:
                /**
                 * ROUTE :
                 *
                 * @name Messaging EventTypes
                 * @method POST
                 * @alias   /messaging/event_types/:id/custom_event_triggers(.:format)
                 * @format  {:controller=>"Messaging_EventTypes", :action=>"add"}
                 */
                
                if ( is_null( $this->_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _id not set.",
                        __FILE__,
                        __LINE__
                    );
                }

                $resource = $this->_resource . '/' . $this->_id . '/' . ONAPP_CUSTOM_EVENT_TRIGGERS;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }
    
    public function save() {
        if ( isset($this->_message) && !is_null( $this->_message ) ) {
            $data = array(
                'root'        => 'message',
                'data'        => array(
                    'message'    => $this->_message,
                ),
            );
            $this->sendPost( ONAPP_CUSTOM_EVENT_TRIGGERS, $data );
        } else {
            parent::save();
        }
    }
   
}
