<?php

/**
 * Managing IntegratedStorage DataStoreDisk
 *
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Mykola Vuy
 * @copyright   © 2018 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 * Managing IntegratedStorage DataStoreDisk
 *
 * The OnApp_IntegratedStorage_DataStoreDisk class is the parent of the OnApp class.
 *
 * The OnApp_IntegratedStorage_DataStoreDisk uses the following basic methods:
 * {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */
class OnApp_IntegratedStorage_DataStoreDisk extends OnApp {
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
    var $_resource = 'storage';

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
                $this->fields               = array(
                    'id' => array(
                        ONAPP_FIELD_MAP   => '_id',
                        ONAPP_FIELD_TYPE  => 'string',
                    ),
                    'nodes'                 => array(
                        ONAPP_FIELD_MAP   => '_nodes',
                        ONAPP_FIELD_CLASS => 'OnApp_IntegratedStorage_Nodes',
                    ),

                    'hypervisor_group_id'   => array(
                        ONAPP_FIELD_MAP   => '_hypervisor_group_id',
                        ONAPP_FIELD_TYPE  => 'string',
                    ),
                    'storage_data_store_id' => array(
                        ONAPP_FIELD_MAP   => '_storage_data_store_id',
                        ONAPP_FIELD_TYPE  => 'string',
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
                 * @name IntegratedStorage DataStoreDisk
                 * @method GET
                 * @alias   /storage/:hypervisor_group_id/data_stores/:storage_data_store_id/disks/storage_disk_id(.:format)
                 * @format  {:controller=>"BillingBucket_RateCards", :action=>"index"}
                 */
                if ( is_null( $this->_hypervisor_group_id ) && is_null( $this->_obj->_hypervisor_group_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _hypervisor_group_id not set.",
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_hypervisor_group_id ) ) {
                        $this->_hypervisor_group_id = $this->_obj->_hypervisor_group_id;
                    }
                }

                if ( is_null( $this->_storage_data_store_id ) && is_null( $this->_obj->_storage_data_store_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _storage_data_store_id not set.",
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_storage_data_store_id ) ) {
                        $this->_storage_data_store_id = $this->_obj->_storage_data_store_id;
                    }
                }
                if ( is_null( $this->_id ) && is_null( $this->_obj->_id ) ) {
                    $this->logger->error(
                        "getResource($action): argument _id not set.",
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_id ) ) {
                        $this->_id = $this->_obj->_id;
                    }
                }

                $resource = $this->_resource . '/' . $this->_hypervisor_group_id . '/data_stores/' . $this->_storage_data_store_id . '/disks/' . $this->_id;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    /**
     * Activates action performed with object
     *
     * @param string $action_name the name of action
     *
     * @access public
     */
    function activateCheck( $action_name ) {
        switch ( $action_name ) {
            case ONAPP_ACTIVATE_LOAD:
            case ONAPP_ACTIVATE_SAVE:
            case ONAPP_ACTIVATE_DELETE:
                exit( 'Call to undefined method ' . __CLASS__ . '::' . $action_name . '()' );
                break;
        }
    }
}
