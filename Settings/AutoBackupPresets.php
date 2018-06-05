<?php
/**
 * Managing Settings AutoBackupPresets
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
 * Managing Settings AutoBackupPresets
 *
 * The OnApp_Settings_HardwareInfo class uses the following basic methods:
 * {@link load}, {@link add}, {@link edit}, {@link delete} and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_Settings_AutoBackupPresets extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'auto_backup_preset';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'auto_backup_presets';

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
                    'days_to_run_on'        => array(
                        ONAPP_FIELD_MAP         => '_days_to_run_on',
                        ONAPP_FIELD_TYPE        => 'array',
                    ),
                    'day_to_run_on'         => array(
                        ONAPP_FIELD_MAP         => '_day_to_run_on',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'enabled'               => array(
                        ONAPP_FIELD_MAP         => '_enabled',
                        ONAPP_FIELD_TYPE        => 'boolean',
                    ),
                    'frequency'             => array(
                        ONAPP_FIELD_MAP         => '_frequency',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'id'                    => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'max_recovery_points'   => array(
                        ONAPP_FIELD_MAP         => '_max_recovery_points',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'period'                => array(
                        ONAPP_FIELD_MAP         => '_period',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'resource_id'           => array(
                        ONAPP_FIELD_MAP         => '_resource_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'start_time'            => array(
                        ONAPP_FIELD_MAP         => '_start_time',
                        ONAPP_FIELD_TYPE        => 'datetime',
                    ),
                    'updated_at'            => array(
                        ONAPP_FIELD_MAP         => '_updated_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true
                    ),
                    'week_to_run_on'        => array(
                        ONAPP_FIELD_MAP         => '_week_to_run_on',
                        ONAPP_FIELD_TYPE        => 'integer',
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
                 * @name Settings AutoBackupPresets
                 * @method GET
                 * 
                 * @alias   /settings/backups/resources/:resource_id/auto_backup_presets(.:format)
                 * @format  {:controller=>"Settings_AutoBackupPresets", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Settings AutoBackupPresets
                 * @method GET
                 * 
                 * @alias   /settings/backups/resources/:resource_id/auto_backup_presets/:id(.:format)
                 * @format  {:controller=>"Settings_AutoBackupPresets", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Settings AutoBackupPresets
                 * @method POST
                 * 
                 * @alias   /settings/backups/resources/:resource_id/auto_backup_presets(.:format)
                 * @format  {:controller=>"Settings_AutoBackupPresets", :action=>"add"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Settings AutoBackupPresets
                 * @method PUT
                 * 
                 * @alias   /settings/backups/resources/:resource_id/auto_backup_presets/:id(.:format)
                 * @format  {:controller=>"Settings_AutoBackupPresets", :action=>"edit"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Settings AutoBackupPresets
                 * @method DELETE
                 * 
                 * @alias   /settings/backups/resources/:resource_id/auto_backup_presets/:id(.:format)
                 * @format  {:controller=>"Settings_AutoBackupPresets", :action=>"delete"}
                 */
                
                $resource = 'settings/backups/resources/' . $this->_resource_id .'/'. $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }
}
