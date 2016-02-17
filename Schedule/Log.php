<?php
/**
 * Schedule Log
 *
 * @category        API wrapper
 * @package         OnApp
 * @subpackage      Schedule
 * @author
 * @copyright       © 2011 OnApp
 * @link            https://docs.onapp.com/display/42API/Schedules
 * @see             OnApp
 */


/**
 * Schedule Log
 *
 * The OnApp_VirtualMachine_Snapshot class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, {@link getList}.
 *
 * For full fields reference and curl request details visit: ( https://docs.onapp.com/display/42API/Schedules )
 */
class OnApp_Schedule_Log extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'schedule_log';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = '';

    /**
     * API Fields description
     *
     * @param string|float $version   OnApp API version
     * @param string       $className current class' name
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
                    'created_at'      => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'updated_at'      => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'id'              => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'log_output'        => array(
                        ONAPP_FIELD_MAP  => '_log_output',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'schedule_id'       => array(
                        ONAPP_FIELD_MAP  => '_schedule_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'status'          => array(
                        ONAPP_FIELD_MAP  => '_status',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                );
                break;

        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

}
