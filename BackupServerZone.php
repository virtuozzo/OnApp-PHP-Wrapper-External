<?php
/**
 * Managing Backup Server Zones
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author
 * @copyright   © 2016 OnApp
 * @link        http://www.onapp.com/
 * @docs        https://docs.onapp.com/display/42API/Get+List+of+Backup+Server+Zones
 * @see         OnApp
 */

/**
 *
 */
define( 'ONAPP_GETRESOURCE_BACKUPSERVERZONE_WITHBACKUPSERVERID', 'backupserverzone_withbackupserverid' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_BACKUPSERVERZONE_SERVERLIST', 'backupserverzone_serverlist' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_BACKUPSERVERZONE_ATTACH', 'backupserverzone_attach' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_BACKUPSERVERZONE_DETACH', 'backupserverzone_detach' );

/**
 * Managing Backup Server Zones
 *
 *
 * The Availability class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( https://docs.onapp.com/display/42API/Get+List+of+Backup+Server+Zones )
 */
class ONAPP_BACKUPSERVERZONE extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'backup_server_group';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/backup_server_zones';

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
                    'created_at'             => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'updated_at'             => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'draas_id'               => array(
                        ONAPP_FIELD_MAP  => '_draas_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'federation_id'          => array(
                        ONAPP_FIELD_MAP  => '_federation_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'hypervisor_id'          => array(
                        ONAPP_FIELD_MAP  => '_hypervisor_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'identifier'             => array(
                        ONAPP_FIELD_MAP  => '_identifier',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'label'                  => array(
                        ONAPP_FIELD_MAP  => '_label',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'location_group_id'      => array(
                        ONAPP_FIELD_MAP  => '_location_group_id',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'id'                     => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'closed'                 => array(
                        ONAPP_FIELD_MAP  => '_closed',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'federation_enabled'     => array(
                        ONAPP_FIELD_MAP  => '_federation_enabled',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'traded'                 => array(
                        ONAPP_FIELD_MAP  => '_traded',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'backup_ip_address'      => array(
                        ONAPP_FIELD_MAP  => '_backup_ip_address',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'backup_server_group_id' => array(
                        ONAPP_FIELD_MAP  => '_backup_server_group_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'capacity'               => array(
                        ONAPP_FIELD_MAP  => '_capacity',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'cpu_idle'               => array(
                        ONAPP_FIELD_MAP  => '_cpu_idle',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'ip_address'             => array(
                        ONAPP_FIELD_MAP  => '_ip_address',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'enabled'                => array(
                        ONAPP_FIELD_MAP  => '_enabled',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'distro'                 => array(
                        ONAPP_FIELD_MAP  => '_distro',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'backup_server_id'       => array(
                        ONAPP_FIELD_MAP  => '_backup_server_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_BACKUPSERVERZONE_SERVERLIST:
                /**
                 * @alias     /settings/backup_server_zones/:backup_server_zone_id/backup_servers.json
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

                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/backup_servers';
                break;
            case ONAPP_GETRESOURCE_BACKUPSERVERZONE_WITHBACKUPSERVERID:
                /**
                 * @alias     /settings/backup_server_zones/:backup_server_zone_id/backup_servers/:backup_server_id
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
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/backup_servers/' . $this->_backup_server_id;
                break;

            case ONAPP_GETRESOURCE_BACKUPSERVERZONE_ATTACH:
                /**
                 * @alias     /settings/backup_server_zones/:backup_server_zone_id/backup_servers/:backup_server_id/attach.json
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_BACKUPSERVERZONE_WITHBACKUPSERVERID ) . '/attach';
                break;

            case ONAPP_GETRESOURCE_BACKUPSERVERZONE_DETACH:
                /**
                 * @alias     /settings/backup_server_zones/backup_server_zone_id/backup_server/:backup_server_id/detach.json
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_BACKUPSERVERZONE_WITHBACKUPSERVERID ) . '/detach';
                break;

            default:
                /**
                 * @alias  /settings/backup_server_zones/:id.json
                 */
                $resource = parent::getResource( $action );

        }

        return $resource;
    }

    function getServerList( $id = null ) {
        if ( ! is_null( $id ) ) {
            $this->_id = $id;
        }

        $tagRootOld     = $this->_tagRoot;
        $this->_tagRoot = 'backup_server';
        $result         = $this->sendGet( ONAPP_GETRESOURCE_BACKUPSERVERZONE_SERVERLIST );
        $this->_tagRoot = $tagRootOld;

        if ( ! is_null( $this->getErrorsAsArray() ) ) {
            return false;
        } else {
            if ( ! is_array( $result ) && ! is_null( $result ) ) {
                $result = array( $result );
            }

            return $result;
        }
    }

    function attach( $backup_server_id = null ) {
        if ( ! is_null( $backup_server_id ) ) {
            $this->_backup_server_id = $backup_server_id;
        }
        $this->sendPost( ONAPP_GETRESOURCE_BACKUPSERVERZONE_ATTACH );
    }

    function detach( $backup_server_id = null ) {
        if ( ! is_null( $backup_server_id ) ) {
            $this->_backup_server_id = $backup_server_id;
        }
        $this->sendPost( ONAPP_GETRESOURCE_BACKUPSERVERZONE_DETACH );
    }

}