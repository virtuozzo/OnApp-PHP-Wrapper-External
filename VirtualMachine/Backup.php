<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * VM Backups
 *
 * @category        API wrapper
 * @package         OnApp
 * @subpackage      VirtualMachine
 * @author          Vitaliy Kondratyuk
 * @copyright       © 2011 OnApp
 * @link            http://www.onapp.com/
 * @see             OnApp
 */

/**
 * @todo: Add description
 */
define( 'ONAPP_GETRESOURCE_BACKUP_CONVERT', 'convert' );

/**
 * @todo: Add description
 */
define( 'ONAPP_GETRESOURCE_BACKUP_RESTORE', 'restore' );

/**
 * @todo: Add description
 */
define( 'ONAPP_GETRESOURCE_DISK_BACKUPS', 'disk_backups' );

/**
 * VM Backups
 *
 * This class represents the Backups which have been taken or are waiting to be taken for Virtual Machine.
 *
 * The OnApp_VirtualMachine_Backup class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_VirtualMachine_Backup extends OnApp {
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
    var $_resource = 'backups';

    /**
     * API Fields description
     *
     * @param string|float $version   OnApp API version
     * @param string       $className current class' name
     *
     * @return array
     */
    public function initFields( $version = null, $className = '' ) {
        switch( $version ) {
            case '2.0':
                $this->fields = array(
                    'id'                          => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'created_at'                  => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'updated_at'                  => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'built_at'                    => array(
                        ONAPP_FIELD_MAP       => '_built_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'disk_id'                     => array(
                        ONAPP_FIELD_MAP       => '_disk_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'operating_system'            => array(
                        ONAPP_FIELD_MAP       => '_operating_system',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'operating_system_distro'     => array(
                        ONAPP_FIELD_MAP       => '_operating_system_distro',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'template_id'                 => array(
                        ONAPP_FIELD_MAP       => '_template_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'allowed_swap'                => array(
                        ONAPP_FIELD_MAP       => '_allowed_swap',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'backup_type'                 => array(
                        ONAPP_FIELD_MAP       => '_backup_type',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'allow_resize_without_reboot' => array(
                        ONAPP_FIELD_MAP       => '_allow_resize_without_reboot',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'backup_size'                 => array(
                        ONAPP_FIELD_MAP       => '_backup_size',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'identifier'                  => array(
                        ONAPP_FIELD_MAP       => '_identifier',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'min_disk_size'               => array(
                        ONAPP_FIELD_MAP       => '_min_disk_size',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'built'                       => array(
                        ONAPP_FIELD_MAP       => '_built',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'locked'                      => array(
                        ONAPP_FIELD_MAP       => '_locked',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                break;

            case '2.1':
                $this->fields = $this->initFields( '2.0' );
                unset( $this->fields[ 'allowed_swap' ] );
                $this->fields[ 'allowed_hot_migrate' ] = array(
                    ONAPP_FIELD_MAP       => '_allowed_hot_migrate',
                    ONAPP_FIELD_TYPE      => 'boolean',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                $this->fields[ 'allowed_swap' ]        = array(
                    ONAPP_FIELD_MAP       => '_allowed_swap',
                    ONAPP_FIELD_TYPE      => 'boolean',
                    ONAPP_FIELD_READ_ONLY => true,
                );
                break;

            case 2.2:
            case 2.3:
                $this->fields                       = $this->initFields( 2.1 );
                $this->fields[ 'backup_server_id' ] = array(
                    ONAPP_FIELD_MAP  => '_backup_server_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                break;

            case 3.0:
            case 3.1:
                $this->fields = $this->initFields( 2.3 );
                break;

            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
                $this->fields                                               = $this->initFields( 3.1 );
                $this->fields[ 'disk_id' ][ ONAPP_FIELD_SKIP_FROM_REQUEST ] = true;
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
        $show_log_msg = true;
        switch( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name virtual_machine_backups
                 * @method GET
                 * @alias    /virtual_machines/:virtual_machine_id/backups(.:format)
                 * @format    {:controller=>"backups", :action=>"index"}
                 */
                if( is_null( $this->_virtual_machine_id ) && is_null( $this->_obj->_virtual_machine_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _virtual_machine_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                else {
                    if( is_null( $this->_virtual_machine_id ) ) {
                        $this->_virtual_machine_id = $this->_obj->_virtual_machine_id;
                    }
                }

                $resource = 'virtual_machines/' . $this->_virtual_machine_id . '/' . $this->_resource;
                break;

            case ONAPP_GETRESOURCE_ADD:
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias    /virtual_machines/:virtual_machine_id/backups(.:format)
                 * @format    {:controller=>"backups", :action=>"create"}
                 */
                if( is_null( $this->_disk_id ) && is_null( $this->_obj->_disk_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _disk_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                else {
                    if( is_null( $this->_disk_id ) ) {
                        $this->_disk_id = $this->_obj->_disk_id;
                    }
                }

                $resource = 'settings/disks/' . $this->_disk_id . '/' . $this->_resource;
                break;
            case ONAPP_GETRESOURCE_DISK_BACKUPS:
                /**
                 * ROUTE :
                 *
                 * @name disk_backups
                 * @method GET
                 * @alias  /settings/disks/:disk_id/backups(.:format)
                 * @format {:controller=>"backups", :action=>"index"}
                 */
                $resource = 'settings/disks/' . $this->_disk_id . '/' . $this->_resource;
                break;

            case ONAPP_GETRESOURCE_LOAD:
            case ONAPP_GETRESOURCE_DELETE:
                /**
                 * ROUTE :
                 *
                 * @name backup
                 * @method GET
                 * @alias    /backups/:id(.:format)
                 * @format    {:controller=>"backups", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method DELETE
                 * @alias     /backups/:id(.:format)
                 * @format     {:controller=>"backups", :action=>"destroy"}
                 */
                if( is_null( $this->_id ) && is_null( $this->_obj->_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                else {
                    if( is_null( $this->_id ) ) {
                        $this->_id = $this->_obj->_id;
                    }
                }

                return $this->_resource . '/' . $this->_id;

            case ONAPP_GETRESOURCE_BACKUP_CONVERT:
                /**
                 * ROUTE :
                 *
                 * @name convert_backup
                 * @method GET
                 * @alias     /backups/:id/convert(.:format)
                 * @format     {:controller=>"backups", :action=>"convert"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/convert';
                break;

            case ONAPP_GETRESOURCE_BACKUP_RESTORE:
                /**
                 * ROUTE :
                 *
                 * @name restore_backup
                 * @method POST
                 * @alias      /backups/:id/restore(.:format)
                 * @format      {:controller=>"backups", :action=>"restore"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/restore';
                break;

            default:
                $resource = parent::getResource( $action );

                $show_log_msg = false;
                break;
        }

        if( $show_log_msg ) {
            $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
        }

        return $resource;
    }

    /**
     * Sends an API request to get the Objects. After requesting,
     * unserializes the received response into the array of Objects
     *
     * @param integer $virtual_machine_id Virtual Machine id
     * @param mixed   $url_args
     *
     * @return mixed an array of Object instances on success. Otherwise false
     * @access public
     */
    function getList( $virtual_machine_id = null, $url_args = null ) {
        if( is_null( $virtual_machine_id ) && ! is_null( $this->_virtual_machine_id ) ) {
            $virtual_machine_id = $this->_virtual_machine_id;
        }

        if( ! is_null( $virtual_machine_id ) ) {
            $this->_virtual_machine_id = $virtual_machine_id;

            return parent::getList();
        }
        else {
            $this->logger->error(
                'getList: argument _virtual_machine_id not set.',
                __FILE__,
                __LINE__
            );
        }
    }

    /**
     * Gets Backups List by Disk Id
     *
     * @param mixed $disk_id Disk Id
     *
     * @return response object
     */
    function diskBackups( $disk_id = null ) {
        if( $disk_id ) {
            $this->_disk_id = $disk_id;
        }

        $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_DISK_BACKUPS ) );

        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_GET );

        if( ! empty( $response[ 'errors' ] ) ) {
            $this->errors = $response[ 'errors' ];

            return false;
        }

        $result = $this->castStringToClass( $response );

        return ( is_array( $result ) || ! $result ) ? $result : array( $result );
    }

    /**
     * Convert backup to template
     *
     * @param string $label The label of new template
     *
     * @return mixed serialized Object instance from API
     */
    function convert( $label ) {
        $this->logger->add( 'Convert backup to template.' );

        $this->_label = $label;

        $this->fields[ 'label' ] = array(
            ONAPP_FIELD_MAP      => '_label',
            ONAPP_FIELD_REQUIRED => true,
        );

        $data = array(
            'root' => $this->_tagRoot,
            'data' => array(
                'label' => $label,
                'id'    => $this->_id
            )
        );
        // workaround because we get template data in response
        $this->_tagRoot  = 'image_template';
        $this->className = 'OnApp_Template';
        $template        = new OnApp_Template();
        $template->initFields( $this->getAPIVersion() );
        $this->fields = $template->getClassFields();
        $this->sendPost( ONAPP_GETRESOURCE_BACKUP_CONVERT, $data );
    }

    /**
     * Restore backup
     *
     * @access public
     */
    function restore() {
        $this->setAPIResource( $this->getResource( ONAPP_GETRESOURCE_BACKUP_RESTORE ) );
        $response   = $this->sendRequest( ONAPP_REQUEST_METHOD_POST );
        $result     = $this->_castResponseToClass( $response );
        $this->_obj = $result;
    }
}
