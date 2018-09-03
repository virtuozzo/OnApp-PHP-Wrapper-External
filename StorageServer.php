<?php

/**
 * Managing Storage Servers
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2016 OnApp
 * @link        https://docs.onapp.com/display/42API/Storage+Server+Backups
 * @see         OnApp
 */

/**
 * This method outputs the details for all server backups
 */
define( 'ONAPP_GET_ALL_BACKUP_DETAIL', 'all_backup_detail' );

/**
 * This method outputs the details for normal server backups
 */
define( 'ONAPP_GET_NORMAL_BACKUP_DETAIL', 'normal_backup_detail' );

/**
 * This method outputs the details for incremental server backups
 */
define( 'ONAPP_GET_INCREMENTAL_BACKUP_DETAIL', 'incremental_backup_detail' );

/**
 * Use the following API request to update backup with a note
 */
define( 'ONAPP_ADD_EDIT_BACKUP_NOTE', 'add_edit_backup_note' );

/**
 * Use the following API request to update backup with a note
 */
define( 'ONAPP_RESTORE_BACKUP', 'restore_backup' );

define('ONAPP_VERSION_SIX', 6);

/**
 * StorageServer
 *
 * The OnApp_StorageServer class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_StorageServer extends OnApp {
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
    var $_resource = 'storage_servers';

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
                    'allow_resize_without_reboot' => array(
                        ONAPP_FIELD_MAP  => '_allow_resize_without_reboot',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'allowed_hot_migrate'         => array(
                        ONAPP_FIELD_MAP  => '_allowed_hot_migrate',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'allowed_swap'                => array(
                        ONAPP_FIELD_MAP  => '_allowed_swap',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'backup_server_id'            => array(
                        ONAPP_FIELD_MAP  => '_backup_server_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'backup_size'                 => array(
                        ONAPP_FIELD_MAP  => '_backup_size',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'built'                       => array(
                        ONAPP_FIELD_MAP  => '_built',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'built_at'                    => array(
                        ONAPP_FIELD_MAP  => '_built_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'created_at'                  => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'data_store_type'             => array(
                        ONAPP_FIELD_MAP  => '_data_store_type',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'id'                          => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'identifier'                  => array(
                        ONAPP_FIELD_MAP  => '_identifier',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'initiated'                   => array(
                        ONAPP_FIELD_MAP  => '_initiated',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'iqn'                         => array(
                        ONAPP_FIELD_MAP  => '_iqn',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'locked'                      => array(
                        ONAPP_FIELD_MAP  => '_locked',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'marked_for_delete'           => array(
                        ONAPP_FIELD_MAP  => '_marked_for_delete',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'min_disk_size'               => array(
                        ONAPP_FIELD_MAP  => '_min_disk_size',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'min_memory_size'             => array(
                        ONAPP_FIELD_MAP  => '_min_memory_size',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'note'                        => array(
                        ONAPP_FIELD_MAP  => '_note',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'operating_system'            => array(
                        ONAPP_FIELD_MAP  => '_operating_system',
                        ONAPP_FIELD_TYPE => '>linux',
                    ),
                    'operating_system_distro'     => array(
                        ONAPP_FIELD_MAP  => '_operating_system_distro',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'target_id'                   => array(
                        ONAPP_FIELD_MAP  => '_target_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'target_type'                 => array(
                        ONAPP_FIELD_MAP  => '_target_type',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'template_id'                 => array(
                        ONAPP_FIELD_MAP  => '_template_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'updated_at'                  => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime',
                    ),
                    'user_id'                     => array(
                        ONAPP_FIELD_MAP  => '_user_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'volume_id'                   => array(
                        ONAPP_FIELD_MAP  => '_volume_id',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'backup_type'                 => array(
                        ONAPP_FIELD_MAP  => '_backup_type',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'disk_id'                     => array(
                        ONAPP_FIELD_MAP  => '_disk_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'backup_id'                   => array(
                        ONAPP_FIELD_MAP  => '_backup_id',
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
            case ONAPP_GETRESOURCE_DEFAULT:
                if ( is_null( $this->_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = $this->_resource . '/' . $this->_id . '/backups';
                break;

            case ONAPP_RESTORE_BACKUP :
                /**
                 * ROUTE :
                 *
                 * @name note
                 * @method POST
                 * @alias  /backups/:backup_id/restore(.:format)
                 * @format {:action=>"index", :controller=>"backups"}
                 */
                if ( is_null( $this->_backup_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _backup_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = '/backups/' . $this->_backup_id . '/restore';
                break;

            case ONAPP_ADD_EDIT_BACKUP_NOTE :
                /**
                 * ROUTE :
                 *
                 * @name note
                 * @method PUT
                 * @alias  /backups/:backup_id/note(.:format)
                 * @format {:action=>"index", :controller=>"backups"}
                 */
                if ( is_null( $this->_backup_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _backup_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = '/backups/' . $this->_backup_id . '/note';
                break;
            case ONAPP_GET_INCREMENTAL_BACKUP_DETAIL :
                /**
                 * ROUTE :
                 *
                 * @name storage_servers
                 * @method POST
                 * @alias  /storage_servers/:id/backups/files(.:format)
                 * @format {:action=>"index", :controller=>"storage_servers"}
                 */
                $resource = $this->getResource() . 'files';
                break;
            case ONAPP_GET_NORMAL_BACKUP_DETAIL :
                /**
                 * ROUTE :
                 *
                 * @name storage_servers
                 * @method POST
                 * @alias  /storage_servers/:id/backups/images(.:format)
                 * @format {:action=>"index", :controller=>"storage_servers"}
                 */
                if ( is_null( $this->_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = $this->getResource() . 'images';
                break;
            case ONAPP_GET_ALL_BACKUP_DETAIL :
                /**
                 * ROUTE :
                 *
                 * @name storage_servers
                 * @method POST
                 * @alias  /storage_servers/:id/backups(.:format)
                 * @format {:action=>"index", :controller=>"storage_servers"}
                 */
                if ( is_null( $this->_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = $this->getResource() . 'backups';
                break;
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    function save() {
        //todo: test if where is edit possibility
        $this->activateCheck( ONAPP_ACTIVATE_SAVE );
        $obj = $this->_create();
        if ( isset( $obj ) && ! isset( $obj->errors ) ) {
            $this->load();
        }
    }

    public function getAllDetails() {
        return $this->sendGet( ONAPP_GET_ALL_BACKUP_DETAIL );
    }

    public function getNormalDetails() {
        return $this->sendGet( ONAPP_GET_NORMAL_BACKUP_DETAIL );
    }

    public function getIncrementalDetails() {
        return $this->sendGet( ONAPP_GET_INCREMENTAL_BACKUP_DETAIL );
    }

    /**
     * restoreBackUp
     *
     * @param boolean $force_restore
     *
     * @return void
     */
    public function restoreBackUp($force_restore=false) {
        if ( $this->getAPIVersion() >= ONAPP_VERSION_SIX ) {
            $data = array('force_restore' => $force_restore);
            $data = json_encode($data);
            $this->setAPIResource($this->getResource(ONAPP_RESTORE_BACKUP));
            $this->sendRequest( ONAPP_REQUEST_METHOD_POST, $data );
        } else {
            $this->sendPost( ONAPP_RESTORE_BACKUP );
        }
    }

    public function saveNote() {
        $this->sendPut( ONAPP_ADD_EDIT_BACKUP_NOTE );
    }
}
