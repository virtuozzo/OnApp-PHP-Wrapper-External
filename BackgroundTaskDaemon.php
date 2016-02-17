<?php
/**
 * Managing Background Task Daemon
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @docs        https://docs.onapp.com/display/42API/Background+Task+Daemon
 * @see         OnApp
 */

/**
 *
 */
define( 'ONAPP_GETRESOURCE_DAEMON_STATUS', 'daemon_status' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_DAEMON_START', 'daemon_start' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_DAEMON_STOP', 'daemon_stop' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_DAEMON_RELOAD', 'daemon_reload' );

/**
 * Managing Background Task Daemon
 *
 *
 * The Availability class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( https://docs.onapp.com/display/42API/Background+Task+Daemon )
 */
class OnApp_BackgroundTaskDaemon extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'daemon';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'sysadmin_tools/daemon';

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
                    'status'             => array(
                        ONAPP_FIELD_MAP  => '_status',
                        ONAPP_FIELD_TYPE => 'start',
                    ),
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DAEMON_STATUS:
                /**
                 * @alias     /sysadmin_tools/daemon/status.json
                 */
                $resource = $this->_resource . '/status';
                break;

            case ONAPP_GETRESOURCE_DAEMON_START:
                /**
                 * @alias     /sysadmin_tools/daemon/start.json
                 */
                $resource = $this->_resource . '/start';
                break;

            case ONAPP_GETRESOURCE_DAEMON_STOP:
                /**
                 * @alias     /sysadmin_tools/daemon/stop.json
                 */
                $resource = $this->_resource . '/stop';
                break;

            case ONAPP_GETRESOURCE_DAEMON_RELOAD:
                /**
                 * @alias     /sysadmin_tools/daemon/reload.json
                 */
                $resource = $this->_resource . '/reload';
                break;

            default:
                $resource = parent::getResource( $action );

        }

        return $resource;
    }

    function getStatus() {
        return $this->sendGet( ONAPP_GETRESOURCE_DAEMON_STATUS );
    }

    function start() {
        return $this->sendPost( ONAPP_GETRESOURCE_DAEMON_START );
    }

    function stop() {
        return $this->sendPost( ONAPP_GETRESOURCE_DAEMON_STOP );
    }

    function reload() {
        return $this->sendPost( ONAPP_GETRESOURCE_DAEMON_RELOAD );
    }

}