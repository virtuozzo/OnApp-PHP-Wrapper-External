<?php
/**
 * Managing High Availability
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @docs        https://docs.onapp.com/display/42API/High+Availability+Control+Panel
 * @see         OnApp
 */

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_AVAILABILITY_ENABLE', 'availability_enable' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_AVAILABILITY_DISABLE', 'availability_disable' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_AVAILABILITY_DEACTIVATE', 'availability_deactivate' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_AVAILABILITY_ACTIVATE', 'availability_activate' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_AVAILABILITY_APPLY_CHANGES', 'availability_apply_changes' );

/**
 *
 *
 */
define( 'ONAPP_GETRESOURCE_AVAILABILITY_COMM_INTERFACES_APPLY', 'availability_comm_interfaces_apply' );

/**
 * Managing High Availability
 *
 *
 * The Availability class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Availability extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'availability_cluster';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/availability/clusters';

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
            case 2.0:
            case 2.1:
            case 2.2:
            case 2.3:
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
                    'created_at' => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'id'         => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'name'       => array(
                        ONAPP_FIELD_MAP  => '_name',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'net_mask'   => array(
                        ONAPP_FIELD_MAP  => '_net_mask',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'ports'      => array(
                        ONAPP_FIELD_MAP  => '_ports',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'state'      => array(
                        ONAPP_FIELD_MAP  => '_state',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'updated_at' => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'virtual_ip' => array(
                        ONAPP_FIELD_MAP  => '_virtual_ip',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'nodes'      => array(
                        ONAPP_FIELD_MAP   => '_nodes',
                        ONAPP_FIELD_TYPE  => 'array',
                        ONAPP_FIELD_CLASS => 'Availability_Node',
                    )
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_AVAILABILITY_ENABLE:
                /**
                 * @alias  /settings/availability/enable.json
                 */
                $resource = 'settings/availability/enable';
                break;

            case ONAPP_GETRESOURCE_AVAILABILITY_DISABLE:
                /**
                 * @alias  /settings/availability/disable.json
                 */
                $resource = 'settings/availability/disable';
                break;
            case ONAPP_GETRESOURCE_AVAILABILITY_DEACTIVATE:
                /**
                 * @alias  /availability/cluster/:id/deactivate.json
                 */
                if ( is_null( $this->_id ) && is_null( $this->_obj->_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_id ) ) {
                        $this->_id = $this->_obj->_id;
                    }
                }

                $resource = 'availability/cluster/' . $this->_id . '/deactivate';
                break;

            case ONAPP_GETRESOURCE_AVAILABILITY_ACTIVATE:
                /**
                 * @alias  /availability/cluster/:id/recreate.json
                 */
                if ( is_null( $this->_id ) && is_null( $this->_obj->_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_id ) ) {
                        $this->_id = $this->_obj->_id;
                    }
                }

                $resource = 'availability/cluster/' . $this->_id . '/recreate';
                break;
            case ONAPP_GETRESOURCE_AVAILABILITY_APPLY_CHANGES:
                /**
                 * @alias  /settings/availability/apply_changes.json
                 */

                $resource = 'settings/availability/apply_changes';
                break;
            case ONAPP_GETRESOURCE_AVAILABILITY_COMM_INTERFACES_APPLY:
                /**
                 * @alias  /settings/availability/communication_interfaces/apply.json
                 */

                $resource = 'settings/availability/communication_interfaces/apply';
                break;

            default:
                /**
                 * @alias  /settings/availability/clusters.json(.:format)
                 */
                $resource = parent::getResource( $action );
        }

        return $resource;
    }

    function enable() {
        $this->sendPut( ONAPP_GETRESOURCE_AVAILABILITY_ENABLE, '' );
    }

    function disable() {
        $this->sendPut( ONAPP_GETRESOURCE_AVAILABILITY_DISABLE, '' );
    }

    function deactivate($id = null) {
        if( !is_null( $id )) {
            $this->_id = $id;
        }
        $this->sendPut( ONAPP_GETRESOURCE_AVAILABILITY_DEACTIVATE, '' );
    }

    function activate($id = null) {
        if( !is_null( $id )) {
            $this->_id = $id;
        }
        $this->sendPut( ONAPP_GETRESOURCE_AVAILABILITY_ACTIVATE, '' );
    }

    function applyChanges() {
        $this->sendPut( ONAPP_GETRESOURCE_AVAILABILITY_APPLY_CHANGES, '' );
    }

    function communicationInterfacesApply() {
        $this->sendPut( ONAPP_GETRESOURCE_AVAILABILITY_COMM_INTERFACES_APPLY, '' );
    }


}