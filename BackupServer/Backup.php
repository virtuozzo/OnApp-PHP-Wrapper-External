<?php
/**
 * Managing Backups
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @docs        https://docs.onapp.com/display/42API/Search+Backups
 * @see         OnApp
 */

/**
 *
 */
define( 'ONAPP_GETRESOURCE_BACKUP_SEARCH', 'backup_search' );

/**
 * Managing Backups
 *
 *
 * The Availability class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( https://docs.onapp.com/display/42API/Search+Backups )
 */
class OnApp_BackupServer_Backup extends OnApp_VirtualMachine_Backup {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'backup';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'backups_search';

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_BACKUP_SEARCH:
                /**
                 * @alias    /settings/backup_servers/:id/backups_search.json
                 */
                if ( is_null( $this->_backup_server_id ) && is_null( $this->_obj->_backup_server_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _backup_server_id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_backup_server_id ) ) {
                        $this->_backup_server_id = $this->_obj->_backup_server_id;
                    }
                }

                $resource = 'settings/backup_servers/' . $this->_backup_server_id . '/' . $this->_resource;
                break;

            default:
                $resource = parent::getResource( $action );
                break;

        }

        return $resource;
    }

    public function search( $sizeFrom = null, $sizeTo = null, $periodStartdate = null, $periodEnddate = null ) {
        $params = array();
        if ( ! is_null( $sizeFrom ) ) {
            $params['size[from]'] = $sizeFrom;
        }
        if ( ! is_null( $sizeTo ) ) {
            $params['size[to]'] = $sizeTo;
        }
        if ( ! is_null( $periodStartdate ) ) {
            $params['period[startdate]'] = $periodStartdate;
        }
        if ( ! is_null( $periodEnddate ) ) {
            $params['period[enddate]'] = $periodEnddate;
        }
        return $this->sendGet( ONAPP_GETRESOURCE_BACKUP_SEARCH, null, $params );
    }

}