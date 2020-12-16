<?php
/**
 * Managing VirtualServers BackupsRecoveryPoints
 * 
 * much they will be charged per unit.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Mykola Vuy
 * @copyright   © 2018 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * const
 */
define('ONAPP_BACKUP_RECOVERY_POINTS_RESTORE', 'restore');

/**
 * Managing VirtualServers BackupsRecoveryPoints
 *
 * The OnApp_VirtualServers_BackupsRecoveryPoints class uses the following basic methods:
 * {@link load}, {@link add}, {@link delete}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_VirtualServers_BackupsRecoveryPoints extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'recovery_point';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'backups/recovery_points';

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
            case 6.0:
                $this->fields = array(
                    'created_at'            => array(
                        ONAPP_FIELD_MAP         => '_created_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true
                    ),
                    'id'                    => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'resource_id'           => array(
                        ONAPP_FIELD_MAP         => '_resource_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'size'                  => array(
                        ONAPP_FIELD_MAP         => '_size',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'state'                 => array(
                        ONAPP_FIELD_MAP         => '_state',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'updated_at'            => array(
                        ONAPP_FIELD_MAP         => '_updated_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true
                    ),
                    'virtual_server_id'        => array(
                        ONAPP_FIELD_MAP         => '_virtual_server_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                );
                break;

            case 6.1:
                $this->fields = $this->initFields( 6.0 );
                break;

            case 6.2:
                $this->fields = $this->initFields( 6.1 );
                break;

            case 6.3:
                $this->fields = $this->initFields( 6.2 );
                break;

            case 6.4:
                $this->fields = $this->initFields( 6.3 );
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
    public function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name VirtualServers BackupsRecoveryPoints
                 * @method GET
                 *
                 * @alias   /virtual_servers/:virtual_server_id/backups/recovery_points(.:format)
                 * @format  {:controller=>"VirtualServers BackupsRecoveryPoints", :action=>"add"}
                 */
                
                $resource = 'virtual_servers/' . $this->_virtual_server_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
            
            case ONAPP_BACKUP_RECOVERY_POINTS_RESTORE:
                /**
                 * ROUTE :
                 *
                 * @name VirtualServers BackupsRecoveryPoints
                 * @method POST
                 *
                 * @alias   /virtual_servers/:virtual_server_id/backups/recovery_points/:recovery_point_id/restore(.:format)
                 * @format  {:controller=>"VirtualServers BackupsRecoveryPoints", :action=>"add"}
                 */
                
                $resource = 'virtual_servers/' . $this->_virtual_server_id . '/' . $this->_resource . '/' . $this->_recovery_point_id . '/' . ONAPP_BACKUP_RECOVERY_POINTS_RESTORE;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
                
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }
    
    /**
     * Restore from recovery point
     *
     * @param integer $recovery_point_id 
     */
    public function restore( $recovery_point_id = null ) {
        if ( ! is_null( $recovery_point_id ) ) {
            $this->_recovery_point_id = $recovery_point_id;
        }
        $this->sendPost( ONAPP_BACKUP_RECOVERY_POINTS_RESTORE );
    }
    
    /**
     * Create recovery point
     *
     * @param integer $resource_id
     */
    public function createRecoveryPoint( $resource_id ) {
        $data = array( 'resource_id' => $resource_id );
        
        if ( ! is_null( $data ) && is_array( $data ) ) {
            $data = json_encode($data);
            $this->logger->debug( 'Additional parameters: ' . $data );
        }
        $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_DEFAULT ) );
        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_POST, $data );

        $result     = $this->_castResponseToClass( $response );
        $this->_obj = $result;
    }
}
