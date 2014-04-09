<?php
/**
 * Scheduleds
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage  Disk
 * @author      Yakubskiy Yuriy
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 *
 * Managing Disk Backups Schedules
 *
 * The OnApp_Disk_Schedule class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * The OnApp_Disk_Schedule class represents Disk Backups Schedules.
 * The OnApp class is a parent of ONAPP_Disk_Schedule class.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
define( 'ONAPP_GETRESOURCE_LIST_BY_DISK_ID', 'get list by disk id' );

class OnApp_Disk_Schedule extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'schedule';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'schedules';

    /**
     * API Fields description
     *
     * @param string|float $version   OnApp API version
     * @param string       $className current class' name
     *
     * @return array
     */
    public function initFields( $version = null, $className = '' ) {
        switch( $version ) {
            case '2.0':
            case '2.1':
                $this->fields = array(
                    'id'            => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'duration'      => array(
                        ONAPP_FIELD_MAP      => '_duration',
                        ONAPP_FIELD_TYPE     => 'integer',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'target_id'     => array(
                        ONAPP_FIELD_MAP       => '_target_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'schedule_logs' => array(
                        ONAPP_FIELD_MAP       => '_schedule_logs',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'period'        => array(
                        ONAPP_FIELD_MAP      => '_period',
                        ONAPP_FIELD_TYPE     => 'string',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'updated_at'    => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'action'        => array(
                        ONAPP_FIELD_MAP       => '_action',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'start_at'      => array(
                        ONAPP_FIELD_MAP       => '_start_at',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'user_id'       => array(
                        ONAPP_FIELD_MAP       => '_user_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'failure_count' => array(
                        ONAPP_FIELD_MAP       => '_failure_count',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'params'        => array(
                        ONAPP_FIELD_MAP       => '_params',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'status'        => array(
                        ONAPP_FIELD_MAP           => '_status',
                        ONAPP_FIELD_TYPE          => 'string',
                        ONAPP_FIELD_REQUIRED      => true,
                        ONAPP_FIELD_DEFAULT_VALUE => 'enabled',

                    ),
                    'target_type'   => array(
                        ONAPP_FIELD_MAP       => '_target_type',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'created_at'    => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                break;

            case 2.2:
            case 2.3:
                $this->fields = $this->initFields( 2.1 );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
                $this->fields = $this->initFields( 2.3 );
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
    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        $show_log_msg = true;
        switch( $action ) {
            case ONAPP_GETRESOURCE_LIST_BY_DISK_ID:
                $resource = 'settings/disks/' . $this->_target_id . '/' . $this->_resource;
                break;
            default:
                $resource = parent::getResource( $action );
                $show_log_msg = false;
                break;
        }

        if( $show_log_msg ) {
            $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
        }

        return $resource;
    }

    /**
     * Sends an API request to get the Objects. After requesting,
     * unserializes the received response into the array of Objects
     *
     * @param integer $disk_id Virtual Machine Disk id
     *
     * @return mixed an array of Object instances on success. Otherwise false
     * @access public
     */
    function getListByDiskId( $disk_id = null ) {
        if( $disk_id ) {
            $this->_target_id = $disk_id;
        }

        $this->activate( ONAPP_ACTIVATE_GETLIST );

        $this->logger->add( 'getList: Get Transaction list.' );

        $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_LIST_BY_DISK_ID ) );
        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

        $result = $this->castStringToClass( $response );

        if( ! empty( $response[ 'errors' ] ) ) {
            return false;
        }

        return ( is_array( $result ) || ! $result ) ? $result : array( $result );
    }

    function save() {
        if( $this->_target_id ) {
            $this->fields[ 'target_id' ][ ONAPP_FIELD_REQUIRED ] = true;
            $this->fields[ 'target_type' ][ ONAPP_FIELD_REQUIRED ] = true;
            $this->fields[ 'target_type' ][ ONAPP_FIELD_DEFAULT_VALUE ] = 'Disk';
            $this->fields[ 'action' ][ ONAPP_FIELD_REQUIRED ] = true;
            $this->fields[ 'action' ][ ONAPP_FIELD_DEFAULT_VALUE ] = 'autobackup';
        }

        return parent::save();
    }
}