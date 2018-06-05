<?php
/**
 * Scheduleds
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @subpackage
 * @author
 * @copyright   © 2011 OnApp
 * @link        https://docs.onapp.com/display/42API/Schedules
 * @see         OnApp
 */

/**
 *
 */
define( 'ONAPP_GETRESOURCE_SCHEDULE_DISKID', 'schedule_diskid' );

/**
 *
 * Managing Backups Schedules
 *
 * The OnApp_Disk_Schedule class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * The OnApp_Disk_Schedule class represents Disk Backups Schedules.
 * The OnApp class is a parent of ONAPP_Disk_Schedule class.
 *
 * For full fields reference and curl request details visit: ( https://docs.onapp.com/display/42API/Schedules )
 */
class OnApp_Schedule extends OnApp {
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
    var $_resource = 'settings/schedules';

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
            case '2.0':
            case '2.1':
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
                    'id'                 => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'duration'           => array(
                        ONAPP_FIELD_MAP  => '_duration',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'target_id'          => array(
                        ONAPP_FIELD_MAP  => '_target_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'schedule_logs'      => array(
                        ONAPP_FIELD_MAP   => '_schedule_logs',
                        ONAPP_FIELD_TYPE  => 'array',
                        ONAPP_FIELD_CLASS => 'Schedule_Log',
                    ),
                    'period'             => array(
                        ONAPP_FIELD_MAP  => '_period',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'updated_at'         => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'action'             => array(
                        ONAPP_FIELD_MAP  => '_action',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'start_at'           => array(
                        ONAPP_FIELD_MAP  => '_start_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'user_id'            => array(
                        ONAPP_FIELD_MAP  => '_user_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'failure_count'      => array(
                        ONAPP_FIELD_MAP  => '_failure_count',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'params'             => array(
                        ONAPP_FIELD_MAP  => '_params',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'status'             => array(
                        ONAPP_FIELD_MAP  => '_status',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'target_type'        => array(
                        ONAPP_FIELD_MAP  => '_target_type',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'created_at'         => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'rotation_period'    => array(
                        ONAPP_FIELD_MAP  => '_rotation_period',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'disk_id'            => array(
                        ONAPP_FIELD_MAP  => '_disk_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'virtual_machine_id' => array(
                        ONAPP_FIELD_MAP  => '_virtual_machine_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                );
                break;
            case 4.3:
            case 5.0:
                $this->fields = $this->initFields( 4.2 );
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
            default:
                /**
                 * @alias   /settings/schedules/:id.json
                 */
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    function save() {
        if ( $this->_target_id ) {
            $this->fields['target_id'][ ONAPP_FIELD_REQUIRED ]        = true;
            $this->fields['target_type'][ ONAPP_FIELD_REQUIRED ]      = true;
            $this->fields['target_type'][ ONAPP_FIELD_DEFAULT_VALUE ] = 'Disk';
            $this->fields['action'][ ONAPP_FIELD_REQUIRED ]           = true;
            $this->fields['action'][ ONAPP_FIELD_DEFAULT_VALUE ]      = 'autobackup';
        }

        return parent::save();
    }
}