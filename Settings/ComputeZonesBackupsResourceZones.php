<?php
/**
 * Managing Settings ComputeZonesBackupsResourceZones
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
 * Managing Settings ComputeZonesBackupsResourceZones
 *
 * The OnApp_SamlIdProviders class uses the following basic methods:
 * {@link load} and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */
// SettingsComputeZonesBackupsResourceZones
class OnApp_Settings_ComputeZonesBackupsResourceZones extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'resource_zone';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'backups/resource_zones';

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
                    'compute_zone_id'       => array(
                        ONAPP_FIELD_MAP         => '_compute_zone_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'id'                    => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'label'                 => array(
                        ONAPP_FIELD_MAP         => '_label',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'location_group_id'     => array(
                        ONAPP_FIELD_MAP         => '_location_group_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'updated_at'            => array(
                        ONAPP_FIELD_MAP         => '_updated_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true
                    ),
                );
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
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name Settings ComputeZonesBackupsResourceZones
                 * @method GET
                 * 
                 * @alias   /settings/compute_zones/:compute_zone_id/backups/resource_zones(.:format)
                 * @format  {:controller=>"Settings_ComputeZonesBackupsResourceZones", :action=>"index"}
                 */
                
                /**
                 * ROUTE :
                 *
                 * @name Settings ComputeZonesBackupsResourceZones
                 * @method DELETE
                 * 
                 * @alias   /settings/compute_zones/:compute_zone_id/backups/resource_zones/:id(.:format)
                 * @format  {:controller=>"Settings_ComputeZonesBackupsResourceZones", :action=>"delete"}
                 */

                if ( is_null( $this->_compute_zone_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _compute_zone_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                $resource = 'settings/compute_zones/' . $this->_compute_zone_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
                
            case ONAPP_GETRESOURCE_ADD:
                /**
                 * ROUTE :
                 *
                 * @name Settings ComputeZonesBackupsResourceZones
                 * @method POST
                 * 
                 * @alias   /settings/compute_zones/:compute_zone_id/backups/resource_zones/:backup_zone_id(.:format)
                 * @format  {:controller=>"Settings_ComputeZonesBackupsResourceZones", :action=>"add"}
                 */
                if ( is_null( $this->_compute_zone_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _compute_zone_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                if ( is_null( $this->_backup_zone_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _backup_zone_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                
                $resource = 'settings/compute_zones/' . $this->_compute_zone_id . '/' . $this->_resource . '/' . $this->_backup_zone_id;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
                
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }
    
    public function save() {
        $this->sendPost(ONAPP_GETRESOURCE_ADD);
    }
}
