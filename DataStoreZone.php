<?php
/**
 * Data Store Zone
 *
 * @todo        Add description
 *
 * @category    API wrapper
 * @package     OnApp
 * @author      Andrew Yatskovets
 * @copyright   © 2011 OnApp
 * @link        http://www.onapp.com/
 * @see         OnApp
 */

/**
 *
 */
define( 'ONAPP_GETRESOURCE_DATASTOREZONE_WITHDATASTOREID', 'datastorezone_withdatastoreid' );

/**
 *
 */
define( 'ONAPP_GETRESOURCE_DATASTOREZONE_ATTACH', 'datastorezone_attach' );

/**
 *
 * Managing Data Store Zones
 *
 * The OnApp_Disk class uses the following basic methods:
 * {@link load}, {@link save}, {@link delete}, {@link getList}.
 *
 * For full fields reference and curl request details visit: ( http://help.onapp.com/manual.php?m=2 )
 */
class OnApp_DataStoreZone extends OnApp {
    /**
     * root tag used in the API request
     *
     * @var string
     */
    var $_tagRoot = 'data_store_group';
    /**
     * alias processing the object data
     *
     * @var string
     */
    var $_resource = 'settings/data_store_zones';

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
            case '2.0':
                $this->fields = array(
                    'id'         => array(
                        ONAPP_FIELD_MAP       => '_id',
                        ONAPP_FIELD_TYPE      => 'integer',
                        ONAPP_FIELD_READ_ONLY => true
                    ),
                    'created_at' => array(
                        ONAPP_FIELD_MAP       => '_created_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'updated_at' => array(
                        ONAPP_FIELD_MAP       => '_updated_at',
                        ONAPP_FIELD_TYPE      => 'datetime',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                    'label'      => array(
                        ONAPP_FIELD_MAP       => '_label',
                        ONAPP_FIELD_TYPE      => 'string',
                        ONAPP_FIELD_READ_ONLY => true,
                    ),
                );
                break;

            case 2.1:
            case 2.2:
            case 2.3:
                $this->fields = $this->initFields( '2.0' );
                break;

            case 3.0:
            case 3.1:
            case 3.2:
            case 3.3:
            case 3.4:
            case 3.5:
            case 4.0:
            case 4.1:
                $this->fields = $this->initFields( 2.3 );
                break;
            case 4.2:
                $this->fields = $this->initFields( 4.1 );

                $this->fields['preconfigured_only'] = array(
                    ONAPP_FIELD_MAP  => '_preconfigured_only',
                    ONAPP_FIELD_TYPE => 'boolean',
                );

                $this->fields['closed']             = array(
                    ONAPP_FIELD_MAP  => '_closed',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['default_burst_iops'] = array(
                    ONAPP_FIELD_MAP  => '_default_burst_iops',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['default_max_iops']   = array(
                    ONAPP_FIELD_MAP  => '_default_max_iops',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['draas_id']           = array(
                    ONAPP_FIELD_MAP  => '_draas_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['federation_enabled'] = array(
                    ONAPP_FIELD_MAP  => '_federation_enabled',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                $this->fields['federation_id']      = array(
                    ONAPP_FIELD_MAP  => '_federation_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['hypervisor_id']      = array(
                    ONAPP_FIELD_MAP  => '_hypervisor_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['identifier']         = array(
                    ONAPP_FIELD_MAP  => '_identifier',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['location_group_id']  = array(
                    ONAPP_FIELD_MAP  => '_location_group_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['min_disk_size']      = array(
                    ONAPP_FIELD_MAP  => '_min_disk_size',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                $this->fields['traded']             = array(
                    ONAPP_FIELD_MAP  => '_traded',
                    ONAPP_FIELD_TYPE => 'boolean',
                );
                break;

            case 4.3:
                $this->fields                    = $this->initFields( 4.2 );
                $this->fields['provider_vdc_id'] = array(
                    ONAPP_FIELD_MAP  => '_provider_vdc_id',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;

            case 5.0:
                $this->fields = $this->initFields( 4.3 );
                break;
            case 5.1:
                $this->fields = $this->initFields( 5.0 );
                break;
            case 5.2:
                $this->fields = $this->initFields( 5.1 );
                break;
            case 5.3:
                $this->fields = $this->initFields( 5.2 );
                $this->fields['server_type'] = array(
                    ONAPP_FIELD_MAP  => '_server_type',
                    ONAPP_FIELD_TYPE => 'string',
                );
                $this->fields['data_store_id'] = array(
                    ONAPP_FIELD_MAP  => '_data_store_id',
                    ONAPP_FIELD_TYPE => 'integer',
                );
                break;
            case 5.4:
                $this->fields = $this->initFields( 5.3 );
                break;
            case 5.5:
                $this->fields = $this->initFields( 5.4 );
                $this->fields['additional_fields'] = array(
                    ONAPP_FIELD_MAP  => '_additional_fields',
                    ONAPP_FIELD_TYPE => 'string',
                );
                break;
            case 6.0:
                $this->fields = $this->initFields( 5.5 );
                break;
        }

        parent::initFields( $version, __CLASS__ );

        return $this->fields;
    }

    function getResource( $action = ONAPP_GETRESOURCE_DEFAULT ) {
        switch ( $action ) {
            case ONAPP_GETRESOURCE_DATASTOREZONE_WITHDATASTOREID:
                /**
                 * @alias     /settings/data_store_zones/:data_store_zone_id/data_stores/:id/attach.json
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
                if ( is_null( $this->_data_store_id ) && is_null( $this->_obj->_data_store_id ) ) {
                    $this->logger->error(
                        'getResource( ' . $action . ' ): argument _data_store_id not set.',
                        __FILE__,
                        __LINE__
                    );
                } else {
                    if ( is_null( $this->_data_store_id ) ) {
                        $this->_data_store_id = $this->_obj->_data_store_id;
                    }
                }
                $resource = $this->getResource( ONAPP_GETRESOURCE_LOAD ) . '/data_stores/' . $this->_data_store_id;
                break;

            case ONAPP_GETRESOURCE_DATASTOREZONE_ATTACH:
                /**
                 * @alias     /settings/data_store_zones/:data_store_zone_id/data_stores/:id/attach.json
                 */
                $resource = $this->getResource( ONAPP_GETRESOURCE_DATASTOREZONE_WITHDATASTOREID ) . '/attach';
                break;

            default:
                /**
                 * ROUTE :
                 *
                 * @name user_data_store_groups
                 * @method GET
                 * @alias  /data_store_zones(.:format)
                 * @format {:controller=>"data_store_groups", :action=>"index"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name user_data_store_group
                 * @method GET
                 * @alias   /data_store_zones/:id(.:format)
                 * @format  {:controller=>"data_store_groups", :action=>"show"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method POST
                 * @alias   /data_store_zones(.:format)
                 * @format  {:controller=>"data_store_groups", :action=>"create"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method PUT
                 * @alias  /data_store_zones/:id(.:format)
                 * @format {:controller=>"data_store_groups", :action=>"update"}
                 */
                /**
                 * ROUTE :
                 *
                 * @name
                 * @method DELETE
                 * @alias  /data_store_zones/:id(.:format)
                 * @format {:controller=>"data_store_groups", :action=>"destroy"}
                 */
                $resource = parent::getResource( $action );
        }
        return $resource;
    }

    function attach( $datastore_id = null ) {
        if ( ! is_null( $datastore_id ) ) {
            $this->_datastore_id = $datastore_id;
        }
        $this->sendPost( ONAPP_GETRESOURCE_DATASTOREZONE_ATTACH );
    }

}
