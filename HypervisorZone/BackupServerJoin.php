<?php

/**
 * Backup Server Joins
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Ivan Gavryliuk
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Backup Server Joins
 *
 * The BackupServerJoin class represents the Data Storages of the OnAPP installation.
 *
 * The OnApp_DataStore class uses the following basic methods:
 * {@link delete}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_HypervisorZone_BackupServerJoin extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'backup_server_join';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'backup_server_joins';

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
            case 5.1:
                $this->fields = array(
                    'id'               => array(
                        ONAPP_FIELD_MAP  => '_id',
                        ONAPP_FIELD_TYPE => 'integer'
                    ),
                    'backup_server_id' => array(
                        ONAPP_FIELD_MAP  => '_backup_server_id',
                        ONAPP_FIELD_TYPE => 'integer'
                    ),
                    'created_at'       => array(
                        ONAPP_FIELD_MAP  => '_created_at',
                        ONAPP_FIELD_TYPE => 'datetime'
                    ),
                    'updated_at'       => array(
                        ONAPP_FIELD_MAP  => '_updated_at',
                        ONAPP_FIELD_TYPE => 'datetime'
                    ),
                    'target_join_id'   => array(
                        ONAPP_FIELD_MAP  => '_target_join_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                    'target_join_type' => array(
                        ONAPP_FIELD_MAP  => '_target_join_type',
                        ONAPP_FIELD_TYPE => 'string',
                    ),
                    'hypervisor_id'    => array(
                        ONAPP_FIELD_MAP  => '_hypervisor_id',
                        ONAPP_FIELD_TYPE => 'integer',
                    ),
                );
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
                /**
                 * ROUTE :
                 *
                 * @name backup_server_joins
                 * @method GET
                 * @alias   /settings/hyrvisor_zones/:hypervisor_id/backup_server_joins(.:format)
                 * @format  {:controller=>"backup_server_joins", :action=>"index"}
                 */

                if ( is_null( $this->_hypervisor_id ) && is_null( $this->_obj->_hypervisor_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _hypervisor_id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_hypervisor_id ) ) {
                        $this->_hypervisor_id = $this->_obj->_hypervisor_id;
                    }
                }

                $resource = 'settings/hypervisor_zones/' . $this->_hypervisor_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    public function save() {
        $data = array(
            'root' => 'tmp_holder',
            'data' => array(
                'backup_server_id' => $this->_backup_server_id,
            ),
        );
        $this->sendPost( ONAPP_GETRESOURCE_ADD, $data );
    }
}