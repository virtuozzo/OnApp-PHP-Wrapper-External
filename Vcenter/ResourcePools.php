<?php
/**
 * Vcenter_ResourcePools
 * 
 * much they will be charged per unit.
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Mykola Vuy
 * @copyright   © 2020 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */
/**
 * @var ONAPP_EDIT_VCENTER_RESOURCE_POOL
 */
define( 'ONAPP_EDIT_VCENTER_RESOURCE_POOL', 'edit_vcenter_resource_pool' );

/**
 * @var ONAPP_CHANGE_VCENTER_RESOURCE_POOL_OWNER
 */
define('ONAPP_CHANGE_VCENTER_RESOURCE_POOL_OWNER', 'ovner');
/**
 * Vcenter_ResourcePools
 *
 * The OnApp_Vcenter_ResourcePools class uses the following basic methods:
 * {@link load} {@link save} {@link delete} and {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php )
 */

class OnApp_Vcenter_ResourcePools extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'vcenter_resource_pool';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'vcenter/resource_pools';

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
            case 6.4:
                $this->fields = array(
                    'id'            => array(
                        ONAPP_FIELD_MAP         => '_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                        ONAPP_FIELD_READ_ONLY   => true,
                    ),
                    'label'         => array(
                        ONAPP_FIELD_MAP         => '_label',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'identifier'    => array(
                        ONAPP_FIELD_MAP         => '_identifier',
                        ONAPP_FIELD_TYPE        => 'string',
                    ),
                    'cluster_id'    => array(
                        ONAPP_FIELD_MAP         => '_cluster_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'parent_id'     => array(
                        ONAPP_FIELD_MAP         => '_parent_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'user_id'       => array(
                        ONAPP_FIELD_MAP         => '_user_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'hypervisor_id'  => array(
                        ONAPP_FIELD_MAP         => '_hypervisor_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                    'owner_id'      => array(
                        ONAPP_FIELD_MAP         => '_owner_id',
                        ONAPP_FIELD_TYPE        => 'integer',
                    ),
                );
                break;

            case 6.5:
                $this->fields = $this->initFields( 6.4 );
                break;

            case 6.6:
                $this->fields = $this->initFields( 6.5 );
                break;
        }
        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DEFAULT:
                /**
                 * ROUTE :
                 *
                 * @name Get List of Resource Pools
                 * @method GET
                 * @alias  /vcenter/resource_pools(.:format)
                 * @format {:controller=>"TemplateRoles", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Add vCenter Resource Pool
                 * @method POST
                 * @alias  /vcenter/resource_pools(.:format)
                 * @format {:controller=>"TemplateRoles", :action=>"load"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Edit vCenter Resource Pool
                 * @method PATCH
                 * @alias  /vcenter/resource_pools/:id(.:format)
                 * @format {:controller=>"TemplateRoles", :action=>"load"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name Delete vCenter Resource Pool
                 * @method DELETE
                 * @alias  /vcenter/resource_pools/:id(.:format)
                 * @format {:controller=>"TemplateRoles", :action=>"load"}
                 */

                $resource = $this->_resource;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            case ONAPP_EDIT_VCENTER_RESOURCE_POOL:
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

                $resource = $this->_resource . '/' . $this->_id;
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            case ONAPP_CHANGE_VCENTER_RESOURCE_POOL_OWNER:
                /**
                 * @name Change vCenter Resource Pool Owner
                 * @method PUT
                 * @alias  /vcenter/resource_pools/:owner_id/owner(.:format)
                 * @format {:controller=>"TemplateRoles", :action=>"changeVCenterResourcePoolOwner"}
                 */

                if ( is_null( $this->_owner_id ) && is_null( $this->_obj->_owner_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _owner_id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_owner_id ) ) {
                        $this->_owner_id = $this->_obj->_owner_id;
                    }
                }

                $resource = $this->_resource . '/' . $this->_owner_id . '/owner';
                $this->logger->debug( 'getResource( ' . $action . ' ): return ' . $resource );
                break;

            default:
                $resource = parent::getResource( $action );
                break;
        }

        return $resource;
    }

    public function save()
    {
        if (is_null($this->_id)) {
            parent::save();
        } else {
            $data = $this->getSerializedDataToSend();
            $this->sendPatch( ONAPP_EDIT_VCENTER_RESOURCE_POOL, $data);
        }
    }

    public function changeVCenterResourcePoolOwner($newOwnerID)
    {
        $data = array(
            'owner_change' => array(
                'new_owner_id' => $newOwnerID
            ),
        );

        $dataJSON = json_encode($data);
        $this->setAPIResource( $this->getResource( ONAPP_CHANGE_VCENTER_RESOURCE_POOL_OWNER ) );
        $response = $this->sendRequest( ONAPP_REQUEST_METHOD_PUT, $dataJSON );

        $result     = $this->_castResponseToClass( $response );
        $this->_obj = $result;
    }
}
