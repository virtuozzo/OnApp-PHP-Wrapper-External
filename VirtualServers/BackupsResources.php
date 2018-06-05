<?php
/**
 * Managing VirtualServers BackupsResources
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
define('ONAPP_BACKUP_RESOURCE', 'backup_resource');

/**
 * Managing VirtualServers BackupsResources
 *
 * The OnApp_VirtualServers_BackupsResources class uses the following basic methods:
 * {@link load}, {@link add}, {@link delete}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_VirtualServers_BackupsResources extends OnApp {
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
                    'advanced_options'            => array(
                        ONAPP_FIELD_MAP         => '_advanced_options',
                        ONAPP_FIELD_TYPE        => '_array',
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
                 * @name VirtualServers BackupsResources
                 * @method GET
                 *
                 * @alias   /virtual_servers/:virtual_server_id/backups/resources(.:format)
                 * @format  {:controller=>"VirtualServers BackupsResources", :action=>"index"}
                 */
                $resource = 'virtual_servers/' . $this->_virtual_server_id . '/' . $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
            
            case ONAPP_BACKUP_RESOURCE:
                /**
                 * ROUTE :
                 *
                 * @name VirtualServers BackupsResources
                 * @method POST
                 *
                 * @alias   /virtual_servers/:virtual_server_id/backups/resources/:id(.:format)
                 * @format  {:controller=>"VirtualServers BackupsResources", :action=>"add"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name VirtualServers BackupsResources
                 * @method DELETE
                 *
                 * @alias   /virtual_servers/:virtual_server_id/backups/resources/:id(.:format)
                 * @format  {:controller=>"VirtualServers BackupsResources", :action=>"delete"}
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
                $resource = 'virtual_servers/' . $this->_virtual_server_id . '/' . $this->_resource . '/' . $this->_id;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;
                
            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }
    
    public function save() {
        if ( isset( $this->_id ) && !is_null( $this->_id ) ) {
            
            $this->sendPost( ONAPP_BACKUP_RESOURCE );
        }
    }
    
    public function delete() {
        if ( isset( $this->_id ) && !is_null( $this->_id ) ) {
            
            $this->sendDelete( ONAPP_BACKUP_RESOURCE );
        }
    }
}
