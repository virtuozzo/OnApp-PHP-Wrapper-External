<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * VM Snapshot
 *
 * @category        API wrapper
 * @package         OnApp
 * @subpackage      VirtualMachine
 * @author
 * @copyright       © 2011 OnApp
 * @link            http://www.onapp.com/
 * @see             OnApp
 */

/**
 * @todo: Add description
 */
define( 'ONAPP_GETRESOURCE_SNAPSHOT_RESTORE', 'restore' );

/**
 * @todo: Add description
 */
define( 'ONAPP_GETRESOURCE_SNAPSHOT_BUILD', 'build' );

/**
 * VM Snapshot
 *
 * This class represents the Snapshots which have been taken or are waiting to be taken for Virtual Machine.
 *
 * The OnApp_VirtualMachine_Snapshot class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_VirtualMachine_Snapshot extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'virtual_machine_snapshot';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'snapshots';

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
            case 4.0:
            case 4.1:
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
                    'is_built'                => array(
                        ONAPP_FIELD_MAP       => '_is_built',
                        ONAPP_FIELD_TYPE      => 'boolean',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'name'                 => array(
                        ONAPP_FIELD_MAP       => '_name',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'virtual_machine_id'                     => array(
                        ONAPP_FIELD_MAP       => '_virtual_machine_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'memory'                 => array(
                        ONAPP_FIELD_MAP       => '_memory',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'quiesce'                 => array(
                        ONAPP_FIELD_MAP       => '_quiesce ',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),

                );
                break;
            case 4.2:
                $this->fields = $this->initFields( 4.1 );
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
                 * @name virtual_machine_snapshot
                 * @method GET
                 * @alias    /virtual_machines/:virtual_machine_id/snapshots(.:format)
                 * @format    {:controller=>"snapshots", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method DELETE
                 * @alias    /virtual_machines/:virtual_machine_id/snapshots(.:format)
                 * @format    {:controller=>"snapshots", :action=>"destroy"}
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
                 * @alias    /virtual_machines/:virtual_machine_id/snapshots(.:format)
                 * @format    {:controller=>"snapshots", :action=>"create"}
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

            case ONAPP_GETRESOURCE_SNAPSHOT_RESTORE:
                /**
                 * ROUTE :
                 *
                 * @name restore_snapshot
                 * @method GET
                 * @alias      /snapshots/:id/restore(.:format)
                 * @format      {:controller=>"snapshots", :action=>"restore"}
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/restore';
                break;

            case ONAPP_GETRESOURCE_SNAPSHOT_BUILD:
                /**
                 * ROUTE :
                 *
                 * @name build_snapshot
                 * @method GET
                 * @alias      /virtual_machines/:id/build(.:format)
                 * @format      {:controller=>"snapshots", :action=>"build"}
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

                $resource = '/virtual_machines/' . $this->_virtual_machine_id . '/build';
                break;

            default:
                $resource = parent::getResource( $action );

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
     * Restore snapshot
     *
     * @access public
     */
    function restore() {
        $this->sendGet(ONAPP_GETRESOURCE_SNAPSHOT_RESTORE);
    }

    /**
     * Build snapshot
     *
     * @access public
     */
    function build() {
        $this->sendGet(ONAPP_GETRESOURCE_SNAPSHOT_BUILD);
    }

    /**
     * Create snapshot
     *
     * @access public
     */
    function create() {
        $this->sendPost(ONAPP_GETRESOURCE_DEFAULT);
    }
}
