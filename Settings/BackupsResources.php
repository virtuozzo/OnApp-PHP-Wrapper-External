<?php
/**
 * Managing Settings BackupsResources
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
define('ONAPP_BACKUP_RESOURSE_ADVANSED_OPTIONS', 'advanced_options');

/**
 * Managing Settings BackupsResources
 *
 * The OnApp_Settings_HardwareInfo class uses the following basic methods:
 * {@link load}, {@link add}, {@link edit}, {@link delete} and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_Settings_BackupsResources extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'resource';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'backups/resources';

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
                    'advanced_options'  => array(
                        ONAPP_FIELD_MAP         => '_advanced_options',
                        ONAPP_FIELD_TYPE        => 'array',
                        ONAPP_FIELD_CLASS       => 'Settings_AdvancedOptions',
                    ),
                    'created_at'        => array(
                        ONAPP_FIELD_MAP         => '_created_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true
                    ),
                    'enabled'           => array(
                        ONAPP_FIELD_MAP  => '_enabled',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'id'                => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'label'             => array(
                        ONAPP_FIELD_MAP         => '_label',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'password'          => array(
                        ONAPP_FIELD_MAP         => '_password',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'plugin'            => array(
                        ONAPP_FIELD_MAP         => '_plugin',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'primary_host'      => array(
                        ONAPP_FIELD_MAP         => '_primary_host',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'resource_zone_id'  => array(
                        ONAPP_FIELD_MAP         => '_resource_zone_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'secondary_host'    => array(
                        ONAPP_FIELD_MAP         => '_secondary_host',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'updated_at'        => array(
                        ONAPP_FIELD_MAP         => '_updated_at',
                        ONAPP_FIELD_TYPE        => 'datetime',
                        ONAPP_FIELD_READ_ONLY   => true
                    ),
                    'username'          => array(
                        ONAPP_FIELD_MAP         => 'username',
                        ONAPP_FIELD_TYPE        => 'string',
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

            case 6.5:
                $this->fields = $this->initFields( 6.4 );
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
                 * @name Settings BackupsResources
                 * @method GET
                 * 
                 * @alias   /settings/backups/resources(.:format)
                 * @format  {:controller=>"Settings_BackupsResources", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Settings BackupsResources
                 * @method GET
                 * 
                 * @alias   /settings/backups/resources/:id(.:format)
                 * @format  {:controller=>"Settings_BackupsResources", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Settings BackupsResources
                 * @method POST
                 * 
                 * @alias   /settings/backups/resources(.:format)
                 * @format  {:controller=>"Settings_BackupsResources", :action=>"add"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Settings BackupsResources
                 * @method PUT
                 * 
                 * @alias   /settings/backups/resources/:id(.:format)
                 * @format  {:controller=>"Settings_BackupsResources", :action=>"edit"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Settings C
                 * @method DELETE
                 * 
                 * @alias   /settings/backups/resources/:id(.:format)
                 * @format  {:controller=>"Settings_BackupsResources", :action=>"delete"}
                 */
                
                $resource = 'settings/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
            case ONAPP_BACKUP_RESOURSE_ADVANSED_OPTIONS:
                /**
                 * ROUTE :
                 *
                 * @name Settings BackupsResources
                 * @method PUT
                 * 
                 * @alias   /settings/backups/resources/:id/advanced_options(.:format)
                 * @format  {:controller=>"Settings_BackupsResources", :action=>"edit"}
                 */
                
                $resource = 'settings/' . $this->_resource . '/' . $this->_id . '/advanced_options';
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }
    
    public function save() {
        if ( isset( $this->_id ) && !is_null( $this->_id ) && isset( $this->_advanced_options ) && !is_null( $this->_advanced_options ) ) {
            $data = array(
                'root'        => 'advanced_options',
                'data'        => $this->_advanced_options,
            
            );
            $this->sendPut( ONAPP_BACKUP_RESOURSE_ADVANSED_OPTIONS, $data );
        } else {
            parent::save();
        }
    }
    
}
