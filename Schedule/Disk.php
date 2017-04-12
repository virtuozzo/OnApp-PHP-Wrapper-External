<?php
/**
 * Schedule Disk
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
 * Schedule Disk
 *
 * The OnApp_VirtualMachine_Snapshot class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, {@link getList}.
 *
 * For full fields reference and curl request details visit: ( https://docs.onapp.com/display/42API/Schedules )
 */
class OnApp_Schedule_Disk extends OnApp_Schedule {

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_ADD:
            case ONAPP_GETRESOURCE_LIST:
                /**
                 * @alias     /settings/disks/:disk_id/schedules.json
                 */
                if ( is_null( $this->_disk_id ) && is_null( $this->_target_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _disk_id or _target_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $disk_id  = is_null( $this->_disk_id ) ? $this->_target_id : $this->_disk_id;
                $resource = '/settings/disks/' . $disk_id . '/schedules';
                break;

            default:
                /**
                 * @alias   /settings/schedules/:id.json
                 */
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    function getList( $target_id = null, $url_args = null ) {
        if ( is_null( $target_id ) ) {
            $target_id = is_null( $this->_disk_id ) ? $this->_target_id : $this->_disk_id;
        }

        if ( ! is_null( $target_id ) ) {
            $this->_target_id = $target_id;

            return parent::getList();
        } else {
            $this->logger->error(
                'getList: argument _target_id or _disk_id not set.',
                __FILE__,
                __LINE__
            );
        }
    }

}
