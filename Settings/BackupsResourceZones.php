<?php
/**
 * Managing Settings BackupsResourceZones
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
define('ONAPP_RESOURSE_ZONE_ATTACH_RESOURSE', 'attach_resource');

/**
 * const
 */
define('ONAPP_RESOURSE_ZONE_DETACH_RESOURSE', 'detach_resource');

/**
 * Managing Settings BackupsResourceZones
 *
 * The OnApp_Settings_HardwareInfo class uses the following basic methods:
 * {@link load}, {@link getList}, {@link add}, {@link edit} and {@link delete}
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_Settings_BackupsResourceZones extends OnApp {
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
    var $_resource = 'resource_zones';

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
                 * @name Settings BackupsResourceZones
                 * @method GET
                 * 
                 * @alias   /settings/backups/resources/:resource_id/auto_backup_presets(.:format)
                 * @format  {:controller=>"Settings_BackupsResourceZones", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Settings BackupsResourceZones
                 * @method GET
                 * 
                 * @alias   /settings/backups/resources/:resource_id/auto_backup_presets/:id(.:format)
                 * @format  {:controller=>"Settings_BackupsResourceZones", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Settings BackupsResourceZones
                 * @method POST
                 * 
                 * @alias   /settings/backups/resources/:resource_id/auto_backup_presets(.:format)
                 * @format  {:controller=>"Settings_BackupsResourceZones", :action=>"add"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Settings BackupsResourceZones
                 * @method PUT
                 * 
                 * @alias   /settings/backups/resources/:resource_id/auto_backup_presets/:id(.:format)
                 * @format  {:controller=>"Settings_BackupsResourceZones", :action=>"edit"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Settings BackupsResourceZones
                 * @method DELETE
                 * 
                 * @alias   /settings/backups/resources/:resource_id/auto_backup_presets/:id(.:format)
                 * @format  {:controller=>"Settings_BackupsResourceZones", :action=>"delete"}
                 */
                
                $resource = 'settings/backups/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
            case ONAPP_RESOURSE_ZONE_ATTACH_RESOURSE:
                /**
                 * ROUTE :
                 *
                 * @name Settings BackupsResourceZones
                 * @method POST
                 * 
                 * @alias   /settings/backups/resource_zones/:resource_zone_id/resources/:resource_id/attach(.:format)
                 * @format  {:controller=>"Settings_BackupsResourceZones", :action=>"attach"}
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
                $resource = 'settings/backups/' . $this->_resource . '/' . $this->_id . '/resources/' . $this->_resource_id . '/attach';
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
            case ONAPP_RESOURSE_ZONE_DETACH_RESOURSE:
                /**
                 * ROUTE :
                 *
                 * @name Settings BackupsResourceZones
                 * @method POST
                 * 
                 * @alias   /settings/backups/resource_zones/:resource_zone_id/resources/:resource_id/:attached_resource_id/detach(.:format)
                 * @format  {:controller=>"Settings_BackupsResourceZones", :action=>"detach"}
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
                $resource = 'settings/backups/' . $this->_resource . '/' . $this->_id . '/resources/' . $this->_resource_id . '/detach';
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }
    
    /**
     * Attach
     *
     * @param integer $resource_id 
     */
    public function attach( $resource_id = null ) {
        if ( ! is_null( $resource_id ) ) {
            $this->_resource_id = $resource_id;
        }
        $this->sendPost( ONAPP_RESOURSE_ZONE_ATTACH_RESOURSE );
    }

    /**
     * Detach
     *
     * @param integer $resource_id 
     */
    public function detach( $resource_id = null ) {
        if ( ! is_null( $resource_id ) ) {
            $this->_resource_id = $resource_id;
        }
        $this->sendPost( ONAPP_RESOURSE_ZONE_DETACH_RESOURSE );
    }
}
