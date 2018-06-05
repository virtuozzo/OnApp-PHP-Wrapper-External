<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Service Addon Event
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2017 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 *
 */
define( 'ONAPP_GETRESOURCE_SERVICE_ADDON_RAISE', 'raise' );

/**
 * Manages Service Addons Event
 *
 * This class represents the roles assigned  to the users in this OnApp installation
 *
 * The OnApp_ServiceAddon_Event class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_ServiceAddon_Event extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'service_addon_event';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'service_addon_events';

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
            case 5.3:
                $this->fields = array(
                    'id'             => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                    ),
                    'service_addon_id'     => array(
                        ONAPP_FIELD_MAP  => '_service_addon_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'recipe_id'     => array(
                        ONAPP_FIELD_MAP  => '_recipe_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'action_type'     => array(
                        ONAPP_FIELD_MAP  => '_action_type',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'event_type'     => array(
                        ONAPP_FIELD_MAP  => '_event_type',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'created_at'     => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                    ),
                    'updated_at'     => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                    ),
                );
                break;
            case 5.4:
                $this->fields = $this->initFields( 5.3 );
                break;
            case 5.5:
                $this->fields                = $this->initFields( 5.4 );
                $this->fields['destination'] = array(
                    ONAPP_FIELD_MAP  => '_destination',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['topic_id']    = array(
                    ONAPP_FIELD_MAP  => '_topic_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_LIST:
                /**
                 * @alias     /service_addons/:service_addons_id/events.json
                 */
                if ( is_null( $this->_service_addons_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _service_addons_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }

                $resource = '/service_addons/' . $this->_service_addons_id . '/events';
                break;

            case ONAPP_GETRESOURCE_EDIT:
            case ONAPP_GETRESOURCE_DELETE:
                /**
                 * @alias     /service_addons/:service_addons_id/events/recipes.json
                 */
                if ( is_null( $this->_service_addons_id ) or is_null( $this->_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _service_addons_id or _id not set.',
                        __FILE__,
                        __LINE__
                    );
                }

                $resource = '/service_addons/' . $this->_service_addons_id . '/events/'. $this->_id;
                break;

            case ONAPP_GETRESOURCE_ADD:
                /**
                 * @alias     /service_addons/:service_addons_id/events/:id.json
                 */
                if ( is_null( $this->_service_addons_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _service_addons_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }

                $resource = '/service_addons/' . $this->_service_addons_id . '/events/recipes';
                break;

            case ONAPP_GETRESOURCE_SERVICE_ADDON_RAISE:
                if ( is_null( $this->_service_addons_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _service_addons_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }

                $resource = '/service_addons/' . $this->_service_addons_id . '/events/notifications';
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    /**
     * Create Service Add-on Raise Event Action
     *
     * @param $topic_id $event_type
     *
     * @access    public
     */
    function raiseEventAction( $topic_id, $event_type ) {
        $data = array(
            'root' => 'tmp_holder',
            'data' => array(
                'service_addon_event' => array(
                    'topic_id'   => $topic_id,
                    'event_type' => $event_type,
                )
            )
        );
        $this->sendPost( ONAPP_GETRESOURCE_SERVICE_ADDON_RAISE, $data );
    }

}
