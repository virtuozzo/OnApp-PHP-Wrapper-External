<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Managing Disks
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Vitaliy Kondratyuk
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 *
 */
define( 'ONAPP_GETRESOURCE_AUTOBACKUP_ENABLE', 'autobackup_enable' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_AUTOBACKUP_DISABLE', 'autobackup_disable' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_TAKE_BACKUP', 'backups' );

define( 'ONAPP_GERRESOURCE_MIGRATE', 'migrate');

/**
 * Managing Disks
 *
 * The OnApp_Disk class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_Disk extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'disk';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/disks';

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
            case '2.1':
            case 2.2:
            case 2.3:
                $this->fields = array(
                    'id'                 => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'created_at'         => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'updated_at'         => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'add_to_linux_fstab' => array(
                        ONAPP_FIELD_MAP  => '_add_to_linux_fstab',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'disk_size'          => array(
                        ONAPP_FIELD_MAP      => '_disk_size',
                        ONAPP_FIELD_TYPE     => 'integer',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'primary'            => array(
                        ONAPP_FIELD_MAP       => '_primary',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'data_store_id'      => array(
                        ONAPP_FIELD_MAP      => '_data_store_id',
                        ONAPP_FIELD_TYPE     => 'integer',
                        ONAPP_FIELD_REQUIRED => true,
                    ),
                    'disk_vm_number'     => array(
                        ONAPP_FIELD_MAP       => '_disk_vm_number',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'is_swap'            => array(
                        ONAPP_FIELD_MAP  => '_is_swap',
                        ONAPP_FIELD_TYPE => 'boolean',
                    ),
                    'mount_point'        => array(
                        ONAPP_FIELD_MAP => '_mount_point',
                    ),
                    'identifier'         => array(
                        ONAPP_FIELD_MAP => '_identifier',
                    ),
                    'file_system'         => array(
                        ONAPP_FIELD_MAP       => '_file_system',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'virtual_machine_id' => array(
                        ONAPP_FIELD_MAP       => '_virtual_machine_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'require_format_disk' => array(
                        ONAPP_FIELD_MAP       => '_require_format_disk',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'built'              => array(
                        ONAPP_FIELD_MAP       => '_built',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'locked'             => array(
                        ONAPP_FIELD_MAP       => '_locked',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'has_autobackups'    => array(
                        ONAPP_FIELD_MAP               => '_has_autobackups',
                        ONAPP_FIELD_TYPE              => 'boolean',
                        ONAPP_FIELD_READ_ONLY         => true,
                        ONAPP_FIELD_SKIP_FROM_REQUEST => true,
                    ),
                );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
                $this->fields = $this->initFields( 2.3 );
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
        switch( $action ) {
            case ONAPP_GETRESOURCE_LIST:
                /**
                 * ROUTE :
                 *
                 * @name virtual_machine_disks
                 * @method GET
                 * @alias  /virtual_machines/:virtual_machine_id/disks(.:format)
                 * @format {:controller=>"disks", :action=>"index"}
                 */
                $resource = $this->_virtual_machine_id ?
                    'virtual_machines/' . $this->_virtual_machine_id . '/disks' :
                    $this->getResource();
                break;

            case ONAPP_GETRESOURCE_ADD:
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias     /virtual_machines/:virtual_machine_id/disks(.:format)
                 * @format    {:controller=>"disks", :action=>"create"}
                 */
                if( is_null( $this->_virtual_machine_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _virtual_machine_id not set.',
                        __FILE__,
                        __LINE__
                    );
                }
                else {
                    $resource = 'virtual_machines/' . $this->_virtual_machine_id . '/disks';
                }
                break;

            case ONAPP_GETRESOURCE_AUTOBACKUP_ENABLE:
                /**
                 * ROUTE :
                 *
                 * @name autobackup_enable_disk
                 * @method POST
                 * @alias     /settings/disks/:id/autobackup_enable(.:format)
                 * @format    {:controller=>"disks", :action=>"autobackup_enable"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/autobackup_enable';
                break;

            case ONAPP_GETRESOURCE_AUTOBACKUP_DISABLE:
                /**
                 * ROUTE :
                 *
                 * @name autobackup_disable_disk
                 * @method POST
                 * @alias  /settings/disks/:id/autobackup_disable(.:format)
                 * @format {:controller=>"disks", :action=>"autobackup_disable"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/autobackup_disable';
                break;

            case ONAPP_GETRESOURCE_TAKE_BACKUP:
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias  /settings/disks/:disk_id/backups(.:format)
                 * @format {:controller=>"backups", :action=>"create"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/backups';
                break;

			case ONAPP_GETRESOURCE_MIGRATE:
				/**
				 * ROUTE :
				 * @name migrate
				 * @method POST
				 * @format {:controller=>"disks", :action=>"migrate"}
				 */
				if( is_null( $this->_virtual_machine_id ) ) {
					$this->logger->error(
						'getResource( ' . $action . ' ): argument _virtual_machine_id not set.',
						__FILE__,
						__LINE__
					);
				}
				elseif( is_null( $this->_id ) ) {
					$this->logger->error(
						'getResource( ' . $action . ' ): argument _id not set.',
						__FILE__,
						__LINE__
					);
				}
				else {
					$resource = 'virtual_machines/' . $this->_virtual_machine_id . '/disks/'. $this -> _id .'/migrate';
				}
				break;

            default:
                /**
                 * ROUTE :
                 *
                 * @name disks
                 * @method GET
                 * @alias     /settings/disks(.:format)
                 * @format    {:controller=>"disks", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name disk
                 * @method GET
                 * @alias     /settings/disks/:id(.:format)
                 * @format    {:controller=>"disks", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias     /settings/disks(.:format)
                 * @format    {:controller=>"disks", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method PUT
                 * @alias  /settings/disks/:id(.:format)
                 * @format {:controller=>"disks", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method DELETE
                 * @alias  /settings/disks/:id(.:format)
                 * @format {:controller=>"disks", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
                break;
        }

        $actions = array(
            ONAPP_GETRESOURCE_LIST,
            ONAPP_GETRESOURCE_ADD,
            ONAPP_GETRESOURCE_AUTOBACKUP_ENABLE,
            ONAPP_GETRESOURCE_AUTOBACKUP_DISABLE,
			ONAPP_GETRESOURCE_MIGRATE,
        );

        if( in_array( $action, $actions ) ) {
            $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
        }

        return $resource;
    }

    /**
     * Enable autobackup
     *
     * @param null $id
     *
     * @return void
     */
    function enableAutobackup( $id = null ) {
        if( $id ) {
            $this->_id = $id;
        }
        $this->sendPost( ONAPP_GETRESOURCE_AUTOBACKUP_ENABLE, '' );
    }

    /**
     * Disable autobackup
     *
     * @param null $id
     *
     * @return void
     */
    function disableAutobackup( $id = null ) {
        if( $id ) {
            $this->_id = $id;
        }

        $this->sendPost( ONAPP_GETRESOURCE_AUTOBACKUP_DISABLE, '' );
    }

    /**
     * Sends an API request to get the Objects. After requesting,
     * unserializes the received response into the array of Objects
     *
     * @param integer $vm_id VM ID
     *
     * @return mixed an array of Object instances on success. Otherwise false
     * @access public
     */
    function getList( $vm_id = null, $url_args = null ) {
        if( $vm_id ) {
            $this->_virtual_machine_id = $vm_id;
        }

        return parent::getList();
    }

    /**
     * The method saves an Object to your account
     *
     * @param integer $vm_id VM ID
     *
     * @return mixed Serialized API Response
     * @access private
     */
    function save() {
        if( $this->_virtual_machine_id ) {
            $this->fields[ 'require_format_disk' ] = array(
                ONAPP_FIELD_MAP           => '_require_format_disk',
                ONAPP_FIELD_TYPE          => 'integer',
                ONAPP_FIELD_REQUIRED      => true,
                ONAPP_FIELD_DEFAULT_VALUE => false,
            );
        }

        if( $this->_id ) {
            $this->fields[ 'add_to_linux_fstab' ][ ONAPP_FIELD_REQUIRED ] = false;
            $this->fields[ 'data_store_id' ][ ONAPP_FIELD_REQUIRED ] = false;
            $this->fields[ 'is_swap' ][ ONAPP_FIELD_REQUIRED ] = false;
            $this->fields[ 'mount_point' ][ ONAPP_FIELD_REQUIRED ] = false;
        }

        return parent::save();
    }

    /**
     * Takes Disk Backup
     *
     * @param integer $disk_id Disk Id
     *
     * @return void
     */
    function takeBackup( $disk_id ) {
        if( $disk_id ) {
            $this->_id = $disk_id;
        }
        // workaround because we get backup data in response
        $this->_tagRoot = 'backup';
        $this->className = 'OnApp_VirtualMachine_Backup';
        $backup = new OnApp_VirtualMachine_Backup();
        $backup->initFields( $this->getAPIVersion() );
        $this->fields = $backup->getClassFields();
        $this->sendPost( ONAPP_GETRESOURCE_TAKE_BACKUP );
    }

	/**
	 * Migrates disk to different data store
	 *
	 * @param integer $id virtual machine id
	 * @param     $data_store_id
	 * @access 	public
	 */
	function migrate( $data_store_id, $id = NULL ) {
		if( $id ) {
			$this->_id = $id;
		}
		$data = array(
			'root' => 'tmp_holder',
			'data' => array(
				'disk' => array(
					'data_store_id' => $data_store_id
				)
			)
		);
		$this->sendPost( ONAPP_GETRESOURCE_MIGRATE, $data );
	}
}
