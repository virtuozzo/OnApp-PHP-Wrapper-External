<?php

/**
 * Manages Announcements
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  Federation
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Enable Booting from CD for ISO Virtual Server
 */
define( 'ONAPP_ANNOUNCEMENTS_NOTIFY_USERS', 'notify_users' );


class OnApp_Federation_Announcement extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'announcement';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'federation/hypervisor_zones';

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
                    'created_at'          => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'finish_at'           => array(
                        ONAPP_FIELD_MAP  => '_finish_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'start_at'            => array(
                        ONAPP_FIELD_MAP  => '_start_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'updated_at'          => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'text'                => array(
                        ONAPP_FIELD_MAP  => '_text',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'federation_id'       => array(
                        ONAPP_FIELD_MAP  => '_federation_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'hypervisor_group_id' => array(
                        ONAPP_FIELD_MAP  => '_hypervisor_group_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'kind'                => array(
                        ONAPP_FIELD_MAP  => '_kind',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                );
                break;
            case 4.3:
                $this->fields = $this->initFields( 4.2 );
                break;
            case 5.0:
                $this->fields = $this->initFields( 4.3 );
                break;
            case 5.1:
                $this->fields = $this->initFields( 5.0 );
                break;
            case 5.2:
                $this->fields = $this->initFields( 5.1 );
                break;
            case 5.3:
                $this->fields = $this->initFields( 5.2 );
                break;
            case 5.4:
                $this->fields = $this->initFields( 5.3 );
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
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
            case ONAPP_ANNOUNCEMENTS_NOTIFY_USERS:
                if ( is_null( $this->_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else if ( is_null( $this->_hypervisor_group_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _hypervisor_group_id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    $resource = $this->_resource . '/' . $this->_hypervisor_group_id . '/announcements/' . $this->_id . '/notify_users';
                    $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                }
                break;

            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name announcements
                 * @method GET
                 * @alias   /federation/hypervisor_zones/:_hypervisor_group_id/announcements(.:format)
                 * @format  {:controller=>"announcements", :action=>"index"}
                 */
                if ( is_null( $this->_hypervisor_group_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _hypervisor_group_id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_hypervisor_group_id ) ) {
                        $this->_hypervisor_group_id = $this->_obj->_hypervisor_group_id;
                    }
                }
                $resource = $this->_resource . '/' . $this->_hypervisor_group_id . '/announcements';
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            default:
                /**
                 * ROUTE :
                 *
                 * @name announcements
                 * @method GET
                 * @alias  /federation/hypervisor_zones/:hypervisor_group_id/announcements(.:format)
                 * @format {:controller=>"supplier_tokens", :action=>"index"}
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }

    public function notify_users() {
        // federation/hypervisor_zones/:hypervisor_group_id/announcements/:id/notify_users
        $this->sendPost( ONAPP_ANNOUNCEMENTS_NOTIFY_USERS );
    }

}